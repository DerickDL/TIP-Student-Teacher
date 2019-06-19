<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Traits\traitCourses;
use App\Http\Traits\traitLessons;
use App\Http\Traits\traitFiles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class restTeacher extends Controller 
{
    use traitCourses, traitLessons, traitFiles;

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
     * @param         $iFileId
     * @return \Illuminate\Http\JsonResponse
     */
    public function addFile(Request $oRequest, $iFileId)
    {
        return response()->json($this->insertFile($oRequest->all(), $iFileId));
    }

    /**
     * @param $iFileId
     * @return mixed
     */
    public function downloadFile($iFileId)
    {
        return $this->retrieveFile($iFileId);
    }

    public function removeCourse($iCourseId)
    {
        $this->deleteCourse($iCourseId);
    }
}