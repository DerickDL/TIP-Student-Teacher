<?php

namespace App\Logic;

class logicStudents extends logicUsers
{
    public function __construct($modelUsers)
    {
        parent::__construct($modelUsers);
    }

    public function submitQuiz($aRequest, $aQuestions)
    {
        $aQuizResult = $this->checkQuiz($aRequest, $aQuestions);
        $aUser = $this->getSession();
        $oUser = $this->modelUsers->findUser($aUser['id']);
        $oUser->quizzes()->attach((int)$aRequest['quiz_id'], $aQuizResult);
        return $aQuizResult;
    }

    private function checkQuiz($aRequest, $aQuestions)
    {
        $iScore = 0;
        $iItems = 0;
        foreach ($aRequest['question_answer'] as $aQuestionAnswer) {
            $iItems++;
            foreach ($aQuestions as $aQuestionData) {
                if ((int)$aQuestionAnswer['question'] === (int)$aQuestionData['id'] && (int)$aQuestionAnswer['question_answer'] === (int)$aQuestionData['question_answer']) {
                    $iScore++;
                }
            }
        }
        $iPercentage = round(($iScore / $iItems) * 100, 2, PHP_ROUND_HALF_UP);
        return array(
            'score' => $iScore,
            'percentage' => $iPercentage
        );
    }
}