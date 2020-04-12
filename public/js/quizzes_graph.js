$(document).ready(function () {
    var oQuizzesGraph = {
        init: function () {
            oQuizzesGraph.getQuizzesData();
            // oQuizzesGraph.overallGraph();
            
        },

        getQuizzesData: function () {
            $.ajax({
               url: '/quizzes/graph/' + iTeacherId,
               type: 'GET',
               success: function (aResponse) {
                    console.log(aResponse);
                    oQuizzesGraph.overallGraph(aResponse);
               }
            });
        },

        overallGraph: function (aData) {
            var quizzes_graph = document.getElementById('quizzes_graph').getContext('2d');
            var quizzes_graph = new Chart(quizzes_graph, {
                type: 'bar',
                data: {
                    labels: aData['courses'],
                    datasets: aData['students_data']
                },
                options: {
                    legend: {
                        display: true,
                        position: 'right',
                        align: 'middle'
                    },
                    
                    title: {
                        display: true,
                        text: 'Quizzes Percentage'
                    },
                    scales: {
                        yAxes: [{
                            display: true,
                            ticks: {
                                suggestedMin: 0,    // minimum will be 0, unless there is a lower value.
                                suggestedMax: 100
                            }
                        }]
                    }
                }
            });
        }
    }
   oQuizzesGraph.init();
});