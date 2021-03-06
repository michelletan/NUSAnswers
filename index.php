<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/Toro.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/HTMLPurifier.standalone.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/constants.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/login_check.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/retrieval.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/fb-login.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/admin_creation.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/admin_update.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/admin_deletion.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/login_admin.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/submission.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/submission_answers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/recaptcha-master/src/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/json.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/vote.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/user_deletion.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/user_update.php';

// Reference & examples: https://github.com/anandkunal/ToroPHP
// More examples: http://www.sitepoint.com/apify-legacy-app-toro/

define('VIEW_DIRECTORY', $_SERVER['DOCUMENT_ROOT'] . '/views/');
define('API_DIRECTORY', $_SERVER['DOCUMENT_ROOT'] . '/api/');

// HTMLPurifier setup
$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);

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

class MyQuestionsHandler {
    function get() {
        $current_user_id = get_active_profile();

        $data = retrieve_questions_by_profile($current_user_id, INITIAL_NUM_QUESTIONS, 1);

        global $questions;
        $questions = $data["questions"];

        global $has_next_page;
        $has_next_page = $data["has_next_page"];

        global $page;
        $page = 1;

        require VIEW_DIRECTORY . '/home.php';
    }
}

class MyQuestionsPageHandler {
    function get($page_no) {
        $current_user_id = get_active_profile();

        $data = retrieve_questions_by_profile($current_user_id, INITIAL_NUM_QUESTIONS, $page_no);

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

class MyAnswersHandler {
    function get() {
        $current_user_id = get_active_profile();

        $data = retrieve_questions_by_answers_by_profile($current_user_id, INITIAL_NUM_QUESTIONS, 1);

        global $questions;
        $questions = $data["questions"];

        global $has_next_page;
        $has_next_page = $data["has_next_page"];

        global $page;
        $page = 1;

        require VIEW_DIRECTORY . '/home.php';
    }
}

class MyAnswersPageHandler {
    function get($page_no) {
        $current_user_id = get_active_profile();

        $data = retrieve_questions_by_answers_by_profile($current_user_id, INITIAL_NUM_QUESTIONS, $page_no);

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

        if (count($data["question"]) > 0) {
            global $question;
            $question = $data["question"];

            global $answers;
            $answers = $data["answers"];

            require VIEW_DIRECTORY . '/question.php';
        } else {
            header('Location: ' . APP_HOME_URL);
        }
    }
}

class UserProfileHandler {
    function get($id) {
        global $user;
        $user = retrieve_profile_by_id($id)[0];

        global $questions;
        $questions = retrieve_questions_by_profile_for_profile($id);
        $questions = $questions["questions"];

        // echo var_dump($questions);

        global $answers;
        $answers = retrieve_answers_by_profile($id);

        // echo var_dump($answers);

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
        if(is_logged_in()) {
            require VIEW_DIRECTORY . '/user_dashboard.php';
        } else {
            $redirect_address = "/";
            header('Location: ' . $redirect_address);
        }
    }
}

class UserViewQuestionsHandler {
    function get() {
        if(is_logged_in()) {
            require VIEW_DIRECTORY . '/user_view_questions.php';
        } else {
            $redirect_address = "/";
            header('Location: ' . $redirect_address);
        }
    }
}

class UserEditQuestionHandler {
    function get() {
        if(is_logged_in()) {
            require VIEW_DIRECTORY . '/user_edit_question.php';
        } else {
            $redirect_address = "/";
            header('Location: ' . $redirect_address);
        }
    }
}

class UserViewQuestionCommentsHandler {
    function get() {
        if(is_logged_in()) {
            require VIEW_DIRECTORY . '/user_view_question_comments.php';
        } else {
            $redirect_address = "/";
            header('Location: ' . $redirect_address);
        }
    }
}

class UserEditQuestionCommentHandler {
    function get() {
        if(is_logged_in()) {
            require VIEW_DIRECTORY . '/user_edit_question_comment.php';
        } else {
            $redirect_address = "/";
            header('Location: ' . $redirect_address);
        }
    }
}

class UserViewAnswersHandler {
    function get() {
        if(is_logged_in()) {
            require VIEW_DIRECTORY . '/user_view_answers.php';
        } else {
            $redirect_address = "/";
            header('Location: ' . $redirect_address);
        }
    }
}

class UserEditAnswerHandler {
    function get() {
        if(is_logged_in()) {
            require VIEW_DIRECTORY . '/user_edit_answer.php';
        } else {
            $redirect_address = "/";
            header('Location: ' . $redirect_address);
        }
    }
}

class UserViewAnswerCommentsHandler {
    function get() {
        if(is_logged_in()) {
            require VIEW_DIRECTORY . '/user_view_answer_comments.php';
        } else {
            $redirect_address = "/";
            header('Location: ' . $redirect_address);
        }
    }
}

class UserEditAnswerCommentHandler {
    function get() {
        if(is_logged_in()) {
            require VIEW_DIRECTORY . '/user_edit_answer_comment.php';
        } else {
            $redirect_address = "/";
            header('Location: ' . $redirect_address);
        }
    }
}

class AdminDashboardHandler {
    function get() {
        if (is_logged_in() && has_admin_rights()) {
            $answers_quantity = retrieve_answers_quantity();
            $questions_quantity = retrieve_questions_quantity();
            $users_quantity = retrieve_users_quantity();
            $upvotes_quantity = retrieve_upvotes_quantity();
            require VIEW_DIRECTORY . '/admin_dashboard.php';
        } else {
            $redirect_address = '/admin/login';
            header('Location: ' . $redirect_address);
        }
    }
}

class AdminCreateAdminAccountHandler {
    function get() {
        if (is_logged_in() && has_admin_rights()) {
            require VIEW_DIRECTORY . '/admin_create_admin_account.php';
        } else {
            $redirect_address = '/admin/login';
            header('Location: ' . $redirect_address);
        }
    }
}

class AdminViewAdminAccountsHandler {
    function get() {
        if (is_logged_in() && has_admin_rights()) {
            require VIEW_DIRECTORY . '/admin_view_admin_accounts.php';
        } else {
            $redirect_address = '/admin/login';
            header('Location: ' . $redirect_address);
        }
    }
}

class AdminEditAdminAccountsHandler {
    function get() {
        if (is_logged_in() && has_admin_rights()) {
            require VIEW_DIRECTORY . '/admin_edit_admin_account.php';
        } else {
            $redirect_address = '/admin/login';
            header('Location: ' . $redirect_address);
        }
    }
}

class AdminViewUsersHandler {
    function get() {
        if (is_logged_in() && has_admin_rights()) {
            require VIEW_DIRECTORY . '/admin_view_users.php';
        } else {
            $redirect_address = '/admin/login';
            header('Location: ' . $redirect_address);
        }
    }
}

class AdminEditUserHandler {
    function get() {
        if (is_logged_in() && has_admin_rights()) {
            require VIEW_DIRECTORY . '/admin_edit_user.php';
        } else {
            $redirect_address = '/admin/login';
            header('Location: ' . $redirect_address);
        }
    }
}

class AdminViewQuestionsHandler {
    function get() {
        if (is_logged_in() && has_admin_rights()) {
            require VIEW_DIRECTORY . '/admin_view_questions.php';
        } else {
            $redirect_address = '/admin/login';
            header('Location: ' . $redirect_address);
        }
    }
}

class AdminEditQuestionHandler {
    function get() {
        if (is_logged_in() && has_admin_rights()) {
            require VIEW_DIRECTORY . '/admin_edit_question.php';
        } else {
            $redirect_address = '/admin/login';
            header('Location: ' . $redirect_address);
        }
    }
}

class AdminViewQuestionCommentsHandler {
    function get() {
        if (is_logged_in() && has_admin_rights()) {
            require VIEW_DIRECTORY . '/admin_view_question_comments.php';
        } else {
            $redirect_address = '/admin/login';
            header('Location: ' . $redirect_address);
        }
    }
}

class AdminEditQuestionCommentHandler {
    function get() {
        if (is_logged_in() && has_admin_rights()) {
            require VIEW_DIRECTORY . '/admin_edit_question_comment.php';
        } else {
            $redirect_address = '/admin/login';
            header('Location: ' . $redirect_address);
        }
    }
}

class AdminViewAnswersHandler {
    function get() {
        if (is_logged_in() && has_admin_rights()) {
            require VIEW_DIRECTORY . '/admin_view_answers.php';
        } else {
            $redirect_address = '/admin/login';
            header('Location: ' . $redirect_address);
        }
    }
}

class AdminEditAnswerHandler {
    function get() {
        if (is_logged_in() && has_admin_rights()) {
            require VIEW_DIRECTORY . '/admin_edit_answer.php';
        } else {
            $redirect_address = '/admin/login';
            header('Location: ' . $redirect_address);
        }
    }
}

class AdminViewAnswerCommentsHandler {
    function get() {
        if (is_logged_in() && has_admin_rights()) {
            require VIEW_DIRECTORY . '/admin_view_answer_comments.php';
        } else {
            $redirect_address = '/admin/login';
            header('Location: ' . $redirect_address);
        }
    }
}

class AdminEditAnswerCommentHandler {
    function get() {
        if (is_logged_in() && has_admin_rights()) {
            require VIEW_DIRECTORY . '/admin_edit_answer_comment.php';
        } else {
            $redirect_address = '/admin/login';
            header('Location: ' . $redirect_address);
        }
    }
}

class AdminCreateTagHandler {
    function get() {
        if (is_logged_in() && has_admin_rights()) {
            require VIEW_DIRECTORY . '/admin_create_tag.php';
        } else {
            $redirect_address = '/admin/login';
            header('Location: ' . $redirect_address);
        }
    }
}

class AdminViewTagsHandler {
    function get() {
        if (is_logged_in() && has_admin_rights()) {
            require VIEW_DIRECTORY . '/admin_view_tags.php';
        } else {
            $redirect_address = '/admin/login';
            header('Location: ' . $redirect_address);
        }
    }
}

class AdminEditTagHandler {
    function get() {
        if (is_logged_in() && has_admin_rights()) {
            require VIEW_DIRECTORY . '/admin_edit_tag.php';
        } else {
            $redirect_address = '/admin/login';
            header('Location: ' . $redirect_address);
        }
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
        set_active_profile_picture($admin_info['image-url']);
        $redirect_address = '/admin-dashboard';
      }
    }
    header('Location: ' . $redirect_address);
  }
}

// Handlers for Logout API

class AdminLogoutAPIHandler {
  function get() {
    logout_active_session();
    $redirect_address = "/admin/login";
    header('Location: ' . $redirect_address);
  }
}

// Handlers for submission API

class AnswerSubmitFromQuestionAPIhandler {
  function post() {
    $redirect_address = "/question/" . $_POST['question-friendly-url'];
    $query_question_id = htmlspecialchars($_POST['question-id']);
    $query_answer_contents = htmlspecialchars($_POST['answer-content']);
    $query_result = submit_answer($query_question_id, $query_answer_contents, get_active_profile());
    header('Location: ' . $redirect_address);
  }
}

class AnswerSubmitFromHomeAPIhandler {
  function post() {
    $query_question_id = htmlspecialchars($_POST['question_id']);
    $query_answer_contents = htmlspecialchars($_POST['answer_content']);
    $query_result = submit_answer($query_question_id, $query_answer_contents, get_active_profile());
    echo $query_result ? 'true' : 'false';
  }
}

class FacebookLoginAPIHandler {
  function post() {
    facebook_login_php();
  }
}

class FacebookLogoutAPIHandler {
  function post() {
    if (get_active_role() != USER_ROLE_ADMIN) {
      logout_active_session();
    }
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
        if (isset($_POST["id"]) && isset($_POST["content"])) {
            $question_id = $_POST["id"];
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
        if (isset($_POST["id"]) && isset($_POST["content"])) {
            $answer_id = $_POST["id"];
            $content = $_POST["content"];
            $parent = isset($_POST["parent"]) ? $_POST["parent"] : null;

            $comment = submit_comment_for_answer($answer_id, $content, $parent);

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

class QuestionSubmitAPIHandler {
    function post_xhr() {
        global $purifier;

        $array_to_return = array();
        if (isset($_POST['type'])) {
            $type = $_POST['type'];
            if ($type == "question") {
                if(!isset($_POST['response'])) {
                    $array_to_return['status'] = "error";
                    $array_to_return['message'] = "Error: recaptcha not selected";
                } else if (empty($_POST['title']) || ctype_space($_POST['title'])) { // don't want unset or empty strings
                    $array_to_return['status'] = "error";
                    $array_to_return['message'] = "Error: no title";
                } else if (empty($_POST['content']) || ctype_space($_POST['content'])) {
                    $array_to_return['status'] = "error";
                    $array_to_return['message'] = "Error: no content";
                } else {
                    $secret = '6LfDtxsTAAAAAKVKX9M3CnOE7RgKfhTuAWYrhe6U';
                    $recaptcha = new \ReCaptcha\ReCaptcha($secret);
                    $resp = $recaptcha->verify($_POST['response'], $_SERVER['REMOTE_ADDR']);

                    if ($resp->isSuccess()) {
                      $tags = [];
                      if (isset($_POST['tags']) && $_POST['tags'] != "") {
                          $tags_string = $_POST['tags'];
                          $tags = explode(',', $tags_string);
                      }

                      // Sanitise content
                      $title = $purifier->purify($_POST['title']);
                      $content = $purifier->purify($_POST['content']);

                      // check if person is logged in, and get the profile id here
                      // left blank for now
                      $profile = get_active_profile() != null ? get_active_profile() : ANON_PROFILE_ID;

                      $file = isset($_POST['file']) ? $_POST['file'] : NULL;
                      $id = submit_question($title, $content, $tags, $profile, $file);
                    } else {
                      $id = false;
                    }
                    if ($id) {
                        $array_to_return['status'] = "success";
                        $array_to_return['message'] = "Question submitted successfully";
                        $array_to_return['question_id'] = $id;
                    } else {
                        $array_to_return['status'] = "error";
                        $array_to_return['message'] = "Question submission not successful";
                    }
                }
            }
            $json_to_return = json_encode($array_to_return);
            echo($json_to_return);
            exit();
        }
    }
}

class UpvoteAPIHandler {
    function post() {
        if (is_logged_in()) {
            if (isset($_POST["answer_id"])) {
                $answer_id = $_POST["answer_id"];
                echo upvote_answer($answer_id);
                http_response_code(200);
            } else {
                http_response_code(400);
            }
        } else {
            http_response_code(403);
        }
    }
}

class DownvoteAPIHandler {
    function post() {
        if (is_logged_in()) {
            if (isset($_POST["answer_id"])) {
                $answer_id = $_POST["answer_id"];
                echo downvote_answer($answer_id);
                http_response_code(200);
            } else {
                http_response_code(400);
            }
        } else {
            http_response_code(403);
        }
    }
}

class UserDashboardChartAPIHandler {
    function get() {
        echo retrieve_user_stats(get_active_profile());
    }
}

class UserQuestionEditAPIHandler {
    function post() {
        if (is_logged_in()) {
            if (isset($_POST['question-id']) && isset($_POST['title']) && isset($_POST['content'])) {
                $question_id = trim($_POST['question-id']);
                $title = htmlspecialchars(trim($_POST['title']));
                $content = htmlspecialchars(trim($_POST['content']));
                if ($question_id !== "" && $title !== "") {
                    update_user_question($question_id, $title, $content);
                }
            }
            $redirect_address = '/user-edit-question?question-id=' . $question_id;
            header('Location: ' . $redirect_address);
        }
    }
}

class UserQuestionDeletionAPIHandler {
    function post() {
        if (is_logged_in()) {
            if (isset($_POST['question-id'])) {
                foreach ($_POST['question-id'] as $question_id) {
                    delete_user_question($question_id);
                }
            }
            $redirect_address = '/user-view-questions';
            header('Location: ' . $redirect_address);
        }
    }
}

class UserQuestionCommentEditAPIHandler {
    function post() {
        if (is_logged_in()) {
            if (isset($_POST['comment-id']) && isset($_POST['content'])) {
                $comment_id = trim($_POST['comment-id']);
                $content = trim($_POST['content']);
                if ($comment_id !== "" && $content !== "") {
                    update_user_question_comment($comment_id, $content);
                }
            }
            $redirect_address = '/user-edit-question-comment?comment-id=' . $comment_id;
            header('Location: ' . $redirect_address);
        }
    }
}

class UserQuestionCommentDeletionAPIHandler {
    function post() {
        if (is_logged_in()) {
            if (isset($_POST['question-comment-id'])) {
                foreach ($_POST['question-comment-id'] as $question_comment_id) {
                    delete_question_comment($question_comment_id);
                }
            }
            $redirect_address = '/user-view-question-comments';
            header('Location: ' . $redirect_address);
        }
    }
}

class UserAnswerEditAPIHandler {
    function post() {
        if (is_logged_in()) {
            if (isset($_POST['answer-id']) && isset($_POST['content'])) {
                $answer_id = trim($_POST['answer-id']);
                $content = htmlspecialchars(trim($_POST['content']));
                if ($answer_id !== "" && $content !== "") {
                    update_user_answer($answer_id, $content);
                }
            }
            $redirect_address = '/user-edit-answer?answer-id=' . $answer_id;
            header('Location: ' . $redirect_address);
        }
    }
}

class UserAnswerDeletionAPIHandler {
    function post() {
        if (is_logged_in()) {
            if (isset($_POST['answer-id'])) {
                foreach ($_POST['answer-id'] as $answer_id) {
                    delete_user_answer($answer_id);
                }
            }
            $redirect_address = '/user-view-answers';
            header('Location: ' . $redirect_address);
        }
    }
}

class UserAnswerCommentEditAPIHandler {
    function post() {
        if (is_logged_in()) {
            if (isset($_POST['comment-id']) && isset($_POST['content'])) {
                $comment_id = trim($_POST['comment-id']);
                $content = trim($_POST['content']);
                if ($comment_id !== "" && $content !== "") {
                    update_user_answer_comment($comment_id, $content);
                }
            }
            $redirect_address = '/user-edit-answer-comment?comment-id=' . $comment_id;
            header('Location: ' . $redirect_address);
        }
    }
}

class UserAnswerCommentDeletionAPIHandler {
    function post() {
        if (is_logged_in()) {
            if (isset($_POST['answer-comment-id'])) {
                foreach ($_POST['answer-comment-id'] as $answer_comment_id) {
                    delete_user_answer_comment($answer_comment_id);
                }
            }
            $redirect_address = '/user-view-answer-comments';
            header('Location: ' . $redirect_address);
        }
    }
}


// Handlers for Admin API

class AdminCreationAPIHandler {
    function post() {
        if (is_logged_in() && has_admin_rights()) {
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
}

class AdminEditAPIHandler {
    function post() {
        if (is_logged_in() && has_admin_rights()) {
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
}

class AdminDeletionAPIHandler {
    function post() {
        if (is_logged_in() && has_admin_rights()) {
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
}

class UserDeletionAPIHandler {
    function post() {
        if (is_logged_in() && has_admin_rights()) {
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
}

class UserEditAPIHandler {
    function post() {
        if (is_logged_in() && has_admin_rights()) {
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
}

class QuestionEditAPIHandler {
    function post() {
        if (is_logged_in() && has_admin_rights()) {
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
}

class QuestionDeletionAPIHandler {
    function post() {
        if (is_logged_in() && has_admin_rights()) {
            if (isset($_POST['question-id'])) {
                foreach ($_POST['question-id'] as $question_id) {
                    delete_question($question_id);
                }
            }
            $redirect_address = '/admin-view-questions';
            header('Location: ' . $redirect_address);
        }
    }
}

class QuestionCommentEditAPIHandler {
    function post() {
        if (is_logged_in() && has_admin_rights()) {
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
}

class QuestionCommentDeletionAPIHandler {
    function post() {
        if (is_logged_in() && has_admin_rights()) {
            if (isset($_POST['question-comment-id'])) {
                foreach ($_POST['question-comment-id'] as $question_comment_id) {
                    delete_question_comment($question_comment_id);
                }
            }
            $redirect_address = '/admin-view-question-comments';
            header('Location: ' . $redirect_address);
        }
    }
}

class AnswerEditAPIHandler {
    function post() {
        if (is_logged_in() && has_admin_rights()) {
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
}

class AnswerDeletionAPIHandler {
    function post() {
        if (is_logged_in() && has_admin_rights()) {
            if (isset($_POST['answer-id'])) {
                foreach ($_POST['answer-id'] as $answer_id) {
                    delete_answer($answer_id);
                }
            }
            $redirect_address = '/admin-view-answers';
            header('Location: ' . $redirect_address);
        }
    }
}

class AnswerCommentEditAPIHandler {
    function post() {
        if (is_logged_in() && has_admin_rights()) {
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
}

class AnswerCommentDeletionAPIHandler {
    function post() {
        if (is_logged_in() && has_admin_rights()) {
            if (isset($_POST['answer-comment-id'])) {
                foreach ($_POST['answer-comment-id'] as $answer_comment_id) {
                    delete_answer_comment($answer_comment_id);
                }
            }
            $redirect_address = '/admin-view-answer-comments';
            header('Location: ' . $redirect_address);
        }
    }
}

class TagCreationAPIHandler {
    function post() {
        if (is_logged_in() && has_admin_rights()) {
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
}

class TagEditAPIHandler {
    function post() {
        if (is_logged_in() && has_admin_rights()) {
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
}

class TagDeletionAPIHandler {
    function post() {
        if (is_logged_in() && has_admin_rights()) {
            if (isset($_POST['tag-id'])) {
                foreach ($_POST['tag-id'] as $tag_id) {
                    delete_tag($tag_id);
                }
            }
            $redirect_address = '/admin-view-tags';
            header('Location: ' . $redirect_address);
        }
    }
}

// Admin API Handlers END

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

    "/my-questions" => "MyQuestionsHandler",
    "/my-questions/" => "MyQuestionsHandler",
    "/my-questions/:number" => "MyQuestionsPageHandler",

    "/popular-answers" => "PopularAnswersHandler",
    "/popular-answers/" => "PopularAnswersHandler",
    "/popular-answers/:number" => "PopularAnswersPageHandler",

    "/new-answers" => "NewAnswersHandler",
    "/new-answers/" => "NewAnswersHandler",
    "/new-answers/:number" => "NewAnswersPageHandler",

    "/my-answers" => "MyAnswersHandler",
    "/my-answers/" => "MyAnswersHandler",
    "/my-answers/:number" => "MyAnswersPageHandler",

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
    "/user-view-questions" => "UserViewQuestionsHandler",
    "/user-edit-question" => "UserEditQuestionHandler",

    "/user-view-question-comments" => "UserViewQuestionCommentsHandler",
    "/user-edit-question-comment" => "UserEditQuestionCommentHandler",

   "/user-view-answers" => "UserViewAnswersHandler",
   "/user-edit-answer" => "UserEditAnswerHandler",
   "/user-view-answer-comments" => "UserViewAnswerCommentsHandler",
   "/user-edit-answer-comment" => "UserEditAnswerCommentHandler",

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
    "/logout/admin" => "AdminLogoutAPIHandler",
    "/question/comments/:number" => "QuestionCommentAPIHandler",
    "/answer/comments/:number" => "AnswerCommentAPIHandler",

    "/login/facebook" => "FacebookLoginAPIHandler",
    "/logout/facebook" => "FacebookLogoutAPIHandler",

    "/question/comments/post" => "QuestionCommentPostAPIHandler",
    "/answer/comments/post" => "AnswerCommentPostAPIHandler",

    "/answer/submit/question" => "AnswerSubmitFromQuestionAPIhandler",
    "/answer/submit/home" => "AnswerSubmitFromHomeAPIhandler",

    "/upvote/" => "UpvoteAPIHandler",
    "/downvote/" => "DownvoteAPIHandler",

    "/user-statistics/" => "UserDashboardChartAPIHandler",
    "/user-question-deletion/" => "UserQuestionDeletionAPIHandler",
    "/user-question-edit/" => "UserQuestionEditAPIHandler",
    "/user-question-comment-deletion" => "UserQuestionCommentDeletionAPIHandler",
    "/user-question-comment-edit/" => "UserQuestionCommentEditAPIHandler",

    "/user-answer-deletion/" => "UserAnswerDeletionAPIHandler",
    "/user-answer-edit/" => "UserAnswerEditAPIHandler",
    "/user-answer-comment-deletion/" => "UserAnswerCommentDeletionAPIHandler",
    "/user-answer-comment-edit/" => "UserAnswerCommentEditAPIHandler",

    "/admin-creation/" => "AdminCreationAPIHandler",
    "/admin-edit/" => "AdminEditAPIHandler",
    "/admin-deletion/" => "AdminDeletionAPIHandler",

    "/user-deletion/" => "UserDeletionAPIHandler",
    "/user-edit/" => "UserEditAPIHandler",

    "/question-submit/" => "QuestionSubmitAPIHandler",
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
    "/tag/search/" => "TagSearchAPIHandler"
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
