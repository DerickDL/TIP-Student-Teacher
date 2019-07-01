<?php

namespace App\Http\Controllers\Sections;

use App\Http\Controllers\Controller;
use App\Http\Traits\traitSections;
use Illuminate\Http\Request;

class restSections extends Controller
{
    use traitSections;

    /**
     * @param Request $oRequest
     */
    public function saveSection(Request $oRequest)
    {
       return response()->json($this->insertSection($oRequest->all()));
    }
}