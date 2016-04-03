$(document).ready(function() {
    $('.post-foldout').hide();

    $('[data-toggle=offcanvas]').click(function() {
        $('.row-offcanvas').toggleClass('active');
    });

    $('.btn-view-comments').click(function(e) {
        e.preventDefault();

        // Get its parent post
        var post = $(e.currentTarget).closest('.answer-list-item');
        post.addClass('foldout-shown');

        var postId = post.attr('id');

        var foldout = post.next('.post-foldout');
        foldout.show();
        // Animate
        foldout.animateCss('slideInDown');
        foldout.one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', changePosition);

        // Retrieve comments
        $.ajax({
          url: "http://localhost:8000/api/answer/comments/" + postId,
          contentType: "application/json",
          method: "GET"
        }).done(function(data) {
            // Show comments
            console.log(data);
            for (var i = 0; i < data.length; i++) {
                var commentElement = createComment(data[i]);
                foldout.append(commentElement);
            }

            var currentUser = {id: 1, name: "Admin"};

            var commentBox = createCommentBox(currentUser);
            foldout.append(commentBox);
        });


    });
});

function createComment(data) {
    var comment = $("<div class='comment row'></div>");
    var content = "<div class='col-md-2 col-lg-2'><a href='/user/"+ data["profile_id"] +"'> " + data["display_name"] + "</a></div>" +
                    "<div class='col-md-10 col-lg-10'>"+ data["content"] +"</div>";
    comment.html(content);
    return comment;
}

function createCommentBox(user) {
    var box = $("<div class='comment-box row'></div>");
    var content = "<div class='col-md-2 col-lg-2'><a href='/user/"+ user["id"] +"'> " + user["name"] + "</a></div>" +
                    "<div class='col-sm-10 col-md-10 col-lg-10'>" +
                        "<div class='input-group'>" +
                            "<input type='text' id='userComment' class='form-control input-sm chat-input' placeholder='Write your message here...' />" +
        	                "<span class='input-group-btn' onclick='addComment()'>" +
                                "<a class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-comment'></span> Add Comment</a>" +
                            "</span>" +
                        "</div>" +
                    "</div>";
    box.html(content);
    return box;
}

function changePosition(e) {
    console.log(e);
    $(e.currentTarget).show();
}

$.fn.extend({
    animateCss: function (animationName) {
        var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        $(this).addClass('animated ' + animationName).one(animationEnd, function() {
            $(this).removeClass('animated ' + animationName);
        });
    }
});
