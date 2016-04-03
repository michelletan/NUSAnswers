<?php
require_once 'C:/xampp/htdocs/projects/CS3226/NUSAnswers/php/lib/deletion.php';

global $db;
if (isset($_POST['tag-id'])) {
    foreach ($_POST['tag-id'] as $tag_id) {
        delete_tag($tag_id);
    }
}
$redirect_address = 'http://localhost/projects/cs3226/nusanswers/views/admin_view_tags.php';
header('Location: ' . $redirect_address);

?>