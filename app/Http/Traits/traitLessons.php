<?php

namespace App\Http\Traits;

use App\Logic\logicLessons;
use App\Model\modelCourses;
use App\Model\modelLessons;

trait traitLessons
{
    /**
     * @var logicLessons
     */
    private $logicLessons;

    /**
     * instantiate objects
     */
    private function instantiateLessons()
    {
        $this->logicLessons = new logicLessons(new modelCourses(), new modelLessons());
    }

    /**
     * Get lesson/s
     * @param array $aParams
     * @return mixed
     */
    public function getLessons($aParams = [])
    {
        $this->instantiateLessons();
        return $this->logicLessons->getLessons($aParams);
    }

    /**
     * Insert lesson
     * @param array $aData
     * @return mixed
     */
    public function insertLesson($aData)
    {
        $this->instantiateLesson();
        return $this->logicLesson->insertCourse($aData);
    }
}