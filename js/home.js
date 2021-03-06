$(document).ready(function() {
    createLinksForUrlsInText();

    $('.post-foldout').hide();

    $('.main').click(function(e) {
        if ($(e.target).hasClass("btn-view-comments")) {
            e.preventDefault();

            // Get its parent post
            var post = $(e.target).closest('.card');

            if (isFoldoutShown(post)) {
                hideFoldout(post);
            } else {
                showFoldout(post);
            }
        }
    });

    $('body').on("click", ".answer-button", function (e) {
      e.preventDefault();
      // get first part of element id
      var target = e.target.id;
      var id = target.split("-")[0];
      var questionUrl = $("#" + id + "-question-friendly-url").val();
      var answerContent = $("#" + id + "-answer-text").val();
      $("#" + target).prop('disabled', true);
      handleAnswerSubmit(id, answerContent, questionUrl, target);
    });

    $(".share-buttons").each(function () {
        // e.preventDefault();
        var post = $(this).closest(".question-list-item");
        initShareButton(post);
    });

    // $('body').on("click", ".share-button", function (e) {
    //   e.preventDefault();
    //   var post = $(e.target).closest(".question-list-item");
    //   initShareButton(post);
    // });

    // Initialise infinite scrolling
    $('.main').jscroll({
        debug: true,
        loadingHtml: '<img src="/img/balls.gif" alt="Loading" /> Loading...',
        padding: 20,
        nextSelector: 'a.jscroll-next',
        contentSelector: '.question-list-item',
        pagingSelector: '.pager',
        callback: createLinksForUrlsInText
    });
});

function initShareButton(target) {
    var postUrl = target.find(".post-title a").attr("href");

    target.find(".share-buttons").jsSocials({
        shareIn: "popup",
        showCount: false,
        showLabel: false,
        url: "http://nusanswers.me" + postUrl,
        shares: [
            {
                share: "twitter",
                label: "Tweet"
            },
            {
                share: "googleplus",
                label: "Share"
            },
            {
                share: "facebook",
                label: "Share"
            }
        ]
    });
}

function createLinksForUrlsInText() {
    $(".post-details").linkify();
    $(".post-answer").linkify();
}

function isFoldoutShown(parent) {
    return parent.hasClass('foldout-shown');
}

function showFoldout(post) {
    post.removeClass('foldout-hidden');
    post.addClass('foldout-shown');

    var postId = post.attr('id');

    var foldout = post.next('.post-foldout');
    foldout.show();

    // Retrieve comments
    $.ajax({
      url: "/api/question/comments/" + postId,
      contentType: "application/json",
      method: "GET"
    }).done(function(data) {
        // Show comments
        populateFoldout(foldout, data, postId);
    });
}

function hideFoldout(post) {
    post.removeClass('foldout-shown');
    post.addClass('foldout-hidden');

    var postId = post.attr('id');

    var foldout = post.next('.post-foldout');
    foldout.hide();
}

function clearFoldout(foldout) {
    foldout.html("");
}

function populateFoldout(foldout, data, postId) {
    // Initialise comments container
    foldout.comments({
        readOnly: $("#is-logged-in").val() == "false",
        enableEditing: false,
        enableUpvoting: false,
        enableDeleting: false,
        enableAttachments: false,
        enableNavigation: false,
        profilePictureURL: $("#user-image-url").val(),
        fieldMappings: {
            id: 'comment_id',
            created: 'created_date',
            content: 'content',
            parent: 'parent',
            fullname: 'display_name',
            profilePictureURL: 'image_url'
        },
        getComments: function(success, error) {
            success(data);
        },
        postComment: function(commentJSON, success, error) {
            $.ajax({
                type: 'post',
                url: '/api/question/comments/post',
                data: {
                    id: postId,
                    content: commentJSON.content,
                    parent: commentJSON.parent
                },
                success: function(comment) {
                    success(comment);
                },
                error: error
            });
        },
        timeFormatter: function(time) {
            return moment(time).fromNow();
        }
    });
}

function handleAnswerSubmit(id, content, questionUrl, target) {
  console.log(id + " " + content);
  $.ajax({
    url: '/api/answer/submit/home',
    method: 'POST',
    data: {
      question_id: id,
      answer_content: content
    },

    success: function(data) {
      if (data == "true") {
        $("#" + target).prop('disabled', true);
        $("#" + target).after("<br>Answer submitted successfully!<br>" +
                              "<a href='/question/" + questionUrl + "' target='_blank'>Click here to view the question in a new tab</a>");

      }
      else {
        $("#" + target).prop('disabled', false);
      }
    },

    error: function() {
      $("#" + target).prop('disabled', false);
    }
  });
}
