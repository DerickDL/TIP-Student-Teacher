<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Logic\logicUsers;
use App\Model\modelUsers;

class controllerUsers extends Controller
{
	/**
	 * Logic/Users
	 *
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

    public function loginUser(Request $oRequest)
    {
    	return response()->json($this->logicUsers->loginUser($oRequest->all()));
    }
}
