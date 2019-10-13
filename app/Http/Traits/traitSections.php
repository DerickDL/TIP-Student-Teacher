<?php

namespace App\Http\Traits;

use App\Logic\logicSections;
use App\Model\modelSections;

trait traitSections
{
    /**
     * @var logicSections
     */
    private $logicSections;

    /**
     * instantiate objects
     */
    private function instantiateSections()
    {
        $this->logicSections = new logicSections(new modelSections());
    }

    public function insertSection($aRequest)
    {
        $this->instantiateSections();
        return $this->logicSections->insertSection($aRequest);
    }

    public function getSections($aParam = []) 
    {
        $this->instantiateSections();
        return $this->logicSections->getSections($aParam);
    }

    public function deleteSection($iSectionId) 
    {
        $this->instantiateSections();
        return $this->logicSections->deleteSection($iSectionId);
    }

    public function enrollSection($aRequest) 
    {
        $this->instantiateSections();
        return $this->logicSections->enrollSection($aRequest);
    }
}