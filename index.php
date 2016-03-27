<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/Toro.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/constants.php';

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

class HomeHandler {
    function get() {
        global $post_data;
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
        require VIEW_DIRECTORY . '/home.php';
    }
}

class QuestionHandler {
    function get($id) {
        // Get question data before showing question.php
        $data = array();
        $data["question_title"] = "I am a new student. Bidding has commenced, but I still have not received notice whether I have passed the QET and whether I am required to allocate part of my schedule to attend compulsory English support modules. What should I do?";
        $data["question_details"] = $data["question_title"];
        $data["question_owner"] = "Michelle Tan";

        global $post_data;

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

// Handlers for API
class SampleAPIHandler {
    function get_xhr($name) {
        require __DIR__ . '/json.php';
    }
}

class QuestionAPIHandler {
    function get_xhr($id) {
        if ($id) {
            // id was provided, return single question
        } else {
            // id was not provided, return list of questions?
        }
    }
}

$html_urls = array(
    "/" => "HomeHandler",
    "/ask" => "AskHandler",
    "/answer" => "AnswerHandler",
    "/question" => "HomeHandler",
    "/question/:number" => "QuestionHandler",
    "/user" => "HomeHandler",
    "/user/:number" => "UserProfileHandler",
    "/login" => "LoginHandler",
    "/admin/login" => "AdminLoginHandler"
);

$json_url_prefix = "/api";

$json_base_urls = array(
    "/api/question/:string" => "SampleAPIHandler",
    "/api/question/:number" => "QuestionAPIHandler"
);

$json_urls = generate_urls($json_base_urls, $json_url_prefix);

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
