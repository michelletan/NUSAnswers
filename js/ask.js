$(document).ready(function() {
    $("#question-tags").tagit({
         showAutocompleteOnFocus: true,
         autocomplete: {
             source: "/tag/search",
             minLength: 2
         }
    });
	$('.post-answer').hide();
	document.getElementById("btn-submit-question").disabled = true;
});

function enableSubmit(){
	document.getElementById("btn-submit-question").disabled = false;
}

function postQuestion() {
	var title = $('#question-title').val();
	var content = $('#question-details').val();
  $.ajax({
	    url: "../php/lib/submission.php",
	    method: "POST",

	    data: {
	      type: "question",
	      title: title,
	      content: content
	    },

	    success: function(data) {
	      var json = $.parseJSON(data);
	      console.log(json);
	      var status = json['status'];
	      var message = json['message'];

	      if(status=="success") {
	      	var question_id = json['question_id'];
	      	$('.post-answer').html(message + "<br>id#: " + question_id);
	      }
	      else {
	      	$('.post-answer').html(message);
	      }      
	    }
	  });

	$('.ask-form').hide();
	$('.post-answer').show();
}