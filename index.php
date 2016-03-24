<?php
require_once __DIR__ . '/php/lib/Toro.php';

// Reference & examples: https://github.com/anandkunal/ToroPHP
// More examples: http://www.sitepoint.com/apify-legacy-app-toro/

// Handlers for HTML pages
class HomeHandler {
    function get() {
        require  __DIR__ . '/home.php';
    }
}

class LoginHandler {
    function get() {
        require  __DIR__ . '/login_user.php';
    }
}

class AdminLoginHandler {
    function get() {
        require  __DIR__ . '/login_admin.php';
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
    "/login" => "LoginHandler",
    "/admin/login" => "AdminLoginHandler"
);

$json_url_prefix = "/api";

$json_base_urls = array(
    "/question/:string" => "SampleAPIHandler",
    "/question/:number" => "QuestionAPIHandler"
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
