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
    public function visitQuiz($iSectionId, $iQuizId)
    {
        $aSession = $this->getSession();
        $aClass = $this->getClasses(['section_id' => $iSectionId]);
        $aQuiz = $this->getQuizzes(['id' => $iQuizId]);
        $aQuestions = $this->getQuestions($iQuizId);
        $aChoices = $this->getChoices($aQuestions);
        $aScore = $this->getQuizScore($iQuizId, $aSession->getData()->id);
        $aQuizData = [
        	'quiz' => $aQuiz,
        	'questions' => $aQuestions,
        	'choices' => $aChoices,
            'score' => $aScore
        ];
        return view('pages.student.student_quiz')->with('aSession', $aSession)->with('aClass', $aClass)->with('aQuizData', $aQuizData);
    }

    public function classes()
    {
        $aSession = $this->getSession();
        $aClasses = $this->getClasses(['students_sections.status' => 1]);
        return view('pages.student.student_classes')->with('aSession', $aSession)->with('aClasses', $aClasses);
    }

    public function coursesPage($iSectionId)
    {
        $aSession = $this->getSession();
        $aClass = $this->getClasses(['section_id' => $iSectionId]);
        $aCourses = $this->getCourses(['integrated_course_id' => $aClass[0]['integration_id']]);
        return view('pages.student.student_all_course')->with('aSession', $aSession)->with('aClass', $aClass)->with('aCourses', $aCourses);
    }

    public function courseDetailPage($iSectionId, $iCourseId)
    {
        $aSession = $this->getSession();
        $aClass = $this->getClasses(['section_id' => $iSectionId]);
        $aCourse = $this->getCourses(['id' => $iCourseId]);
        $aFiles = $this->getFiles(['course_id' => $iCourseId]);
        return view('pages.student.student_course')->with('aSession', $aSession)->with('aClass', $aClass)->with('aCourse', $aCourse)->with('aFiles', $aFiles);
    }

    public function quizzesPage($iSectionId)
    {
        $aSession = $this->getSession();
        $aClass = $this->getClasses(['section_id' => $iSectionId]);
        $aCourses = $this->getCourses(['integrated_course_id' => $aClass[0]['integration_id']]);
        $aQuizzes = $this->getCourseQuizzes($aCourses);
        foreach ($aQuizzes as $aQuizData) {
            $aQuizData['sub_course'] = $this->getCourses(['id' => $aQuizData['course_id']])[0];
            $aQuizData['parent_course'] = $this->getParentCourse($aQuizData['course_id']);
        }
        return view('pages.student.student_quizzes')->with('aSession', $aSession)->with('aClass', $aClass)->with('aQuizzes', $aQuizzes);
    }

    private function getCourseQuizzes($aCourses)
    {
        $aQuizzes = [];
        foreach ($aCourses as $aCourse) {
            $aQuiz = $this->getQuizzes(['course_id' => $aCourse['id']]);
            if (count($aQuiz) > 0) {
                $aQuizzes[] = $aQuiz[0];
            }
        }
        return $aQuizzes;
    }

    public function examsPage($iSectionId)
    {
        $aSession = $this->getSession();
        $aClass = $this->getClasses(['section_id' => $iSectionId]);
        $aExams = $this->getExams(['creator_id' => $aClass[0]['user_id']]);
        foreach ($aExams as $aExamData) {
            $aExamData['parent_course'] = $this->getIntegratedCourseDetail($aExamData['course_id']);
        }
        $aExams = $this->segregateExams($aExams);
        return view('pages.student.student_exams')->with('aSession', $aSession)->with('aClass', $aClass)->with('aExams', $aExams);
    }

    private function segregateExams($aExams)
    {
        $aSegregatedExams = [];
        foreach ($aExams as $aExamData) {
            $aSegregatedExams[$aExamData['type']][] = $aExamData;
        }
        return $aSegregatedExams;
    }

    public function examPage($iSectionId, $iExamId)
    {
        $aSession = $this->getSession();
        $aClass = $this->getClasses(['section_id' => $iSectionId]);
        $aExam = $this->getExams(['id' => $iExamId]);
        $aExam['questions'] = $this->getExamQuestions($iExamId);
        $aExam['choices'] = $this->getExamChoices($aExam['questions']);
        return view('pages.student.student_exam')->with('aSession', $aSession)->with('aClass', $aClass)->with('aExam', $aExam);
    }
}
