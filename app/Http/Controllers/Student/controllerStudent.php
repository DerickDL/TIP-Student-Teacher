<?php


namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Traits\traitQuizzes;
use App\Logic\logicStudents;
use App\Model\modelUsers;
use Illuminate\Http\Request;

class controllerStudent extends Controller
{
    use traitQuizzes;

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
        $aQuestions = $this->getQuestions(['quiz_id' => $aRequest['quiz_id']]);
        return response()->json($this->logicStudent->submitQuiz($aRequest, $aQuestions));
    }

    public function enrollClass(Request $oRequest)
    {
        return response()->json($this->logicStudent->enrollClass($oRequest->all()));
    }
}