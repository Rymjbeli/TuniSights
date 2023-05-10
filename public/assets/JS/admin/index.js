/* PostsByCategory chart */
document.addEventListener('DOMContentLoaded', function () {
    // Retrieve the chart data passed from the controller

    // Create the pie chart
    var ctx = document.getElementById('chartByCategory').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: Object.keys(chartDataByCategory),
            datasets: [{
                data: Object.values(chartDataByCategory),
                backgroundColor: [
                    '#000080',
                    '#87CEEB',
                    '#800080', // Violet
                    '#FFD1DC',
                    '#007bff',
                    '#008080', // Vert bleuté
                    '#1e90ff',
                    '#4169e1',
                    '#6495ed',
                    '#87ceeb',
                    '#87cefa',
                    '#00bfff',
                    '#1aa3ff',
                    '#00ccff',
                    '#00e5ff',
                    '#33ccff',
                    '#66ccff',
                    '#99ccff',
                    '#ccddff',
                    '#e6f2ff',
                    '#b3e0ff',
                    '#80ccff',
                    '#4db8ff',
                    '#1a94ff',
                    '#0066cc',
                    '#003d99',
                    '#001a66',
                    '#000d33',
                    '#00051a'

                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
});

/* PostsByState chart */
document.addEventListener('DOMContentLoaded', function () {
    // Retrieve the chart data passed from the controller

    // Create the doughnut chart
    var ctxDoughnut = document.getElementById('chart-doughnut').getContext('2d');
    new Chart(ctxDoughnut, {
        type: 'doughnut',
        data: {
            labels: Object.keys(chartDataByState),
            datasets: [{
                data: Object.values(chartDataByState),
                backgroundColor: [
                    '#000080',   // Bleu marine
                    '#87CEEB',   // Bleu ciel
                    '#FFD1DC',   // Rose pâle
                    '#1e90ff',
                    '#800080',   // Violet
                    '#008080',   // Vert bleuté
                    '#007BFF',   // Bleu primaire
                    '#1E90FF',   // Bleu dodger
                    '#4169E1',   // Bleu royal
                    '#6495ED',   // Bleu acier clair
                    '#FF1493',   // Rose vif
                    '#FFA07A',   // Saumon clair
                    '#FF6347',   // Rouge corail
                    '#1aa3ff',
                    '#00ccff',
                    '#FF8C00',   // Orange foncé
                    '#FFFF00',   // Jaune vif
                    '#ADFF2F',   // Vert jaunâtre
                    '#32CD32',   // Vert lime
                    '#007bff',
                    '#4169e1',
                    '#6495ed',
                    '#87ceeb',
                    '#87cefa',
                    '#00bfff',
                    '#00ccff',
                    '#00e5ff',
                    '#33ccff',
                    '#66ccff',
                    '#99ccff',
                    '#ccddff',
                    '#e6f2ff',
                    '#b3e0ff',
                    '#80ccff',
                    '#4db8ff',
                    '#1a94ff',
                    '#0066cc',
                    '#003d99',
                    '#001a66',
                    '#000d33',
                    '#00051a'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('chart-bar').getContext('2d');

// Retrieve the chart data passed from the controller

// Create the bar chart
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: Object.keys(chartDataByAge),
            datasets: [{
                label: 'Number of Users',
                data: Object.values(chartDataByAge),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(33,204,222,0.2)',
                    'rgba(255,58,157,0.2)',


                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(33,204,222,1)',
                    'rgba(255,58,157,1)',


                ],
                borderWidth: 1,
                barThickness: 60,
            }]
        },
        options: {
            plugins: {
                legend: {
                    labels: {
                        color: 'grey',
                    }
                }
            }
        }
    });
});