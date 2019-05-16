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
     * Get course/s
     * @param $aParams
     * @return mixed
     */
    public function getQuizzes($aParams)
    {
        return static::where($aParams)->get();
    }
}