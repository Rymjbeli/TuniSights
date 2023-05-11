var colors = [
    '#EF9A9A',
    '#F48FB1',
    '#CE93D8',
    '#B39DDB',
    '#9FA8DA',
    '#90CAF9',
    '#81D4FA',
    '#80DEEA',
    '#80CBC4',
    '#A5D6A7',
    '#C5E1A5',
    '#E6EE9C',
    '#FFF59D',
    '#FFE082',
    '#FFCC80',
    '#FFAB91',
    '#BCAAA4',
    '#B0BEC5',
    '#F8BBD0',
    '#B2EBF2',
    '#DCEDC8',
    '#FFCCBC',
    '#B2DFDB'
];
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
                    '#ffe9c2',
                    '#ecd08b',
                    '#e57a9a',
                    '#c767a3',
                    '#6f68c0',
                    '#4d77c5',
                    '#71bdf0',
                    '#6ec7a6',
                    '#99df6d'
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
                backgroundColor: colors
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