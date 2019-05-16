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
     * Get course/s
     * @param $aParams
     * @return mixed
     */
    public function getQuestions($aParams)
    {
        return static::where($aParams)->get();
    }
}