$(document).ready(function () {
   var oAddExam = {
       init: function () {
           this.cacheDOM();
           this.addEvents();
           this.aQuestions = [];
       },
       
       cacheDOM: function () {
           this.eIntegCourses = $('#integ-courses');
           this.eNumItems = $('#no-items');
           this.eTimeLimit = $('#time-limit');
           this.eBtnGenerate = $('#btn-generate');
           this.eQuestionsList = $('#questions-list');
           this.eQuestionsListArea = $('#questions-area');
           this.eToolTipGenerated = $('#tooltip-generated');
           this.eBtnSaveExam = $('#save-exam');
           this.eBtnClearExam = $('#clear-exam');
       },
        
       addEvents: function () {
           oAddExam.eBtnGenerate.click(oAddExam.generateExam);
           oAddExam.eBtnClearExam.click(oAddExam.clearExam);
           oAddExam.eBtnSaveExam.click(oAddExam.saveExam);
       },

       generateExam: function () {
           $.ajax({
               url: '/teacher/exams/generate',
               type: 'POST',
               data: {
                   'course_id': oAddExam.eIntegCourses.val(),
                   'time_limit': oAddExam.eTimeLimit.val(),
                   'items': oAddExam.eNumItems.val()
               },
               success: function (oResponse) {
                   if (oResponse['result'] === false) {
                        alert(oResponse['message']);
                   } else {
                        alert('Succesfully generated questions');
                        oAddExam.clearExam(false);
                        oAddExam.renderQuestions(oResponse);
                   }
               }
           });
       },
       saveExam: function () {
            if (confirm('Are you sure you want to save this exam?')) {
                $.ajax({
                    url: '/teacher/exams/save',
                    type: 'POST',
                    data: {
                        'time_limit': oAddExam.eTimeLimit.val(),
                        'items': oAddExam.eNumItems.val(),
                        'questions': oAddExam.aQuestions,
                        'course_id': oAddExam.eIntegCourses.val()
                    },
                    success: function () {
                        alert('Successfully created exam');
                        window.location.replace('/teacher/exams');
                    }
                })
            }
       },

       clearExam: function (isClear) {
           oAddExam.eQuestionsList.empty();
           if (oAddExam.eQuestionsListArea.css('display') === 'none') {
               oAddExam.eQuestionsListArea.show();
               oAddExam.eToolTipGenerated.hide();
           } else if (isClear !== false) {
               oAddExam.eQuestionsListArea.hide();
               oAddExam.eToolTipGenerated.show();
           }
       },

       renderQuestions: function (aData) {
           oAddExam.aQuestions = aData['questions'];
           for (var i = 0; i < oAddExam.aQuestions.length; i++) {
                var sQuestions = '';
                sQuestions += `<div class="mb-3"><p>${i + 1}). ${oAddExam.aQuestions[i]['question']}</p>`;
                var aChoices = aData['choices'][i];
                if (oAddExam.aQuestions[i]['question_type'] === 0) {
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
                } else if (oAddExam.aQuestions[i]['question_type'] === 1) {
                    sQuestions += `<div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="radio" class="radio-choice" ${(oAddExam.aQuestions[i]['question_answer'] === 1 ? 'checked' : '')} readonly>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" value="True" readonly>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="radio" class="radio-choice" ${(oAddExam.aQuestions[i]['question_answer'] === 0 ? 'checked' : '')} readonly>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" value="False" readonly>
                                </div>`  
                } else if (oAddExam.aQuestions[i]['question_type'] === 3) {
                    sQuestions += `<input type="text" class="form-control" value="${ (aChoices[0]['choice']) }" readonly>`
                }
                sQuestions += `</div>`;
                oAddExam.eQuestionsList.append(sQuestions);
           }
       }

    }
   oAddExam.init();
});