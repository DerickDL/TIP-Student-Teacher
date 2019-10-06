$(document).ready(function () {
   var oAddSection = {
       init: function () {
            this.cacheDOM();
            this.addEvents();
            this.generateKey();
       },
       
       cacheDOM: function () {
           this.eBtnSaveSection = $('#create-section');
           this.eBtnCancelSection = $('#cancel-section');
       },
       
       addEvents: function () {
           oAddSection.eBtnCancelSection.click(oAddSection.redirectToSectionList);
           oAddSection.eBtnSaveSection.click(oAddSection.saveSection);
       },

       generateKey: function() {
            var result           = '';
            var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for ( var i = 0; i < 10; i++ ) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            $('#section-key').val(result);
       },

       saveSection: function () {
            $.ajax({
                url: '/teacher/section/save',
                type: 'POST',
                data: {
                    'name': $('#section-name').val(),
                    'num_stud': $('#no-stud').val(),
                    'start_date': $('#start_date').val(),
                    'end_date': $('#end_date').val(),
                    'class_room': $('#class-room').val(),
                    'act_room': $('#act-room').val(),
                    'integration_id': $('#integ-course').val(),
                    'key': $('#section-key').val(),
                    'user_id': iUserId
                },
                success: function (aResponse) {
                    alert(aResponse['message']);
                    if (aResponse['result'] === true) {
                        oAddSection.redirectToSectionList();
                    }
                }
            })
       },

       redirectToSectionList: function() {
           window.location.replace('/teacher/sections');
       },
    }
   oAddSection.init();
});