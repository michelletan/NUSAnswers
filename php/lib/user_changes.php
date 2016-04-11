<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/dbaccess.php';

function save_question_changes_by_user($question_id_param, $question_title, $question_details) {
	global $db;

    $query = "UPDATE questions SET title = '" . $question_title . "', content = '" . $question_details . "' WHERE question_id = " . $question_id_param;
    $db->query($query);

    if($db->affected_rows >= 0){ 
    	return 1;
    } else {
    	return 0;
    }
}

function save_question_comment_changes_by_user($comment_id_param, $comment_details) {
	global $db;

    $query = "UPDATE question_comments SET content = '" . $comment_details . "' WHERE comment_id = " . $comment_id_param;
    $db->query($query);

    if($db->affected_rows >= 0){ 
    	return 1;
    } else {
    	return 0;
    }
}

function save_answer_changes_by_user($answer_id_param, $answer_details) {
    global $db;

    $query = "UPDATE answers SET content = '" . $answer_details . "' WHERE answer_id = " . $answer_id_param;
    $db->query($query);

    if($db->affected_rows >= 0){ 
        return 1;
    } else {
        return 0;
    }
}
?>