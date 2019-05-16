<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class modelChoices extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'choices';

    /**
     * Get course/s
     * @param $aParams
     * @return mixed
     */
    public function getChoices($aParams)
    {
        return static::where($aParams)->get();
    }
}