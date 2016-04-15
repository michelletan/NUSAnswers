$(document).ready(function() {
    $(".post-details").linkify();
    $(".post-answer").linkify();

    $('.post-foldout').hide();

    $('.main').click(function(e) {
        if ($(e.target).hasClass("btn-view-comments")) {
            e.preventDefault();

            // Get its parent post
            var post = $(e.target).closest('.card');

            var isQuestion = !post.hasClass('answer-list-item');

            if (isFoldoutShown(post)) {
                hideFoldout(post);
            } else {
                showFoldout(post, isQuestion);
            }
        }
    });

    $(".share-buttons").each(function () {
        // e.preventDefault();
        var post = $(this).closest(".card");
        initShareButton(post);
    });
});

function initShareButton(target) {
    console.log("init");
    var postId = target.find(".card").attr("id");
    var postUrl = target.find(".post-title a").attr("href");
    var postTitle = target.find(".post-title a").text();
    var postContent = target.find(".post-question-content").text();

    target.find(".share-buttons").jsSocials({
        shareIn: "popup",
        showCount: false,
        showLabel: false,
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

function isFoldoutShown(parent) {
    return parent.hasClass('foldout-shown');
}

function showFoldout(post, isQuestion) {
    post.removeClass('foldout-hidden');
    post.addClass('foldout-shown');

    var postId = post.attr('id');

    var foldout = post.next('.post-foldout');
    foldout.show();

    // Retrieve comments
    $.ajax({
      url: "/api/" + (isQuestion ? 'question' : 'answer') + "/comments/" + postId,
      contentType: "application/json",
      method: "GET"
    }).done(function(data) {
        // Show comments
        populateFoldout(foldout, data, postId, isQuestion);
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

function populateFoldout(foldout, data, postId, isQuestion) {
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
                url: '/api/' + (isQuestion ? 'question' : 'answer') +'/comments/post',
                data: {
                    id: postId,
                    content: commentJSON.content,
                    parent: commentJSON.parent
                },
                success: function(comment) {
                    console.log(comment);
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
