<?php


namespace App\Http\Controllers\App;

use App\Http\Traits\traitCourses;

class frontUsers extends controllerUsers
{
    use traitCourses;

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