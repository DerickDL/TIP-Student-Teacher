<?php

namespace App\Http\Controllers\App;

use App\Logic\logicUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\modelUsers;

class controllerUsers extends Controller
{
	/**
	 * Logic/Users logic
	 * @var logicUsers
	 */
	private $logicUsers;

	public function __construct()
	{
		$this->logicUsers = new logicUsers(new modelUsers());
	}

	/**
	 * Register user
	 * @params $oRequest
	 * @return array
	 */
    public function registerUser(Request $oRequest)
    {
    	return response()->json($this->logicUsers->registerUser($oRequest->all()));
    }

    /**
     * login user
     * @param Request $oRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginUser(Request $oRequest)
    {
    	return response()->json($this->logicUsers->loginUser($oRequest->all()));
    }

    /**
     * change password
     * @param Request $oRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(Request $oRequest) {
        return response()->json($this->logicUsers->changePassword($oRequest->all()));
    }

    /**
     * logout, flush session
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logoutUser()
    {
        $aSession = $this->logicUsers->getSession();
        $this->logicUsers->logoutUser();
        return redirect('/');
    }

    /**
     * get session
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSession()
    {
        return response()->json($this->logicUsers->getSession());
    }

    public function getUsers(Request $oRequest)
    {
        return response()->json($this->logicUsers->getUsers($oRequest->all()));
    }

    public function assignTeacherIntegration(Request $oRequest)
    {
        return response()->json($this->logicUsers->assignTeacherIntegration($oRequest->all()));
    }

    public function getTeacherIntegration()
    {
        $aSession = $this->logicUsers->getSession();
        return $this->logicUsers->getTeacherIntegration($aSession);
    }

    public function getClasses($aParams = [])
    {
        return $this->logicUsers->getClasses($aParams);
    }
}
