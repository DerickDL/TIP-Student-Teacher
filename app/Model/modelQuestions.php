<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class modelQuestions extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'questions';

    /**
     * @var array
     */
    protected $fillable = ['question', 'question_type', 'question_answer', 'question_difficulty'];

    public function quizzes()
    {
        return $this->belongsTo('App\Model\modelQuizzes');
    }

    public function lessons()
    {
        return $this->belongsTo('App\Model\modelLessons', 'lesson_id');
    }

    public function choices()
    {
        return $this->hasMany('App\Model\modelChoices', 'question_id');
    }

    public function students()
    {
        return $this->belongsTo('App\Model\modelQuizzes');
    }

    /**
     * Find a question
     * @param $id
     * @return mixed
     */
    public function findQuestion($id)
    {
        return static::find($id);
    }

    /**
     * Get course/s
     * @param $aParams
     * @return mixed
     */
    public function getQuestions($aParams)
    {
        return static::where($aParams)->get();
    }
}