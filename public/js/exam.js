$(document).ready(function () {
    var oExam = {
        init: function () {
            this.cacheDOM();
            this.addEvents();
        },

        cacheDOM: function () {
            this.eExamType = $('#exam-type');
            this.eExamList = $('#exam-list');
            this.eDeleteExam = $('.delete-exam');   
        },

        addEvents: function () {
            oExam.eExamType.change(oExam.renderExamList);
            $(document).on('click', '.delete-exam', oExam.deleteExam);
        },

        deleteExam: function () {
            if (confirm('Are you sure you want to delete this exam?')) {
                $.ajax({
                    url: '/teacher/exams/delete/' + $(this).data('value'),
                    type: 'DELETE',
                    success: function () {
                        window.location.reload();
                    }
                });
            }
        },

        renderExamList: function (self) {
            if (oExam.eExamList.find('tbody') !== undefined || oExam.eExamList.find('tbody').length > 0) {
                oExam.eExamList.find('tbody').remove();
            }
            var iExamType = $(self.target).val();
            if (aExams[iExamType].length > 0) {
                var sExamList = `<tbody>
                                ${Object.keys(aExams[iExamType]).map(function (iCtr) {                     
                                    var sRowData = "<tr>";
                                    sRowData += "<td class='text-center'><a href='/teacher/exams/detail/" + aExams[iExamType][iCtr]['id'] + "'>" + aExams[iExamType][iCtr]['parent_course']['integrated_course_name'] + "</a></td>";
                                    sRowData += "<td class='text-center'>" + aExams[iExamType][iCtr]['items'] + "</td>";
                                    sRowData += "<td class='text-center'>" + aExams[iExamType][iCtr]['time_limit'] + "</td>";
                                    sRowData += "<td><button class='btn btn-sm btn-secondary delete-exam'" + aExams[iExamType][iCtr]['id'] + " data-value='" + aExams[iExamType][iCtr]['id'] + "'>Delete</button></td>";
                                    return sRowData;           
                                }).join("")}
                            </tbody>`;
                oExam.eExamList.append(sExamList);
            }
        }
    }
    oExam.init();
});