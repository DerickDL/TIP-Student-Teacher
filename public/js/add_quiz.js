$(document).ready(function () {
   var oAddQuiz = {
       init: function () {
           this.cacheDOM();
           this.addEvents();
           this.aQuestions = [];
           this.appendIntegrationCourses();
       },
       
       cacheDOM: function () {
           this.eIntegCourses = $('#integ-courses');
           this.eSubCourses = $('#sub-courses');
           this.eNumItems = $('#no-items');
           this.eTimeLimit = $('#time-limit');
           this.eBtnGenerate = $('#btn-generate');
           this.eQuestionsList = $('#questions-list');
           this.eQuestionsListArea = $('#questions-area');
           this.eToolTipGenerated = $('#tooltip-generated');
           this.eBtnSaveQuiz = $('#save-quiz');
           this.eBtnClearQuiz = $('#clear-quiz');
       },
       
       addEvents: function () {
           oAddQuiz.eIntegCourses.change(oAddQuiz.setSubCourses);
           oAddQuiz.eBtnGenerate.click(oAddQuiz.generateQuiz);
           oAddQuiz.eBtnClearQuiz.click(oAddQuiz.clearQuiz);
           oAddQuiz.eBtnSaveQuiz.click(oAddQuiz.saveQuiz);
       },

       appendIntegrationCourses: function() {
            var sIntegCourses = '';
            aIntegrations.forEach(aIntegCourseDetail => {
                sIntegCourses += `<option value="${aIntegCourseDetail}">Integrated Course ${aIntegCourseDetail}</option>`;
            });
            $('#integ-courses').append(sIntegCourses);
       },

       setSubCourses: function () {
            var sOptions = '';
            aSubCourses[$(this).val()].forEach(aCourseDetail => {
                sOptions += `<option value="${aCourseDetail['id']}">${aCourseDetail['course_title']}</option>`;
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
                   if (aResponse['result'] === true) {
                       alert('Successfully generated questions');
                       oAddQuiz.clearQuiz(false);
                       oAddQuiz.renderQuestions(aResponse);
                   } else {
                       alert(aResponse['message']);
                   }
               }
           });
       },

       saveQuiz: function () {
            if (confirm('Are you sure you want to save this quiz?')) {
                $.ajax({
                    url: '/teacher/quizzes/save',
                    type: 'POST',
                    data: {
                        'quiz_timelimit': oAddQuiz.eTimeLimit.val(),
                        'quiz_items': oAddQuiz.eNumItems.val(),
                        'questions': oAddQuiz.aQuestions,
                        'course_id': oAddQuiz.eSubCourses.val(),
                        'start_datetime': $('#start_date').val(),
                        'end_datetime': $('#end_date').val(),
                        'status': 0
                    },
                    success: function () {
                        alert('Successfully created quiz');
                        window.location.replace('/teacher/quizzes/list');
                    }
                })
            }
       },

       clearQuiz: function (isClear) {
           oAddQuiz.eQuestionsList.empty();
           if (oAddQuiz.eQuestionsListArea.css('display') === 'none') {
               oAddQuiz.eQuestionsListArea.show();
               oAddQuiz.eToolTipGenerated.hide();
           } else if (isClear !== false) {
               oAddQuiz.eQuestionsListArea.hide();
               oAddQuiz.eToolTipGenerated.show();
           }
       },

       renderQuestions: function (aData) {
           oAddQuiz.eQuestionsList.empty();
           oAddQuiz.aQuestions = aData['questions'];
           for (var i = 0; i < oAddQuiz.aQuestions.length; i++) {
                var sQuestions = '';
                sQuestions += `<div class="mb-3"><p>${i + 1}). ${oAddQuiz.aQuestions[i]['question']}</p>`;
                var aChoices = aData['choices'][i];
                if (oAddQuiz.aQuestions[i]['question_type'] === 0) {
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
                } else if (oAddQuiz.aQuestions[i]['question_type'] === 1) {
                    sQuestions += `<div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="radio" class="radio-choice" ${(oAddQuiz.aQuestions[i]['question_answer'] === 1 ? 'checked' : '')} readonly>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" value="True" readonly>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="radio" class="radio-choice" ${(oAddQuiz.aQuestions[i]['question_answer'] === 0 ? 'checked' : '')} readonly>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" value="False" readonly>
                                </div>`  
                } else if (oAddQuiz.aQuestions[i]['question_type'] === 3) {
                    sQuestions += `<input type="text" class="form-control" value="${ (aChoices[0]['choice']) }" readonly>`
                }
                sQuestions += `</div>`;
                oAddQuiz.eQuestionsList.append(sQuestions);
           }
       }

    }
   oAddQuiz.init();
});