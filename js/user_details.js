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
        data: {question_id: questionID, question_title: document.getElementById("question-title").value, question_details: document.getElementById("question-details").innerHTML},
        success:function(data) {
          window.location.reload();
        }
      });
    });

    $("#saveQuestionCommentChanges").on('click', function() {
      $.ajax({
        url: "http://localhost:8000/api/user-question-comment-edit/",  
        method: "post",
        data: {comment_id: questionCommentID, comment_content: document.getElementById("question-comment-details").innerHTML},
        success:function(data) {
          window.location.reload();
        }
      });
    });

    $("#saveAnswerChanges").on('click', function() {
      $.ajax({
        url: "http://localhost:8000/api/user-answer-edit/",  
        method: "post",
        data: {answer_id: answerID, answer_details: document.getElementById("answer-details").innerHTML},
        success:function(data) {
          window.location.reload();
        }
      });
    });

    $("#saveAnswerCommentChanges").on('click', function() {
      $.ajax({
        url: "http://localhost:8000/api/user-answer-comment-edit/",  
        method: "post",
        data: {comment_id: questionCommentID, comment_content: document.getElementById("comment-details").innerHTML},
        success:function(data) {
          window.location.reload();
        }
      });
    });
});

function editQuestion(id, questionTitle, questionContent) {
  $("#edit-modal").modal("show");
    document.getElementById("question-title").value = questionTitle;
    document.getElementById("question-details").innerHTML = questionContent;
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
  document.getElementById("question-title").innerHTML = questionTitle;
  document.getElementById("question-comment-details").innerHTML = commentContent;
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

/*
function editAnswer(id, questionTitle, answerContent) {
  $("#edit-modal").modal("show");
    document.getElementById("question-title").value = questionTitle;
    document.getElementById("answer-details").innerHTML = answerContent;
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
  document.getElementById("answer-content").innerHTML = answerContent;
  document.getElementById("comment-details").innerHTML = commentContent;
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
*/