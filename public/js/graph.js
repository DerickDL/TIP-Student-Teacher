$(document).ready(function () {
    var oGraph = {
        init: function () {
            oGraph.startCompute();
            
        },

        filterStudents: function() {
            var aFilteredStudents = [];
            for (var i = 0; i < aStudents.length; i++) {
                if (aStudents[i]['pivot']['status'] === 1) {
                    aFilteredStudents.push(aStudents[i]);
                }
            }
            return aFilteredStudents;
        },

        startCompute: function() {
            var aFilteredStudents = oGraph.filterStudents();
            $.ajax({
                'url': '/compute',
                'type': 'GET',
                'data': {
                    'students': aFilteredStudents,
                    'integrations': aIntegrations,
                    'section': aSection[0],
                    'creator_id': iCreatorId
                },
                success: function(aResponse) {
                    aData = oGraph.buildPieData(aResponse);
                    oGraph.overallGraph(aData);
                }
            });
        },

        buildPieData: function(aData) {
            aFrequencies = [];
            for (var item in aData) {
                aFrequencies.push(aData[item]);
            }
            return aFrequencies;
        },

        overallGraph: function (aData) {
            var overall = document.getElementById('overall').getContext('2d');
            var overallPie = new Chart(overall, {
                type: 'pie',
                data: {
                    labels: ['1', '1.25', '1.5', '1.75', '2', '2.25', '2.5', '2.75', '3', '4', '5'],
                    datasets: [{
                        data: aData,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(239, 245, 66, 0.5)',
                            'rgba(173, 245, 66, 0.7)',
                            'rgba(120, 245, 66, 0.7)',
                            'rgba(66, 245, 123, 0.7)',
                            'rgba(245, 150, 66, 0.8)',
                            'rgba(239, 245, 66, 0.8)',
                            'rgba(66, 108, 245, 0.8)',
                            'rgba(245, 66, 120, 0.9)',
                            'rgba(224, 66, 245, 0.9)'
                        ],
                    }]
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
                }
            });
        }
    }
   oGraph.init();
});