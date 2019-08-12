<?php

namespace App\Http\Controllers\Exams;

use App\Http\Controllers\Controller;
use App\Http\Traits\traitExams;
use Illuminate\Http\Request;

class controllerExams extends Controller
{
    use traitExams;

    /**
     * insert quiz
     * @param Request $oRequest
     */
    public function insertExam(Request $oRequest)
    {
        return $this->addExam($oRequest->all());
    }

    public function deleteExam($iExamId)
    {
        $this->removeExam($iExamId);
    }
}