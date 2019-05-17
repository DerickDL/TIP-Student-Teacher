<?php

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use App\Logic\logicCourses;
use App\Model\modelCourses;
use Illuminate\Http\Request;

class controllerCourses extends Controller
{
    /**
     * @var logicCourses
     */
    private $logicCourses;

    /**
     * controllerCommon constructor.
     */
    public function __construct()
    {
        $this->logicCourses = new logicCourses(new modelCourses());
    }

    /**
     * @param Request $oRequest
     * @return mixed
     */
    public function getCourses(Request $oRequest)
    {
        return $this->logicCourses->getCourses($oRequest);
    }
}