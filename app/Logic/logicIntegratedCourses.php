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

}