<?php

namespace App\Http\Controllers\Quizzes;

use App\Http\Controllers\Controller;
use App\Logic\logicQuizzes;
use App\Model\modelQuizzes;
use App\Model\modelQuestions;
use App\Model\modelChoices;
use Illuminate\Http\Request;

class controllerQuizzes extends Controller
{
    /**
     * @var logicCourses
     */
    private $logicQuizzes;

    /**
     * controllerCommon constructor.
     */
    public function __construct()
    {
        $this->logicQuizzes = new logicQuizzes(new modelQuizzes(), new modelQuestions(), new modelChoices());
    }

    /**
     * insert quiz
     * @return logicCourses
     */
    public function insertQuiz(Request $oRequest)
    {
        return response()->json($oRequest);
        return response()->json($this->insertQuiz->insertQuiz());
    }
}