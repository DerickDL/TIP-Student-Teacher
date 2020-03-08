$(document).ready(function () {
    var oChangePass = {
        init: function () {
            this.cacheDOM();
            this.addEvents();
        },

        cacheDOM: function () {
            this.eBtnChange = $('.btn-change-pass');
        },

        addEvents: function () {
            oChangePass.eBtnChange.click(oChangePass.changePassword);
        },

        changePassword: function () {
            var sCurrentPassword = $('#current-password').val();
            if (sCurrentPassword === aSession['password']) {
                var sNewPassword = $('#new-password').val();
                var sConfirmPassword = $('#confirm-password').val();
                if(sNewPassword === sConfirmPassword) {
                    oChangePass.changePassRequest();
                } else {
                    alert('New Password doesn\'t match.');
                }
            } else {
                alert('Wrong Password.');
            }
        },

        changePassRequest: function() {
            $.ajax({
                'url': '/change-password',
                'type': 'PUT',
                'data': {
                    'user_data': aSession,
                    'new_password': $('#new-password').val()
                },
                'success': function(aResponse) {
                    alert(aResponse['message']);
                    if (aSession['user_type'] === 0) {
                        window.location.replace('/student');
                    } else if (aSession['user_type'] === 1) {
                        window.location.replace('/teacher');
                    } else if (aSession['user_type'] === 2) {
                        window.location.replace('/admin');
                    }
                }
            });
        }

    }
    oChangePass.init();
});