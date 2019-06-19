<?php

namespace App\Http\Traits;

use App\Logic\logicQuestions;
use App\Model\modelCourses;
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
        $this->logicQuestions = new logicQuestions(new modelCourses(), new modelQuestions(), new modelChoices());
    }

    public function insertQuestion($aRequest, $iLessonId)
    {
        $this->instantiateQuestions();
        $this->logicQuestions->insertQuestion($aRequest, $iLessonId);
    }

    public function loadQuestions($iLessonId, $aParams = [])
    {
        $this->instantiateQuestions();
        return $this->logicQuestions->loadQuestions($iLessonId, $aParams);
    }
}