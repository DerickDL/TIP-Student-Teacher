<?php

namespace App\Http\Traits;

use App\Logic\logicCourses;
use App\Model\modelCourses;

trait traitCourses
{
    /**
     * @var logicCourses
     */
    private $logicCourses;

    /**
     * instantiate objects
     */
    private function instantiateCourses()
    {
        $this->logicCourses = new logicCourses(new modelCourses());
    }

    /**
     * Get course/s
     * @param array $aParams
     * @return mixed
     */
    public function getCourses($aParams = [])
    {
        $this->instantiateCourses();
        return $this->logicCourses->getCourses($aParams);
    }
}