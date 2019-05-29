<?php

namespace App\Logic;

use App\Model\modelCourses;
use App\Model\modelLessons;
use Illuminate\Support\Facades\Validator;

class logicLessons
{
    /**
     * @var modelCourses
     */
    private $modelCourses;

    /**
     * @var modelLessons
     */
    private $modelLessons;

    /**
     * logicCourses constructor.
     * @param $modelCourses
     */
    public function __construct($modelCourses, $modelLessons)
    {
        $this->modelCourses = $modelCourses;
        $this->modelLessons = $modelLessons;
    }

    /**
     * Get all lessons
     * @return mixed
     */
    public function getLessons($aParams)
    {
        return $this->modelLessons->getLessons($aParams);
    }

    /**
     * insert lessons
     * @return mixed
     */
    public function insertLesson($aRequest)
    {

    }

    
    /**
	 * validate user
	 * @params $aRules
	 * @params $aData
	 * @return array
	 */
    private function validateLesson($aRules, $aData)
    {

    }
}