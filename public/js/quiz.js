$(document).ready(function () {
    var oQuiz = {
        init: function () {
            this.cacheDOM();
            this.addEvents();
        },

        cacheDOM: function () {
            this.eDeleteQuiz = $('.delete-quiz');
        },

        addEvents: function () {
            oQuiz.eDeleteQuiz.click(oQuiz.deleteQuiz);
        },

        deleteQuiz: function () {
            if (confirm('Are you sure you want to delete this quiz?')) {
                $.ajax({
                    url: '/quizzes/delete/' + $(this).data('value'),
                    type: 'DELETE',
                    success: function () {
                        window.location.reload();
                    }
                });
            }
        },
    }
    oQuiz.init();
});