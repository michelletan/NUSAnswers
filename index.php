<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/Toro.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/constants.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/retrieval.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/admin_creation.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/admin_update.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/admin_deletion.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/submission.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/json.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/vote.php';

// Reference & examples: https://github.com/anandkunal/ToroPHP
// More examples: http://www.sitepoint.com/apify-legacy-app-toro/

define('VIEW_DIRECTORY', $_SERVER['DOCUMENT_ROOT'] . '/views/');
define('API_DIRECTORY', $_SERVER['DOCUMENT_ROOT'] . '/api/');

$post_data = array();
$post_data["post_title"] = "I am a new student. Bidding has commenced, but I still have not received notice whether I have passed the QET and whether I am required to allocate part of my schedule to attend compulsory English support modules. What should I do?";
$post_data["post_answer"] = "The Centre for English Language Communication (CELC) will endeavour to release the QET results before the commencement of bidding for faculty and ULR modules by new students. However, in the unforeseen event that the results are not yet available, students should proceed to bid for their faculty and ULR modules on the understanding that priority be given to CELC's English support courses (Basic English Course and English for Academic Purposes Course) if students are required to take them in the current semester when the QET results are subsequently released.";

// Handlers for HTML pages
class ComingSoonHandler {
    function get() {
        require VIEW_DIRECTORY . '/coming_soon.php';
    }
}

class PopularQuestionsHandler {
    function get() {
        $data = retrieve_questions_by_views(INITIAL_NUM_QUESTIONS, 1);

        global $questions;
        $questions = $data["questions"];

        global $has_next_page;
        $has_next_page = $data["has_next_page"];

        global $page;
        $page = 1;

        require VIEW_DIRECTORY . '/home.php';
    }
}

class PopularQuestionsPageHandler {
    function get($page_no) {
        $data = retrieve_questions_by_views(INITIAL_NUM_QUESTIONS, $page_no);

        global $questions;
        $questions = $data["questions"];

        global $has_next_page;
        $has_next_page = $data["has_next_page"];

        global $page;
        $page = $page_no;

        require VIEW_DIRECTORY . '/home.php';
    }
}

class NewQuestionsHandler {
    function get() {
        $data = retrieve_questions_by_latest(INITIAL_NUM_QUESTIONS, 1);

        global $questions;
        $questions = $data["questions"];

        global $has_next_page;
        $has_next_page = $data["has_next_page"];

        global $page;
        $page = 1;

        require VIEW_DIRECTORY . '/home.php';
    }
}

class NewQuestionsPageHandler {
    function get($page_no) {
        $data = retrieve_questions_by_latest(INITIAL_NUM_QUESTIONS, $page_no);

        global $questions;
        $questions = $data["questions"];

        global $has_next_page;
        $has_next_page = $data["has_next_page"];

        global $page;
        $page = $page_no;

        require VIEW_DIRECTORY . '/home.php';
    }
}

class PopularAnswersHandler {
    function get() {
        $data = retrieve_questions_with_popular_answers(INITIAL_NUM_QUESTIONS, 1);

        global $questions;
        $questions = $data["questions"];

        global $has_next_page;
        $has_next_page = $data["has_next_page"];

        global $page;
        $page = 1;

        require VIEW_DIRECTORY . '/home.php';
    }
}

class PopularAnswersPageHandler {
    function get($page_no) {
        $data = retrieve_questions_with_popular_answers(INITIAL_NUM_QUESTIONS, $page_no);

        global $questions;
        $questions = $data["questions"];

        global $has_next_page;
        $has_next_page = $data["has_next_page"];

        global $page;
        $page = $page_no;

        require VIEW_DIRECTORY . '/home.php';
    }
}

class NewAnswersHandler {
    function get() {
        $data = retrieve_questions_with_recent_answers(INITIAL_NUM_QUESTIONS, 1);

        global $questions;
        $questions = $data["questions"];

        global $has_next_page;
        $has_next_page = $data["has_next_page"];

        global $page;
        $page = 1;

        require VIEW_DIRECTORY . '/home.php';
    }
}

class NewAnswersPageHandler {
    function get($page_no) {
        $data = retrieve_questions_with_recent_answers(INITIAL_NUM_QUESTIONS, $page_no);

        global $questions;
        $questions = $data["questions"];

        global $has_next_page;
        $has_next_page = $data["has_next_page"];

        global $page;
        $page = $page_no;

        require VIEW_DIRECTORY . '/home.php';
    }
}

class TagHandler {
    function get($tag) {
        $data = retrieve_questions_with_tag($tag, INITIAL_NUM_QUESTIONS, 1);

        global $questions;
        $questions = $data["questions"];

        global $has_next_page;
        $has_next_page = $data["has_next_page"];

        global $page;
        $page = 1;

        require VIEW_DIRECTORY . '/home.php';
    }
}

class TagPageHandler {
    function get($tag, $page_no) {
        $data = retrieve_questions_with_tag($tag, INITIAL_NUM_QUESTIONS, $page_no);

        global $questions;
        $questions = $data["questions"];

        global $has_next_page;
        $has_next_page = $data["has_next_page"];

        global $page;
        $page = $page_no;

        require VIEW_DIRECTORY . '/home.php';
    }
}

class AskHandler {
    function get() {
        require VIEW_DIRECTORY . '/ask.php';
    }
}

class AnswerHandler {
    function get() {
        $data = retrieve_questions_without_answers(INITIAL_NUM_QUESTIONS, 1);

        global $questions;
        $questions = $data["questions"];

        global $has_next_page;
        $has_next_page = $data["has_next_page"];

        global $page;
        $page = 1;
        require VIEW_DIRECTORY . '/home.php';
    }
}

class AnswerPageHandler {
    function get($page_no) {
        $data = retrieve_questions_without_answers(INITIAL_NUM_QUESTIONS, $page_no);

        global $questions;
        $questions = $data["questions"];

        global $has_next_page;
        $has_next_page = $data["has_next_page"];

        global $page;
        $page = $page_no;

        require VIEW_DIRECTORY . '/home.php';
    }
}

class QuestionHandler {
    function get($url) {
        $data = retrieve_question_with_answers($url);

        global $question;
        $question = $data["question"];

        global $answers;
        $answers = $data["answers"];

        require VIEW_DIRECTORY . '/question.php';
    }
}

class UserProfileHandler {
    function get($id) {
        require VIEW_DIRECTORY . '/profile.php';
    }
}

class LoginHandler {
    function get() {
        require VIEW_DIRECTORY . '/login_user.php';
    }
}

class AdminLoginHandler {
    function get() {
        require VIEW_DIRECTORY . '/login_admin.php';
    }
}

class UserDashboardHandler {
    function get() {
        require VIEW_DIRECTORY . '/user_dashboard.php';
    }
}

class UserDashboardQuestionsHandler {
    function get() {
        require VIEW_DIRECTORY . '/user_question_list.php';
    }
}

class UserDashboardAnswersHandler {
    function get() {
        require VIEW_DIRECTORY . '/user_answer_list.php';
    }
}

class UserDashboardCommentsHandler {
    function get() {
        require VIEW_DIRECTORY . '/user_comment_list.php';
    }
}

class AdminDashboardHandler {
    function get() {
        require VIEW_DIRECTORY . '/admin_dashboard.php';
    }
}

class AdminCreateAdminAccountHandler {
    function get() {
        require VIEW_DIRECTORY . '/admin_create_admin_account.php';
    }
}

class AdminViewAdminAccountsHandler {
    function get() {
        require VIEW_DIRECTORY . '/admin_view_admin_accounts.php';
    }
}

class AdminEditAdminAccountsHandler {
    function get() {
        require VIEW_DIRECTORY . '/admin_edit_admin_account.php';
    }
}

class AdminViewUsersHandler {
    function get() {
        require VIEW_DIRECTORY . '/admin_view_users.php';
    }
}

class AdminEditUserHandler {
    function get() {
        require VIEW_DIRECTORY . '/admin_edit_user.php';
    }
}

class AdminViewQuestionsHandler {
    function get() {
        require VIEW_DIRECTORY . '/admin_view_questions.php';
    }
}

class AdminViewQuestionCommentsHandler {
    function get() {
        require VIEW_DIRECTORY . '/admin_view_question_comments.php';
    }
}

class AdminViewAnswersHandler {
    function get() {
        require VIEW_DIRECTORY . '/admin_view_answers.php';
    }
}

class AdminViewAnswerCommentsHandler {
    function get() {
        require VIEW_DIRECTORY . '/admin_view_answer_comments.php';
    }
}

class AdminCreateTagHandler {
    function get() {
        require VIEW_DIRECTORY . '/admin_create_tag.php';
    }
}

class AdminViewTagsHandler {
    function get() {
        require VIEW_DIRECTORY . '/admin_view_tags.php';
    }
}

class AdminEditTagHandler {
    function get() {
        require VIEW_DIRECTORY . '/admin_edit_tag.php';
    }
}

// Handlers for API

class QuestionCommentAPIHandler {
    function get_xhr($id) {
        if ($id) {
            // id was provided, return comments for that question
            $comments = retrieve_comments_for_question($id);
            return_success_response($comments);
        } else {
            // id was not provided, return error
            return_bad_request_error_response();
        }
    }
}

class AnswerCommentAPIHandler {
    function get_xhr($id) {
        if ($id) {
            // id was provided, return comments for that answer
            $comments = retrieve_comments_for_answer($id);
            return_success_response($comments);
        } else {
            // id was not provided, return error
            return_bad_request_error_response();
        }
    }
}

class UpvoteAPIHandler {
    function post() {
        if (isset($_POST["answer_id"])) {
            $answer_id = $_POST["answer_id"];
            $new_num_votes = upvote_answer($answer_id);
            echo $new_num_votes;
        }
    }
}

class DownvoteAPIHandler {
    function post() {
        if (isset($_POST["answer_id"])) {
            $answer_id = $_POST["answer_id"];
            $new_num_votes = downvote_answer($answer_id);
            echo $new_num_votes;
        }
    }
}

// Handlers for Admin API

class AdminCreationAPIHandler {
    function post() {
        // Creates an admin profile and an admin account
        if (isset($_POST['admin-id']) && isset($_POST['password1']) && isset($_POST['password2'])) {
            $admin_id = trim($_POST['admin-id']);
            $password1 = trim($_POST['password1']);
            $password2 = trim($_POST['password2']);
            if ($admin_id !== "" && $password1 !== "" && $password2 !== "" && $password1 === $password2) {
                $profile_fk = create_profile($admin_id);
                $hashed_password = crypt($password1, $password1);
                create_admin_account($admin_id, $hashed_password, $profile_fk);
            }
        }
        $redirect_address = '/admin-create-admin-account';
        header('Location: ' . $redirect_address);
    }
}

class AdminEditAPIHandler {
    function post() {
        if (isset($_POST['admin-id']) && isset($_POST['new-admin-id']) && isset($_POST['display-name'])) {
            $admin_id = trim($_POST['admin-id']);
            $new_admin_id = trim($_POST['new-admin-id']);
            $display_name = trim($_POST['display-name']);
            if ($new_admin_id !== "" && $display_name !== "") {
                if (isset($_POST['password1']) && isset($_POST['password2']) && $_POST['password1'] !== "" && $_POST['password2'] !== "") {
                    $password1 = trim($_POST['password1']);
                    $password2 = trim($_POST['password2']);
                    if ($password1 !== "" && $password2 !== "" && $password1 === $password2) {
                        $hashed_password = crypt($password1, $password1);
                        update_admin_account($admin_id, $new_admin_id, $hashed_password);
                    }
                } else {
                    $admin = retrieve_admin_account($admin_id);
                    update_admin_id($admin_id, $new_admin_id);
                }
                update_profile($admin['profile_fk'], $display_name);
            }
        }
        $redirect_address = '/admin-edit-admin-account?admin-id=' . $new_admin_id;
        header('Location: ' . $redirect_address);
    }
}

class AdminDeletionAPIHandler {
    function post() {
        // Cascades deletion to profile of admin
        if (isset($_POST['admin-id'])) {
            foreach ($_POST['admin-id'] as $admin_id) {
                $admin_account = retrieve_admin_account($admin_id);
                delete_profile($admin_account['profile_fk']);
                delete_admin_account($admin_id);
            }
        }
        $redirect_address = '/admin-view-admin-accounts';
        header('Location: ' . $redirect_address);
    }
}

class UserDeletionAPIHandler {
    function post() {
        // Cascades deletion to profile of user
        if (isset($_POST['user-id'])) {
            foreach ($_POST['user-id'] as $user_id) {
                $user = retrieve_user($user_id);
                delete_profile($user['profile_fk']);
                delete_user($user_id);
            }
        }
        $redirect_address = '/admin-view-users';
        header('Location: ' . $redirect_address);
    }
}

class UserEditAPIHandler {
    function post() {
        if (isset($_POST['user-id']) && isset($_POST['display-name'])) {
            $user_id = trim($_POST['user-id']);
            $display_name = trim($_POST['display-name']);
            if ($user_id !== "" && $display_name !== "") {
                if (isset($_POST['role'])) {
                    update_user($user_id, 1);
                } else {
                    update_user($user_id, 0);
                }
                $user = retrieve_user($user_id);
                update_profile($user['profile_fk'], $display_name);
            }
        }
        $redirect_address = '/admin-edit-user?user-id=' . $user_id;
        header('Location: ' . $redirect_address);
    }
}

class QuestionDeletionAPIHandler {
    function post() {
        if (isset($_POST['question-id'])) {
            foreach ($_POST['question-id'] as $question_id) {
                delete_question($question_id);
            }
        }
        $redirect_address = '/admin-view-questions';
        header('Location: ' . $redirect_address);
    }
}

class QuestionCommentDeletionAPIHandler {
    function post() {
        if (isset($_POST['question-comment-id'])) {
            foreach ($_POST['question-comment-id'] as $question_comment_id) {
                delete_question_comment($question_comment_id);
            }
        }
        $redirect_address = '/admin-view-question-comments';
        header('Location: ' . $redirect_address);
    }
}

class AnswerDeletionAPIHandler {
    function post() {
        if (isset($_POST['answer-id'])) {
            foreach ($_POST['answer-id'] as $answer_id) {
                delete_answer($answer_id);
            }
        }
        $redirect_address = '/admin-view-answers';
        header('Location: ' . $redirect_address);
    }
}

class AnswerCommentDeletionAPIHandler {
    function post() {
        if (isset($_POST['answer-comment-id'])) {
            foreach ($_POST['answer-comment-id'] as $answer_comment_id) {
                delete_answer_comment($answer_comment_id);
            }
        }
        $redirect_address = '/admin-view-answer-comments';
        header('Location: ' . $redirect_address);
    }
}

class TagCreationAPIHandler {
    function post() {
        if (isset($_POST['tag-name'])) {
            $tag_name = trim($_POST['tag-name']);
            if ($tag_name !== "") {
                create_tag($tag_name);
            }
        }
        $redirect_address = '/admin-create-tag';
        header('Location: ' . $redirect_address);
    }
}

class TagEditAPIHandler {
    function post() {
        if (isset($_POST['tag-name']) && isset($_POST['tag-id'])) {
            $tag_id = trim($_POST['tag-id']);
            $tag_name = trim($_POST['tag-name']);
            if ($tag_name !== "") {
                update_tag($tag_id, $tag_name);
            }
        }
        $redirect_address = '/admin-edit-tag?tag-id=' . $tag_id;
        header('Location: ' . $redirect_address);
    }
}

class TagDeletionAPIHandler {
    function post() {
        if (isset($_POST['tag-id'])) {
            foreach ($_POST['tag-id'] as $tag_id) {
                delete_tag($tag_id);
            }
        }
        $redirect_address = '/admin-view-tags';
        header('Location: ' . $redirect_address);
    }
}

$html_urls = array(
    "/" => "PopularQuestionsHandler",

    "/popular-questions" => "PopularQuestionsHandler",
    "/popular-questions/" => "PopularQuestionsHandler",
    "/popular-questions/:number" => "PopularQuestionsPageHandler",

    "/new-questions" => "NewQuestionsHandler",
    "/new-questions/" => "NewQuestionsHandler",
    "/new-questions/:number" => "NewQuestionsPageHandler",

    "/popular-answers" => "PopularAnswersHandler",
    "/popular-answers/" => "PopularAnswersHandler",
    "/popular-answers/:number" => "PopularAnswersPageHandler",

    "/new-answers" => "NewAnswersHandler",
    "/new-answers/" => "NewAnswersHandler",
    "/new-answers/:number" => "NewAnswersPageHandler",

    "/ask" => "AskHandler",
    "/ask/" => "AskHandler",

    "/answer" => "AnswerHandler",
    "/answer/" => "AnswerHandler",
    "/answer/:number" => "AnswerPageHandler",

    "/question" => "HomeHandler",
    "/question/" => "HomeHandler",
    "/question/:alpha" => "QuestionHandler",

    "/tagged/:alpha" => "TagHandler",
    "/tagged/:alpha/:number" => "TagPageHandler",

    "/user" => "HomeHandler",
    "/user/:number" => "UserProfileHandler",

    "/login" => "LoginHandler",
    "/admin/login" => "AdminLoginHandler",

    "/user-dashboard" => "UserDashboardHandler",
    "/user-questions" => "UserDashboardQuestionsHandler",
    "/user-answers" => "UserDashboardAnswersHandler",
    "/user-comments" => "UserDashboardCommentsHandler",
    "/admin-dashboard" => "AdminDashboardHandler",
    "/admin-create-admin-account" => "AdminCreateAdminAccountHandler",
    "/admin-view-admin-accounts" => "AdminViewAdminAccountsHandler",
    "/admin-edit-admin-account" => "AdminEditAdminAccountsHandler",
    "/admin-view-users" => "AdminViewUsersHandler",
    "/admin-edit-user" => "AdminEditUserHandler",
    "/admin-view-questions" => "AdminViewQuestionsHandler",
    "/admin-view-question-comments" => "AdminViewQuestionCommentsHandler",
    "/admin-view-answers" => "AdminViewAnswersHandler",
    "/admin-view-answer-comments" => "AdminViewAnswerCommentsHandler",
    "/admin-create-tag" => "AdminCreateTagHandler",
    "/admin-view-tags" => "AdminViewTagsHandler",
    "/admin-edit-tag" => "AdminEditTagHandler"
);

$json_url_prefix = "/api";

$json_base_urls = array(
    "/question/comments/:number" => "QuestionCommentAPIHandler",
    "/answer/comments/:number" => "AnswerCommentAPIHandler",
    "/upvote/" => "UpvoteAPIHandler",
    "/downvote/" => "DownvoteAPIHandler",
    "/admin-creation/" => "AdminCreationAPIHandler",
    "/admin-edit/" => "AdminEditAPIHandler",
    "/admin-deletion/" => "AdminDeletionAPIHandler",
    "/user-deletion/" => "UserDeletionAPIHandler",
    "/user-edit/" => "UserEditAPIHandler",
    "/question-deletion/" => "QuestionDeletionAPIHandler",
    "/question-comment-deletion/" => "QuestionCommentDeletionAPIHandler",
    "/answer-deletion/" => "AnswerDeletionAPIHandler",
    "/answer-comment-deletion/" => "AnswerCommentDeletionAPIHandler",
    "/tag-creation/" => "TagCreationAPIHandler",
    "/tag-edit/" => "TagEditAPIHandler",
    "/tag-deletion/" => "TagDeletionAPIHandler",
);

$json_urls = generate_urls($json_base_urls, $json_url_prefix);

// For 404 page
ToroHook::add("404",  function() { require VIEW_DIRECTORY . '/404.php'; });

Toro::serve(array_merge(
    $html_urls,
    $json_urls
));

function generate_urls($old_array, $prefix) {
    // Add prefix to all indices of old array
    $new_array = array();
    foreach($old_array as $key => $value) {
        $new_array[$prefix.$key] = $value;
    }
    return $new_array;
}

?>
