<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\App\frontUsers;
use App\Http\Traits\traitCourses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class frontTeacher extends frontUsers
{
    public function sectionPage()
    {
        $aSession = $this->getSession();
        $aSections = $this->getSections(['user_id' => $aSession->getData()->id]);
        return view('pages.teacher.teacher_sections1')->with('aSession', $aSession)->with('aSections', $aSections);
    }

    public function createSectionPage()
    {
        $aSession = $this->getSession();
        return view('pages.teacher.teacher_create_section1')->with('aSession', $aSession);
    }

    /**
     * Teacher homepage
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function homePage($iSectionId)
	{
	    $aSession = $this->getSession();
        $aSection = $this->getSections(['id' => $iSectionId]);
        return view('pages.teacher.teacher_home')->with('aSession', $aSession)->with('aSection', $aSection);
	}

    /**
     * Teacher course page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function integCoursePage($iSectionId, $iIntegCourseId)
    {
        $aSession = $this->getSession();
        $aSection = $this->getSections(['id' => $iSectionId]);
        $aIntegCourse = $this->getIntegratedCourseDetail($iIntegCourseId);
        $aCourses = $this->getCourses(['integrated_course_id' => $iIntegCourseId, 'section_id' => $iSectionId]);
        return view('pages.teacher.teacher_all_course')->with('aSession', $aSession)->with('aCourses', $aCourses)->with('aIntegCourse', $aIntegCourse)->with('aSection', $aSection);
    }

    /**
     * Teacher course detail page
     * @param $iCourseId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function subCourseDetailPage($iSectionId, $iIntegCourseId, $iCourseId)
    {
        $aSession = $this->getSession();
        $aSection = $this->getSections(['id' => $iSectionId]);
        $aIntegCourse = $this->getIntegratedCourseDetail($iIntegCourseId);
        $aCourse = $this->getCourses(['id' => $iCourseId]);
        $aFiles = $this->getFiles(['course_id' => $iCourseId]);
        return view('pages.teacher.teacher_course')->with('aSession', $aSession)->with('aSection', $aSection)->with('aCourse', $aCourse)->with('aIntegCourse', $aIntegCourse)->with('aFiles', $aFiles);
    }

    /**
     * Teacher add course page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function addCoursePage($iSectionId, $iIntegCourseId)
    {
        $aSession = $this->getSession();
        $aSection = $this->getSections(['id' => $iSectionId]);
        $aIntegCourse = $this->getIntegratedCourseDetail($iIntegCourseId);
        return view('pages.teacher.teacher_add_course')->with('aSession', $aSession)->with('aIntegCourse', $aIntegCourse)->with('aSection', $aSection);
    }

    /**
     * Teacher questions page
     * @param $iCourseId
     * @param $iIntegCourseId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function questionsPage($iSectionId, $iIntegCourseId, $iCourseId)
    {
        $aSession = $this->getSession();
        $aSection = $this->getSections(['id' => $iSectionId]);
        $aIntegCourse = $this->getIntegratedCourseDetail($iIntegCourseId);
        $aCourse = $this->getCourses(['id' => $iCourseId]);
        return view('pages.teacher.teacher_questions')->with('aSession', $aSession)->with('aIntegCourse', $aIntegCourse)->with('aCourse', $aCourse)->with('aSection', $aSection);
    }

    /**
     * Teacher quizzes page
     * @param $iQuizId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function quizPage($iSectionId)
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
    public function generateQuizPage($iSectionId)
    {
        $aSession = $this->getSession();
        $aSubCourses = $this->getSubCourses();
        $aSection = $this->getSections(['id' => $iSectionId]);
        return view('pages.teacher.teacher_generate_quiz')->with('aSession', $aSession)->with('aSubCourses', $aSubCourses)->with('aSection', $aSection);
    }

    public function listQuizPage($iSectionId)
    {
        $aSession = $this->getSession();
        $aQuizzes = $this->getQuizzes();
        foreach ($aQuizzes as $aQuizData) {
            $aQuizData['sub_course'] = $this->getCourses(['id' => $aQuizData['course_id']])[0];
            $aQuizData['parent_course'] = $this->getParentCourse($aQuizData['course_id']);
        }
        $aSection = $this->getSections(['id' => $iSectionId]);
        return view('pages.teacher.teacher_list_quiz')->with('aSession', $aSession)->with('aQuizzes', $aQuizzes)->with('aSection', $aSection);        
    }

    public function viewQuizPage($iSectionId, $iQuizId)
    {
        $aSession = $this->getSession();
        $aQuiz = $this->getQuizzes(['id' => $iQuizId]);
        $aQuiz['integ_course'] = $this->getParentCourse($aQuiz[0]['course_id']);
        $aQuiz['course'] = $this->getCourses(['id' => $aQuiz[0]['course_id']]);
        $aQuestions = $this->getQuestions($iQuizId);
        $aChoices = $this->getChoices($aQuestions);
        $aSection = $this->getSections(['id' => $iSectionId]);
        return view('pages.teacher.teacher_view_quiz')->with('aSession', $aSession)->with('aQuiz', $aQuiz)->with('aQuestions', $aQuestions)->with('aChoices', $aChoices)->with('aSection', $aSection);
    }

    public function sectionDetailPage($iSectionId)
    {
        $aSession = $this->getSession();
        $aSection = $this->getSections(['id' => $iSectionId]);
        return view('pages.teacher.teacher_section_detail')->with('aSession', $aSession)->with('aSection', $aSection);
    }

    public function examPage($iSectionId)
    {
        $aSession = $this->getSession();
        $aExams = $this->getExams();
        foreach ($aExams as $aExamData) {
            $aExamData['parent_course'] = $this->getIntegratedCourseDetail($aExamData['course_id']);
        }
        $aExams = $this->segregateExams($aExams);
        $aSection = $this->getSections(['id' => $iSectionId]);
        return view('pages.teacher.teacher_exam')->with('aSession', $aSession)->with('aExams', $aExams)->with('aSection', $aSection);
    }

    public function studentListPage($iSectionId)
    {
        $aSession = $this->getSession();
        $aSection = $this->getSections(['id' => $iSectionId]);
        return view('pages.teacher.teacher_students')->with('aSession', $aSession)->with('aSection', $aSection);
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

    public function viewExamPage($iSectionId, $iExamId)
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
    public function generateExamPage($iSectionId)
    {
        $aSession = $this->getSession();
        $aSubCourses = $this->getSubCourses();
        return view('pages.teacher.teacher_generate_exam')->with('aSession', $aSession)->with('aSubCourses', $aSubCourses);
    }
}
