$(document).ready(function () {
   var oAddQuestion = {
       init: function () {
           this.cacheDOM();
           this.addEvents();
           this.iCurrentTab = 0;
           this.iNumberQuestion = 0;
       },
       
       cacheDOM: function () {
           this.eAddMultiple = $('#add-question-multiple');
           this.eAddTrueFalse = $('#add-question-true-false');
           this.eAddEssay = $('#add-question-essay');
           this.eAddShort = $('#add-question-short');
           this.eQuestionArea = $('#question-area');
           this.eCancelAddQuiz = $('#btn-cancel-quiz');
           this.eSaveAddQuiz = $('#btn-save-quiz');
           this.eQuestion = $('#question');
       },
       
       addEvents: function () {
           oAddQuestion.eAddMultiple.on('click', oAddQuestion.addQuestion);
           oAddQuestion.eAddTrueFalse.on('click', oAddQuestion.addQuestion);
           oAddQuestion.eAddShort.on('click', oAddQuestion.addQuestion);
           oAddQuestion.eCancelAddQuiz.on('click', oAddQuestion.cancelAddQuiz);
           oAddQuestion.eSaveAddQuiz.on('click', oAddQuestion.saveAddQuiz);
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
                        <div class="text-right">
                            <button class="btn btn-info btn-sm btn-add-question">
                                &#10004;
                            </button>
                            <button class="btn btn-danger btn-sm btn-delete-question">
                                &#10005;
                            </button>
                        </div>
                            <div class="input-group">
                                <textarea class="form-control" id="question-content" rows="3" placeholder="Question here..."></textarea>
                                ${(iQuestionType === 0) ?
                                   `<div class="input-group-append">
                                        <button class="btn btn-default btn-add-quiz" id="question-add-choice${iQuestionNumber}">Add choice</button>
                                   </div>` : ''
                                }
                                ${(iQuestionType === 3) ?
               `<div class="input-group-append">
                                        <button class="btn btn-default btn-add-quiz" id="question-add-blank${iQuestionNumber}">Add blank</button>
                                   </div>` : ''
               }
                            </div>
                            ${(iQuestionType !== 2) ? 
                                `<ul class="list-group list-group-flush" id="question-choices${iQuestionNumber}">
                                ${(iQuestionType !== 3) ?
                                    `<li class="list-group-item">
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
                                </li>` : ''
                                }
                            </ul>` : ''
                            }
                    </div>
           `;
           oAddQuestion.eQuestionArea.append(questionTemplate);
           $('.btn-delete-question').on('click', function () {
               $(this).closest('div.question').remove();
           });
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
           console.log(oSelf);
           var sQuestion = $('#question-content').val();
           sQuestion += (sQuestion.trim().length < 1) ? '\u005f\u005f\u005f\u005f\u005f' : '  \u005f\u005f\u005f\u005f\u005f';
           $('#question-content').val(sQuestion);
           var sAnswer = `
                <li class="list-group-item">
                    <div class="input-group">
                        <input type="text" class="form-control" aria-label="Text input with radio button">
                        <div class="input-group-append">
                            <button class="btn btn-default btn-delete-answer">&mdash;</button>
                        </div>
                    </div>
                </li>
            `;
           $('#question-choices' + iQuestionNumber).append(sAnswer);
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
   oAddQuestion.init();
});