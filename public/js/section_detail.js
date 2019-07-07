
$(document).ready(function () {
   var oSection = {
       init: function () {
           this.cacheDOM();
           this.addEvents();
           
       },
       
       cacheDOM: function () {
           this.eBtnUpdateSection = $('#create-section');
           this.eBtnCancelSection = $('#cancel-section');
           this.eBtnDeleteSection = $('#delete-section');
       },
       
       addEvents: function () {
           oSection.eBtnCancelSection.click(oSection.redirectToSectionList);
           oSection.eBtnDeleteSection.click(oSection.deleteSection);
       },

       deleteSection: function () {
           if (confirm('Are you sure you want to delete this section?')) {
                $.ajax({
                    url: '/teacher/section/delete/' + iSectionId,
                    type: 'DELETE',
                    success: function () {
                        alert('Successfuly deleted.');
                        window.location.replace('/teacher/section');
                       
                    },
                    error: function () {
                        alert('Something went wrong. Please try again.');
                    }
                })
           }
       },

       redirectToSectionList: function() {
           if (confirm('Are you sure you want to cancel updating quiz?')) {
                window.location.replace('/teacher/sections');
           }
       },
    }
   oSection.init();
});