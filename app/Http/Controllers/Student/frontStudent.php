<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\App\frontUsers;
use Illuminate\Support\Facades\Session;

class frontStudent extends frontUsers
{
	 /**
     * Student homepage
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function index()
	{
	    $aData = $this->getPageData();
		return view('pages.home')->with('aData', $aData);
	}

    /**
     * Student course home page
     * @param $iCourseId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function courseHomePage($iCourseId)
    {
        $aData = $this->getPageData(['id' => $iCourseId]);
        $aQuiz = $this->getLatestQuizzes(['course_id' => $iCourseId]);
        return view('pages.student.student_course')->with('aData', $aData)->with('aQuiz', $aQuiz);
    }

    /**
     * Student quizzes page
     * @param $iCourseId
     * @param $iQuizId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function quizPage($iCourseId)
    {
        $aData = $this->getPageData(['id' => $iCourseId]);
        $aQuiz = $this->getQuizzes(['course_id' => $iCourseId]);
        return view('pages.student.student_quizzes')->with('aData', $aData)->with('aQuiz', $aQuiz);
    }

    /**
     * Student quiz page
     * @param $iCourseId
     * @param $iQuizId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function visitQuiz($iCourseId, $iQuizId)
    {
        $aData = $this->getPageData(['id' => $iCourseId]);
        $aQuiz = $this->getQuizzes(['id' => $iQuizId]);
        $aQuestions = $this->getQuestions(['quiz_id' => $iQuizId]);
        $aChoices = $this->getChoices($aQuestions);
        $aScore = $this->getQuizScore($iQuizId, $aData['session']->getData()->id);
        $aQuizData = [
        	'quiz' => $aQuiz,
        	'questions' => $aQuestions,
        	'choices' => $aChoices,
            'score' => $aScore
        ];
        return view('pages.student.student_quiz')->with('aData', $aData)->with('aQuizData', $aQuizData);
    }

    public function classes()
    {
        $aSession = $this->getSession();
        $aClasses = $this->getClasses();
        return view('pages.student.student_classes')->with('aSession', $aSession)->with('aClasses', $aClasses);
    }
}
