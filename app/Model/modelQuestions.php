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
    protected $fillable = ['question', 'question_type', 'question_answer', 'question_difficulty', 'image_attachment'];

    public function courses()
    {
        return $this->belongsTo('App\Model\modelCourses', 'course_id');
    }

    public function choices()
    {
        return $this->hasMany('App\Model\modelChoices', 'question_id');
    }

    public function students()
    {
        return $this->belongsTo('App\Model\modelQuizzes');
    }

    public function quizzes()
    {
        return $this->belongsToMany('App\Model\modelQuizzes', 'question_quiz', 'quiz_id', 'question_id')                    ->withPivot('score', 'percentage')
            ->withTimestamps();
    }

    public function exams()
    {
        return $this->belongsToMany('App\Model\modelExams', 'question_exam', 'exam_id', 'question_id')                    ->withPivot('score', 'percentage')
            ->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany('App\Model\modelQuestions', 'user_question')                    
            ->withPivot('score', 'percentage')
            ->withPivot('answer')
            ->withTimestamps();
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