<?php
require_once 'C:/xampp/htdocs/projects/CS3226/NUSAnswers/php/lib/update.php';

global $db;
if (isset($_POST['tag-name']) && isset($_POST['tag-id'])) {
    $tag_id = trim($_POST['tag-id']);
    $tag_name = trim($_POST['tag-name']);
    if ($tag_name !== "") {
        update_tag($tag_id, $tag_name);
    }
}
$redirect_address = 'http://localhost/projects/cs3226/nusanswers/views/admin_edit_tag.php?tag-id=' . $tag_id;
header('Location: ' . $redirect_address);

?>