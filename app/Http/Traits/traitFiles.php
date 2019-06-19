<?php

namespace App\Http\Traits;

use App\Logic\logicFiles;
use App\Model\modelFiles;

trait traitFiles
{
    /**
     * @var logicFiles
     */
    private $logicFiles;

    /**
     * instantiate objects
     */
    private function instantiateFiles()
    {
        $this->logicFiles = new logicFiles(new modelFiles());
    }

    /**
     * Get lesson/s
     * @param array $aParams
     * @return mixed
     */
    public function getFiles($aParams = [])
    {
        $this->instantiateFiles();
        return $this->logicFiles->getFiles($aParams);
    }

    /**
     * @param $iFileId
     * @return mixed
     */
    public function retrieveFile($iFileId)
    {
        $this->instantiateFiles();
        return $this->logicFiles->retrieveFile($iFileId);
    }


    /**
     * Insert lesson
     * @param array $aData
     * @param $iCourseId
     * @return mixed
     */
    public function insertFile($aData, $iCourseId)
    {
        $this->instantiateFiles();
        return $this->logicFiles->insertFile($aData, $iCourseId);
    }

    /**
     * @param $iFileId
     * @return mixed
     */
    public function removeFile($iFileId)
    {
        $this->instantiateFiles();
        return $this->logicFiles->deleteFile($iFileId);
    }
}