<?php

namespace App\Logic;

use App\Model\modelUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
class logicQuizzes
{
	/**
	 * Model/Users modelUsers
	 *
	 */
	private $modelUsers;

	public function __construct($modelUsers)
	{
		$this->modelUsers = $modelUsers;
	}

	/**
	 * Register user
	 * @params $aRequest
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
    	$aValidation = $this->validateUser($aRules, $aRequest);
    	if ($aValidation['result'] === false) {
    		return $aValidation;
    	}
    	$aReturn = $this->modelUsers->registerUser($aRequest);
    	return array('return' => $aReturn);
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
    	$aValidation = $this->validateUser($aRules, $aRequest);
    	if ($aValidation['result'] === false) {
    		return $aValidation;
    	}
    	return $this->validateLogin($this->modelUsers->getUser($aRequest['sUsername']), $aRequest);
    }

	/**
	 * validate login input
	 * @params $aUser
	 * @params $aRequest
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
}
