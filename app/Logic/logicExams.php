<?php

namespace App\Logic;


use App\Model\modelChoices;
use App\Model\modelCourses;
use App\Model\modelQuestions;
use App\Model\modelExams;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class logicExams
{
    /**
     * @var modelCourses
     */
    private $modelCourses;

	/**
	 * @var modelExams
	 */
	private $modelExams;

    /**
     * @var modelQuestions
     */
	private $modelQuestions;

    /**
     * @var modelChoices
     */
	private $modelChoices;

	public function __construct($modelCourses, $modelExams, $modelQuestions, $modelChoices)
	{
		$this->modelCourses = $modelCourses;
		$this->modelExams = $modelExams;
		$this->modelQuestions = $modelQuestions;
		$this->modelChoices = $modelChoices;
	}

    /**
     * @param $aRequest
     */
	public function insertExam($aRequest)
    {
        $aValidateParams = $this->validateParams(
            array(
                'course_id' => 'required',
                'items' => 'required|integer',
                'time_limit' => 'required|integer'
            ),
            $aRequest
        );
        if ($aValidateParams['result'] === false) {
            return $aValidateParams;
        }
        $aData = [
            'course_id' => $aRequest['course_id'],
            'items' => $aRequest['items'],
            'time_limit' => $aRequest['time_limit']
        ];
        $aExam = $this->modelExams->createExam($aRequest);
        $oExam = $this->modelExams->findExam($aExam['id']);
        foreach ($aRequest['questions'] as $aQuestion) {
            $oExam->questions()->attach($aQuestion['id']);
        }
    }

    /**
     * @param $oExams
     * @param $aQuestion
     * @return mixed
     */
    private function addQuestion($oExams, $aQuestion)
    {
        $aQuestionData = [
            'question' => $aQuestion['question'],
            'question_type' => $aQuestion['type']
        ];
        if ((int)$aQuestion['type'] === 1) {
            $aQuestionData['question_answer'] = (int)$aQuestion['answer'];
        }
        return $oExams->questions()->create($aQuestionData);
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
     * @param $iExamId
     * @return mixed
     */
    public function getExams($aParam)
    {
        return $this->modelExams->getExams($aParam);
    }

    /**
     * @param $aParam
     * @return mixed
     */
    public function getLatestExams($aParam)
    {
        return $this->modelExams->getLatestExams($aParam);
    }

    /**
     * @param $iExamId
     * @return mixed
     */
    public function getQuestions($iExamId)
    {
        $oExam = $this->modelExams->findExam($iExamId);
        return $oExam->questions;
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
     * @param $iExamId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getExamScore($iExamId, $iUserId)
    {
        $oExam = $this->modelExams->findExam($iExamId);
        return $oExam->users()->find($iUserId);
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
}
