<?php

namespace App\Logic;

use App\Model\modelSections;
use Illuminate\Support\Facades\Validator;

class logicSections
{
    /**
     * @var modelSections
     */
	private $modelSections;

	public function __construct($modelSections)
	{
		$this->modelSections = $modelSections;
	}

    /**
     * @param $aRequest
     */
	public function insertSection($aRequest)
    {
        $aValidate = $this->validateParams(
            array(
                'name' => 'required',
                'num_stud' => 'required|integer',
                'start_date' => 'required',
                'end_date' => 'required',
                'integration_id' => 'required',
                'key' => 'required|unique:sections,key'
            ),
            $aRequest
        );
        if ($aValidate['result'] === false) {
            return $aValidate;
        }
        $this->modelSections->createSection($aRequest);
        return array(
            'result' => true,
            'message' => 'Created section successfully.'
        );
    }

    public function getSections($aParam)
    {
        return $this->modelSections->getSections($aParam);
    }

    
    public function deleteSection($iSectionId)
    {
        $this->modelSections->deleteSection($iSectionId);
    }

    /**
	 * validate user
	 * @params $aRules
	 * @params $aData
	 * @return array
	 */
    private function validateParams($aRules, $aData)
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

    public function enrollSection($aRequest)
    {
        $aSection = $this->modelSections->getSections(['key' => $aRequest['key']]);
        if (count($aSection) < 1) {
            return array(
                'result' => false,
                'message' => 'Invalid Code.'
            );
        }
        $oSection = $this->modelSections->findSection($aSection[0]['id']);
        $aStudents = $oSection->users()->where(['status' => 1])->get()->toArray();
        if (count($aStudents) === $aSection[0]['num_stud']) {
            return array(
                'result' => false,
                'message' => 'No more slot for this section.'
            );
        }
        $aStudent = $oSection->users()->where(['user_id' => $aRequest['user_id']])->get()->toArray();
        if (count($aStudent) > 0) {
            return array(
                'result' => false,
                'message' => 'You are already enrolled in this class. If not yet enrolled, please wait for your teacher\'s confirmation'
            );
        }
        $oSection->users()->attach($aRequest['user_id'], ['status' => 0]);
        return array(
            'result' => true
        );
    }

    public function getStudents($iSectionId)
    {
        $oSection = $this->modelSections->findSection($iSectionId);
        return $oSection->users()->get()->toArray();
    }

    public function deleteStudent($aRequest)
    {
        $oSection = $this->modelSections->findSection($aRequest['section_id']);
        $oSection->users()->detach($aRequest['student_id']);
    }

    public function updateStudentStatus($aRequest)
    {
        $oSection = $this->modelSections->findSection($aRequest['section_id']);
        $oSection->users()->updateExistingPivot($aRequest['student_id'], ['status' => 1]);
    }
}
