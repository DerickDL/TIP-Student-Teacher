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
    protected $fillable = ['first_name', 'last_name', 'email', 'username', 'password', 'user_type'];

    public function quizzes()
    {
        return $this->belongsToMany('App\Model\modelQuizzes', 'user_quiz', 'quiz_id', 'user_id')                    ->withPivot('score', 'percentage')
            ->withTimestamps();
    }

    /**
     * find user by ID
     * @param $iId
     * @return mixed
     */
    public function findUser($iId)
    {
        return static::find($iId);
    }

    /**
     * Create a user
     * @param $aRequest
     * @return mixed
     */
	public function registerUser($aRequest) 
	{
		$aCreateUser = array(
		    'first_name' => $aRequest['sFirstName'],
            'last_name' => $aRequest['sLastName'],
            'email' => $aRequest['sEmail'],
            'username' => $aRequest['sUsername'],
            'password' => $aRequest['sPassword'],
            'user_type' => $aRequest['iType'],
        );
		return $this->create($aCreateUser);
	}

    /**
     * Get user by username
     * @param $sUsername
     * @return mixed
     */
	public function getUser($sUsername)
	{
		return $this->get()->where('username', '=', $sUsername)->first();
	}

}
