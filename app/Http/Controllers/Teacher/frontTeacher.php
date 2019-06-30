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
     * Teacher course page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function integCoursePage($iIntegCourseId)
    {
        $aSession = $this->getSession();
        $aIntegCourse = $this->getIntegratedCourseDetail($iIntegCourseId);
        $aCourses = $this->getCourses(['integrated_course_id' => $iIntegCourseId]);
        return view('pages.teacher.teacher_all_course')->with('aSession', $aSession)->with('aCourses', $aCourses)->with('aIntegCourse', $aIntegCourse);
    }

    /**
     * Teacher course detail page
     * @param $iCourseId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function subCourseDetailPage($iIntegCourseId, $iCourseId)
    {
        $aSession = $this->getSession();
        $aIntegCourse = $this->getIntegratedCourseDetail($iIntegCourseId);
        $aCourse = $this->getCourses(['id' => $iCourseId]);
        $aFiles = $this->getFiles(['course_id' => $iCourseId]);
        return view('pages.teacher.teacher_course')->with('aSession', $aSession)->with('aCourse', $aCourse)->with('aIntegCourse', $aIntegCourse)->with('aFiles', $aFiles);
    }

    /**
     * Teacher add course page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function addCoursePage($iIntegCourseId)
    {
        $aSession = $this->getSession();
        $aIntegCourse = $this->getIntegratedCourseDetail($iIntegCourseId);
        return view('pages.teacher.teacher_add_course')->with('aSession', $aSession)->with('aIntegCourse', $aIntegCourse);
    }

    /**
     * Teacher questions page
     * @param $iCourseId
     * @param $iIntegCourseId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function questionsPage($iIntegCourseId, $iCourseId)
    {
        $aSession = $this->getSession();
        $aIntegCourse = $this->getIntegratedCourseDetail($iIntegCourseId);
        $aCourse = $this->getCourses(['id' => $iCourseId]);
        return view('pages.teacher.teacher_questions')->with('aSession', $aSession)->with('aIntegCourse', $aIntegCourse)->with('aCourse', $aCourse);
    }

    /**
     * Teacher quizzes page
     * @param $iQuizId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function quizPage()
    {
        $aSession = $this->getSession();
        $aData = $this->getPageData(['id' => $iCourseId]);
        $aQuiz = $this->getQuizzes(['course_id' => $iCourseId]);
        return view('pages.teacher.teacher_quizzes')->with('aData', $aData)->with('aQuiz', $aQuiz);
    }

    /**
     * generate quiz
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function generateQuizPage()
    {
        $aSession = $this->getSession();
        $aSubCourses = $this->getSubCourses();
        return view('pages.teacher.teacher_generate_quiz')->with('aSession', $aSession)->with('aSubCourses', $aSubCourses);
    }
}
