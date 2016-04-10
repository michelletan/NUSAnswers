<?php

function submit_comment_for_question($question_id_param, $content_param, $parent_param) {
    global $db;

    $question_id = $db->escape_string($question_id_param);
    $content = $db->escape_string($content_param);
    $profile_id = 1; // TODO get from session login

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

        $data = retrieve_comment_with_id($comment_id);
        return $data;
    } else {
        return array();
    }

}

function submit_comment_for_answer($id_param, $data) {
    global $db;

    if (!is_int($id_param)) {
        // ERROR
        $id = $db->escape_string($id_param);
    } else {
        $id = $id_param;
    }

    $query = "INSERT INTO answer_comments (content, profile_fk, answer_fk) VALUES ".
             "(". $data['content'] . ", " . $data['profile_id'] . ", " . $data['answer_id'];

    if ($data["parent"]) {
        $query = $query . ", " . $data['parent'] . ")";
    } else {
        $query = $query . ")";
    }

    $result = $db->query($query);

    return $result;
}

?>
