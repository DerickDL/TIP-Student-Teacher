<?php

namespace App\Http\Traits;

use App\Logic\logicStudents;
use App\Model\modelUsers;

trait traitStudents
{
    /**
     * @var logicStudents
     */
    private $logicStudents;

    /**
     * instantiate objects
     */
    private function instantiateStudents()
    {
        $this->logicStudents = new logicStudents(new modelUsers());
    }

    public function getQuestionAnswer($iUserId, $aParams)
    {
        $this->instantiateStudents();
        return $this->logicStudents->getQuestionAnswer($iUserId, $aParams);
    }
}