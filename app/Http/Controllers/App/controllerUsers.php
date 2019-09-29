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
     * logout, flush session
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logoutUser()
    {
        $aSession = $this->logicUsers->getSession();
        $this->logicUsers->logoutUser();
        if ($aSession['user_type'] === 0) {
            return redirect('/');
        } else if ($aSession['user_type'] === 1) {
            return redirect('/teacher');
        } else {
            return redirect('/admin');
        }
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
}
