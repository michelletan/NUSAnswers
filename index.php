<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/Toro.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/constants.php';

// Reference & examples: https://github.com/anandkunal/ToroPHP
// More examples: http://www.sitepoint.com/apify-legacy-app-toro/

define('VIEW_DIRECTORY', $_SERVER['DOCUMENT_ROOT'] . '/views/');
define('API_DIRECTORY', $_SERVER['DOCUMENT_ROOT'] . '/api/');

// Handlers for HTML pages
class ComingSoonHandler {
    function get() {
        require VIEW_DIRECTORY . '/coming_soon.php';
    }
}

class HomeHandler {
    function get() {
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
        $data["question_title"] = "When does the gym open?";
        $data["question_details"] = "I don't know when the gym opens Help!";
        $data["question_owner"] = "Michelle Tan";

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
