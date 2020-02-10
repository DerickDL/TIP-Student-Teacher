<?php

namespace App\Logic;

use App\Model\modelCourses;
use App\Model\modelQuizzes;
use App\Model\modelExams;

class logicComputation
{

    private $aStudents;
    private $aIntegrations;
    private $aSectionDetails;
    private $iCreatorId;
    private $oModelCourses;
    private $oModelQuizzes;
    private $oModelExams;

    public function __construct(modelCourses $oModelCourses, modelQuizzes $oModelQuizzes, modelExams $oModelExams)
    {
        $this->oModelCourses = $oModelCourses;
        $this->oModelQuizzes = $oModelQuizzes;
        $this->oModelExams = $oModelExams;
    }
    
    public function startCompute($aData)
    {
        $this->initData($aData);
        $this->computeOverall();
    }

    private function initData($aData)
    {
        $this->aStudents = $aData['students'];
        $this->aIntegrations = $aData['integrations'];
        $this->aSectionDetails = $aData['section'];
        $this->iCreatorId = $aData['creator_id'];
    }

    private function computeOverall()
    {
        $aPrelims = [];
        $aCourses = $this->getCourses();
        $aQuizzes = $this->getQuizzes($aCourses);
        $aPrelimExam = $this->getExam(1);
        $aMidtermExam = $this->getExam(2);
        $aFinaltermExam = $this->getExam(3);
        foreach ($this->aStudents as $aStudentDetails) {         
            $iQuizPercent = 0;
            $iQuizPercent = $this->computeQuiz($aStudentDetails['id'], $aQuizzes);
            $iPrelimExamPercent = (count($aPrelimExam) > 0) ? $this->getUserExam($aPrelimExam[0]['id'], $aStudentDetails['id']) : 0;
            $iMidtermExamPercent = (count($aMidtermExam) > 0) ? $this->getUserExam($aMidtermExam[0]['id'], $aStudentDetails['id']) : 0;
            $iFinaltermExamPercent = (count($aFinaltermExam) > 0) ? $this->getUserExam($aFinaltermExam[0]['id'], $aStudentDetails['id']) : 0;
            $iPrelimGrade = $this->computePrelimGrade($iQuizPercent, $iPrelimExamPercent);
            $iMidtermGrade = $this->computeMidtermGrade($iQuizPercent, $iMidtermExamPercent, $iPrelimGrade);
        }
    }

    private function computePrelimGrade($iQuizPercent, $iPrelimExamPercent)
    {
        return ($iQuizPercent * .5) + ($iPrelimExamPercent * .5);
    }

    private function computeMidtermGrade($iQuizPercent, $iMidtermExamPercent, $iPrelimGrade)
    {
        return (.33 * $iPrelimGrade) + (.66 * (($iQuizPercent * .5) + ($iMidtermExamPercent * .5)));
    }

    private function computeFinaltermGrade($iQuizPercent, $iFinaltermExamPercent, $iMidtermGrade)
    {
        return (.33 * $iMidtermGrade) + (.66 * (($iQuizPercent * .5) + ($iFinaltermExamPercent * .5)));
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

    private function getExam($iType)
    {
        return $this->oModelExams->getExams(['course_id' => $this->aSectionDetails['integration_id'], 'creator_id' => $this->iCreatorId, 'type' => $iType]);
    }

    private function getUserExam($iExamId, $iUserId)
    {
        $oExam = $this->oModelExams->findExam($iExamId);
        $aScore = $oExam->users()->where(['user_id' => $iUserId])->get();
        return count($aScore) > 0 ? $aScore[0]['pivot']['percentage'] : 0;
    }
}