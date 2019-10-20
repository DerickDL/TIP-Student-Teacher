$(document).ready(function () {
    var oStudent = {
        init() {
            this.cacheDom();
            this.bindEvents();  
        },
        cacheDom() {
            this.oCode = $('#code');
            this.oEnroll = $('#enroll');
            this.oModal = $('#modal-enroll');
        },
        bindEvents() {
            oStudent.oEnroll.click(oStudent.enrollStudent);
        },
        enrollStudent() {
            var aData = {
                'user_id': iStudentId,
                'key': oStudent.oCode.val()
            };
            $.ajax({
                type: 'POST',
                url: '/enroll',
                data: aData,
                success: function (aResponse) {
                    if(aResponse['result'] === false) {
                        alert(aResponse['message']);
                    } else {
                        oStudent.oModal.modal('hide');
                        alert('Successfully enrolled. Wait for the professor to approve your enrollment.');
                    }
                }
            });
        } 
    };

    oStudent.init();
});