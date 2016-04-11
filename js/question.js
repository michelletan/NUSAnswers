$(document).ready(function() {

    $('.post-foldout').hide();

    $('.btn-view-comments').click(function(e) {
        e.preventDefault();

        // Get its parent post
        var post = $(e.currentTarget).closest('.card');
        console.log(post);

        var isQuestion = !post.hasClass('answer-list-item');

        if (isFoldoutShown(post)) {
            hideFoldout(post);
        } else {
            showFoldout(post, isQuestion);
        }

    });
});

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
        enableEditing: false,
        enableUpvoting: false,
        enableDeleting: false,
        enableAttachments: false,
        enableNavigation: false,
        enableReplying: $("#is_logged_in").val(),
        profilePictureURL: '/img/profile02.png',
        fieldMappings: {
            id: 'comment_id',
            created: 'created_timestamp',
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
                    question_id: postId,
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
