$(document).ready(function () {
    var oCoursesList = {
        init: function () {
            this.cacheDOM();
            this.bindEvents();
        },

        cacheDOM: function () {
            this.oBtnDeleteCourse = $('.delete-course');
        },

        bindEvents: function () {
            this.oBtnDeleteCourse.click(this.deleteCourse);
        },

        deleteCourse: function () {
            var oSelf = this;
            if (confirm('Are you sure you want to delete this course?')) {
                $.ajax({
                    url: `/teacher/section/${iSectionId}/course/delete/${$(oSelf).data('value')}`,
                    type: 'DELETE',
                    success: function () {
                        alert('Deleted successfully');
                        window.reload();
                    },
                    error: function (err) {
                        console.log(err);
                    }
                })
            }
        }
    };

    oCoursesList.init();
});