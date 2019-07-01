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
     * @param $iCourseId
     * @return mixed
     */
    public function insertLesson($aData, $iCourseId)
    {
        $this->instantiateLessons();
        return $this->logicLessons->insertLesson($aData, $iCourseId);
    }

    /**
     * @param $iLessonId
     * @return mixed
     */
    public function removeLesson($iLessonId)
    {
        $this->instantiateLessons();
        return $this->logicLessons->deleteLesson($iLessonId);
    }
}