<?php

namespace App\Logic;

use App\Model\modelCourses;
use Illuminate\Support\Facades\Validator;

class logicCourses
{
    /**
     * @var modelCourses
     */
    private $modelCourses;

    /**
     * logicCourses constructor.
     * @param $modelCourses
     */
    public function __construct($modelCourses)
    {
        $this->modelCourses = $modelCourses;
    }

    /**
     * Get all courses
     * @return mixed
     */
    public function getCourses($aParams)
    {
        return $this->modelCourses->getCourses($aParams);
    }

    /**
     * insert course
     * @return mixed
     */
    public function insertCourse($aRequest)
    {
        $aData = array(
            'course_code' => $aRequest['course_code'],
            'course_title' => $aRequest['course_title'],
            'course_overview' => $aRequest['course_overview'],
            'user_id' => $aRequest['course_user_id'],
        );
        $aRules = array(
            'course_code' => 'required|string',
            'course_title' => 'required|string',
            'course_overview' => 'required|string',
            'user_id'   => 'required|int'
        );
        $aValidation = $this->validateCourse($aRules, $aData);
        if ($aValidation['result'] === false) {
            return $aValidation;
        }
        $this->modelCourses->insertCourse($aData);
        return array(
            'result' => true
        );
    }

    
    /**
	 * validate user
	 * @params $aRules
	 * @params $aData
	 * @return array
	 */
    private function validateCourse($aRules, $aData)
    {
    	$validator = Validator::make($aData, $aRules);
    	if ($validator->fails()) {
		    return array(
		    	'result' => false,
		    	'message' => $validator->messages()->first()
		    );
		}
		return array('result' => true);
    }
}