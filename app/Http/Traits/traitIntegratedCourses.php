<?php

namespace App\Http\Traits;

use App\Logic\logicIntegratedCourses;
use App\Model\modelIntegratedCourses;

trait traitIntegratedCourses
{
    /**
     * @var logicIntegratedCourses
     */
    private $logicIntegratedCourses;

    /**
     * instantiate objects
     */
    private function instantiateIntegratedCourses()
    {
        $this->logicIntegratedCourses = new logicIntegratedCourses(new modelIntegratedCourses());
    }

    public function getIntegratedCourseDetail($iIntegCourseId)
    {
        $this->instantiateIntegratedCourses();
        return $this->logicIntegratedCourses->findIntegratedCourse($iIntegCourseId);
    }
}