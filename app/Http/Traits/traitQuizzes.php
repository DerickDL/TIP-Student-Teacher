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
    public function getQuizzes($iQuizId = '')
    {
        $this->instantiateQuizzes();
        return $this->logicQuizzes->getQuizzes($iQuizId);
    }
}