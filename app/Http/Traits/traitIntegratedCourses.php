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

    /**
     * @param $iIntegratedCourseId
     * @return mixed
     */
    public function getSubCourses($iIntegratedCourseId)
    {
        $this->instantiateIntegratedCourses();
        return $this->logicIntegratedCourses->getSubCourses($iIntegratedCourseId);
    }
}