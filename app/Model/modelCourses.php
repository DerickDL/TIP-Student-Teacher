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
    protected $fillable = ['course_code', 'course_title', 'course_overview', 'user_id'];

    public function lessons()
    {
        return $this->hasMany('App\Model\modelLessons', 'course_id');
    }

    public function users()
    {
        return $this->belongsTo('App\Model\modelUsers', 'user_id');
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
}