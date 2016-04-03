$(document).ready(function() {
    $("#menu").metisMenu();
   Chart.defaults.global.responsive = true;
    drawSummaryChart("summary-canvas");
    drawQuestionsChart("questions-canvas");
    drawAnswersChart("answers-canvas");
    drawCommentsChart("comments-canvas");
});

function drawSummaryChart(id) {
    var data = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [
            {
                label: "Number of Questions Asked",
                fillColor: "rgba(238, 207, 32, 0.5)",
                strokeColor: "rgba(238, 207, 32, 0.8)",
                highlightFill: "rgba(238, 207, 32, 0.75)",
                highlightStroke: "rgba(238, 207, 32, 1)",
                data: [65, 59, 80, 81, 56, 55, 40]
            },
            {
                label: "Number of Answers Given",
                fillColor: "rgba(224, 102, 102, 0.5)",
                strokeColor: "rgba(224, 102, 102, 0.8)",
                highlightFill: "rgba(224, 102, 102, 0.75)",
                highlightStroke: "rgba(224, 102, 102, 1)",
                data: [28, 48, 40, 19, 86, 27, 90]
            },
            {
                label: "Number of Comments Given",
                fillColor: "rgba(204, 102, 255, 0.5)",
                strokeColor: "rgba(204, 102, 255, 0.8)",
                highlightFill: "rgba(204, 102, 255, 0.75)",
                highlightStroke: "rgba(204, 102, 255, 1)",
                data: [45, 24, 57, 35, 93, 51, 13]
            }
        ]
    };
    var options = {
        //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        scaleBeginAtZero : true,

        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines : true,

        //String - Colour of the grid lines
        scaleGridLineColor : "rgba(0,0,0,.05)",

        //Number - Width of the grid lines
        scaleGridLineWidth : 1,

        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,

        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines: true,

        //Boolean - If there is a stroke on each bar
        barShowStroke : true,

        //Number - Pixel width of the bar stroke
        barStrokeWidth : 2,

        //Number - Spacing between each of the X value sets
        barValueSpacing : 5,

        //Number - Spacing between data sets within X values
        barDatasetSpacing : 1,

        //String - A legend template
        legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"

    };
    var ctx = document.getElementById(id).getContext("2d");
    var myBarChart = new Chart(ctx).Bar(data, options);
}

function drawQuestionsChart(id) {
    var data = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [
            {
                label: "Number of Questions Asked",
                fillColor: "rgba(238, 207, 32, 0.5)",
                strokeColor: "rgba(238, 207, 32, 0.8)",
                highlightFill: "rgba(238, 207, 32, 0.75)",
                highlightStroke: "rgba(238, 207, 32, 1)",
                data: [65, 59, 80, 81, 56, 55, 40]
            }
        ]
    };
    var options = {
        //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        scaleBeginAtZero : true,

        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines : true,

        //String - Colour of the grid lines
        scaleGridLineColor : "rgba(0,0,0,.05)",

        //Number - Width of the grid lines
        scaleGridLineWidth : 1,

        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,

        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines: true,

        //Boolean - If there is a stroke on each bar
        barShowStroke : true,

        //Number - Pixel width of the bar stroke
        barStrokeWidth : 2,

        //Number - Spacing between each of the X value sets
        barValueSpacing : 5,

        //Number - Spacing between data sets within X values
        barDatasetSpacing : 1,

        //String - A legend template
        legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"

    };
    var ctx = document.getElementById(id).getContext("2d");
    var myBarChart = new Chart(ctx).Bar(data, options);
}

function drawAnswersChart(id) {
    var data = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [
            {
                label: "Number of Answers Given",
                fillColor: "rgba(224, 102, 102, 0.5)",
                strokeColor: "rgba(224, 102, 102, 0.8)",
                highlightFill: "rgba(224, 102, 102, 0.75)",
                highlightStroke: "rgba(224, 102, 102, 1)",
                data: [28, 48, 40, 19, 86, 27, 90]
            }
        ]
    };
    var options = {
        //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        scaleBeginAtZero : true,

        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines : true,

        //String - Colour of the grid lines
        scaleGridLineColor : "rgba(0,0,0,.05)",

        //Number - Width of the grid lines
        scaleGridLineWidth : 1,

        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,

        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines: true,

        //Boolean - If there is a stroke on each bar
        barShowStroke : true,

        //Number - Pixel width of the bar stroke
        barStrokeWidth : 2,

        //Number - Spacing between each of the X value sets
        barValueSpacing : 5,

        //Number - Spacing between data sets within X values
        barDatasetSpacing : 1,

        //String - A legend template
        legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"

    };
    var ctx = document.getElementById(id).getContext("2d");
    var myBarChart = new Chart(ctx).Bar(data, options);
}

function drawCommentsChart(id) {
    var data = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [
            {
                label: "Number of Comments Given",
                fillColor: "rgba(204, 102, 255, 0.5)",
                strokeColor: "rgba(204, 102, 255, 0.8)",
                highlightFill: "rgba(204, 102, 255, 0.75)",
                highlightStroke: "rgba(204, 102, 255, 1)",
                data: [45, 24, 57, 35, 93, 51, 13]
            }
        ]
    };
    var options = {
        //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        scaleBeginAtZero : true,

        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines : true,

        //String - Colour of the grid lines
        scaleGridLineColor : "rgba(0,0,0,.05)",

        //Number - Width of the grid lines
        scaleGridLineWidth : 1,

        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,

        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines: true,

        //Boolean - If there is a stroke on each bar
        barShowStroke : true,

        //Number - Pixel width of the bar stroke
        barStrokeWidth : 2,

        //Number - Spacing between each of the X value sets
        barValueSpacing : 5,

        //Number - Spacing between data sets within X values
        barDatasetSpacing : 1,

        //String - A legend template
        legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"

    };
    var ctx = document.getElementById(id).getContext("2d");
    var myBarChart = new Chart(ctx).Bar(data, options);
}