<?php
require_once 'C:/xampp/htdocs/projects/CS3226/NUSAnswers/php/lib/deletion.php';

global $db;
if (isset($_POST['answer-id'])) {
    foreach ($_POST['answer-id'] as $answer_id) {
        delete_answer($answer_id);
    }
}
$redirect_address = 'http://localhost/projects/cs3226/nusanswers/views/admin_view_answers.php';
header('Location: ' . $redirect_address);

?>