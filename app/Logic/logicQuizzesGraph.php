<?php

namespace App\Logic;

use App\Model\modelCourses;
use App\Model\modelQuizzes;
use App\Model\modelExams;
use App\Model\modelSections;

class logicQuizzesGraph
{

    private $oModelSections;
    private $oModelCourses;
    private $oModelQuizzes;

    public function __construct(modelSections $oModelSections, modelCourses $oModelCourses, modelQuizzes $oModelQuizzes)
    {
        $this->oModelSections = $oModelSections;
        $this->oModelCourses = $oModelCourses;
        $this->oModelQuizzes = $oModelQuizzes;
    }

    public function getGraphQuizzes($iTeacherId)
    {
        $aCoursesTitles = [];
        $aQuizzesId = [];
        $aCourses = $this->oModelCourses->getCourses(['user_id' => $iTeacherId]);
        foreach ($aCourses as $aCourse) {
            $aQuiz = $this->oModelQuizzes->getQuizzes(['course_id' => $aCourse['id']]);
            if (count($aQuiz) > 0) {
                $aCoursesTitles[] = $aCourse['course_title'];
                $aQuizzesId[] = $aQuiz[0]['id'];
            }
        }
        dd($aCoursesTitles, $aQuizzesId);
    }
}