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

    public function listQuizPage()
    {
        $aSession = $this->getSession();
        $aQuizzes = $this->getQuizzes();
        foreach ($aQuizzes as $aQuizData) {
            $aQuizData['sub_course'] = $this->getCourses(['id' => $aQuizData['course_id']])[0];
            $aQuizData['parent_course'] = $this->getParentCourse($aQuizData['course_id']);
        }
        return view('pages.teacher.teacher_list_quiz')->with('aSession', $aSession)->with('aQuizzes', $aQuizzes);        
    }

    public function viewQuizPage($iQuizId)
    {
        $aSession = $this->getSession();
        $aQuiz = $this->getQuizzes(['id' => $iQuizId]);
        $aQuiz['integ_course'] = $this->getParentCourse($aQuiz[0]['course_id']);
        $aQuiz['course'] = $this->getCourses(['id' => $aQuiz[0]['course_id']]);
        $aQuestions = $this->getQuestions($iQuizId);
        $aChoices = $this->getChoices($aQuestions);
        return view('pages.teacher.teacher_view_quiz')->with('aSession', $aSession)->with('aQuiz', $aQuiz)->with('aQuestions', $aQuestions)->with('aChoices', $aChoices);
    }

    public function sectionPage()
    {
        $aSession = $this->getSession();
        $aSections = $this->getSections();
        return view('pages.teacher.teacher_sections')->with('aSession', $aSession)->with('aSections', $aSections);
    }

    public function createSectionPage()
    {
        $aSession = $this->getSession();
        return view('pages.teacher.teacher_create_section')->with('aSession', $aSession);
    }

    public function sectionDetailPage($iSectionId)
    {
        $aSession = $this->getSession();
        $aSection = $this->getSections(['id' => $iSectionId]);
        return view('pages.teacher.teacher_section_detail')->with('aSession', $aSession)->with('aSection', $aSection);
    }

    public function examPage()
    {
        $aSession = $this->getSession();
        $aExams = $this->getExams();
        foreach ($aExams as $aExamData) {
            $aExamData['parent_course'] = $this->getIntegratedCourseDetail($aExamData['course_id']);
        }
        $aExams = $this->segregateExams($aExams);
        return view('pages.teacher.teacher_exam')->with('aSession', $aSession)->with('aExams', $aExams);
    }

    /**
     * Segregate exams by type
     */
    private function segregateExams($aExams)
    {
        $aSegregatedExams = [];
        foreach ($aExams as $aExamData) {
            $aSegregatedExams[$aExamData['type']][] = $aExamData;
        }
        return $aSegregatedExams;
    }

    public function viewExamPage($iExamId)
    {
        $aSession = $this->getSession();
        $aExam = $this->getExams(['id' => $iExamId]);
        $aExam['integ_course'] = $this->getIntegratedCourseDetail($aExam[0]['course_id']);
        $aQuestions = $this->getExamQuestions($iExamId);
        $aChoices = $this->getExamChoices($aQuestions);
        return view('pages.teacher.teacher_view_exam')->with('aSession', $aSession)->with('aExam', $aExam)->with('aQuestions', $aQuestions)->with('aChoices', $aChoices);
    }

    /**
     * generate exam page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function generateExamPage()
    {
        $aSession = $this->getSession();
        return view('pages.teacher.teacher_generate_exam')->with('aSession', $aSession);
    }
}
