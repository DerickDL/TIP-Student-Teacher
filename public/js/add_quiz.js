$(document).ready(function () {
   var oAddQuiz = {
       init: function () {
           this.cacheDOM();
           this.addEvents();
       },
       
       cacheDOM: function () {
           this.eIntegCourses = $('#integ-courses');
           this.eSubCourses = $('#sub-courses');
           this.eNumItems = $('#no-items');
           this.eTimeLimit = $('#time-limit');
           this.eBtnGenerate = $('#btn-generate');
           this.eQuestionsList = $('#questions-list');
       },
       
       addEvents: function () {
           oAddQuiz.eIntegCourses.change(oAddQuiz.setSubCourses);
           oAddQuiz.eBtnGenerate.click(oAddQuiz.generateQuiz);
       },

       setSubCourses: function () {
            var sOptions = '';
            aSubCourses[$(this).val()].forEach(aCourseDetail => {
                sOptions += `<option value="${aCourseDetail['id']}">${aCourseDetail['course_title']}</option>`
            });
            oAddQuiz.eSubCourses.find('option').not(':first').remove();
            oAddQuiz.eSubCourses.append(sOptions);
       },

       generateQuiz: function () {
           $.ajax({
               url: '/teacher/quizzes/generate',
               type: 'POST',
               data: {
                   'course_id': oAddQuiz.eSubCourses.val(),
                   'quiz_timelimit': oAddQuiz.eTimeLimit.val(),
                   'quiz_items': oAddQuiz.eNumItems.val()
               },
               success: function (aResponse) {
                   alert(aResponse['message']);
                   if (aResponse['result'] === true) {
                       console.log(aResponse['questions']);
                       oAddQuiz.renderQuestions(aResponse);
                   }
               }
           });
       },

       renderQuestions: function (aData) {
           oAddQuiz.eQuestionsList.empty();
           var aQuestions = aData['questions'];
           for (var i = 0; i < aQuestions.length; i++) {
                var sQuestions = '';
                sQuestions += `<div class="mb-3"><p>${i + 1}). ${aQuestions[i]['question']}</p>`;
                var aChoices = aData['choices'][i];
                if (aQuestions[i]['question_type'] === 0) {
                    aChoices.forEach(function (aChoicesData) {
                        sQuestions += `<div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <input type="radio" class="radio-choice" data-value=${aChoicesData['id']} ${(aChoicesData['is_correct'] === 1 ? 'checked' : '')} readonly>
                            </div>
                        </div>
                        <input type="text" class="form-control" value="${aChoicesData['choice']}" readonly>
                    </div>`  
                    });   
                } else if (aQuestions[i]['question_type'] === 1) {
                    sQuestions += `<div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="radio" class="radio-choice" ${(aQuestions[i]['question_answer'] === 1 ? 'checked' : '')} readonly>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" value="True" readonly>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="radio" class="radio-choice" ${(aQuestions[i]['question_answer'] === 0 ? 'checked' : '')} readonly>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" value="False" readonly>
                                </div>`  
                } else if (aQuestions[i]['question_type'] === 3) {
                    sQuestions += `<input type="text" class="form-control" value="${ (aChoices[0]['choice']) }" readonly>`
                }
                sQuestions += `</div>`;
                oAddQuiz.eQuestionsList.append(sQuestions);
           }
       }

    }
   oAddQuiz.init();
});