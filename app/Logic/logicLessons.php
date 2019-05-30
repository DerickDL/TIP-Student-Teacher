<?php

namespace App\Logic;

use App\Model\modelCourses;
use App\Model\modelLessons;
use Illuminate\Support\Facades\Validator;

class logicLessons
{
    /**
     * @var modelCourses
     */
    private $modelCourses;

    /**
     * @var modelLessons
     */
    private $modelLessons;

    /**
     * logicLessons constructor.
     * @param $modelCourses
     * @param $modelLessons
     */
    public function __construct($modelCourses, $modelLessons)
    {
        $this->modelCourses = $modelCourses;
        $this->modelLessons = $modelLessons;
    }

    /**
     * Get all lessons
     * @param $aParams
     * @return mixed
     */
    public function getLessons($aParams)
    {
        return $this->modelLessons->getLessons($aParams);
    }

    /**
     * Get parent course
     * @param $iLessonId
     * @return mixed
     */
    public function getParentCourse($iLessonId)
    {
        $oLesson = $this->modelLessons->findLesson($iLessonId);
        return $oLesson->courses;
    }

    /**
     * insert lessons
     * @param $aRequest
     * @param $iCourseId
     * @return mixed
     */
    public function insertLesson($aRequest, $iCourseId)
    {
        $aRules = array(
            'lesson_title' => 'required|string',
            'lesson_overview' => 'required|string'
        );
        $aValidation = $this->validateLesson($aRules, $aRequest);
        if ($aValidation['result'] === false) {
            return $aValidation;
        }
        $oCourse = $this->modelCourses->findCourse($iCourseId);
        $oCourse->lessons()->create($aRequest);
        return array(
            'result' => true
        );
    }

    
    /**
	 * validate lesson
	 * @param $aRules
	 * @param $aData
	 * @return array
	 */
    private function validateLesson($aRules, $aData)
    {
        $validator = Validator::make($aData, $aRules);
        if ($validator->fails()) {
            return array(
                'result' => false,
                'message' => $validator->messages()->first()
            );
        }
        return array('result' => true);
    }
}