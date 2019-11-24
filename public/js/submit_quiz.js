$(document).ready(function () {
    var oSubmitQuiz = {
        init: function () {
            this.cacheDOM();
            this.bindEvents();
        },
       
        cacheDOM: function () {
            this.eBtnSubmitQuiz = $('#submit-quiz');
            this.eScoreArea = $('#score-area');
            this.ePercentArea = $('#percent-area');
            this.eScoreDiv = $('#score-div');
            this.eBtnCancelQuiz = $('#cancel-quiz');
        },
        
        bindEvents: function () {
            oSubmitQuiz.eBtnSubmitQuiz.on('click', oSubmitQuiz.submitQuiz)
        },

        submitQuiz: function () {
            var aQuestionAnswer = [];
            if (confirm('Are you sure you want to submit?')) {
                aQuestionAnswer = oSubmitQuiz.getQuestions();
                var aData = {
                    'quiz_id': $(this).data('value'),
                    'question_answer': aQuestionAnswer
                };
                $.ajax({
                    url: '/quizzes/submit',
                    type: 'POST',
                    data: aData,
                    success: function (aResponse) {
                        alert('Submitted successfully. Check your score.');
                        window.location.reload();
                        // oSubmitQuiz.eScoreArea.text(aResponse.score);
                        // oSubmitQuiz.ePercentArea.text(aQuestionAnswer.length);
                        // oSubmitQuiz.eBtnSubmitQuiz.remove();
                        // oSubmitQuiz.eScoreDiv.show();
                        // oSubmitQuiz.eBtnCancelQuiz.text('Exit');
                    }
                })
            }
        },

        getQuestions: function () {
            var aQuestionAnswer = [];
            $('.questions').each(function (itr, self) {
                var oQuestionData = {
                    'question': $(self).data('id'),
                    'question_type': $(self).data('type'),
                    'question_answer': (($(self).find('.radio-choice:radio:checked').data('value') === undefined) ? -1 : $(self).find('.radio-choice:radio:checked').data('value'))
                };
                aQuestionAnswer.push(oQuestionData);
            });
            return aQuestionAnswer;
        }
   };
   oSubmitQuiz.init();
});