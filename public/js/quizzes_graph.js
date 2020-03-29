$(document).ready(function () {
    var oQuizzesGraph = {
        init: function () {
            // oQuizzesGraph.startCompute();
            oQuizzesGraph.overallGraph();
            
        },

        startCompute: function () {
            $.ajax({
               url: '',
               type: 'GET',
               success: function (aResponse) {

               }
            });
        },

        overallGraph: function (aData) {
            var quizzes_graph = document.getElementById('quizzes_graph').getContext('2d');
            var quizzes_graph = new Chart(quizzes_graph, {
                type: 'bar',
                data: {
                    labels: ['Trigonometry', 'Physics', 'Data Commmunication'],
                    datasets: [
                        {
                            label: "John Derick De Leon",
                            backgroundColor: "blue",
                            data: [80,95,70]
                        },
                        {
                            label: "Jimwell Dela Pena ",
                            backgroundColor: "red",
                            data: [87,90,97]
                        },
                        {
                            label: "John Dee Bobo De Leon",
                            backgroundColor: "green",
                            data: [85,90,85]
                        }
                    ]
                },
                options: {
                    legend: {
                        display: true,
                        position: 'right',
                        align: 'middle'
                    },
                    
                    title: {
                        display: true,
                        text: 'Overall Percentage'
                    },
                    scales: {
                        yAxes: [{
                            display: true,
                            ticks: {
                                suggestedMin: 0,    // minimum will be 0, unless there is a lower value.
                                // OR //
                            }
                        }]
                    }
                }
            });
        }
    }
   oQuizzesGraph.init();
});