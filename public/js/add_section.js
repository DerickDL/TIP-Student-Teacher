$(document).ready(function () {
   var oAddSection = {
       init: function () {
           this.cacheDOM();
           this.addEvents();
           
       },
       
       cacheDOM: function () {
           this.eBtnSaveSection = $('#create-section');
           this.eBtnCancelSection = $('#cancel-section');
       },
       
       addEvents: function () {
           oAddSection.eBtnCancelSection.click(oAddSection.redirectToSectionList);
           oAddSection.eBtnSaveSection.click(oAddSection.saveSection);
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
                    'act_room': $('#act-room').val()
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