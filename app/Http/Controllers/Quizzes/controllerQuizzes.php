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
     * @var logicQuizzes
     */
    private $logicQuizzes;

    /**
     * controllerCommon constructor.
     */
    public function __construct()
    {
        $this->logicQuizzes = new logicQuizzes(new modelCourses(), new modelQuizzes(), new modelQuestions(), new modelChoices());
    }

    /**
     * insert quiz
     * @param Request $oRequest
     */
    public function insertQuiz(Request $oRequest)
    {
        $this->logicQuizzes->insertQuiz($oRequest->all());
    }

    /**
     * @param $iQuizId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getQuiz($iQuizId)
    {
        return response()->json($this->getQuizzes($iQuizId));
    }
}