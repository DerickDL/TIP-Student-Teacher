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
                'result' => false
            );
        }
        //@TODO
        //INSERT to sections_students table
        $oSection = $this->modelSections->findSection($aSection[0]['id']);
        $oSection->users()->attach($aRequest['user_id'], 0);
    }
}
