<?php

namespace App\Http\Controllers\Questions;

use App\Http\Controllers\Controller;
use App\Http\Traits\traitQuestions;
use Illuminate\Http\Request;

class restQuestions extends Controller
{
    use traitQuestions;

    /**
     * @param Request $oRequest
     * @param         $iLessonId
     */
    public function addQuiz(Request $oRequest, $iLessonId)
    {
        $this->insertQuestion($oRequest->all(), $iLessonId);
    }
}