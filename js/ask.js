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
	$('.question-message').hide();
	document.getElementById("btn-submit-question").disabled = true;

	$("#filepicker").click(function() {
		filepicker.setKey("Ag47cAGj4Td2gqU2gOyrLz");
		filepicker.pick(
		 {
		    mimetype: 'image/*',
		    container: 'window',
		    services: ['COMPUTER', 'FACEBOOK', 'CLOUDAPP']
		  },
		  function(Blob){
		  	$("#file").val(Blob.url);
		  	$("#file-url").text(Blob.filename).css("display", "block");
		  },
		  function(FPError){
		//  console.log(FPError.toString()); - print errors to console
		  }
		);
	});
});

function enableSubmit(){
	document.getElementById("btn-submit-question").disabled = false;
}

function postQuestion() {
	var title = $('#question-title').val();
	var content = $('#question-details').val();
	var response = grecaptcha.getResponse();
	var file = $("#file").val();
  $.ajax({
	    url: "/api/question-submit/",
	    method: "POST",
        type: "application/json",
	    data: {
	      type: "question",
	      title: title,
	      content: content,
	      response: response,
	      file: file
	    },

	    success: function(json) {
	    //   var json = $.parseJSON(data);
	    //   console.log(json);
	      var status = json['status'];
	      var message = json['message'];

	      if(status=="success") {
	      	var question_id = json['question_id'];
            // post-answer').html(message + "<br>id#: " + question_id);
      		// 	$('.ask-form').hide();
			// $('.post-answer').show();
            window.location.replace("/new-questions/");
	      }
	      else {
	      	$('.question-message').html(message);
			$('.question-message').show();
			grecaptcha.reset();
			document.getElementById("btn-submit-question").disabled = true;
	      }
	    }
	  });
}
