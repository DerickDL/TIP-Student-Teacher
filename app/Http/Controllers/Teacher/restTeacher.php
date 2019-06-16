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
    public function addFile(Request $oRequest)
    {
        var_dump($oRequest->all());
        $oFile = $oRequest->file('attached-file');
        $new_name = rand() . '.' . $oFile->getClientOriginalExtension();
        $oFile->move(public_path('files'), $new_name);
        return response()->json($oRequest->all());
    }

    public function removeCourse($iCourseId)
    {
        $this->deleteCourse($iCourseId);
    }
}