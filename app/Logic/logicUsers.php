<?php

namespace App\Logic;

use App\Model\modelUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
class logicUsers
{
	/**
	 * Model/Users modelUsers
	 *
	 */
	protected $modelUsers;

	public function __construct($modelUsers)
	{
		$this->modelUsers = $modelUsers;
	}

	/**
	 * Register user
	 * @param $aRequest
	 * @return array
	 */
    public function registerUser($aRequest)
    {
    	$aRules = [
    		'sFirstName'	=> 'required|string',
    		'sLastName'	=> 'required|string',
    		'sEmail'	=> 'required|string|unique:users,email|email',
    		'sUsername' => 'required|string|unique:users,username',
    		'sPassword'	=> 'required|string|min:8',
    		'iType'	=> 'required|integer'
    	];
    	$aRequest['iType'] = (int)$aRequest['iType'];
        if ($aRequest['iType'] === 0) {
            $aRules['sStudent'] = 'required|integer|min:7|unique:users,student_id';
        }
    	$aValidation = $this->validateUser($aRules, $aRequest);
    	if ($aValidation['result'] === false) {
    		return $aValidation;
    	}
    	$aParams = $this->createUser($aRequest);
    	$aReturn = $this->modelUsers->registerUser($aParams);
    	if ($aRequest['iType'] === 1) {
    	    $aData = [
    	        'receiver_email' => $aRequest['sEmail'],
    	        'fullname' => $aRequest['sFirstName'] . ' ' . $aRequest['sLastName'],
    	        'username' => $aRequest['sUsername'],
    	        'password' => $aRequest['sPassword'],
            ];
            event(new \App\Events\RegisteredInstructor($aData));
        }
    	return array('return' => $aReturn);
    }

    /**
     * @param $aRequest
     * @return array
     */
    private function createUser($aRequest)
    {
        $aUserData = [
            'first_name' => $aRequest['sFirstName'],
            'last_name' => $aRequest['sLastName'],
            'email' => $aRequest['sEmail'],
            'username' => $aRequest['sUsername'],
            'password' => $aRequest['sPassword'],
            'user_type' => $aRequest['iType'],
        ];
        if ($aRequest['iType'] === 0) {
            $aUserData['student_id'] = $aRequest['sStudent'];
        }
        return $aUserData;
    }

	/**
	 * login user
	 * @params $aRequest
	 * @return array
	 */
    public function loginUser($aRequest)
    {
    	$aRules = [
    		'sUsername' => 'required',
    		'sPassword'	=> 'required',
    	];
    	$aQueryCondition = array(
            'username' => $aRequest['sUsername'],
            'user_type' => (int)$aRequest['iType']
        );
    	if ($aRequest['iType'] === 0) {
    	    $aRules['sStudent'] = 'required|integer';
            $aQueryCondition['student_id'] = $aRequest['sStudent'];
        }
    	$aValidation = $this->validateUser($aRules, $aRequest);
    	if ($aValidation['result'] === false) {
    		return $aValidation;
    	}
    	return $this->validateLogin($this->modelUsers->getUser($aQueryCondition), $aRequest);
    }

	/**
	 * validate login input
	 * @param $aUser
	 * @param $aRequest
	 * @return array
	 */
    private function validateLogin($aUser, $aRequest)
    {
    	if (count((array)$aUser) === 0) {
			return array(
				'result' => false,
				'message' => 'User doesn\'t exist'
			);
    	}
    	if ($aUser->password !== $aRequest['sPassword']) {
    		return array(
    			'result' => false,
    			'message' => 'Wrong password'
    		);
    	}
        $this->setSession($aUser);
    	return array(
    		'result' => true,
    		'data' => $aUser
    	);
    }

    /**
	 * validate user
	 * @params $aRules
	 * @params $aData
	 * @return array
	 */
    private function validateUser($aRules, $aData)
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

    /**
     * logout user, flush session
     */
    public function logoutUser()
    {
        Session::flush();
    }

    /**
     * set session
     * @param $aUser
     */
    public function setSession($aUser)
    {
        Session::put('current_user', $aUser);
    }

    /**
     * get session
     * @return mixed
     */
    public function getSession()
    {
        return Session::get('current_user');
	}
	
	public function getUsers($aParams)
	{
		return $this->modelUsers->getUsers($aParams);
	}

	public function assignTeacherIntegration($aParams)
	{
		$aCheckUser = $this->checkExistingUser($aParams);
		if (count($aCheckUser) < 1) {
			return array(
				'result' => false,
				'message'	=> 'User doesn\'t exist!'
			);
		}
		$aAssignUser = $this->checkAssignUser($aCheckUser, $aParams);
		if (count($aAssignUser) > 0) {
			return array(
				'result' => false,
				'message'	=> 'This user is already assigned to this integration course!'
			);
		}
		$oUser = $this->modelUsers->findUser($aCheckUser[0]['id']);
		$oUser->integrated_courses()->attach($aParams['integration']);
		return array(
			'result' => true,
			'message'	=> 'This user is successfully assigned to this integration course!'
		);
	}

	private function checkExistingUser($aParams)
	{
		return $this->modelUsers->getUsers(['username' => $aParams['user']])->toArray();
	}

	private function checkAssignUser($aCheckUser, $aParams)
	{
		$oUser = $this->modelUsers->findUser($aCheckUser[0]['id']);
		return $oUser->integrated_courses()->wherePivot('integration_id', $aParams['integration'])->get()->toArray();
	}

	public function getTeacherIntegration($aUser)
	{
		$oUser = $this->modelUsers->findUser($aUser['id']);
		$aIntegrationsDetails = $oUser->integrated_courses()->get()->toArray();
		$aIntegrations[] = array_map(array($this, 'getIntegrationId'), $aIntegrationsDetails);
		sort($aIntegrations[0]);
		return $aIntegrations[0];
	}

	private function getIntegrationId($aIntegrationDetails)
	{
		return $aIntegrationDetails['id'];
	}

	public function getClasses($aParams)
    {
        $aStudent = $this->getSession();
        $oStudent = $this->modelUsers->findUser($aStudent['id']);
        return $oStudent->sections()->where($aParams)->get()->toArray();
    }
}
