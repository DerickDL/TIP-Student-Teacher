<?php

namespace App\Logic;

use App\Model\modelCourses;
use App\Model\modelQuizzes;
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
        $aStudents = $this->getStudents($iTeacherId);
        $aStudents = $this->filterStudentsData($aStudents);
        $aStudentQuizzesData = $this->getStudentQuizGraphData($aStudents, $aQuizzesId);
        return [
            'courses' => $aCoursesTitles,
            'students_data' => $aStudentQuizzesData
        ];
        // dd($aCoursesTitles, $aQuizzesId, $aStudents, $aStudentQuizzesData);
    }

    private function getStudents($iTeacherId)
    {
        $aStudents = [];
        $aSections = $this->oModelSections->getSections(['user_id' => $iTeacherId]);
        foreach($aSections as $aSection) {
            $aSectionStudents = $this->oModelSections->findSection(($aSection['id']))->users()->get()->toArray();
            $aStudents = count($aStudents) > 0 ? array_merge($aStudents, $aSectionStudents) : $aSectionStudents;
        }
        return $aStudents;
    }

    private function filterStudentsData($aStudents)
    {
        $aFilteredStudentsData = [];
        foreach ($aStudents as $aStudent) {
            $aFilteredStudentsData[] = [
                'id' => $aStudent['id'],
                'name' => $aStudent['first_name'] . ' ' . $aStudent['last_name']
            ];
        }
        return $aFilteredStudentsData;
    }

    private function getStudentQuizGraphData($aStudents, $aQuizzesId)
    {
        foreach ($aStudents as $aStudent) {
            $aStudentQuizzesPercentage = [];
            foreach ($aQuizzesId as $iQuizId) {
                $aStudentQuizzesPercentage[] = $this->getStudentQuizPercentage($aStudent, $iQuizId);
            }
            $rand_color = '#' . substr(md5(mt_rand()), 0, 6);
            $aStudentQuizzesData[] = [
                'label' => $aStudent['name'],
                'data' => $aStudentQuizzesPercentage,
                'backgroundColor' => $rand_color
            ];
        }
        return $aStudentQuizzesData;
    }

    private function getStudentQuizPercentage($aStudent, $iQuizId)
    {
        $oQuiz = $this->oModelQuizzes->findQuiz($iQuizId);
        $aStudentQuizPercentage = $oQuiz->users()->where(['user_id' => $aStudent])->get();
        return count($aStudentQuizPercentage) > 0 ? $aStudentQuizPercentage[0]['pivot']['percentage'] : 0;
    }
}