function upvoteAnswer(answerId) {
    var domain = window.location.host;
    var url = "http://" + domain + "/api/upvote/";
    $.ajax({
        url: url,
        method: "post",
        data: {answer_id: answerId},
        success: function(data) {
            $("#answer-" + answerId + "-vote-count").text(data);
        }
    });
}

function downvoteAnswer(answerId) {
    var domain = window.location.host;
    var url = "http://" + domain + "/api/downvote/";
    $.ajax({
        url: url,  
        method: "post",
        data: {answer_id: answerId},
        success:function(data) {
            $("#answer-" + answerId + "-vote-count").text(data);
        }
    });
}