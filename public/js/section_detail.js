
$(document).ready(function () {
   var oSection = {
       init: function () {
           this.cacheDOM();
           this.addEvents();
           
       },
       
       cacheDOM: function () {
           this.eBtnUpdateSection = $('#create-section');
           this.eBtnCancelSection = $('#cancel-section');
           this.eBtnDeleteSection = $('#delete-section');
           this.eBtnAcceptStudent = $('.btn-accept');
           this.eBtnDeclineStudent = $('.btn-decline');
           this.eBtnDeleteStudent = $('.btn-delete');
       },
       
       addEvents: function () {
           oSection.eBtnCancelSection.click(oSection.redirectToSectionList);
           oSection.eBtnDeleteSection.click(oSection.deleteSection);
           oSection.eBtnAcceptStudent.click(oSection.acceptStudent);
           oSection.eBtnDeclineStudent.click(oSection.removeStudent);
           oSection.eBtnDeleteStudent.click(oSection.removeStudent);
       },

       deleteSection: function () {
           if (confirm('Are you sure you want to delete this section?')) {
                $.ajax({
                    url: '/teacher/section/delete/' + iSectionId,
                    type: 'DELETE',
                    success: function () {
                        alert('Successfuly deleted.');
                        window.location.replace('/teacher/sections');
                       
                    },
                    error: function () {
                        alert('Something went wrong. Please try again.');
                    }
                })
           }
       },

       redirectToSectionList: function() {
           if (confirm('Are you sure you want to cancel updating quiz?')) {
                window.location.replace('/teacher/sections');
           }
       },

       removeStudent: function() {
            if (confirm('Are you sure you want to remove this student?')) {
                var iStudentId = $($(this).parent()).data('value');
                $.ajax({
                    url: '/remove/student',
                    type: 'POST',
                    data: {
                        'section_id': iSectionId,
                        'student_id': iStudentId
                    },
                    success: function(aResponse) {
                        window.location.reload();
                    }
                });
            }
       },

       acceptStudent: function()
       {
            var iStudentId = $($(this).parent()).data('value');
            $.ajax({
                url: '/update/status',
                type: 'POST',
                data: {
                    'section_id': iSectionId,
                    'student_id': iStudentId
                },
                success: function(aResponse) {
                    window.location.reload();
                }
            });
       }
    }
   oSection.init();
});