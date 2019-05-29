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
	public function homePage()
	{
	    $aSession = $this->getSession();
		return view('pages.teacher.teacher_home')->with('aSession', $aSession);
	}

    /**
     * Teacher subject page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function subjectPage()
    {
        $aSession = $this->getSession();
        $aSubjects = $this->getCourses();
        return view('pages.teacher.teacher_all_subject')->with('aSession', $aSession)->with('aSubjects', $aSubjects);
    }

    /**
     * Teacher subject detail page
     * @param $iCourseId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function subjectDetailPage($iCourseId)
    {
        $aSession = $this->getSession();
        $aSubject = $this->getCourses(['id' => $iCourseId]);
        $aLessons = $this->getLessons();
        return view('pages.teacher.teacher_subject')->with('aSession', $aSession)->with('aSubject', $aSubject)->with('aLessons', $aLessons);
    }

    /**
     * Teacher add subject page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function addSubjectPage()
    {
        $aSession = $this->getSession();
        return view('pages.teacher.teacher_add_subject')->with('aSession', $aSession);
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
        $aQuiz = $this->getQuizzes(['course_id' => $iCourseId]);
        return view('pages.teacher.teacher_quizzes')->with('aData', $aData)->with('aQuiz', $aQuiz);
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
