<?php

namespace App\Logic;

use App\Model\modelFiles;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class logicFiles
{
    /**
     * @var modelFiles
     */
    private $modelFiles;

    /**
     * logicLessons constructor.
     * @param $modelFiles
     */
    public function __construct($modelFiles)
    {
        $this->modelFiles = $modelFiles;
    }

    /**
     * Get all files
     * @param $aParams
     * @return mixed
     */
    public function getFiles($aParams)
    {
        return $this->modelFiles->getFiles($aParams);
    }

    /**
     * @param $iFileId
     * @return mixed
     */
    public function retrieveFile($iFileId)
    {
        $aFileData = $this->modelFiles->findFile($iFileId);
        return Storage::download('attachments/' . $aFileData['new_filename'], $aFileData['filename']);
    }

    /**
     * insert files
     * @param $aRequest
     * @param $iCourseId
     * @return mixed
     */
    public function insertFile($aRequest, $iCourseId)
    {
        $aRules = array(
            'attached-file' => 'required|mimes:doc,docx,pdf,zip,txt',
        );
        $aValidation = $this->validateFiles($aRules, $aRequest);
        if ($aValidation['result'] === false) {
            return $aValidation;
        }
        $sName = $aRequest['attached-file']->getClientOriginalName();
        $sNewName = $this->moveFile($aRequest);
        $aData = array(
            'filename' => $sName,
            'new_filename' => $sNewName,
            'course_id' => $iCourseId
        );
        $aUploadedFile = $this->modelFiles->insertFile($aData);
        return array(
            'result' => true,
            'data' => $aUploadedFile,
            'message' => 'Uploaded Successfully!'
        );
    }

    private function moveFile($aData)
    {
        $oFile = $aData['attached-file'];
        $sNewName = rand() . '.' . $oFile->getClientOriginalExtension();
        $oFile->storeAs('attachments', $sNewName);
        return $sNewName;
    }

    
    /**
	 * validate lesson
	 * @param $aRules
	 * @param $aData
	 * @return array
	 */
    private function validateFiles($aRules, $aData)
    {
        $validator = Validator::make($aData, $aRules);
        if ($validator->fails()) {
            return array(
                'result' => false,
                'message' => $validator->messages()->first()
            );
        }
        return array('result' => true);
    }

    /**
     * delete file
     * @param $iFileId
     * @return mixed
     */
    public function deleteFile($iFileId)
    {
        $aFileData = $this->modelFiles->findFile($iFileId);
        $this->removeFile($aFileData);
        return $this->modelFiles->deleteFile($iFileId);
    }

    /**
     * @param $aFileData
     */
    private function removeFile($aFileData)
    {
        Storage::delete('attachments/' . $aFileData['new_filename']);
    }
}