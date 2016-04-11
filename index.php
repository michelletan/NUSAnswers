<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/Toro.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/constants.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/login_check.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/retrieval.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/admin_creation.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/admin_update.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/admin_deletion.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/login_admin.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/submission.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/submission_answers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/json.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/vote.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/user_changes.php';

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

class SearchHandler {
    function get() {
        require VIEW_DIRECTORY . '/search.php';
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

class UserDashboardQuestionCommentsHandler {
    function get() {
        require VIEW_DIRECTORY . '/user_question_comments_list.php';
    }
}

class UserDashboardAnswersHandler {
    function get() {
        require VIEW_DIRECTORY . '/user_answer_list.php';
    }
}

/*class UserDashboardAnswerCommentsHandler {
    function get() {
        require VIEW_DIRECTORY . '/user_answer_comments_list.php';
    }
}*/

class AdminDashboardHandler {
    function get() {
        $answers_quantity = retrieve_answers_quantity();
        $questions_quantity = retrieve_questions_quantity();
        $users_quantity = retrieve_users_quantity();
        $upvotes_quantity = retrieve_upvotes_quantity();
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

class AdminEditQuestionHandler {
    function get() {
        require VIEW_DIRECTORY . '/admin_edit_question.php';
    }
}

class AdminViewQuestionCommentsHandler {
    function get() {
        require VIEW_DIRECTORY . '/admin_view_question_comments.php';
    }
}

class AdminEditQuestionCommentHandler {
    function get() {
        require VIEW_DIRECTORY . '/admin_edit_question_comment.php';
    }
}

class AdminViewAnswersHandler {
    function get() {
        require VIEW_DIRECTORY . '/admin_view_answers.php';
    }
}

class AdminEditAnswerHandler {
    function get() {
        require VIEW_DIRECTORY . '/admin_edit_answer.php';
    }
}

class AdminViewAnswerCommentsHandler {
    function get() {
        require VIEW_DIRECTORY . '/admin_view_answer_comments.php';
    }
}

class AdminEditAnswerCommentHandler {
    function get() {
        require VIEW_DIRECTORY . '/admin_edit_answer_comment.php';
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

// Handlers for Login API

class AdminLoginAPIHandler {
  function post() {
    $redirect_address = "/admin/login";
    if (isset($_POST['admin-id']) && isset($_POST['password'])) {
      $admin_info = admin_login($_POST['admin-id'], $_POST['password']);
      if ($admin_info) {
        set_active_profile($admin_info['profile-id']);
        set_active_display_name($admin_info['display-name']);
        set_active_role(USER_ROLE_ADMIN);
        $redirect_address = '/admin-dashboard';
      }
    }
    header('Location: ' . $redirect_address);
  }
}

// Handlers for submission API

class AnswerSubmitFromQuestionAPIhandler {
  function post() {
    $redirect_address = "/question/" . $_POST['question-friendly-url'];
    $query_result = submit_answer($_POST['question-id'], $_POST['answer-content'], 1);
    header('Location: ' . $redirect_address);
  }
}

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

class QuestionCommentPostAPIHandler {
    function post() {
        if (isset($_POST["question_id"]) && isset($_POST["content"])) {
            $question_id = $_POST["question_id"];
            $content = $_POST["content"];
            $parent = isset($_POST["parent"]) ? $_POST["parent"] : null;

            $comment = submit_comment_for_question($question_id, $content, $parent);

            if (count($comment) > 0) {
                return_success_response($comment[0]);
            } else {
                return_internal_server_error_response();
            }
        } else {
            return_bad_request_error_response();
        }
    }
}

class AnswerCommentPostAPIHandler {
    function post() {
        $success = submit_comment_for_answer();
        echo $success;
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

class UserSaveQuestionChangesAPIHandler {
    function post() {
        if((isset($_POST["question_id"]) && isset($_POST["question_title"])) && isset($_POST["question_details"])) {
            $question_id = htmlspecialchars($_POST["question_id"]);
            $question_title = htmlspecialchars($_POST["question_title"]);
            $question_details = htmlspecialchars($_POST["question_details"]);
            $has_saved = save_question_changes_by_user($question_id, $question_title, $question_details);
        }
    }
}

class UserDeleteQuestionAPIHandler {
    function post() {
        if(isset($_POST["question_id"])) {
            $question_id = htmlspecialchars($_POST["question_id"]);
            $has_deleted = delete_question($question_id);
        }
    }
}

class UserSaveQuestionCommentChangesAPIHandler {
    function post() {
        if(isset($_POST["comment_id"]) &&  isset($_POST["comment_content"])) {
            $comment_id = htmlspecialchars($_POST["comment_id"]);
            $comment_details = htmlspecialchars($_POST["comment_content"]);
            $has_saved = save_question_comment_changes_by_user($comment_id, $comment_details);
        }
    }
}

class UserDeleteQuestionCommentAPIHandler {
    function post() {
        if(isset($_POST["comment_id"])) {
            $comment_id = htmlspecialchars($_POST["comment_id"]);
            $has_deleted = delete_question_comment($comment_id);
        }
    }
}

class UserSaveAnswerChangesAPIHandler {
    function post() {
        if(isset($_POST["answer_id"]) &&  isset($_POST["answer_details"])) {
            $answer_id = htmlspecialchars($_POST["answer_id"]);
            $answer_details = htmlspecialchars($_POST["answer_details"]);
            $has_saved = save_answer_changes_by_user($answer_id, $answer_details);
            echo $has_saved;
        }
    }
}

class UserDeleteAnswerAPIHandler {
    function post() {
        if(isset($_POST["answer_id"])) {
            $answer_id = htmlspecialchars($_POST["answer_id"]);
            $has_deleted = delete_answer($answer_id);
        }
    }
}
// Handlers for Admin API

class AdminCreationAPIHandler {
    function post() {
        // Creates an admin profile and an admin account
        if (isset($_POST['login-id']) && isset($_POST['password1']) && isset($_POST['password2'])) {
            $login_id = htmlspecialchars(trim($_POST['login-id']));
            $password1 = trim($_POST['password1']);
            $password2 = trim($_POST['password2']);
            if ($login_id !== "" && $password1 !== "" && $password2 !== "" && $password1 === $password2) {
                $profile_fk = create_profile($login_id);
                $hashed_password = crypt($password1, $password1);
                create_admin_account($login_id, $hashed_password, $profile_fk);
            }
        }
        $redirect_address = '/admin-create-admin-account';
        header('Location: ' . $redirect_address);
    }
}

class AdminEditAPIHandler {
    function post() {
        if (isset($_POST['admin-id']) && isset($_POST['login-id']) && isset($_POST['display-name'])) {
            $admin_id = trim($_POST['admin-id']);
            $login_id = htmlspecialchars(trim($_POST['login-id']));
            $display_name = htmlspecialchars(trim($_POST['display-name']));
            if ($login_id !== "" && $display_name !== "") {
                if (isset($_POST['password1']) && isset($_POST['password2']) && $_POST['password1'] !== "" && $_POST['password2'] !== "") {
                    $password1 = trim($_POST['password1']);
                    $password2 = trim($_POST['password2']);
                    if ($password1 !== "" && $password2 !== "" && $password1 === $password2) {
                        $hashed_password = crypt($password1, $password1);
                        update_admin_account($admin_id, $login_id, $hashed_password);
                    }
                } else {
                    $admin = retrieve_admin_account($admin_id);
                    update_admin_id($admin_id, $login_id);
                }
                update_profile($admin['profile_fk'], $display_name);
            }
        }
        $redirect_address = '/admin-edit-admin-account?admin-id=' . $admin_id;
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
            $display_name = htmlspecialchars(trim($_POST['display-name']));
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

class QuestionEditAPIHandler {
    function post() {
        if (isset($_POST['question-id']) && isset($_POST['title']) && isset($_POST['content'])) {
            $question_id = trim($_POST['question-id']);
            $title = htmlspecialchars(trim($_POST['title']));
            $content = htmlspecialchars(trim($_POST['content']));
            if ($question_id !== "" && $title !== "") {
                if (isset($_POST['visible'])) {
                    update_question($question_id, $title, $content, 1);
                } else {
                    update_question($question_id, $title, $content, 0);
                }
            }
        }
        $redirect_address = '/admin-edit-question?question-id=' . $question_id;
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

class QuestionCommentEditAPIHandler {
    function post() {
        if (isset($_POST['comment-id']) && isset($_POST['content'])) {
            $comment_id = trim($_POST['comment-id']);
            $content = trim($_POST['content']);
            if ($comment_id !== "" && $content !== "") {
                update_question_comment($comment_id, $content);
            }
        }
        $redirect_address = '/admin-edit-question-comment?comment-id=' . $comment_id;
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

class AnswerEditAPIHandler {
    function post() {
        if (isset($_POST['answer-id']) && isset($_POST['content'])) {
            $answer_id = trim($_POST['answer-id']);
            $content = htmlspecialchars(trim($_POST['content']));
            if ($answer_id !== "" && $content !== "") {
                if (isset($_POST['visible'])) {
                    update_answer($answer_id, $content, 1);
                } else {
                    update_answer($answer_id, $content, 0);
                }
            }
        }
        $redirect_address = '/admin-edit-answer?answer-id=' . $answer_id;
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

class AnswerCommentEditAPIHandler {
    function post() {
        if (isset($_POST['comment-id']) && isset($_POST['content'])) {
            $comment_id = trim($_POST['comment-id']);
            $content = trim($_POST['content']);
            if ($comment_id !== "" && $content !== "") {
                update_answer_comment($comment_id, $content);
            }
        }
        $redirect_address = '/admin-edit-answer-comment?comment-id=' . $comment_id;
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
            $tag_name = htmlspecialchars(trim($_POST['tag-name']));
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
            $tag_name = htmlspecialchars(trim($_POST['tag-name']));
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

class TagSearchAPIHandler {
    function get_xhr() {
        $data = retrieve_tag_names_like_string($_GET["term"]);

        $result = array();
        for ($i = 0; $i < count($data); $i++) {
            array_push($result, $data[$i][0]);
        }

        return_success_response($result);
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

    "/search" => "SearchHandler",

    "/login" => "LoginHandler",
    "/admin/login" => "AdminLoginHandler",

    "/user-dashboard" => "UserDashboardHandler",
    "/user-questions" => "UserDashboardQuestionsHandler",
    "/user-question-comments" => "UserDashboardQuestionCommentsHandler",
    "/user-answers" => "UserDashboardAnswersHandler",
    "/user-answer-comments" => "UserDashboardAnswerCommentsHandler",
    "/admin-dashboard" => "AdminDashboardHandler",
    "/admin-create-admin-account" => "AdminCreateAdminAccountHandler",
    "/admin-view-admin-accounts" => "AdminViewAdminAccountsHandler",
    "/admin-edit-admin-account" => "AdminEditAdminAccountsHandler",

    "/admin-view-users" => "AdminViewUsersHandler",
    "/admin-edit-user" => "AdminEditUserHandler",

    "/admin-view-questions" => "AdminViewQuestionsHandler",
    "/admin-edit-question" => "AdminEditQuestionHandler",
    "/admin-view-question-comments" => "AdminViewQuestionCommentsHandler",
    "/admin-edit-question-comment" => "AdminEditQuestionCommentHandler",

    "/admin-view-answers" => "AdminViewAnswersHandler",
    "/admin-edit-answer" => "AdminEditAnswerHandler",
    "/admin-view-answer-comments" => "AdminViewAnswerCommentsHandler",
    "/admin-edit-answer-comment" => "AdminEditAnswerCommentHandler",

    "/admin-create-tag" => "AdminCreateTagHandler",
    "/admin-view-tags" => "AdminViewTagsHandler",
    "/admin-edit-tag" => "AdminEditTagHandler"
);

$json_url_prefix = "/api";

$json_base_urls = array(
    "/login/admin" => "AdminLoginAPIHandler",
    "/question/comments/:number" => "QuestionCommentAPIHandler",
    "/answer/comments/:number" => "AnswerCommentAPIHandler",

    "/question/comments/post" => "QuestionCommentPostAPIHandler",
    "/answer/comments/post" => "AnswerCommentPostAPIHandler",

    "/answer/submit/question" => "AnswerSubmitFromQuestionAPIhandler",

    "/upvote/" => "UpvoteAPIHandler",
    "/downvote/" => "DownvoteAPIHandler",

    "/admin-creation/" => "AdminCreationAPIHandler",
    "/admin-edit/" => "AdminEditAPIHandler",
    "/admin-deletion/" => "AdminDeletionAPIHandler",

    "/user-deletion/" => "UserDeletionAPIHandler",
    "/user-edit/" => "UserEditAPIHandler",

    "/question-edit/" => "QuestionEditAPIHandler",
    "/question-deletion/" => "QuestionDeletionAPIHandler",
    "/question-comment-edit/" => "QuestionCommentEditAPIHandler",
    "/question-comment-deletion/" => "QuestionCommentDeletionAPIHandler",

    "/answer-edit/" => "AnswerEditAPIHandler",
    "/answer-deletion/" => "AnswerDeletionAPIHandler",
    "/answer-comment-edit/" => "AnswerCommentEditAPIHandler",
    "/answer-comment-deletion/" => "AnswerCommentDeletionAPIHandler",

    "/tag-creation/" => "TagCreationAPIHandler",
    "/tag-edit/" => "TagEditAPIHandler",
    "/tag-deletion/" => "TagDeletionAPIHandler",
    "/tag/search/" => "TagSearchAPIHandler",

    "/user-question-edit/" => "UserSaveQuestionChangesAPIHandler",
    "/user-question-delete/" => "UserDeleteQuestionAPIHandler",
    "/user-question-comment-edit/" => "UserSaveQuestionCommentChangesAPIHandler",
    "/user-question-comment-delete/" => "UserDeleteQuestionCommentAPIHandler",
    "/user-answer-edit/" => "UserSaveAnswerChangesAPIHandler",
    "/user-answer-delete/" => "UserDeleteAnswerAPIHandler"
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
