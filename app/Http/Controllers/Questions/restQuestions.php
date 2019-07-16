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
    public function addQuestion(Request $oRequest, $iCourseId)
    {
        $this->insertQuestion($oRequest->all(), $iCourseId);
    }

    public function loadQuestion(Request $oRequest, $iCourseId)
    {
        return response()->json($this->loadQuestions($iCourseId, ['question_difficulty' => $oRequest->all()['difficulty']]));
    }

    public function generateQuestions(Request $oRequest)
    {
        return response()->json($this->generateQuizQuestions($oRequest->all()));
    }

    public function generateExams(Request $oRequest)
    {
        return response()->json($this->generateExamQuestions($oRequest->all()));
    }
}