<?php

namespace App\Logic;

use App\Model\modelCourses;

class logicCourses
{
    /**
     * @var modelCourses
     */
    private $modelCourses;

    /**
     * logicCourses constructor.
     * @param $modelCourses
     */
    public function __construct($modelCourses)
    {
        $this->modelCourses = $modelCourses;
    }

    /**
     * Get all courses
     * @return mixed
     */
    public function getCourses()
    {
        return $this->modelCourses->getCourses();
    }
}