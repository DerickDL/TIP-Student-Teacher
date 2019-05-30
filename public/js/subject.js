$(document).ready(function () {
    var oSubject = {
        init: function () {
            this.cacheDOM();
            this.bindEvents();
        },

        cacheDOM: function () {
            this.oBtnDeleteLesson = $('.delete-lesson');
            this.oListLesson = $('.list-group-item');
        },

        bindEvents: function () {
            this.oListLesson.mouseover(function () {
                $(this).children('span').show();
            }).mouseleave(function () {
                $(this).children('span').hide();
            });
            this.oBtnDeleteLesson.click(this.deleteLesson);
        },

        deleteLesson: function () {
            var oSelf = this;
            if (confirm('Are you sure you want to delete this lesson?')) {
                $.ajax({
                    url: `/teacher/subject/lesson/delete`,
                    type: 'POST',
                    data: {
                        'lesson_id': $(oSelf).data('value')
                    },
                    success: function () {
                        alert('Deleted successfully');
                        $(oSelf).parent().remove();
                    },
                    error: function (err) {
                        console.log(err);
                    }
                })
            }
        }
    };

    oSubject.init();
});