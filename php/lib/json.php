<?php
function return_bad_request_error_response() {
    header('HTTP/1.1 400 Bad Request');
    exit();
}

function return_internal_server_error_response() {
    header('HTTP/1.1 500 Internal Server Error');
    exit();
}

function return_success_response($i) {
    header('Content-Type: application/json');
    echo json_encode($i);
    exit();
}
?>
