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

    public function quizzes()
    {
        return $this->belongsToMany('App\Model\modelQuizzes', 'user_quiz', 'quiz_id', 'user_id')                    ->withPivot('score', 'percentage')
            ->withTimestamps();
    }

    public function courses()
    {
        return $this->hasMany('App\Model\modelCourses', 'user_id');
    }

    public function integrated_courses()
    {
        return $this->belongsToMany('App\Model\modelIntegratedCourses', 'integration_users', 'user_id', 'integration_id')
            ->withTimestamps();
    }

    /**
     * @param $aRequest
     * @return mixed
     */
    public function registerUser($aRequest)
    {
        return self::create($aRequest);
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
     * Get user by username
     * @param $aParams
     * @return mixed
     */
	public function getUser($aParams)
	{
		return $this->where($aParams)->get()->first();
    }
    
    /**
     * Get all user
     * @param $aParams
     * @return mixed
     */
	public function getUsers($aParams)
	{
		return $this->where($aParams)->get();
    }

}
