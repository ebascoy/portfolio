import Chart from 'chart.js';
$(document).ready(function () {
    let chartCanvas = document.getElementById("poll-result-chart").getContext('2d');
    let myChart = new Chart(chartCanvas, {
        type: 'doughnut',
        data: chartData,
        options: {
            responsive: false
        }
    });


    // chartData.push(["{{ $key }}", {{ $data }}]);

});
