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
                       oAddQuiz.renderQuestions(aResponse['questions']);
                   }
               }
           });
       },

       renderQuestions: function ($aQuestions) {
           oAddQuiz.eQuestionsList.empty();
           $aQuestions.forEach(function ($aQuestionData) {
               // Todo, show choices and right answer
                oAddQuiz.eQuestionsList.append(`<p>${$aQuestionData['question']}</p>`);
           });
       }

    }
   oAddQuiz.init();
});