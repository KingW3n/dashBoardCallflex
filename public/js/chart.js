function instanciarChart(idCampo,lbCampOne,lbCampTwo,valorOne,valorTwo,colorOne,colorTwo,hoverColorOne,hoverColorTwo){
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    // Pie Chart Example
    $('.Chart'+idCampo).html('<canvas id="'+idCampo+'"></canvas>');
    var ctx = document.getElementById(idCampo);
    var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [lbCampOne, lbCampTwo],
            datasets: [{
                data: [valorOne, valorTwo],
                backgroundColor: [colorOne,colorTwo],
                hoverBackgroundColor: [hoverColorOne,hoverColorTwo],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            cutoutPercentage: 80,
        },
    });
    $(idCampo).html('oi');
}
