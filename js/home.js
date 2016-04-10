$(document).ready(function() {
    $('.post-foldout').hide();

    $('.btn-view-comments').click(function(e) {
        e.preventDefault();

        // Get its parent post
        var post = $(e.currentTarget).closest('.question-list-item');

        if (isFoldoutShown(post)) {
            hideFoldout(post);
        } else {
            showFoldout(post);
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


// Code for adding popup modal
// $(document).ready(function() {
//
//
//     var formLogin = $('#login-form');
//     var formLost = $('#lost-form');
//     var formRegister = $('#register-form');
//     var divForms = $('#div-forms');
//     var modalAnimateTime = 300;
//     var msgAnimateTime = 150;
//     var msgShowTime = 2000;
//
//     $("form").submit(function () {
//         switch(this.id) {
//             case "login-form":
//                 var lg_username = $('#login_username').val();
//                 var lg_password = $('#login_password').val();
//                 if (lg_username == "ERROR") {
//                     msgChange($('#div-login-msg'), $('#icon-login-msg'), $('#text-login-msg'), "error", "glyphicon-remove", "Login error");
//                 } else {
//                     msgChange($('#div-login-msg'), $('#icon-login-msg'), $('#text-login-msg'), "success", "glyphicon-ok", "Login OK");
//                 }
//                 return false;
//                 break;
//             case "lost-form":
//                 var ls_email = $('#lost_email').val();
//                 if (ls_email == "ERROR") {
//                     msgChange($('#div-lost-msg'), $('#icon-lost-msg'), $('#text-lost-msg'), "error", "glyphicon-remove", "Send error");
//                 } else {
//                     msgChange($('#div-lost-msg'), $('#icon-lost-msg'), $('#text-lost-msg'), "success", "glyphicon-ok", "Send OK");
//                 }
//                 return false;
//                 break;
//             case "register-form":
//                 var rg_username = $('#register_username').val();
//                 var rg_email = $('#register_email').val();
//                 var rg_password = $('#register_password').val();
//                 if (rg_username == "ERROR") {
//                     msgChange($('#div-register-msg'), $('#icon-register-msg'), $('#text-register-msg'), "error", "glyphicon-remove", "Register error");
//                 } else {
//                     msgChange($('#div-register-msg'), $('#icon-register-msg'), $('#text-register-msg'), "success", "glyphicon-ok", "Register OK");
//                 }
//                 return false;
//                 break;
//             default:
//                 return false;
//         }
//         return false;
//     });
//
//     $('#login_register_btn').click( function () { modalAnimate(formLogin, formRegister) });
//     $('#register_login_btn').click( function () { modalAnimate(formRegister, formLogin); });
//     $('#login_lost_btn').click( function () { modalAnimate(formLogin, formLost); });
//     $('#lost_login_btn').click( function () { modalAnimate(formLost, formLogin); });
//     $('#lost_register_btn').click( function () { modalAnimate(formLost, formRegister); });
//     $('#register_lost_btn').click( function () { modalAnimate(formRegister, formLost); });
//
//     function modalAnimate (oldForm, newForm) {
//         var oldH = $oldForm.height();
//         var newH = $newForm.height();
//         divForms.css("height",oldH);
//         oldForm.fadeToggle(modalAnimateTime, function(){
//             divForms.animate({height: newH}, modalAnimateTime, function(){
//                 newForm.fadeToggle(modalAnimateTime);
//             });
//         });
//     }
//
//     function msgFade (msgId, msgText) {
//         msgId.fadeOut(msgAnimateTime, function() {
//             $(this).text(msgText).fadeIn(msgAnimateTime);
//         });
//     }
//
//     function msgChange(divTag, iconTag, textTag, divClass, iconClass, msgText) {
//         var msgOld = divTag.text();
//         msgFade(textTag, msgText);
//         divTag.addClass(divClass);
//         iconTag.removeClass("glyphicon-chevron-right");
//         iconTag.addClass(iconClass + " " + divClass);
//         setTimeout(function() {
//             msgFade(textTag, msgOld);
//             divTag.removeClass(divClass);
//             iconTag.addClass("glyphicon-chevron-right");
//             iconTag.removeClass(iconClass + " " + divClass);
//   		}, msgShowTime);
//     }
// });
