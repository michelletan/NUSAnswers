function upvoteAnswer(answerId) {
    $.ajax({
        url: "http://localhost:8000/api/upvote/",
        method: "post",
        data: {answer_id: answerId},
        success: function(data) {
            $("#answer-" + answerId + "-vote-count").text(data);
        }
    });
}

function downvoteAnswer(answerId) {
    $.ajax({
        url: "http://localhost:8000/api/downvote/",  
        method: "post",
        data: {answer_id: answerId},
        success:function(data) {
            $("#answer-" + answerId + "-vote-count").text(data);
        }
    });
}