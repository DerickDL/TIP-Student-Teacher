var oInstructor = {
    init: function() {
        oInstructor.cacheDom();
        oInstructor.bindEvents();
        oInstructor.showInstructorsList();
    },

    cacheDom: function () {
        this.oAddInstructor = $('#add-instructor');
        this.oFirstName = $('#first-name');
        this.oLastName = $('#last-name');
        this.oEmail = $('#email');
        this.oUsername = $('#username');
        this.oPassword = $('#password');
        this.oInstructorsList = $('#instructors-list');
        this.oModal = $('#modal-assign');
    },

    bindEvents: function () {
        oInstructor.oAddInstructor.click(oInstructor.addInstructor);
    },

    showInstructorsList: function () {
        $.ajax({
            type: 'GET',
            url: '/instructors',
            data: {
                'user_type': 1
            },
            success: function (aResponse) {
                for (var i = 0; i < aResponse.length; i++) {
                    oInstructor.renderInstructorsList(i, aResponse[i]);
                }
            }
        });
    },

    renderInstructorsList: function (i, aData) {
        var rowData = `<tr>
                        <td class="text-center">${i + 1}</td>
                        <td class="text-center">${aData['username']}</td>
                        <td class="text-center">${aData['first_name']}</td>
                        <td class="text-center">${aData['last_name']}</td>
                        <td class="text-center">${aData['email']}</td>
                    </tr>`;
        oInstructor.oInstructorsList.append(rowData);
    },

    addInstructor: function () {
        $.ajax({
            type: 'POST',
            url: '/register',
            data: {
                'sFirstName': oInstructor.oFirstName.val(),
                'sLastName': oInstructor.oLastName.val(),
                'sEmail': oInstructor.oEmail.val(),
                'sUsername': oInstructor.oUsername.val(),
                'sPassword': oInstructor.oPassword.val(),
                'iType': 1
            },
            success: function(aResponse) {
                if (aResponse.result === false) {
                    alert(aResponse.message);
                } else {
                    oInstructor.oInstructorsList.empty();
                    oInstructor.showInstructorsList();
                    oInstructor.oModal.modal('hide'); 
                }
            }
        });
    }
}

$(document).ready(function () {
    oInstructor.init();
})