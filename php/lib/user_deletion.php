<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/dbaccess.php';

function delete_user_question($question_id_param)
{
    global $db;
    $id = $db->escape_string($question_id_param);

    $query = "SELECT * FROM questions WHERE question_id = $id AND profile_fk = " . get_active_profile();

    $result = $db->query($query);

    if ($result->num_rows != 0) {
        $query = "DELETE FROM questions WHERE question_id = " . $id . ";";
        $db->query($query);
    }
}

function delete_user_question_comment($question_comment_id_param)
{
    global $db;
    $id = $db->escape_string($question_comment_id_param);

    $query = "SELECT * FROM questions WHERE question_id = $id AND profile_fk = " . get_active_profile();

    $result = $db->query($query);

    if ($result->num_rows != 0) {
        $query = "DELETE FROM question_comments WHERE comment_id = " . $id . ";";
        $db->query($query);
    }
}

function delete_user_answer($answer_id_param)
{
    global $db;
    $id    = $db->escape_string($answer_id_param);
    $query = "SELECT * FROM questions WHERE question_id = $id AND profile_fk = " . get_active_profile();

    $result = $db->query($query);

    if ($result->num_rows != 0) {
        $query = "DELETE FROM answers WHERE answer_id = " . $id . ";";
        $db->query($query);
    }
}

function delete_user_answer_comment($answer_comment_id_param)
{
    global $db;
    $id    = $db->escape_string($answer_comment_id_param);
    $query = "SELECT * FROM questions WHERE question_id = $id AND profile_fk = " . get_active_profile();

    $result = $db->query($query);

    if ($result->num_rows != 0) {
        $query = "DELETE FROM answer_comments WHERE comment_id = " . $id . ";";
        $db->query($query);
    }
}

?>
