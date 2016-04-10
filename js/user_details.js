var questionID = -1;
$(document).ready(function() {
    $('.btn-filter').on('click', function () {
      var $target = $(this).data('target');
      if ($target != 'all') {
        $('.table tr').css('display', 'none');
        $('.table tr[data-status="' + $target + '"]').fadeIn('slow');
      } else {
        $('.table tr').css('display', 'none').fadeIn('slow');
      }
    });

    $("#saveChanges").on('click', function() {
      $.ajax({
        url: "http://localhost:8000/api/edit/",  
        method: "post",
        data: {question_id: questionID, question_title: document.getElementById("question-title").value, question_details: document.getElementById("question-details").innerHTML},
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
  $("#delete").on('click', function() {
    $.ajax({
      url: "http://localhost:8000/api/delete/",
      method: "post",
      data: {question_id: id},
      success:function(data) {
        console.log(data);
        window.location.reload();
      }
    });
  });
}