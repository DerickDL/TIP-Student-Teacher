<?php

namespace App\Logic;

use App\Model\modelIntegratedCourses;
use Illuminate\Support\Facades\Validator;

class logicIntegratedCourses
{
    /**
     * @var modelIntegratedCourses
     */
    private $modelIntegratedCourses;

    /**
     * logicIntegratedCourses constructor.
     * @param $modelIntegratedCourses
     */
    public function __construct($modelIntegratedCourses)
    {
        $this->modelIntegratedCourses = $modelIntegratedCourses;
    }

    public function findIntegratedCourse($iIntegCourseId)
    {
        return $this->modelIntegratedCourses->findIntegratedCourse($iIntegCourseId);
    }

    public function getAssignedUsers($iIntegCourseId)
    {
        $oIntegration = $this->modelIntegratedCourses->findIntegratedCourse($iIntegCourseId);
        return $oIntegration->users()->get()->toArray();
    }
}