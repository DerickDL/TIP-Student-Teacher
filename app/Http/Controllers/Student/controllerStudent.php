<?php


namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Traits\traitQuizzes;
use App\Http\Traits\traitExams;
use App\Logic\logicStudents;
use App\Model\modelUsers;
use Illuminate\Http\Request;

class controllerStudent extends Controller
{
    use traitQuizzes, traitExams;

    /**
     * @var logicStudents
     */
    private $logicStudent;

    /**
     * contollerStudent constructor.
     */
    public function __construct()
    {
        $this->logicStudent = new logicStudents(new modelUsers());
    }

    public function submitQuiz(Request $oRequest)
    {
        $aRequest = $oRequest->all();
        $aQuestions = $this->getQuestions($aRequest['quiz_id']);
        return response()->json($this->logicStudent->submitQuiz($aRequest, $aQuestions));
    }

    public function submitExam(Request $oRequest)
    {
        $aRequest = $oRequest->all();
        $aQuestions = $this->getExamQuestions($aRequest['exam_id']);
        return response()->json($this->logicStudent->submitExam($aRequest, $aQuestions));
    }

    public function enrollClass(Request $oRequest)
    {
        return response()->json($this->logicStudent->enrollClass($oRequest->all()));
    }
}