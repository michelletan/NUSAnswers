var userStats = [];
$(document).ready(function() {
    Chart.defaults.global.responsive = true;
    $.get("http://" + window.location.host + "/api/user-statistics/", function(data) {
        var stats = JSON.parse(data);
        userStats[0] = stats['questions'].slice(0, 7);
        userStats[1] = stats['answers'].slice(0, 7);
        userStats[2] = stats['comments'].slice(0, 7);

        drawSummaryChart("summary-canvas", userStats);
        drawQuestionsChart("questions-canvas", userStats[0]);
        drawAnswersChart("answers-canvas", userStats[1]);
        drawCommentsChart("comments-canvas", userStats[2]);
    })
});

function drawSummaryChart(id) {
    var data = {
        labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
        datasets: [
            {
                label: "Number of Questions Asked",
                fillColor: "rgba(238, 207, 32, 0.5)",
                strokeColor: "rgba(238, 207, 32, 0.8)",
                highlightFill: "rgba(238, 207, 32, 0.75)",
                highlightStroke: "rgba(238, 207, 32, 1)",
                data: [userStats[0][0], userStats[0][1], userStats[0][2], userStats[0][3], userStats[0][4], userStats[0][5], userStats[0][6]]
            },
            {
                label: "Number of Answers Given",
                fillColor: "rgba(224, 102, 102, 0.5)",
                strokeColor: "rgba(224, 102, 102, 0.8)",
                highlightFill: "rgba(224, 102, 102, 0.75)",
                highlightStroke: "rgba(224, 102, 102, 1)",
                data: [userStats[1][0], userStats[1][1], userStats[1][2], userStats[1][3], userStats[1][4], userStats[1][5], userStats[1][6]]
            },
            {
                label: "Number of Comments Given",
                fillColor: "rgba(204, 102, 255, 0.5)",
                strokeColor: "rgba(204, 102, 255, 0.8)",
                highlightFill: "rgba(204, 102, 255, 0.75)",
                highlightStroke: "rgba(204, 102, 255, 1)",
                data: [userStats[2][0], userStats[2][1], userStats[2][2], userStats[2][3], userStats[2][4], userStats[2][5], userStats[2][6]]
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

function drawQuestionsChart(id, questionStats) {
    var data = {
        labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
        datasets: [
            {
                label: "Number of Questions Asked",
                fillColor: "rgba(238, 207, 32, 0.5)",
                strokeColor: "rgba(238, 207, 32, 0.8)",
                highlightFill: "rgba(238, 207, 32, 0.75)",
                highlightStroke: "rgba(238, 207, 32, 1)",
                data: [questionStats[0], questionStats[1], questionStats[2], questionStats[3], questionStats[4], questionStats[5], questionStats[6]]
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

function drawAnswersChart(id, answerStats) {
    var data = {
        labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
        datasets: [
            {
                label: "Number of Answers Given",
                fillColor: "rgba(224, 102, 102, 0.5)",
                strokeColor: "rgba(224, 102, 102, 0.8)",
                highlightFill: "rgba(224, 102, 102, 0.75)",
                highlightStroke: "rgba(224, 102, 102, 1)",
                data: [answerStats[0], answerStats[1], answerStats[2], answerStats[3], answerStats[4], answerStats[5], answerStats[6]]
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

function drawCommentsChart(id, commentStats) {
    var data = {
        labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
        datasets: [
            {
                label: "Number of Comments Given",
                fillColor: "rgba(204, 102, 255, 0.5)",
                strokeColor: "rgba(204, 102, 255, 0.8)",
                highlightFill: "rgba(204, 102, 255, 0.75)",
                highlightStroke: "rgba(204, 102, 255, 1)",
                data: [commentStats[0], commentStats[1], commentStats[2], commentStats[3], commentStats[4], commentStats[5], commentStats[6]]
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

$('.todays-stats-quantity').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 1000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});