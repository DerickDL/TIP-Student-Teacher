<?php

namespace App\Logic;


use App\Model\modelChoices;
use App\Model\modelCourses;
use App\Model\modelQuestions;
use App\Model\modelQuizzes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class logicQuizzes
{
    /**
     * @var modelCourses
     */
    private $modelCourses;

	/**
	 * @var modelQuizzes
	 */
	private $modelQuizzes;

    /**
     * @var modelQuestions
     */
	private $modelQuestions;

    /**
     * @var modelChoices
     */
	private $modelChoices;

	public function __construct($modelCourses, $modelQuizzes, $modelQuestions, $modelChoices)
	{
		$this->modelCourses = $modelCourses;
		$this->modelQuizzes = $modelQuizzes;
		$this->modelQuestions = $modelQuestions;
		$this->modelChoices = $modelChoices;
	}

    /**
     * @param $aRequest
     */
	public function insertQuiz($aRequest)
    {
        $aValidateParams = $this->validateParams(
            array(
                'course_id' => 'required',
                'quiz_items' => 'required|integer',
                'quiz_timelimit' => 'required|integer'
            ),
            $aRequest
        );
        if ($aValidateParams['result'] === false) {
            return $aValidateParams;
        }
        $aData = [
            'course_id' => $aRequest['course_id'],
            'quiz_items' => $aRequest['quiz_items'],
            'quiz_timelimit' => $aRequest['quiz_timelimit']
        ];
        $aQuiz = $this->modelQuizzes->createQuiz($aRequest);
        $oQuiz = $this->modelQuizzes->findQuiz($aQuiz['id']);
        foreach ($aRequest['questions'] as $aQuestion) {
            $oQuiz->questions()->attach($aQuestion['id']);
        }
    }

    /**
     * @param $oQuizzes
     * @param $aQuestion
     * @return mixed
     */
    private function addQuestion($oQuizzes, $aQuestion)
    {
        $aQuestionData = [
            'question' => $aQuestion['question'],
            'question_type' => $aQuestion['type']
        ];
        if ((int)$aQuestion['type'] === 1) {
            $aQuestionData['question_answer'] = (int)$aQuestion['answer'];
        }
        return $oQuizzes->questions()->create($aQuestionData);
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
     * @param $iQuizId
     * @return mixed
     */
    public function getQuizzes($aParam)
    {
        return $this->modelQuizzes->getQuizzes($aParam);
    }

    /**
     * @param $aParam
     * @return mixed
     */
    public function getLatestQuizzes($aParam)
    {
        return $this->modelQuizzes->getLatestQuizzes($aParam);
    }

    /**
     * @param $iQuizId
     * @return mixed
     */
    public function getQuestions($iQuizId)
    {
        $oQuiz = $this->modelQuizzes->findQuiz($iQuizId);
        return $oQuiz->questions;
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

    /**
     * validate user
     * @params $aRules
     * @params $aData
     * @return array
     */
    private function validateParams($aRules, $aData)
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

    public function deleteQuiz($iQuizId)
    {
        $oExam = $this->modelQuizzes->findQuiz($iQuizId);
        $oExam->questions()->detach();
        $this->modelQuizzes->deleteQuiz($iQuizId);
    }
}
