<?php

namespace App\Logic;

use App\Model\modelCourses;
use App\Model\modelQuizzes;

class logicComputation
{

    private $aStudents;
    private $aIntegrations;
    private $aSectionDetails;
    private $iCreatorId;
    private $oModelCourses;
    private $oModelQuizzes;

    public function __construct(modelCourses $oModelCourses, modelQuizzes $oModelQuizzes)
    {
        $this->oModelCourses = $oModelCourses;
        $this->oModelQuizzes = $oModelQuizzes;
    }
    
    public function startCompute($aData)
    {
        $this->initData($aData);
        $this->computePrelims();
    }

    private function initData($aData)
    {
        $this->aStudents = $aData['students'];
        $this->aIntegrations = $aData['integrations'];
        $this->aSectionDetails = $aData['section'];
        $this->iCreatorId = $aData['creator_id'];
    }

    private function computePrelims()
    {
        $aPrelims = [];
        $aCourses = $this->getCourses();
        $aQuizzes = $this->getQuizzes($aCourses);
        foreach ($this->aStudents as $aStudentDetails) {         
            $iQuizGrade = $this->computeQuiz($aStudentDetails['id'], $aQuizzes);
            //@TODO get prelim exam
        }
    }

    private function computeQuiz($iUserId, $aQuizzes)
    {
        $iTotalPercentage = 0;
        foreach ($aQuizzes as $aQuiz) {
            $oQuiz = $this->oModelQuizzes->findQuiz($aQuiz['id']);
            $aScore = $oQuiz->users()->where(['user_id' => $iUserId])->get();
            $iTotalPercentage += count($aScore) > 0 ? $aScore[0]['pivot']['percentage'] : 0;
        }
        return $iTotalPercentage / count($aQuizzes);
    }

    private function getCourses()
    {
        return $this->oModelCourses->getCourses(['user_id' => $this->iCreatorId, 'integrated_course_id' => $this->aSectionDetails['integration_id']]);
    }

    private function getQuizzes($aCourses)
    {
        $aQuizzes = [];
        foreach ($aCourses as $aCourseDetail) {
            $aCourseQuizzes = $aCourseDetail->quizzes;
            foreach ($aCourseQuizzes as $aQuiz) {
                $aQuizzes[] = $aQuiz;
            }
        }
        return $aQuizzes;
    }
}