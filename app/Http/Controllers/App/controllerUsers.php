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
        if ($aSession['user_type'] !== 2) {
            return redirect('/');
        }
        return redirect('/admin');
    }

    /**
     * get session
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSession()
    {
        return response()->json($this->logicUsers->getSession());
    }
}
