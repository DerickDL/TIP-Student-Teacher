<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class modelSections extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'sections';

    /**
     * @var array
     */
    protected $fillable = ['name', 'num_stud', 'class_room', 'act_room', 'date'];

    /**
     * Find a question
     * @param $id
     * @return mixed
     */
    public function findSection($id)
    {
        return static::find($id);
    }

    /**
     * Get course/s
     * @param $aParams
     * @return mixed
     */
    public function createSection($aParams)
    {
        return static::create($aParams);
    }

    public function getSections($aParams)
    {
        return static::where($aParams)->get();
    }
}