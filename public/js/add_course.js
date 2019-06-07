$(document).ready(function () {
    var oAddSubject = {
        init: function() {
            this.cacheDOM();
            this.bindEvents();
        },

        cacheDOM: function() {
            this.oBtnSave = $('#add-course');
            this.oBtnCancel = $('#cancel-course');
            this.oInputCode = $('#courseCode');
            this.oInputTitle = $('#courseTitle');
            this.oInputOverview = $('#courseOverview');
        },

        bindEvents: function() {
            this.oBtnCancel.click(this.cancelSavingSubject);
            this.oBtnSave.click(this.saveSubject);
        },

        cancelSavingSubject: function() {
            if (confirm("Are you sure you want to cancel?")) {
                window.location.replace('/teacher/courses');
            }
        },

        saveSubject: function() {
            if (confirm("Are you sure you want to submit this course details?")) {
                oAddSubject.addSubject($(this).data('value'));
            }
        },

        addSubject: function(iUserId) {
            $.ajax({
                url: '/teacher/course/add',
                type: 'POST',
                data: {
                    'course_code': oAddSubject.oInputCode.val(),
                    'course_title': oAddSubject.oInputTitle.val(),
                    'course_overview': oAddSubject.oInputOverview.val(),
                    'course_user_id': iUserId
                },
                success: function (aResponse) {
                    if (aResponse.result === true) {
                        alert("Added successfully");
                        window.location.replace('/teacher/courses');
                    } else {
                        alert(aResponse.message);
                    }
                }
            });
        }
    };

    oAddSubject.init();
});