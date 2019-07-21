<?php


namespace App\Http\Controllers\App;

use App\Http\Traits\traitCourses;
use App\Http\Traits\traitIntegratedCourses;
use App\Http\Traits\traitLessons;
use App\Http\Traits\traitQuizzes;
use App\Http\Traits\traitFiles;
use App\Http\Traits\traitSections;
use App\Http\Traits\traitExams;

class frontUsers extends controllerUsers
{
    use traitCourses, traitQuizzes, traitLessons, traitIntegratedCourses, traitFiles, traitSections, traitExams;

    /**
     * Get page data
     * @param array $aParam
     * @return array
     */
    public function getPageData($aParam = [])
    {
        $aCourses = $this->getCourses($aParam);
        $aSession = $this->getSession();
        return array(
            'courses' => $aCourses,
            'session' => $aSession
        );
    }
}