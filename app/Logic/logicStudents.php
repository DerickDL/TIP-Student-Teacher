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
        foreach ($aRequest['question_answer'] as $aQuestionAnswer) {
            $aPivotData = [
                'answer' => $aQuestionAnswer['question_answer'],
                'type' => 'quiz',
                'mixed_id' => (int)$aRequest['quiz_id'],
            ];
            $oUser->questions()->attach($aQuestionAnswer['question'], $aPivotData);
        }
        return $aQuizResult;
    }

    public function submitExam($aRequest, $aQuestions)
    {
        $aExamResult = $this->checkQuiz($aRequest, $aQuestions);
        $aUser = $this->getSession();
        $oUser = $this->modelUsers->findUser($aUser['id']);
        $oUser->exams()->attach((int)$aRequest['exam_id'], $aExamResult);
        foreach ($aRequest['question_answer'] as $aQuestionAnswer) {
            $aPivotData = [
                'answer' => $aQuestionAnswer['question_answer'],
                'type' => 'exam',
                'mixed_id' => (int)$aRequest['exam_id'],
            ];
            $oUser->questions()->attach($aQuestionAnswer['question'], $aPivotData);
        }
        return $aExamResult;
    }

    private function checkQuiz($aRequest, $aQuestions)
    {
        $iScore = 0;
        $iItems = 0;
        foreach ($aRequest['question_answer'] as $aQuestionAnswer) {
            $iItems++;
            foreach ($aQuestions as $aQuestionData) {
                if ((int)$aQuestionAnswer['question'] === (int)$aQuestionData['id'] && $aQuestionAnswer['question_answer'] == $aQuestionData['question_answer']) {
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

    public function getQuestionAnswer($iUserId, $aParams)
    {
        $oUser = $this->modelUsers->findUser($iUserId);
        return $oUser->questions()->where($aParams)->get()->toArray();
    }
}