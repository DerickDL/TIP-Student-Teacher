<?php
/**
 * Created by PhpStorm.
 * User: PH_DEVPC
 * Date: 4/5/2020
 * Time: 6:55 PM
 */

namespace App\Http\Controllers\Quizzes;

use App\Logic\logicQuizzesGraph;

class controllerQuizzesGraph
{
    private $oLogicQuizzesGraph;

    public function __construct(logicQuizzesGraph $oLogicQuizzesGraph)
    {
        $this->oLogicQuizzesGraph = $oLogicQuizzesGraph;
    }

    public function getQuizzesGraph($iTeacherId)
    {
        return response()->json($this->oLogicQuizzesGraph->getGraphQuizzes($iTeacherId));
    }
}