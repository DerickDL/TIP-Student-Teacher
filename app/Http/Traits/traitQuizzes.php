<?php

namespace App\Http\Traits;

use App\Logic\logicQuizzes;
use App\Model\modelCourses;
use App\Model\modelQuizzes;
use App\Model\modelQuestions;
use App\Model\modelChoices;

trait traitQuizzes
{
    /**
     * @var logicQuizzes
     */
    private $logicQuizzes;

    /**
     * instantiate objects
     */
    private function instantiateQuizzes()
    {
        $this->logicQuizzes = new logicQuizzes(new modelCourses(), new modelQuizzes(), new modelQuestions(), new modelChoices());
    }

    /**
     * @param $iQuizId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getQuizzes($aParam = [])
    {
        $this->instantiateQuizzes();
        return $this->logicQuizzes->getQuizzes($aParam);
    }

    /**
     * @param $aParam
     * @return mixed
     */
    public function getLatestQuizzes($aParam)
    {
        $this->instantiateQuizzes();
        return $this->logicQuizzes->getLatestQuizzes($aParam);
    }

    public function getQuestions($iQuizId)
    {
        $this->instantiateQuizzes();
        return $this->logicQuizzes->getQuestions($iQuizId);
    }

    public function getChoices($aData)
    {
        $this->instantiateQuizzes();
        return $this->logicQuizzes->getChoices($aData);
    }

    /**
     * insert quiz
     * @param $aRequest
     */
    public function addQuiz($aRequest)
    {
        $this->instantiateQuizzes();
        $this->logicQuizzes->insertQuiz($aRequest);
    }

    /**
     * @param $iQuizId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getQuizScore($iQuizId, $iUserId)
    {
        $this->instantiateQuizzes();
        return $this->logicQuizzes->getQuizScore($iQuizId, $iUserId);
    }

    public function removeQuiz($iQuizId)
    {
        $this->instantiateQuizzes();
        $this->logicQuizzes->deleteQuiz($iQuizId);
    }
}