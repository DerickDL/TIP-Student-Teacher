<?php

namespace App\Logic;


use App\Model\modelChoices;
use App\Model\modelLessons;
use App\Model\modelQuestions;

class logicQuestions
{
    /**
     * @var modelLessons
     */
    private $modelLessons;

    /**
     * @var modelQuestions
     */
	private $modelQuestions;

    /**
     * @var modelChoices
     */
	private $modelChoices;

	public function __construct($modelLessons, $modelQuestions, $modelChoices)
	{
		$this->modelLessons = $modelLessons;
		$this->modelQuestions = $modelQuestions;
		$this->modelChoices = $modelChoices;
	}

    /**
     * @param $aRequest
     * @param $iLessonId
     */
	public function insertQuestion($aRequest, $iLessonId)
    {
        $oLesson = $this->modelLessons->findLesson($iLessonId);
        $aQuestion = $aRequest['data'];
        $aQuestionReturn = $this->addQuestion($oLesson, $aQuestion);
        if ((int)$aQuestion['type'] === 0) {
            foreach ($aQuestion['choices'] as $sChoice) {
                $this->addChoice($aQuestion, $sChoice, $aQuestionReturn);
            }
        }
    }

    /**
     * @param $oLessons
     * @param $aQuestion
     * @return mixed
     */
    private function addQuestion($oLessons, $aQuestion)
    {
        $aQuestionData = [
            'question' => $aQuestion['question'],
            'question_type' => $aQuestion['type'],
            'question_difficulty' => $aQuestion['difficulty']
        ];
        if ((int)$aQuestion['type'] === 1) {
            $aQuestionData['question_answer'] = (int)$aQuestion['answer'];
        }
        return $oLessons->questions()->create($aQuestionData);
    }

    /**
     * @param $aQuestion
     * @param $sChoice
     * @param $aQuestionReturn
     */
    private function addChoice($aQuestion, $sChoice, $aQuestionReturn)
    {
        $oQuestions = $this->modelQuestions->findQuestion($aQuestionReturn['id']);
        $aChoiceReturn = $oQuestions->choices()->create([
            'choice' => $sChoice,
            'is_correct' => ($sChoice === $aQuestion['answer']) ? 1 : 0
        ]);
        if ($sChoice === $aQuestion['answer']) {
            $oQuestions->question_answer = $aChoiceReturn['id'];
            $oQuestions->save();
        }
    }

    /**
     * @param $aParam
     * @return mixed
     */
    public function getQuestions($aParam)
    {
        return $this->modelQuestions->getQuestions($aParam);
    }

    /**
     * @param $aParam
     * @return mixed
     */
    public function getChoices($aQuestion)
    {
        $aChoices = [];
        foreach ($aQuestion as $aQuestionData) {
           $aChoiceData = $this->modelChoices->getChoices(['question_id' => $aQuestionData['id']]);
           array_push($aChoices, $aChoiceData);
        }
        return  $aChoices;
    }

    /**
     * @param $iQuizId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getQuizScore($iQuizId, $iUserId)
    {
        $oQuiz = $this->modelQuizzes->findQuiz($iQuizId);
        return $oQuiz->users()->find($iUserId);
    }
}
