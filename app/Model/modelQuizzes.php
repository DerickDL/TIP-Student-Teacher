<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class modelQuizzes extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'quizzes';

    /**
     * @var array
     */
    protected $fillable = ['quiz_title', 'quiz_items'];

    public function questions()
    {
        return $this->hasMany('App\Model\modelQuestions', 'quiz_id');
    }

    public function courses()
    {
        return $this->belongsTo('App\Model\modelCourses');
    }

    public function users()
    {
        return $this->belongsToMany('App\Model\modelUsers', 'user_quiz', 'user_id', 'quiz_id')
            ->withPivot('score', 'percentage')
            ->withTimestamps();
    }

    /**
     * Find a quiz
     * @param $id
     * @return mixed
     */
    public function findQuiz($id)
    {
        return static::find($id);
    }

    /**
     * Get quiz/s
     * @param $aParam
     * @return mixed
     */
    public function getQuizzes($aParam)
    {
        return static::where($aParam)->get();
    }

    /**
     * @param $aParams
     * @return mixed
     */
    public function getLatestQuizzes($aParams)
    {
        return static::where($aParams)->orderBy('created_at', 'DESC')->take(5)->get();
    }
}