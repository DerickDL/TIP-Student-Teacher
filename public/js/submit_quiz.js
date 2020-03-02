$(document).ready(function () {
    var oSubmitQuiz = {
        init: function () {
            this.cacheDOM();
            this.bindEvents();
            if (iTimeLimit !== null) {this.startTimer()};
        },
       
        cacheDOM: function () {
            this.eBtnSubmitQuiz = $('#submit-quiz');
            this.eScoreArea = $('#score-area');
            this.ePercentArea = $('#percent-area');
            this.eScoreDiv = $('#score-div');
            this.eBtnCancelQuiz = $('#cancel-quiz');
        },

        startTimer() {
            var sEndTime = oSubmitQuiz.getStartTime();
            oSubmitQuiz.x = setInterval(function() {

                // Get today's date and time
                var now = new Date().getTime();
                // Find the distance between now and the count down date
                var distance = sEndTime - now;
              
                // Time calculations for days, hours, minutes and seconds
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
              
                // Display the result in the element with id="demo"
                $("#timer").html(minutes + ":" + seconds);
              
                // If the count down is finished, write some text
                if (distance < 0) {
                  clearInterval(oSubmitQuiz.x);
                  $("#timer").remove();
                  localStorage.removeItem("quiz_end_datetime");
                  var aQuestionAnswer = oSubmitQuiz.getQuestions();
                  oSubmitQuiz.postQuiz(aQuestionAnswer['data']);
                }
              }, 1000);
        },

        getStartTime: function () {
            var sCurrentDateTime = localStorage.getItem('quiz_end_datetime');
            if (sCurrentDateTime !== null) {
                return sCurrentDateTime;
            }
            sCurrentDateTime = new Date();
            sCurrentDateTime.setMinutes(sCurrentDateTime.getMinutes() + iTimeLimit);
            localStorage.setItem('quiz_end_datetime', sCurrentDateTime.getTime());
            return sCurrentDateTime.getTime();
        },
        
        bindEvents: function () {
            oSubmitQuiz.eBtnSubmitQuiz.on('click', oSubmitQuiz.submitQuiz)
        },

        submitQuiz: function () {
            if (confirm('Are you sure you want to submit?')) {
                clearInterval(oSubmitQuiz.x);
                $("#timer").remove();
                localStorage.removeItem("quiz_end_datetime");
                var aQuestionAnswer = oSubmitQuiz.getQuestions();
                if (aQuestionAnswer['result'] === false) {
                    alert(aQuestionAnswer['message']);
                } else {
                    oSubmitQuiz.postQuiz(aQuestionAnswer['data']);
                }
            }
        },

        postQuiz: function (aQuestionAnswer) {
            var aData = {
                'quiz_id': $(oSubmitQuiz.eBtnSubmitQuiz).data('value'),
                'question_answer': aQuestionAnswer
            };
            $.ajax({
                url: '/quizzes/submit',
                type: 'POST',
                data: aData,
                success: function (aResponse) {
                    alert('Submitted successfully. Check your score.');
                    window.location.replace(`/student/class/${iClass}/quizzes`);
                    // oSubmitQuiz.eScoreArea.text(aResponse.score);
                    // oSubmitQuiz.ePercentArea.text(aQuestionAnswer.length);
                    // oSubmitQuiz.eBtnSubmitQuiz.remove();
                    // oSubmitQuiz.eScoreDiv.show();
                    // oSubmitQuiz.eBtnCancelQuiz.text('Exit');
                }
            })
        },

        getQuestions: function () {
            var aQuestionAnswer = [];
            var aData = [];
            var sMessage = '';
            var bResult = true;
            $('.questions').each(function (itr, self) {
                if ($(self).data('type') !== 3) {
                    if ($(self).find('.radio-choice:radio:checked').data('value') === undefined) {
                        bResult = false;
                        sMessage = `Question ${itr + 1} has no answer yet.`;
                        return false;
                    }
                    mQuestion_answer = (($(self).find('.radio-choice:radio:checked').data('value') === undefined) ? -1 : $(self).find('.radio-choice:radio:checked').data('value'))
                } else {
                    var iQuestionId = $(self).data('id');
                    mQuestion_answer = $("#blank_answer" + iQuestionId).val();
                }
                var oQuestionData = {
                    'question': $(self).data('id'),
                    'question_type': $(self).data('type'),
                    'question_answer': mQuestion_answer
                };
                aData.push(oQuestionData);
            });
            aQuestionAnswer = {
                'result': bResult,
                'data': aData,
                'message': sMessage
            };
            return aQuestionAnswer;
        }
   };
   oSubmitQuiz.init();
});