<?php

namespace App\Logic;


use App\Model\modelChoices;
use App\Model\modelCourses;
use App\Model\modelQuestions;

class logicQuestions
{
    /**
     * @var modelCourses
     */
    private $modelCourses;

    /**
     * @var modelQuestions
     */
	private $modelQuestions;

    /**
     * @var modelChoices
     */
	private $modelChoices;

	public function __construct($modelCourses, $modelQuestions, $modelChoices)
	{
		$this->modelCourses = $modelCourses;
		$this->modelQuestions = $modelQuestions;
		$this->modelChoices = $modelChoices;
	}

    public function loadQuestions($iCourseId, $aParams)
    {
        $oCourse =  $this->modelCourses->findCourse($iCourseId);
        return $oCourse->questions()->where($aParams)->get();
    }

    /**
     * @param $aRequest
     * @param $iCourseId
     */
	public function insertQuestion($aRequest, $iCourseId)
    {
        $oCourse = $this->modelCourses->findCourse($iCourseId);
        $aQuestion = $aRequest['data'];
        $aQuestionReturn = $this->addQuestion($oCourse, $aQuestion);
        if ((int)$aQuestion['type'] === 0) {
            foreach ($aQuestion['choices'] as $sChoice) {
                $this->addChoice($aQuestion, $sChoice, $aQuestionReturn);
            }
        }
    }

    /**
     * @param $oCourses
     * @param $aQuestion
     * @return mixed
     */
    private function addQuestion($oCourses, $aQuestion)
    {
        $aQuestionData = [
            'question' => $aQuestion['question'],
            'question_type' => $aQuestion['type'],
            'question_difficulty' => $aQuestion['difficulty']
        ];
        if ((int)$aQuestion['type'] === 1) {
            $aQuestionData['question_answer'] = (int)$aQuestion['answer'];
        }
        return $oCourses->questions()->create($aQuestionData);
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
