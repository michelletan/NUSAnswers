var questionID = -1;
var questionCommentID = -1;
var answerID = -1;
var answerCommentID = -1;
$(document).ready(function() {
  $("#menu").metisMenu();
    $('.btn-filter').on('click', function () {
      var $target = $(this).data('target');
      if ($target != 'all') {
        $('.table tr').css('display', 'none');
        $('.table tr[data-status="' + $target + '"]').fadeIn('slow');
      } else {
        $('.table tr').css('display', 'none').fadeIn('slow');
      }
    });

    $("#saveQuestionChanges").on('click', function() {
      $.ajax({
        url: "http://localhost:8000/api/user-question-edit/",  
        method: "post",
        data: {question_id: questionID, question_title: $("#question-title").val(), question_details: $("#question-details").val()},
        success:function(data) {
          window.location.reload();
        }
      });
    });

    $("#saveQuestionCommentChanges").on('click', function() {
      $.ajax({
        url: "http://localhost:8000/api/user-question-comment-edit/",  
        method: "post",
        data: {comment_id: questionCommentID, comment_content: $("#question-comment-details").val()},
        success:function(data) {
          window.location.reload();
        }
      });
    });

    $("#saveAnswerChanges").on('click', function() {
      $.ajax({
        url: "http://localhost:8000/api/user-answer-edit/",  
        method: "post",
        data: {answer_id: answerID, answer_details: $("#answer-details").val()},
        success:function(data) {
          console.log(data);
          window.location.reload();
        }
      });
    });

    $("#saveAnswerCommentChanges").on('click', function() {
      $.ajax({
        url: "http://localhost:8000/api/user-answer-comment-edit/",  
        method: "post",
        data: {comment_id: questionCommentID, comment_content: $("#comment-details").val()},
        success:function(data) {
          console.log(data);
          window.location.reload();
        }
      });
    });
});

function editQuestion(id, questionTitle, questionContent) {
  $("#edit-modal").modal("show");
    $("#question-title").val(questionTitle);
    $("#question-details").val(questionContent);
    questionID = id;
}

function deleteQuestion(id) {
  $("#delete-modal").modal("show");
  $("#deleteQuestion").on('click', function() {
    $.ajax({
      url: "http://localhost:8000/api/user-question-delete/",
      method: "post",
      data: {question_id: id},
      success:function(data) {
        window.location.reload();
      }
    });
  });
}

function editQuestionComment(id, questionTitle, commentContent) {
  $("#edit-modal").modal("show");
  $("#question-title").text(questionTitle);
  $("#question-comment-details").val(commentContent);
  questionCommentID = id;
}

function deleteQuestionComment(id) {
  $("#delete-modal").modal("show");
  $("#deleteQuestionComment").on('click', function() {
    $.ajax({
      url: "http://localhost:8000/api/user-question-comment-delete/",
      method: "post",
      data: {comment_id: id},
      success:function(data) {
        window.location.reload();
      }
    });
  });
}


function editAnswer(id, questionTitle, answerContent) {
  $("#edit-modal").modal("show");
    $("#question-title").text(questionTitle);
    $("#answer-details").val(answerContent);
    answerID = id;
}

function deleteAnswer(id) {
  $("#delete-modal").modal("show");
  $("#deleteAnswer").on('click', function() {
    $.ajax({
      url: "http://localhost:8000/api/user-answer-delete/",
      method: "post",
      data: {answer_id: id},
      success:function(data) {
        window.location.reload();
      }
    });
  });
}

function editAnswerComment(id, answerContent, commentContent) {
  $("#edit-modal").modal("show");
  $("#answer-details").text(answerContent);
  $("#comment-details").val(commentContent);
  answerCommentID = id;
}

function deleteAnswerComment(id) {
  $("#delete-modal").modal("show");
  $("#deleteAnswerComment").on('click', function() {
    $.ajax({
      url: "http://localhost:8000/api/user-answer-comment-delete/",
      method: "post",
      data: {comment_id: id},
      success:function(data) {
        window.location.reload();
      }
    });
  });
}