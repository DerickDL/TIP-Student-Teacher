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
    public function addQuestion(Request $oRequest, $iLessonId)
    {
        $this->insertQuestion($oRequest->all(), $iLessonId);
    }

    public function loadQuestion(Request $oRequest, $iLessonId)
    {
        return response()->json($this->loadQuestions($iLessonId, ['question_difficulty' => $oRequest->all()['difficulty']]));
    }
}