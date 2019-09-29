$(document).ready(function () {
    var oAddCourse = {
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
            this.oBtnCancel.click(this.cancelSavingCourse);
            this.oBtnSave.click(this.saveCourse);
        },

        cancelSavingCourse: function() {
            if (confirm("Are you sure you want to cancel?")) {
                window.location.replace(`/teacher/courses/${iIntegratedCourse}`);
            }
        },

        saveCourse: function() {
            if (confirm("Are you sure you want to submit this course details?")) {
                oAddCourse.addCourse($(this).data('value'));
            }
        },

        addCourse: function(iUserId) {
            $.ajax({
                url: `/teacher/course/add`,
                type: 'POST',
                data: {
                    'course_code': oAddCourse.oInputCode.val(),
                    'course_title': oAddCourse.oInputTitle.val(),
                    'course_overview': oAddCourse.oInputOverview.val(),
                    'course_user_id': iUserId,
                    'integrated_course_id': iIntegratedCourse,
                },
                success: function (aResponse) {
                    if (aResponse.result === true) {
                        alert("Added successfully");
                        window.location.replace(`/teacher/courses/${iIntegratedCourse}`);
                    } else {
                        alert(aResponse.message);
                    }
                }
            });
        }
    };

    oAddCourse.init();
});