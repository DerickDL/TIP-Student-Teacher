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
        $aIntegrations = $this->getTeacherIntegration();
        $aSections = $this->getSections(['user_id' => $aSession->getData()->id]);
        return view('pages.teacher.teacher_sections')->with('aSession', $aSession)->with('aSections', $aSections)->with('aIntegrations', $aIntegrations);
    }

    public function createSectionPage()
    {
        $aSession = $this->getSession();
        $aIntegrations = $this->getTeacherIntegration();
        return view('pages.teacher.teacher_create_section')->with('aSession', $aSession)->with('aIntegrations', $aIntegrations);
    }

    /**
     * Teacher homepage
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function homePage()
	{
        $aSession = $this->getSession();
        $aIntegrations = $this->getTeacherIntegration();
        return view('pages.teacher.teacher_home')->with('aSession', $aSession)->with('aIntegrations', $aIntegrations);
	}

    /**
     * Teacher course page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function integCoursePage($iIntegCourseId)
    {
        $aSession = $this->getSession();
        $aIntegCourse = $this->getIntegratedCourseDetail($iIntegCourseId);
        $aCourses = $this->getCourses(['integrated_course_id' => $iIntegCourseId, 'user_id' => $aSession->getData()->id]);
        $aIntegrations = $this->getTeacherIntegration();
        return view('pages.teacher.teacher_all_course')->with('aSession', $aSession)->with('aCourses', $aCourses)->with('aIntegCourse', $aIntegCourse)->with('aIntegrations', $aIntegrations);
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
        $aIntegrations = $this->getTeacherIntegration();
        return view('pages.teacher.teacher_course')->with('aSession', $aSession)->with('aCourse', $aCourse)->with('aIntegCourse', $aIntegCourse)->with('aFiles', $aFiles)->with('aIntegrations', $aIntegrations);
    }

    /**
     * Teacher add course page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function addCoursePage($iIntegCourseId)
    {
        $aSession = $this->getSession();
        $aIntegrations = $this->getTeacherIntegration();
        $aIntegCourse = $this->getIntegratedCourseDetail($iIntegCourseId);
        return view('pages.teacher.teacher_add_course')->with('aSession', $aSession)->with('aIntegCourse', $aIntegCourse)->with('aIntegrations', $aIntegrations);
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
        $aIntegrations = $this->getTeacherIntegration();
        $aIntegCourse = $this->getIntegratedCourseDetail($iIntegCourseId);
        $aCourse = $this->getCourses(['id' => $iCourseId]);
        return view('pages.teacher.teacher_questions')->with('aSession', $aSession)->with('aIntegCourse', $aIntegCourse)->with('aCourse', $aCourse)->with('aIntegrations', $aIntegrations);
    }

    /**
     * Teacher quizzes page
     * @param $iQuizId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function quizPage($iQuizId)
    {
        $aSession = $this->getSession();
        $aIntegrations = $this->getTeacherIntegration();
        $aData = $this->getPageData(['id' => $iCourseId]);
        $aQuiz = $this->getQuizzes(['course_id' => $iCourseId]);
        return view('pages.teacher.teacher_quizzes')->with('aData', $aData)->with('aQuiz', $aQuiz)->with('aIntegrations', $aIntegrations);
    }

    /**
     * generate quiz
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function generateQuizPage()
    {
        $aSession = $this->getSession();
        $aIntegrations = $this->getTeacherIntegration();
        $aSubCourses = $this->getSubCourses();
        return view('pages.teacher.teacher_generate_quiz')->with('aSession', $aSession)->with('aSubCourses', $aSubCourses)->with('aIntegrations', $aIntegrations);
    }

    public function listQuizPage()
    {
        $aSession = $this->getSession();
        $aIntegrations = $this->getTeacherIntegration();
        $aCourses = $this->getCourses(['user_id' => $aSession->getData()->id]);
        $aQuizzes = $this->getCourseQuizzes($aCourses);
        foreach ($aQuizzes as $aQuizData) {
            $aQuizData['sub_course'] = $this->getCourses(['id' => $aQuizData['course_id']])[0];
            $aQuizData['parent_course'] = $this->getParentCourse($aQuizData['course_id']);
        }
        return view('pages.teacher.teacher_list_quiz')->with('aSession', $aSession)->with('aQuizzes', $aQuizzes)->with('aIntegrations', $aIntegrations);        
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

    public function viewQuizPage($iQuizId)
    {
        $aSession = $this->getSession();
        $aIntegrations = $this->getTeacherIntegration();
        $aQuiz = $this->getQuizzes(['id' => $iQuizId]);
        $aQuiz['integ_course'] = $this->getParentCourse($aQuiz[0]['course_id']);
        $aQuiz['course'] = $this->getCourses(['id' => $aQuiz[0]['course_id']]);
        $aQuestions = $this->getQuestions($iQuizId);
        $aChoices = $this->getChoices($aQuestions);
        return view('pages.teacher.teacher_view_quiz')->with('aSession', $aSession)->with('aQuiz', $aQuiz)->with('aQuestions', $aQuestions)->with('aChoices', $aChoices)->with('aIntegrations', $aIntegrations);
    }

    public function sectionDetailPage($iSectionId)
    {
        $aSession = $this->getSession();
        $aIntegrations = $this->getTeacherIntegration();
        $aSection = $this->getSections(['id' => $iSectionId]);
        $aStudents = $this->getStudents($iSectionId);
        return view('pages.teacher.teacher_section_detail_v2')->with('aSession', $aSession)->with('aSection', $aSection)->with('aIntegrations', $aIntegrations)->with('aStudents', $aStudents);
    }

    public function examPage()
    {
        $aSession = $this->getSession();
        $aIntegrations = $this->getTeacherIntegration();
        $aExams = $this->getExams(['creator_id' => $aSession->getData()->id]);
        foreach ($aExams as $aExamData) {
            $aExamData['parent_course'] = $this->getIntegratedCourseDetail($aExamData['course_id']);
        }
        $aExams = $this->segregateExams($aExams);
        return view('pages.teacher.teacher_exam')->with('aSession', $aSession)->with('aExams', $aExams)->with('aIntegrations', $aIntegrations);
    }

    public function studentListPage()
    {
        $aSession = $this->getSession();
        $aIntegrations = $this->getTeacherIntegration();
        return view('pages.teacher.teacher_students')->with('aSession', $aSession)->with('aIntegrations', $aIntegrations);
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
        $aIntegrations = $this->getTeacherIntegration();
        $aExam = $this->getExams(['id' => $iExamId]);
        $aExam['integ_course'] = $this->getIntegratedCourseDetail($aExam[0]['course_id']);
        $aQuestions = $this->getExamQuestions($iExamId);
        $aChoices = $this->getExamChoices($aQuestions);
        return view('pages.teacher.teacher_view_exam')->with('aSession', $aSession)->with('aExam', $aExam)->with('aQuestions', $aQuestions)->with('aChoices', $aChoices)->with('aIntegrations', $aIntegrations);
    }

    /**
     * generate exam page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function generateExamPage()
    {
        $aSession = $this->getSession();
        $aIntegrations = $this->getTeacherIntegration();
        $aSubCourses = $this->getSubCourses();
        return view('pages.teacher.teacher_generate_exam')->with('aSession', $aSession)->with('aSubCourses', $aSubCourses)->with('aIntegrations', $aIntegrations);
    }
}
