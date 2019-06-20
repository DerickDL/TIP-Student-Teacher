$(document).ready(function () {
   var oAddQuestion = {
       init: function () {
           this.cacheDOM();
           this.addEvents();
           this.iCurrentTab = 0;
           this.iNumberQuestion = 0;
           this.loadQuestion();
       },
       
       cacheDOM: function () {
           this.eAddMultiple = $('#add-question-multiple');
           this.eAddTrueFalse = $('#add-question-true-false');
           this.eAddEssay = $('#add-question-essay');
           this.eAddShort = $('#add-question-short');
           this.eQuestionArea = $('#question-area');
           this.eCancelAddQuiz = $('#btn-cancel-question');
           this.eSaveAddQuiz = $('#btn-save-question');
           this.eQuestion = $('#question');
           this.eTabEasy = $('#easy-questions-tab');
           this.eTabAverage = $('#average-questions-tab');
           this.eTabDifficult = $('#difficult-questions-tab');
           this.eAreaListQuestions = $('#list-questions');
       },
       
       addEvents: function () {
           oAddQuestion.eAddMultiple.on('click', oAddQuestion.addQuestion);
           oAddQuestion.eAddTrueFalse.on('click', oAddQuestion.addQuestion);
           oAddQuestion.eAddShort.on('click', oAddQuestion.addQuestion);
           oAddQuestion.eTabEasy.click(oAddQuestion.changeDifficultyTab);
           oAddQuestion.eTabAverage.click(oAddQuestion.changeDifficultyTab);
           oAddQuestion.eTabDifficult.click(oAddQuestion.changeDifficultyTab);
       },

       changeDifficultyTab: function () {
           $('.nav-link').removeClass('active');
           oAddQuestion.iCurrentTab = $(this).data('value');
           $(this).addClass('active');
           oAddQuestion.loadQuestion();
       },

       loadQuestion: function () {
           $.ajax({
           url: `/teacher/courses/sub/${ iSubCourse }/questions/load`,
           type: 'GET',
           data: {
            'difficulty': oAddQuestion.iCurrentTab
           },
           success: function (aResponse) {
                oAddQuestion.displayQuestions(aResponse);
           }
        });
       },

       displayQuestions: function (aResponse) {
            oAddQuestion.eAreaListQuestions.empty();
            if (aResponse.length < 1) {
                oAddQuestion.eAreaListQuestions.append('<p>No questions yet on this difficulty.</p>');
            }
            $.each(aResponse, function (index, value) {
                console.log(value);
                 var sQuestionTemplate = `
                        <li class="list-group-item">${index + 1}.) ${value['question']}</li>
                 `;
               oAddQuestion.eAreaListQuestions.append(sQuestionTemplate);  
            });
       },

       addQuestion: function () {
           if ($('.question').length > 0) {
               $('.question').remove();
           }
           oAddQuestion.iNumberQuestion += 1;
           var iQuestionNumber = oAddQuestion.iNumberQuestion;
           var iQuestionType = $(this).data('value');
           var questionTemplate = `
                    <div class="question mb-2" data-value="${iQuestionType}">
                            <div class="input-group">
                                <textarea class="form-control" id="question-content" rows="3" placeholder="Question here..."></textarea>
                                ${(iQuestionType === 0) ?
                                   `<div class="input-group-append">
                                        <button class="btn btn-secondary btn-add-quiz" id="question-add-choice${iQuestionNumber}">Add choice</button>
                                   </div>` : ''
                                }
                                ${(iQuestionType === 3) ?
               `<div class="input-group-append">
                                        <button class="btn btn-secondary btn-add-quiz" id="question-add-blank${iQuestionNumber}">Add blank</button>
                                   </div>` : ''
               }
                            </div>
                            ${(iQuestionType !== 2) ? 
                                `<ul class="list-group list-group-flush mb-1" id="question-choices${iQuestionNumber}">
                                ${(iQuestionType !== 3) ?
                                    `<li class="list-group-item">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="radio" class="radio-choice" aria-label="Radio button for following text input" name="question${iQuestionNumber}" value=1>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control input-choice" aria-label="Text input with radio button" value="${(iQuestionType === 1) ? 'True' : ''}" ${(iQuestionType === 1) ? 'readonly' : ''}>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="radio" class="radio-choice" aria-label="Radio button for following text input" name="question${iQuestionNumber}" value=0>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control input-choice" aria-label="Text input with radio button" value="${(iQuestionType === 1) ? 'False' : ''}" ${(iQuestionType === 1) ? 'readonly' : ''}>
                                    </div>
                                </li>` : ''
                                }
                            </ul>` : ''
                            }
                            <div class="text-right">
                                <button class="btn btn-info btn-sm btn-save-question">
                                    Save
                                </button>
                                <button class="btn btn-danger btn-sm btn-delete-question">
                                    Cancel
                                </button>
                            </div>
                    </div>
           `;
           oAddQuestion.eQuestionArea.append(questionTemplate);
           $('.btn-delete-question').on('click', oAddQuestion.cancelAddQuestion);
           $('.btn-save-question').on('click', oAddQuestion.saveAddQuestion);
            if (iQuestionType === 0) {
                oAddQuestion.addMultiple(iQuestionNumber);
            }
            if (iQuestionType === 3) {
               oAddQuestion.addBlankEvent(iQuestionNumber);
            }
       },
       
       addMultiple: function (iQuestionNumber) {
           $('#question-add-choice' + iQuestionNumber).on('click', oAddQuestion.addChoice.bind(this, iQuestionNumber));
       },

       addBlankEvent: function (iQuestionNumber) {
           $('#question-add-blank' + iQuestionNumber).on('click', oAddQuestion.addBlank.bind(this, iQuestionNumber));
       },

       addBlank: function (iQuestionNumber, oSelf) {
           $(oSelf.currentTarget).hide();
           var sQuestion = $('#question-content').val();
           sQuestion += (sQuestion.trim().length < 1) ? '\u005f\u005f\u005f\u005f\u005f' : '  \u005f\u005f\u005f\u005f\u005f ';
           $('#question-content').val(sQuestion);
           var sAnswer = `
                <li class="list-group-item">
                    <div class="input-group">
                        <input type="text" class="form-control input-choice" aria-label="Text input with radio button">
                        <div class="input-group-append">
                            <button class="btn btn-secondary btn-delete-answer">&mdash;</button>
                        </div>
                    </div>
                </li>
            `;
           $('#question-choices' + iQuestionNumber).append(sAnswer);
           $('textarea').focus();
           $('.btn-delete-answer').on('click', function () {
               $(this).closest('li').remove();
               $(oSelf.currentTarget).show();
           });
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
                        <input type="text" class="form-control input-choice" aria-label="Text input with radio button">
                        <div class="input-group-append">
                            <button class="btn btn-secondary btn-delete-choice">&mdash;</button>
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
       },

       cancelAddQuestion: function () {
           if (confirm('Are you sure you want to cancel creating question?')) {
               $(this).closest('div.question').remove();
           }
       },

       saveAddQuestion: function () {
           if (confirm('Are you sure you want to save this question?')) {
                var aQuestionData = oAddQuestion.getQuestionData();
                if (aQuestionData.result === false) {
                    alert(aQuestionData.message);
                } else {
                    $.ajax({
                        url: `/teacher/courses/sub/${ iSubCourse }/questions/add`,
                        type: 'POST',
                        data: aQuestionData,
                        success: function (aResponse) {
                            alert('Successfully added question');
                            $('.question').remove();
                            oAddQuestion.loadQuestion();
                        }
                    });
                }
           }
       },

       getQuestionData: function () {
           var oQuestion = $('.question');
           var sQuestion = oQuestion.find('textarea').val().trim();
           var iQuestionType = parseInt(oQuestion.data('value'), 10);
           if (sQuestion.length < 1) {
               return {
                   'result': false,
                   'message': 'Question is required'
               }
           }
           if (iQuestionType === 0 || iQuestionType === 3) {
               if ($('.input-choice').length < 1) {
                   return {
                       'result': false,
                       'message': 'Put a blank'
                   }
               }
               var iFlag = true;
               var sMessage = '';
               $('.input-choice').each(function (itr, obj) {
                  if ($(obj).val().trim().length < 1) {
                      iFlag = false;
                      sMessage = 'Fill up choices';
                      return false;
                  }
               });
               if (iFlag === false) {
                   return {
                       'result': iFlag,
                       'message': sMessage
                   }
               }
           }
           var eSelectedRadio = oQuestion.find('.radio-choice:radio:checked');
           if ((iQuestionType === 0 || iQuestionType === 1) && eSelectedRadio.length === 0) {
               return {
                   'result': false,
                   'message': 'Choose correct answer'
               }
           }
           if (iQuestionType === 0 || iQuestionType === 1) {
               var eInputAnswer = eSelectedRadio.parent().parent().siblings('input[type=text]');
               var mCorrectAnswer = (iQuestionType === 1) ? eSelectedRadio.val() : eInputAnswer.val();
           } else {
               var mCorrectAnswer = $('.input-choice').val();
           }
           var aChoices = [];
           if (iQuestionType === 0 || iQuestionType === 3) {
               $('.input-choice').each(function (i, obj) {
                   aChoices.push($(obj).val());
               });
           }
           return {
               'result': true,
               'message': 'Added Successfully',
               'data': {
                   'question': sQuestion,
                   'type': iQuestionType,
                   'answer': mCorrectAnswer,
                   'choices': aChoices,
                   'difficulty': oAddQuestion.iCurrentTab
               }
           };
       }
   };
   oAddQuestion.init();
});