<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Traits\traitCourses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class restTeacher extends Controller 
{
    use traitCourses;

    public function addSubject(Request $oRequest)
    {
        return response()->json($this->insertCourse($oRequest->all()));
    }
}