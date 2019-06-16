$(document).ready(function () {
    var oCourse = {
        init: function () {
            this.cacheDOM();
            this.bindEvents();
        },

        cacheDOM: function () {
            this.eBtnInputFile = $('#upload-file');
            this.eFileForm = $('#file-form');
            this.eInputFile = $('#input-file');
        },

        bindEvents: function () {
            oCourse.eFileForm.on('submit', oCourse.uploadFile);
        },

        uploadFile: function (e) {
            e.preventDefault();
            var oFormData = new FormData(this);
            $.ajax({
                url: '/teacher/courses/file/add',
                method: 'POST',
                data: oFormData,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (aResponse) {
                    console.log(aResponse);
                }
            });
        }
    };

    oCourse.init();
});