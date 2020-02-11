<?php

namespace App\Http\Controllers\Computation;

use App\Http\Controllers\Controller;
use App\Logic\logicComputation;
use Illuminate\Http\Request;

class controllerComputation extends Controller
{

    private $oLogicComputation;

    public function __construct(logicComputation $oLogicComputation)
    {
        $this->oLogicComputation = $oLogicComputation;
    }

    public function startCompute(Request $oRequest)
    {
        return response()->json($this->oLogicComputation->startCompute($oRequest->all()));
    }

}