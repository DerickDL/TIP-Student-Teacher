<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class modelCourses extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'courses';

    /**
     * @var array
     */
    protected $fillable = ['course_code', 'course_title', 'course_overview', 'user_id', 'integrated_course_id'];

    public function questions()
    {
        return $this->hasMany('App\Model\modelQuestions', 'question_id');
    }

    public function quizzes()
    {
        return $this->hasMany('App\Model\modelQuizzes', 'course_id');
    }

    public function users()
    {
        return $this->belongsTo('App\Model\modelUsers', 'course_id');
    }

    public function integrated_courses()
    {
        return $this->belongsTo('App\Model\modelIntegratedCourses', 'integrated_course_id');
    }

    /**
     * Find a course
     * @param $id
     * @return mixed
     */
    public function findCourse($id)
    {
        return static::find($id);
    }

    /**
     * Get course/s
     * @param $aParams
     * @return mixed
     */
    public function getCourses($aParams)
    {
        return static::where($aParams)->get();
    }

    /**
     * Insert course
     * @param $aData
     * @return mixed
     */
    public function insertCourse($aData)
    {
        return static::create($aData);
    }

    public function deleteCourse($iCourseId)
    {
        return self::destroy($iCourseId);
    }
}