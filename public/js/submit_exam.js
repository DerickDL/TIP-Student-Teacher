$(document).ready(function () {
    var oSubmitExam = {
        init: function () {
            this.cacheDOM();
            this.bindEvents();
        },
       
        cacheDOM: function () {
            this.eBtnSubmitExam = $('#submit-exam');
            this.eScoreArea = $('#score-area');
            this.ePercentArea = $('#percent-area');
            this.eScoreDiv = $('#score-div');
            this.eBtnCancelExam = $('#cancel-exam');
        },
        
        bindEvents: function () {
            oSubmitExam.eBtnSubmitExam.on('click', oSubmitExam.submitExam)
        },

        submitExam: function () {
            var aQuestionAnswer = [];
            if (confirm('Are you sure you want to submit?')) {
                aQuestionAnswer = oSubmitExam.getQuestions();
                var aData = {
                    'exam_id': $(this).data('value'),
                    'question_answer': aQuestionAnswer
                };
                $.ajax({
                    url: '/exams/submit',
                    type: 'POST',
                    data: aData,
                    success: function (aResponse) {
                        alert('Submitted successfully. Check your score.');
                        window.location.reload();
                        // oSubmitExam.eScoreArea.text(aResponse.score);
                        // oSubmitExam.ePercentArea.text(aQuestionAnswer.length);
                        // oSubmitExam.eBtnSubmitExam.remove();
                        // oSubmitExam.eScoreDiv.show();
                        // oSubmitExam.eBtnCancelExam.text('Exit');
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
   oSubmitExam.init();
});