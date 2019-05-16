$(document).ready(function () {
   var oAddQuiz = {
       init: function () {
           this.cacheDOM();
           this.addEvents();
           this.iNumberQuestion = 0;
       },
       
       cacheDOM: function () {
           this.eAddMultiple = $('#add-question-multiple');
           this.eAddTrueFalse = $('#add-question-true-false');
           this.eAddEssay = $('#add-question-essay');
           this.eAreaQuizQuestions = $('#quiz-questions');
           this.eCancelAddQuiz = $('#btn-cancel-quiz');
           this.eSaveAddQuiz = $('#btn-save-quiz');
           this.eQuestion = $('#question');
       },
       
       addEvents: function () {
           oAddQuiz.eAddMultiple.on('click', oAddQuiz.addQuestion);
           oAddQuiz.eAddTrueFalse.on('click', oAddQuiz.addQuestion);
           oAddQuiz.eAddEssay.on('click', oAddQuiz.addQuestion);
           oAddQuiz.eCancelAddQuiz.on('click', oAddQuiz.cancelAddQuiz);
           oAddQuiz.eSaveAddQuiz.on('click', oAddQuiz.saveAddQuiz);
       },

       saveAddQuiz: function () {
           if (oAddQuiz.eAreaQuizQuestions.children().length > 0 && oAddQuiz.eQuestion.val().trim().length > 0) {
               if (confirm('Are you sure you want to save this quiz?')) {
                   // do the saving here
                    var aQuestionsResult = oAddQuiz.getQuestionData();
                    if (aQuestionsResult.result === false) {
                        alert(aQuestionsResult.message);
                    } else {
                        aQuestionsResult.quiz_title = oAddQuiz.eQuestion.val();
                        aQuestionsResult.course_id = $(this).data('value');
                        $.ajax({
                            url: '/quizzes/insert',
                            type: 'POST',
                            data: aQuestionsResult,
                            success: function (aResponse) {
                                console.log(aResponse);
                            }
                        });
                    }
               }
           }
       },

       getQuestionData: function () {
           var aQuestions = [];
           var iFlag = true;
           var sMessage = 'Added successfully';
           var sMessage = '';
            $('.questions').each(function (iItr, oSelf) {
                var sQuestion =  $(oSelf).find('textarea').val();
                var eSelectedRadio = $(oSelf).find('.radio-choice:radio:checked');
                var iQuestionType = $(oSelf).data('value');
                if (sQuestion.trim().length < 1) {
                    iFlag = false;
                    sMessage = 'Question is required'
                    return false;
                }

                if (eSelectedRadio.length === 0 && iQuestionType !== 3) {
                    iFlag = false;
                    sMessage = 'Choose correct answer'
                    return false;
                }

                var eInputAnswer = eSelectedRadio.parent().parent().siblings('input[type=text]');
                var mCorrectAnswer = (iQuestionType === 1) ? eSelectedRadio.val() : eInputAnswer.val();
                var aChoices = [];
                if (iQuestionType === 0) {
                  $(oSelf).find('input[type=text]').each(function (i, obj) {
                      aChoices.push($(obj).val());
                  });
                }
                var aQuestionDetails = {
                    'question': sQuestion,
                    'type': iQuestionType,
                    'answer': mCorrectAnswer,
                    'choices': aChoices
                };
                aQuestions.push(aQuestionDetails);
            })
            return {
              'result': iFlag,
              'message': sMessage,
              'data': aQuestions
            }
       },

       cancelAddQuiz: function () {
           if (confirm('Are you sure you want to cancel creating quiz?')) {
               var iCourseId = $(this).data('value');
               window.location.replace(`/teacher/course/${iCourseId}/quizzes`);
           }
       },

       addQuestion: function () {
           oAddQuiz.iNumberQuestion += 1;
           var iQuestionNumber = oAddQuiz.iNumberQuestion;
           var iQuestionType = $(this).data('value');
           var questionTemplate = `
                    <div class="questions mb-2" data-value="${iQuestionType}">
                        <div class="text-right">
                            <button class="btn btn-danger btn-sm btn-delete-quiz">
                                &#10005;
                            </button>
                        </div>
                        <div class="card p-2">
                            <div class="input-group">
                                <textarea class="form-control" rows="3" placeholder="Question here..."></textarea>
                                ${(iQuestionType === 0) ?
                                   `<div class="input-group-append">
                                        <button class="btn btn-default btn-add-quiz" id="question-add-choice${iQuestionNumber}">Add choice</button>
                                   </div>` : ''
                                }
                            </div>
                            ${(iQuestionType !== 2) ? 
                                `<ul class="list-group list-group-flush" id="question-choices${iQuestionNumber}">
                                <li class="list-group-item">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="radio" class="radio-choice" aria-label="Radio button for following text input" name="question${iQuestionNumber}" value=1>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Text input with radio button" value="${(iQuestionType === 1) ? 'True' : ''}" ${(iQuestionType === 1) ? 'readonly' : ''}>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="radio" class="radio-choice" aria-label="Radio button for following text input" name="question${iQuestionNumber}" value=0>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Text input with radio button" value="${(iQuestionType === 1) ? 'False' : ''}" ${(iQuestionType === 1) ? 'readonly' : ''}>
                                    </div>
                                </li>
                            </ul>` : ''
                            }
                        </div>
                    </div>
           `;
           oAddQuiz.eAreaQuizQuestions.append(questionTemplate);
           $('.btn-delete-quiz').on('click', function () {
               $(this).closest('div.questions').remove();
           });
            if (iQuestionType === 0) {
                oAddQuiz.addMultiple(iQuestionNumber);
            }
       },
       
       addMultiple: function (iQuestionNumber) {
           $('#question-add-choice' + iQuestionNumber).on('click', oAddQuiz.addChoice.bind(this, iQuestionNumber));
       },

       addChoice: function (iQuestionNumber) {
            var sChoice = `
                <li class="list-group-item">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <input type="radio" class="radio-choice" aria-label="Radio button for following text input" name="question${iQuestionNumber}">
                            </div>
                        </div>
                        <input type="text" class="form-control" aria-label="Text input with radio button">
                        <div class="input-group-append">
                            <button class="btn btn-default btn-delete-choice">&mdash;</button>
                        </div>
                    </div>
                </li>
            `;
            $('#question-choices' + iQuestionNumber).append(sChoice);
            $('.btn-delete-choice').on('click', function () {
                $(this).closest('li').remove();
            });
       },

       addTrueFalse: function () {
           // Do something for true or false question here
       }
   };
   oAddQuiz.init();
});