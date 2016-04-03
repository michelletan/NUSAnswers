<?php
require_once 'C:/xampp/htdocs/projects/CS3226/NUSAnswers/php/lib/creation.php';

global $db;
if (isset($_POST['tag-name'])) {
    $tag_name = trim($_POST['tag-name']);
    if ($tag_name !== "") {
        create_tag($tag_name);
    }
}
$redirect_address = 'http://localhost/projects/cs3226/nusanswers/views/admin_create_tag.php';
header('Location: ' . $redirect_address);

?>