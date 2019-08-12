<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class modelExams extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'exams';

    /**
     * @var array
     */
    protected $fillable = ['exam_title', 'items', 'course_id', 'time_limit', 'type'];

    public function questions()
    {
        return $this->belongsToMany('App\Model\modelQuestions', 'exam_question', 'exam_id', 'question_id')
            ->withTimestamps();
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
    public function findExam($id)
    {
        return static::find($id);
    }

    /**
     * Get quiz/s
     * @param $aParam
     * @return mixed
     */
    public function getExams($aParam)
    {
        return static::where($aParam)->get();
    }

    /**
     * @param $aParams
     * @return mixed
     */
    public function getLatestExams($aParams)
    {
        return static::where($aParams)->orderBy('created_at', 'DESC')->take(5)->get();
    }

    public function createExam($aData)
    {
        return static::create($aData);
    }

    public function deleteExam($iExamId)
    {
        return self::destroy($iExamId);
    }
}