var oAssign = {
    init: function() {
        oAssign.iCurrentInteg = 1;
        oAssign.cacheDom();
        oAssign.bindEvents();
        oAssign.showInstructorsList();
    },

    cacheDom: function () {
        this.oAssignInstructor = $('#assign-instructor');
        this.oUsername = $('#username');
        this.oAssignsList = $('#instructors-list');
        this.oModal = $('#modal-assign');
        this.oIntegration = $('.integration');
        this.oIntegration1 = $('#integ-course-1');
        this.oIntegration2 = $('#integ-course-2');
        this.oIntegration3 = $('#integ-course-3');
        this.oUsername = $('#username');
    },

    bindEvents: function () {
        oAssign.oIntegration.click(oAssign.changeIntegration);
        oAssign.oAssignInstructor.click(oAssign.assignInstructor);
    },

    showInstructorsList: function () {
        $.ajax({
            type: 'GET',
            url: '/assigned/instructors',
            data: {
                'integration': oAssign.iCurrentInteg
            },
            success: function (aResponse) {
                oAssign.oAssignsList.empty();
                for (var i = 0; i < aResponse.length; i++) {
                    oAssign.renderInstructorsList(i, aResponse[i]);
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
        oAssign.oAssignsList.append(rowData);
    },

    changeIntegration: function () {
        var iSelectedInteg = $(this).data('value');
        if (iSelectedInteg !== oAssign.iCurrentInteg) {
            oAssign.oIntegration.removeClass('active');
            oAssign.iCurrentInteg = iSelectedInteg;
            oAssign.showInstructorsList();
            if (iSelectedInteg === 1) {
                oAssign.oIntegration1.addClass('active');
            } else if (iSelectedInteg === 2) {
                oAssign.oIntegration2.addClass('active');
            } else if (iSelectedInteg === 3) {
                oAssign.oIntegration3.addClass('active');
            }
        }
    },

    assignInstructor: function () {
        $.ajax({
            type: 'POST',
            url: '/assign',
            data: {
                'user': oAssign.oUsername.val(),
                'integration': oAssign.iCurrentInteg
            },
            success: function (aResponse) {
                alert(aResponse['message']);
                if (aResponse['result'] === true) {
                    oAssign.showInstructorsList();
                    oAssign.oModal.modal('hide');
                }
            }
        })
    }
};


$(document).ready(function () {
    oAssign.init();
})