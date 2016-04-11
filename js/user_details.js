var questionID = -1;
var commentID = -1;
var answerID = -1;
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

    $("#saveCommentChanges").on('click', function() {
      $.ajax({
        url: "http://localhost:8000/api/user-question-comment-edit/",  
        method: "post",
        data: {comment_id: commentID, comment_content: document.getElementById("comment-details").innerHTML},
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

function editComment(id, questionTitle, commentContent) {
  $("#edit-modal").modal("show");
  document.getElementById("question-title").innerHTML = questionTitle;
  document.getElementById("comment-details").innerHTML = commentContent;
  commentID = id;
}

function deleteComment(id) {
  $("#delete-modal").modal("show");
  $("#deleteComment").on('click', function() {
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