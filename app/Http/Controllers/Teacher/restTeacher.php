<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Traits\traitCourses;
use App\Http\Traits\traitLessons;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class restTeacher extends Controller 
{
    use traitCourses, traitLessons;

    /**
     * @param Request $oRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function addCourse(Request $oRequest)
    {
        return response()->json($this->insertCourse($oRequest->all()));
    }

    /**
     * @param Request $oRequest
     * @param         $iCourseId
     * @return \Illuminate\Http\JsonResponse
     */
    public function addLesson(Request $oRequest, $iCourseId)
    {
        return response()->json($this->insertLesson($oRequest->all(), $iCourseId));
    }

    /**
     * @param $iLessonId
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteLesson(Request $aRequest)
    {
        $this->removeLesson($aRequest->all()['lesson_id']);
    }

    public function removeCourse($iCourseId)
    {
        $this->deleteCourse($iCourseId);
    }
}