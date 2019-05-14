<?php

namespace App\Http\Controllers;

use App\Logic\logicCourses;
use App\Model\modelCourses;

class controllerCommon extends Controller
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
     * Get all courses
     * @return logicCourses
     */
    public function getCourses()
    {
        return $this->logicCourses->getCourses();
    }
}