<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class frontStudent extends Controller
{
	public function index()
	{
		return view('pages.student_home');
	}
}
