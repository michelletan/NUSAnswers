<?php
require_once __DIR__ . '/php/lib/Toro.php';

class HomeHandler {
    function get() {
        require  __DIR__ . '/home.php';
    }
}

class APIHandler {
    function get_xhr($name) {
        require __DIR__ . '/json.php';
    }
}

Toro::serve(array(
    "/" => "HomeHandler",
    "/json/:string" => "APIHandler"
));

?>
