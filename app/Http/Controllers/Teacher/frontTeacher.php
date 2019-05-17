<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\App\frontUsers;
use App\Http\Traits\traitCourses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class frontTeacher extends frontUsers
{
    /**
     * Teacher homepage
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function index()
	{
	    $aData = $this->getPageData();
		return view('pages.home')->with('aData', $aData);
	}

    /**
     * Teacher course page
     * @param $iCourseId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function coursePage($iCourseId)
    {
        $aData = $this->getPageData(['id' => $iCourseId]);
        $aQuiz = $this->getLatestQuizzes(['course_id' => $iCourseId]);
        return view('pages.teacher.teacher_course')->with('aData', $aData)->with('aQuiz', $aQuiz);
    }

    /**
     * Teacher quizzes page
     * @param $iCourseId
     * @param $iQuizId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function quizPage($iCourseId)
    {
        $aData = $this->getPageData(['id' => $iCourseId]);
        $aQuiz = $this->getQuizzes();
        return view('pages.teacher.teacher_quiz')->with('aData', $aData)->with('aQuiz', $aQuiz);
    }

    /**
     * add quiz
     * @param $iCourseId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addQuizPage($iCourseId)
    {
        $aData = $this->getPageData(['id' => $iCourseId]);
        return view('pages.teacher.teacher_add_quiz')->with('aData', $aData);
    }
}
