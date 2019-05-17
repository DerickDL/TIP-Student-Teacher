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
     * @var array
     */
    protected $fillable = ['choice', 'is_correct'];

    public function questions()
    {
        return $this->belongsTo('App\Model\modelQuestions');
    }

    /**
     * Find a question
     * @param $id
     * @return mixed
     */
    public function findChoices($id)
    {
        return static::find($id);
    }

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