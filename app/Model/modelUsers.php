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

    /**
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'username', 'email', 'student_id', 'password', 'user_type'];

	public function registerUser($aRequest) 
	{
		return self::create($aRequest);
	}

	public function getUser($sUsername)
	{
		return $this->get()->where('username', '=', $sUsername)->first();
	}
}
