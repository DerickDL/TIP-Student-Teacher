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
     * Get course/s
     * @param $aParams
     * @return mixed
     */
    public function getCourses($aParams)
    {
        return static::where($aParams)->get();
    }
}