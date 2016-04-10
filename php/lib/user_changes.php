<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/dbaccess.php';

function save_changes_by_user($question_id_param, $question_title, $question_details) {
	global $db;

    $query = "UPDATE questions SET title = '" . $question_title . "', content = '" . $question_details . "' WHERE question_id = " . $question_id_param;
    $db->query($query);

    if($db->affected_rows >= 0){ 
    	return 1;
    } else {
    	return 0;
    }
}
?>