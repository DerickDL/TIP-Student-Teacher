<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class modelFiles extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'files';

    /**
     * @var array
     */
    protected $fillable = ['filename', 'new_filename', 'course_id'];

    public function courses()
    {
        return $this->belongsTo('App\Model\modelCourses', 'course_id');
    }

    /**
     * Find a course
     * @param $id
     * @return mixed
     */
    public function findFile($id)
    {
        return self::findOrFail($id);
    }

    /**
     * Get course/s
     * @param $aParams
     * @return mixed
     */
    public function getFiles($aParams)
    {
        return static::where($aParams)->get();
    }

    /**
     * Insert course
     * @param $aData
     * @return mixed
     */
    public function insertFile($aData)
    {
        return static::create($aData);
    }

    /**
     * delete lesson
     * @param $iLessonId
     * @return int
     */
    public function deleteFile($iFileId)
    {
        return self::destroy($iFileId);
    }
}