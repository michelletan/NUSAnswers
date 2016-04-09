<?php
require_once 'C:/xampp/htdocs/projects/CS3226/NUSAnswers/php/lib/deletion.php';

global $db;
if (isset($_POST['question-id'])) {
    foreach ($_POST['question-id'] as $question_id) {
        delete_question($question_id);
    }
}
$redirect_address = 'http://localhost/projects/cs3226/nusanswers/views/admin_view_questions.php';
header('Location: ' . $redirect_address);

?>