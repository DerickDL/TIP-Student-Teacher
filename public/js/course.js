$(document).ready(function () {
    var oCourse = {
        init: function () {
            this.cacheDOM();
            this.bindEvents();
        },

        cacheDOM: function () {
            this.eFileForm = $('#file-form');
            this.eUploadSpinner = $('#upload-spinner');
            this.eBtnInputFile = $('#upload-file');
            this.eInputFile = $('#input-file');
            this.eListFile = $('.list-file');
            this.eDeleteFile = $('.delete-file');
        },

        bindEvents: function () {
            oCourse.eFileForm.on('submit', oCourse.uploadFile);
            oCourse.eListFile.hover(
                function () {
                    $(this).find('.delete-file').show();    
                },
                function () {
                    $(this).find('.delete-file').hide();
                }
            );
            oCourse.eDeleteFile.click(oCourse.deleteFile);
        },

        uploadFile: function (e) {
            e.preventDefault();
            var oFormData = new FormData(this);
            oCourse.loadState();
            $.ajax({
                url: '/teacher/courses/file/add/' + iSubCourse,
                method: 'POST',
                data: oFormData,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (aResponse) {
                    oCourse.doneState();
                    alert(aResponse['message']);
                    if (aResponse['result'] === true) {
                        location.reload();
                    }
                },
                error: function () {
                    oCourse.doneState();
                }
            });
        },

        deleteFile: function () {
            if (confirm("Are you sure you want to delete this file?")) {
                $.ajax({
                    url: '/teacher/courses/file/delete/' + $(this).data('value'),
                    type: 'DELETE',
                    success: function (aResponse) {
                        alert("Successfully deleted");
                    }
                });
            }
        },

        loadState: function () {
            oCourse.eBtnInputFile.prop('disabled', 'disabled');
            oCourse.eInputFile.prop('disabled', 'disabled');
            oCourse.eUploadSpinner.addClass('active');
        },

        doneState: function () {
            oCourse.eBtnInputFile.removeAttr('disabled');
            oCourse.eInputFile.removeAttr('disabled');
            oCourse.eUploadSpinner.removeClass('active');
        }
    };

    oCourse.init();
});