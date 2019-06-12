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
    public function subCourseDetailPage($iCourseId)
    {
        $aSession = $this->getSession();
        $aCourse = $this->getCourses(['id' => $iCourseId]);
        $aLessons = $this->getLessons(['course_id' => $iCourseId]);
        return view('pages.teacher.teacher_course')->with('aSession', $aSession)->with('aCourse', $aCourse)->with('aLessons', $aLessons);
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
     * Teacher  lesson page
     * @param $iLessonId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function lessonPage($iLessonId)
    {
        $aSession = $this->getSession();
        $aCourse = $this->getParentCourse($iLessonId);
        $aLesson = $this->getLessons(['id' => $iLessonId]);
        return view('pages.teacher.teacher_lesson')->with('aSession', $aSession)->with('aCourse', $aCourse)->with('aLesson', $aLesson);
    }

    /**
     * Teacher add lesson page
     * @param $iCourseId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addLessonPage($iCourseId)
    {
        $aSession = $this->getSession();
        $aCourse = $this->getCourses(['id' => $iCourseId]);
        return view('pages.teacher.teacher_add_lesson')->with('aSession', $aSession)->with('aCourse', $aCourse);
    }

    /**
     * Teacher questions page
     * @param $iLessonId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function questionsPage($iLessonId)
    {
        $aSession = $this->getSession();
        $aCourse = $this->getParentCourse($iLessonId);
        $aLesson = $this->getLessons(['id' => $iLessonId]);
        return view('pages.teacher.teacher_questions')->with('aSession', $aSession)->with('aCourse', $aCourse)->with('aLesson', $aLesson);
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
