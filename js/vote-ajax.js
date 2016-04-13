function voteAnswer(answerId, type) {
    var action = "";
    if (type == 1) {
        action = "upvote/";
    } else if (type == -1) {
        action = "downvote/";
    }
    
    var domain = window.location.host;
    var url = "http://" + domain + "/api/" + action;
    $.ajax({
        url: url,
        method: "post",
        data: {answer_id: answerId},
        statusCode: {
            200: function (response) {
                var original_votes = parseInt($("#answer-" + answerId + "-vote-count").text());
                $("#answer-" + answerId + "-vote-count").text(original_votes + parseInt(response));
            }, 
            403: function (response) {
                login()
            }
        }
    });
}

function upvoteAnswer(answerId) {
    voteAnswer(answerId, 1);
}

function downvoteAnswer(answerId) {
    voteAnswer(answerId, -1);
}