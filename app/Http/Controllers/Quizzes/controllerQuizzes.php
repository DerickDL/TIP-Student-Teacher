<?php

namespace App\Http\Controllers\Quizzes;

use App\Http\Controllers\Controller;
use App\Http\Traits\traitQuizzes;
use App\Logic\logicQuizzes;
use App\Model\modelCourses;
use App\Model\modelQuizzes;
use App\Model\modelQuestions;
use App\Model\modelChoices;
use Illuminate\Http\Request;

class controllerQuizzes extends Controller
{
    use traitQuizzes;

    /**
     * insert quiz
     * @param Request $oRequest
     */
    public function insertQuiz(Request $oRequest)
    {
        return response()->json($this->addQuiz($oRequest->all()));
    }

    public function deleteQuiz($iQuizId)
    {
        $this->removeQuiz($iQuizId);
    }
}