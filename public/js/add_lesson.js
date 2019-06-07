$(document).ready(function () {
    var oAddLesson = {
        init: function() {
            this.cacheDOM();
            this.bindEvents();
        },

        cacheDOM: function() {
            this.oBtnSave = $('#add-lesson');
            this.oBtnCancel = $('#cancel-lesson');
            this.oInputTitle = $('#lessonTitle');
            this.oInputOverview = $('#lessonOverview');
        },

        bindEvents: function() {
            this.oBtnCancel.click(this.cancelSavingLesson);
            this.oBtnSave.click(this.saveLesson);
        },

        cancelSavingLesson: function() {
            if (confirm("Are you sure you want to cancel?")) {
                window.location.replace(`/teacher/courses/${$(this).data('value')}`);
            }
        },

        saveLesson: function() {
            if (confirm("Are you sure you want to submit this lesson details?")) {
                oAddLesson.addLesson($(this).data('value'));
            }
        },

        addLesson: function(iCourseId) {
            $.ajax({
                url: `/teacher/courses/${iCourseId}/lesson/add`,
                type: 'POST',
                data: {
                    'lesson_title': oAddLesson.oInputTitle.val(),
                    'lesson_overview': oAddLesson.oInputOverview.val(),
                },
                success: function (aResponse) {
                    if (aResponse.result === true) {
                        alert("Added successfully");
                        window.location.replace(`/teacher/courses/${iCourseId}`);
                    } else {
                        alert(aResponse.message);
                    }
                }
            });
        }
    };

    oAddLesson.init();
});