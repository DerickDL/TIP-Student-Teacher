<?php

namespace App\Http\Traits;

use App\Logic\logicCourses;
use App\Model\modelCourses;
use App\Model\modelUsers;

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
        $this->logicCourses = new logicCourses(new modelCourses(), new modelUsers());
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

    /**
     * @param $aData
     * @param $iIntegCourseId
     * @return mixed
     */
    public function insertCourse($aData)
    {
        $this->instantiateCourses();
        return $this->logicCourses->insertCourse($aData);
    }

    public function deleteCourse($iCourseId)
    {
        $this->instantiateCourses();
        return $this->logicCourses->deleteCourse($iCourseId);
    }
}