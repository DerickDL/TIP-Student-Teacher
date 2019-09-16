<?php

namespace App\Http\Controllers\IntegratedCourses;

use App\Http\Controllers\Controller;
use App\Logic\logicIntegratedCourses;
use App\Model\modelIntegratedCourses;
use Illuminate\Http\Request;

class controllerIntegratedCourses extends Controller
{
    /**
     * @var logicIntegratedCourses
     */
    private $logicIntegratedCourses;

    /**
     * controllerCommon constructor.
     */
    public function __construct()
    {
        $this->logicIntegratedCourses = new logicIntegratedCourses(new modelIntegratedCourses());
    }

    /**
     * @param Request $oRequest
     * @return mixed
     */
    public function getIntegratedCourses(Request $oRequest)
    {
        return $this->logicIntegratedCourses->getCourses($oRequest);
    }

    public function getAssignedInstructors(Request $oRequest)
    {
        $aRequest = $oRequest->all();
        return $this->logicIntegratedCourses->getAssignedUsers($aRequest['integration']);
    }
}