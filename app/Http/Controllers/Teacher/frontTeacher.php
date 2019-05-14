<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\controllerCommon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class frontTeacher extends controllerCommon
{
	public function index()
	{
        $aData = $this->getCourses();
        var_dump($aData);
		return view('pages.teacher_home');
	}
}
