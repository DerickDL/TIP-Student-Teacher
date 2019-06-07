<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class modelIntegratedCourses extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'integrated_courses';

    public function courses()
    {
        return $this->hasMany('App\Model\modelCourses', 'integrated_courses_id');
    }

    /**
     * Find a course
     * @param $id
     * @return mixed
     */
    public function findIntegratedCourse($id)
    {
        return static::find($id);
    }
}