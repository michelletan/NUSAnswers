<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/Toro.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/constants.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/retrieval.php';
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
        global $questions;
        $questions = retrieve_questions_with_tag($tag, INITIAL_NUM_QUESTIONS);
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
        $data = retrieve_questions_for_answer_page(INITIAL_NUM_QUESTIONS, 1);

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
        $data = retrieve_questions_for_answer_page(INITIAL_NUM_QUESTIONS, $page_no);

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
        global $data;
        $data = retrieve_question_with_answer($url);

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

$html_urls = array(
    "/" => "PopularQuestionsHandler",
    "/popular-questions/" => "PopularQuestionsHandler",
    "/popular-questions/:number" => "PopularQuestionsPageHandler",
    "/new-questions/" => "NewQuestionsHandler",
    "/new-questions/:number" => "NewQuestionsPageHandler",
    "/popular-answers/" => "PopularAnswersHandler",
    "/popular-answers/:number" => "PopularAnswersPageHandler",
    "/new-answers/" => "NewAnswersHandler",
    "/new-answers/:number" => "NewAnswersPageHandler",
    "/ask" => "AskHandler",
    "/answer/" => "AnswerHandler",
    "/answer/:number" => "AnswerPageHandler",
    "/question" => "HomeHandler",
    "/question/:alpha" => "QuestionHandler",
    "/tagged/:alpha" => "TagHandler",
    "/user" => "HomeHandler",
    "/user/:number" => "UserProfileHandler",
    "/login" => "LoginHandler",
    "/admin/login" => "AdminLoginHandler",
    "/user-dashboard" => "UserDashboardHandler",
    "/user-questions" => "UserDashboardQuestionsHandler",
    "/user-answers" => "UserDashboardAnswersHandler",
    "/user-comments" => "UserDashboardCommentsHandler"
);

$json_url_prefix = "/api";

$json_base_urls = array(
    "/question/comments/:number" => "QuestionCommentAPIHandler",
    "/answer/comments/:number" => "AnswerCommentAPIHandler",
    "/upvote/" => "UpvoteAPIHandler",
    "/downvote/" => "DownvoteAPIHandler"
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
