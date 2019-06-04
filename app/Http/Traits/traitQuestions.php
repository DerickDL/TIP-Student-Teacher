<?php

namespace App\Http\Traits;

use App\Logic\logicQuestions;
use App\Model\modelLessons;
use App\Model\modelQuestions;
use App\Model\modelChoices;

trait traitQuestions
{
    /**
     * @var logicQuizzes
     */
    private $logicQuestions;

    /**
     * instantiate objects
     */
    private function instantiateQuestions()
    {
        $this->logicQuestions = new logicQuestions(new modelLessons(), new modelQuestions(), new modelChoices());
    }

    public function insertQuestion($aRequest, $iLessonId)
    {
        $this->instantiateQuestions();
        $this->logicQuestions->insertQuestion($aRequest, $iLessonId);
    }
}