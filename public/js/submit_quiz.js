$(document).ready(function () {
    var oSubmitQuiz = {
        init: function () {
            this.cacheDOM();
            this.bindEvents();
        },
       
        cacheDOM: function () {
            this.eBtnSubmitQuiz = $('#submit-quiz');
        },
        
        bindEvents: function () {
            oSubmitQuiz.eBtnSubmitQuiz.on('click', oSubmitQuiz.submitQuiz)
        },

        submitQuiz: function () {
            var aQuestionAnswer = [];
            if (confirm('Are you sure you want to save this quiz?')) {
                $('.questions').each(function (itr, self) {
                    var oQuestionData = {
                        'question': $(self).data('id'),
                        'question_type': $(self).data('type'),
                        'question_answer': $(self).find('.radio-choice:radio:checked').data('value')
                    };
                    aQuestionAnswer.push(oQuestionData);
                });
                console.log(aQuestionAnswer);
            }
        },
   };
   oSubmitQuiz.init();
});