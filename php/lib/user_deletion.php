<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/dbaccess.php';

function delete_user_question($question_id_param) {
    global $db;
    $id = $db->escape_string($question_id_param);
    $query = "DELETE FROM questions WHERE question_id = " . $id . ";";
    $db->query($query); 
}
?>