<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class modelLessons extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'lessons';

    /**
     * @var array
     */
    protected $fillable = ['lesson_title', 'lesson_overview', 'course_id'];

    public function quizzes()
    {
        return $this->hasMany('App\Model\modelQuizzes', 'lesson_id');
    }

    public function courses()
    {
        return $this->belongsTo('App\Model\modelCourses', 'course_id');
    }

    /**
     * Find a course
     * @param $id
     * @return mixed
     */
    public function findLesson($id)
    {
        return self::findOrFail($id);
    }

    /**
     * Get course/s
     * @param $aParams
     * @return mixed
     */
    public function getLessons($aParams)
    {
        return static::where($aParams)->get();
    }

    /**
     * Insert course
     * @param $aData
     * @return mixed
     */
    public function insertLesson($aData)
    {
        return static::create($aData);
    }
}