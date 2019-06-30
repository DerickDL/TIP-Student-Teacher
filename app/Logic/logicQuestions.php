<?php

namespace App\Logic;


use App\Model\modelChoices;
use App\Model\modelCourses;
use App\Model\modelQuestions;
use Illuminate\Support\Facades\Validator;

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

    public function generateQuizQuestions($aRequest)
    { 
        $aValidateParams = $this->validateParams(
            array(
                'course_id' => 'required',
                'quiz_items' => 'required|integer'
            ),
            $aRequest
        );
        if ($aValidateParams['result'] === false) {
            return $aValidateParams;
        }
        $aQuestions = $this->modelQuestions->getQuestions(['course_id' => $aRequest['course_id']]);
        $aSegragatedQuestions = $this->segregateQuestions($aQuestions);
        $aValidationItems = $this->validateQuestionsNumber($aSegragatedQuestions, $aRequest['quiz_items']);
        if ($aValidationItems['result'] === false) {
            return $aValidationItems;
        }
        $aGeneratedQuestions = $this->generateListQuestions($aSegragatedQuestions, $aRequest['quiz_items']); 
        return array(
            'message' => 'Successfully generated questions',
            'result' => true,
            'questions' => $aGeneratedQuestions
        );
    }

    private function validateQuestionsNumber($aQuestions, $iQuizItems)
    {
        $iQuestions = count($aQuestions[2]) + count($aQuestions[1]) + count($aQuestions[0]);
        if ($iQuestions < $iQuizItems) {
            return [
                'result' => false,
                'message' => 'Number of questions is insufficient'
            ];
        }
        $iDifficultItems = round($iQuizItems * .1);
        if (count($aQuestions[2]) < $iDifficultItems) {
            return [
                'result' => false,
                'message' => 'Number of difficult questions is insufficient'
            ];
        }
        $iAverageItems = round($iQuizItems * .3);
        if (count($aQuestions[1]) < $iAverageItems) {
            return [
                'result' => false,
                'message' => 'Number of average questions is insufficient'
            ];
        }
        $iEasyItems = $iQuizItems - ($iDifficultItems + $iAverageItems);
        if (count($aQuestions[0]) < $iEasyItems) {
            return [
                'result' => false,
                'message' => 'Number of easy questions is insufficient'
            ];
        }
    }

    private function generateListQuestions($aSegregatedQuestions, $iQuizItems)
    {
        $aQuestions = [];
        $aRandomEasy = [];
        $aRandomAverage = [];
        $aRandomDifficult = [];
        $aRandomKeys = [];
        $iDifficultItems = (int)round($iQuizItems * .1);
        // Generate random key
        $aRandomDifficult = $iDifficultItems === 1 ? [0] : array_rand($aSegregatedQuestions[2], $iDifficultItems); 
        $aRandomKeys[2] = $aRandomDifficult;
        $iAverageItems = (int)round($iQuizItems * .3);
        // Generate random key
        $aRandomAverage = array_rand($aSegregatedQuestions[1], $iAverageItems);
        $aRandomKeys[1] = $aRandomAverage;
        $iEasyItems = $iQuizItems - ($iDifficultItems + $iAverageItems);
        // Generate random key
        $aRandomEasy = array_rand($aSegregatedQuestions[0], $iEasyItems);
        $aRandomKeys[0] = $aRandomEasy;
        foreach ($aRandomKeys as $aRandomKey => $aRandomValue) {
            foreach ($aRandomValue as $aRandomGeneratedKey) {
                array_push($aQuestions, $aSegregatedQuestions[$aRandomKey][$aRandomGeneratedKey]);
            }
        }
        return $aQuestions;
    }

    private function segregateQuestions($aQuestions)
    {
        $aSegragatedQuestions = [
            0 => [],
            1 => [],
            2 => []
        ];
        // dd($aSegragatedQuestions[0]);
        foreach ($aQuestions as $aQuestionData) {
            array_push($aSegragatedQuestions[$aQuestionData['question_difficulty']], $aQuestionData);
        }
        return $aSegragatedQuestions;
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
