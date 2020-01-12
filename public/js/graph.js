$(document).ready(function () {
    var oGraph = {
        init: function () {
            this.quizGraph();
            this.prelimGraph();
            this.midtermGraph();
            this.finalGraph();
        },
       
        quizGraph: function () {
            var quizzes = document.getElementById('quizzes').getContext('2d');
            var quizzesChart = new Chart(quizzes, {
                type: 'bar',
                data: {
                    labels: ['Algebra', 'Basic Programming', 'Cisco 1'],
                    datasets: [{
                        data: [86, 78, 90],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    
                    title: {
                        display: true,
                        text: 'Quizzes'
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                stepSize: 5,
                                min: 50,
                                max: 100
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'Percentage'
                              }
                        }]
                    }
                }
            });
        },

        prelimGraph: function () {
            var prelims = document.getElementById('prelims').getContext('2d');
            var prelimsChart = new Chart(prelims, {
                type: 'bar',
                data: {
                    labels: ['Integration Course 1', 'Integration Course 2', 'Integration Course 3'],
                    datasets: [{
                        data: [86, 78, 90],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    
                    title: {
                        display: true,
                        text: 'Preliminary Exams'
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                stepSize: 5,
                                min: 50,
                                max: 100
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'Percentage'
                              }
                        }]
                    }
                }
            });
        },

        midtermGraph: function () {
            var midterms = document.getElementById('midterms').getContext('2d');
            var midtermsChart = new Chart(midterms, {
                type: 'bar',
                data: {
                    labels: ['Integration Course 1', 'Integration Course 2', 'Integration Course 3'],
                    datasets: [{
                        data: [86, 78, 90],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    
                    title: {
                        display: true,
                        text: 'Mid Term Exams'
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                stepSize: 5,
                                min: 50,
                                max: 100
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'Percentage'
                              }
                        }]
                    }
                }
            });
        },

        finalGraph: function () {
            var finals = document.getElementById('finals').getContext('2d');
            var finalsChart = new Chart(finals, {
                type: 'bar',
                data: {
                    labels: ['Integration Course 1', 'Integration Course 2', 'Integration Course 3'],
                    datasets: [{
                        data: [86, 78, 90],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    
                    title: {
                        display: true,
                        text: 'Final Term Exams'
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                stepSize: 5,
                                min: 50,
                                max: 100
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'Percentage'
                              }
                        }]
                    }
                }
            });
        },
    }
   oGraph.init();
});