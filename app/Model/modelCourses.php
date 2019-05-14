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
     * Get all courses
     * @return mixed
     */
    public function getCourses()
    {
        return static::all();
    }
}