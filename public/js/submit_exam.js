$(document).ready(function () {
    var oSubmitExam = {
        init: function () {
            this.cacheDOM();
            this.bindEvents();
            if (iTimeLimit !== null) {this.startTimer()};
        },

        startTimer() {
            var sEndTime = oSubmitExam.getStartTime();
            oSubmitExam.x = setInterval(function() {

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
                  clearInterval(oSubmitExam.x);
                  $("#timer").remove();
                  localStorage.removeItem("exam_end_datetime");
                  oSubmitExam.postExam();
                }
              }, 1000);
        },

        getStartTime: function () {
            var sCurrentDateTime = localStorage.getItem('exam_end_datetime');
            if (sCurrentDateTime !== null) {
                return sCurrentDateTime;
            }
            sCurrentDateTime = new Date();
            sCurrentDateTime.setMinutes(sCurrentDateTime.getMinutes() + iTimeLimit);
            localStorage.setItem('exam_end_datetime', sCurrentDateTime.getTime());
            return sCurrentDateTime.getTime();
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
            if (confirm('Are you sure you want to submit?')) {
                clearInterval(oSubmitExam.x);
                $("#timer").remove();
                localStorage.removeItem("exam_end_datetime");
                oSubmitExam.postExam();
            }
        },

        postExam: function() {
            var aQuestionAnswer = [];
                aQuestionAnswer = oSubmitExam.getQuestions();
                var aData = {
                    'exam_id': $(oSubmitExam.eBtnSubmitExam).data('value'),
                    'question_answer': aQuestionAnswer
                };
                $.ajax({
                    url: '/exams/submit',
                    type: 'POST',
                    data: aData,
                    success: function (aResponse) {
                        alert('Submitted successfully. Check your score.');
                        window.location.replace(`/students/class/${iClass}/exams`);
                        // oSubmitExam.eScoreArea.text(aResponse.score);
                        // oSubmitExam.ePercentArea.text(aQuestionAnswer.length);
                        // oSubmitExam.eBtnSubmitExam.remove();
                        // oSubmitExam.eScoreDiv.show();
                        // oSubmitExam.eBtnCancelExam.text('Exit');
                    }
                })
        },

        getQuestions: function () {
            var aQuestionAnswer = [];
            $('.questions').each(function (itr, self) {
                if ($(self).data('type') !== 3) {
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
                aQuestionAnswer.push(oQuestionData);
            });
            return aQuestionAnswer;
        }
   };
   oSubmitExam.init();
});