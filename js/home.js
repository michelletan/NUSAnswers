$(document).ready(function() {
    $('.post-foldout').hide();

    $('.main').click(function(e) {
        if ($(e.target).hasClass("btn-view-comments")) {
            console.log("yea");
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

    // Initialise infinite scrolling
    $('.main').jscroll({
        debug: true,
        loadingHtml: '<img src="/img/balls.gif" alt="Loading" /> Loading...',
        padding: 20,
        nextSelector: 'a.jscroll-next',
        contentSelector: '.question-list-item',
        pagingSelector: '.pager'
    });
});

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
