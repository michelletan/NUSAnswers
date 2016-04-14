<?php

function submit_comment_for_question($question_id_param, $content_param, $parent_param) {
    global $db;

    $question_id = $db->escape_string($question_id_param);
    $content = $db->escape_string($content_param);
    $profile_id = get_active_profile();

    $query = "INSERT INTO question_comments (content, profile_fk, question_fk, parent) VALUES ".
             "('". $content . "', " . $profile_id . ", " . $question_id;

    if ($parent_param) {
        $parent = $db->escape_string($parent_param);
        $query = $query . ", " . $parent . ")";
    } else {
        $query = $query . ", NULL)";
    }

    // return $query;

    $result = $db->query($query);

    if ($result) {
        $comment_id = $db->insert_id;

        $data = retrieve_question_comment_with_id($comment_id);
        return $data;
    } else {
        return array();
    }

}

function submit_comment_for_answer($answer_id_param, $content_param, $parent_param) {
    global $db;

    $answer_id = $db->escape_string($answer_id_param);
    $content = $db->escape_string($content_param);
    $profile_id = get_active_profile();

    $query = "INSERT INTO answer_comments (content, profile_fk, answer_fk, parent) VALUES ".
             "('". $content . "', " . $profile_id . ", " . $answer_id;

    if ($parent_param) {
        $parent = $db->escape_string($parent_param);
        $query = $query . ", " . $parent . ")";
    } else {
        $query = $query . ", NULL)";
    }

    // return $query;

    $result = $db->query($query);

    if ($result) {
        $comment_id = $db->insert_id;

        $data = retrieve_answer_comment_with_id($comment_id);
        return $data;
    } else {
        return array();
    }

}

?>
