<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class modelUsers extends Model
{
	/**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
	protected $table = 'users';

	public function registerUser($aRequest) 
	{
		$this->first_name = $aRequest['sFirstName'];
		$this->last_name = $aRequest['sLastName'];
		$this->email = $aRequest['sEmail'];
		$this->username = $aRequest['sUsername'];
		$this->password = $aRequest['sPassword'];
		$this->user_type = $aRequest['iType'];
		return $this->save();
	}

	public function getUser($sUsername)
	{
		return $this->get()->where('username', '=', $sUsername)->first();
	}
}
