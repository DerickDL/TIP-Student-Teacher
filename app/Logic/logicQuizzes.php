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
        $oCourses = $this->modelCourses->findCourse($aRequest['course_id']);
        $aQuizReturn = $oCourses->quizzes()->create([
            'quiz_title' => $aRequest['quiz_title'],
            'quiz_items' => count($aRequest['data'])
        ]);
        $oQuizzes = $this->modelQuizzes->findQuiz($aQuizReturn['id']);
        foreach ($aRequest['data'] as $aQuestion) {
            $aQuestionReturn = $this->addQuestion($oQuizzes, $aQuestion);
            if ((int)$aQuestion['type'] === 0) {
                foreach ($aQuestion['choices'] as $sChoice) {
                    $this->addChoice($aQuestion, $sChoice, $aQuestionReturn);
                }
            }
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
    public function getQuizzes($iQuizId)
    {
        if ($iQuizId === '') {
            $aParam = [];
        } else {
            $aParam = ['id' => $iQuizId];
        }
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
}
