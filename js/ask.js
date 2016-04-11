$(document).ready(function() {
    $("#question-tags").tagit({
         showAutocompleteOnFocus: true,
         tagSource: function(search, showChoices) {
             if (search.term.length >= 2) {
                 $.ajax({
                   url: "/api/tag/search/",
                   data: search,
                   success: function(choices) {
                     showChoices(choices);
                   }
                 });
             } else {
                 showChoices([]);
             }

         }
    });
	$('.post-answer').hide();
	// document.getElementById("btn-submit-question").disabled = true;
});

function enableSubmit(){
	document.getElementById("btn-submit-question").disabled = false;
}

function postQuestion() {
	var title = $('#question-title').val();
	var content = $('#question-details').val();
  $.ajax({
	    url: "/api/question-submit",
	    method: "POST",
        type: "application/json",
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
