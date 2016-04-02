// TODO: replace relative URLs with actual URLs used in production
//       can't do it because my computer can't see any URL other than /
//       D:
function getQuestion(id) {
  $.ajax({
    url: "../php/lib/retrieval.php",
    method: "GET",

    data: {
      post_type: "question",
      id: id
    },

    success: function(data) {
      var json = $.parseJSON(data);
      console.log(json);
      if (json['question_found']) {
        var title = json['title'];
        var content = json['content'];
        var created = json['created'];
        var answer_count = json['answer_count'];
        var comment_count = json['comment_count'];
        var profile_id = json['profile_id'];
      }
    }
  });
}

function getQuestionWithAnswer(id) {
  $.ajax({
    url: "../php/lib/retrieval.php",
    method: "GET",

    data: {
      post_type: "question-with-answers",
      id: id
    },

    success: function(data) {
      var json = $.parseJSON(data);
      console.log(json);
      if (json['question_found']) {
        var title = json['title'];
        var content = json['content'];
        var created = json['created'];
        var answer_count = json['answer_count'];
        var comment_count = json['comment_count'];
        var profile_id = json['profile_id'];
        for (var i = 0; i < json['answers'].length; i++) {
          console.log(json['answers'][i]);
          var answer_id = json['answers'][i]['answer_id'];
          var answer_content = json['answers'][i]['content'];
          var answer_created = json['answers'][i]['created'];
          var answer_votes = json['answers'][i]['votes'];
          var answer_comment_count = json['answers'][i]['comment_count'];
          var answer_profile_id = json['answers'][i]['profile_id'];
        }
      }
    }
  });
}

function getAnswer(id) {
  $.ajax({
    url: "../php/lib/retrieval.php",
    method: "GET",

    data: {
      post_type: "answer",
      id: id
    },

    success: function(data) {
      var json = $.parseJSON(data);
      console.log(json);
      if (json['answer_found']) {
        var content = json['content'];
        var vote_count = json['vote_count'];
        var comment_count = json['comment_count'];
        var profile_id = json['profile_id'];
      }
    }
  });
}
