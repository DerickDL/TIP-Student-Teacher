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
        $aGrades = $this->computeOverall();
        $aGroupedGrades = $this->countGradeFrequency($aGrades);
        return $aGroupedGrades;
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
        $aGrades = [];
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
            $iFinaltermGrade = $this->computeFinaltermGrade($iQuizPercent, $iFinaltermExamPercent, $iMidtermGrade);
            $aGrades[] = $iFinaltermGrade;
        }
        return $aGrades;
    }

    private function countGradeFrequency($aGrades)
    {
        $aFrequency = ['1' => 0, '1.25' => 0, '1.5' => 0, '1.75' => 0, '2' => 0, '2.25' => 0, '2.5' => 0, '2.75' => 0, '3' => 0, '4' => 0, '5' => 0];
        for ($i = 0; $i < count($aGrades); $i++) {
            if ($aGrades[$i] <= 100 && $aGrades[$i] >= 96) {
                $aFrequency['1'] += 1;
            } else if ($aGrades[$i] <= 95 && $aGrades[$i] >= 91) {
                $aFrequency['1.25'] += 1;
            } else if ($aGrades[$i] <= 90 && $aGrades[$i] >= 86) {
                $aFrequency['1.5'] += 1;
            } else if ($aGrades[$i] <= 85 && $aGrades[$i] >= 81) {
                $aFrequency['1.75'] += 1;
            } else if ($aGrades[$i] <= 80 && $aGrades[$i] >= 76) {
                $aFrequency['2'] += 1;
            } else if ($aGrades[$i] <= 75 && $aGrades[$i] >= 71) {
                $aFrequency['2.25'] += 1;
            } else if ($aGrades[$i] <= 70 && $aGrades[$i] >= 66) {
                $aFrequency['2.5'] += 1;
            } else if ($aGrades[$i] <= 65 && $aGrades[$i] >= 61) {
                $aFrequency['2.75'] += 1;
            } else if ($aGrades[$i] <= 60 && $aGrades[$i] >= 56) {
                $aFrequency['3'] += 1;
            } else if ($aGrades[$i] <= 55 && $aGrades[$i] >= 51) {
                $aFrequency['4'] += 1;
            } else {
                $aFrequency['5'] += 1;
            } 
        }
        return $aFrequency;
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