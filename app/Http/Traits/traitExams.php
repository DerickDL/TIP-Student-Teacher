<?php

namespace App\Http\Traits;

use App\Logic\logicExams;
use App\Model\modelCourses;
use App\Model\modelExams;
use App\Model\modelQuestions;
use App\Model\modelChoices;

trait traitExams
{
    /**
     * @var logicExams
     */
    private $logicExams;

    /**
     * instantiate objects
     */
    private function instantiateExams()
    {
        $this->logicExams = new logicExams(new modelCourses(), new modelExams(), new modelQuestions(), new modelChoices());
    }

    /**
     * @param $iExamId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getExams($aParam = [])
    {
        $this->instantiateExams();
        return $this->logicExams->getExams($aParam);
    }

    /**
     * @param $aParam
     * @return mixed
     */
    public function getLatestExams($aParam)
    {
        $this->instantiateExams();
        return $this->logicExams->getLatestExams($aParam);
    }

    public function getQuestions($iExamId)
    {
        $this->instantiateExams();
        return $this->logicExams->getQuestions($iExamId);
    }

    public function getChoices($aData)
    {
        $this->instantiateExams();
        return $this->logicExams->getChoices($aData);
    }

    /**
     * insert quiz
     * @param $aRequest
     */
    public function addExam($aRequest)
    {
        $this->instantiateExams();
        $this->logicExams->insertExam($aRequest);
    }

    /**
     * @param $iExamId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getExamScore($iExamId, $iUserId)
    {
        $this->instantiateExams();
        return $this->logicExams->getExamScore($iExamId, $iUserId);
    }
}