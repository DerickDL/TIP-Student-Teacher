<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Traits\traitCourses;
use App\Http\Traits\traitLessons;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class restTeacher extends Controller 
{
    use traitCourses, traitLessons;

    public function addSubject(Request $oRequest)
    {
        return response()->json($this->insertCourse($oRequest->all()));
    }

    public function addLesson(Request $oRequest, $iCourseId)
    {
        return response()->json($this->insertLesson($oRequest->all(), $iCourseId));
    }
}