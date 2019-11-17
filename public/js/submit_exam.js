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
                console.log(aData);
                $.ajax({
                    url: '/exams/submit',
                    type: 'POST',
                    data: aData,
                    success: function (aResponse) {
                        oSubmitExam.eScoreArea.text(aResponse.score);
                        oSubmitExam.ePercentArea.text(aQuestionAnswer.length);
                        oSubmitExam.eBtnSubmitExam.remove();
                        oSubmitExam.eScoreDiv.show();
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