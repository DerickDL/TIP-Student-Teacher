$(document).ready(function () {
    var oExam = {
        init: function () {
            this.cacheDOM();
            this.addEvents();
        },

        cacheDOM: function () {
            this.eExamType = $('#exam-type');
            this.eExamList = $('#exam-list'); 
        },

        addEvents: function () {
            oExam.eExamType.change(oExam.renderExamList);
        },


        renderExamList: function (self) {
            if (oExam.eExamList.find('tbody') !== undefined || oExam.eExamList.find('tbody').length > 0) {
                oExam.eExamList.find('tbody').remove();
            }
            var iExamType = $(self.target).val();
            if (aExams[iExamType] !== undefined) {
                var sExamList = `<tbody>
                                ${Object.keys(aExams[iExamType]).map(function (iCtr) {                     
                                    var sRowData = "<tr>";
                                    sRowData += `<td class="text-center"><a class="btn btn-link ${aExams[iExamType][iCtr]['status'] == 0 ? 'd-none' : '' }" href="/student/class/${aClass[0]['id']}/exam/${aExams[iExamType][iCtr]['id']}">${aExams[iExamType][iCtr]['parent_course']['integrated_course_name'] }</a>${ aExams[iExamType][iCtr]['status'] == 0 ? aExams[iExamType][iCtr]['parent_course']['integrated_course_name'] : '' }</td>`;
                                    sRowData += "<td class='text-center'>" + aExams[iExamType][iCtr]['items'] + "</td>";
                                    sRowData += "<td class='text-center'>" + aExams[iExamType][iCtr]['time_limit'] + "</td>";
                                    sRowData += `<td scope="col" class="text-center">${aExams[iExamType][iCtr]['score'] !== null ? aExams[iExamType][iCtr]['score'] + '/' + aExams[iExamType][iCtr]['items'] : '-' }</td>`;
                                    sRowData += `<td class="text-center">${ aExams[iExamType][iCtr]['status'] === 0 ? 'Close' : 'Open' }</td>`;
                                    return sRowData;           
                                }).join("")}
                            </tbody>`;
                oExam.eExamList.append(sExamList);
            }
        }
    }
    oExam.init();
});