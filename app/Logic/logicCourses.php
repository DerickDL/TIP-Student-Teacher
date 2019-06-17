<?php

namespace App\Logic;

use App\Model\modelCourses;
use App\Model\modelUsers;
use Illuminate\Support\Facades\Validator;

class logicCourses
{
    /**
     * @var modelCourses
     */
    private $modelCourses;

    /**
     * @var modelUsers
     */
    private $modelUsers;

    /**
     * logicCourses constructor.
     * @param $modelCourses
     * @param $modelUsers
     */
    public function __construct($modelCourses, $modelUsers)
    {
        $this->modelCourses = $modelCourses;
        $this->modelUsers = $modelUsers;
    }

    /**
     * @param $aParams
     * @return mixed
     */
    public function getCourses($aParams)
    {
        return $this->modelCourses->getCourses($aParams);
    }

    /**
     * @param $aRequest
     * @param $iIntegratedCourseId
     * @return array
     */
    public function insertCourse($aRequest)
    {
        $aData = array(
            'course_code' => $aRequest['course_code'],
            'course_title' => $aRequest['course_title'],
            'course_overview' => $aRequest['course_overview']
        );
        $aRules = array(
            'course_code' => 'required|string',
            'course_title' => 'required|string',
            'course_overview' => 'required|string'
        );
        $aValidation = $this->validateCourse($aRules, $aData);
        if ($aValidation['result'] === false) {
            return $aValidation;
        }
        $aData['integrated_course_id'] = $aRequest['integrated_course_id'];
        $aData['user_id'] = $aRequest['course_user_id'];
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

    public function deleteCourse($iCourseId)
    {
        $this->modelCourses->deleteCourse($iCourseId);
    }
}