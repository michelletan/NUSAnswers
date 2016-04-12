<?php
function retrieve_highest_voted_answer_for_question($question_id_param) {
    global $db;

    if (!is_int($question_id_param)) {
        // ERROR
        $question_id = $db->escape_string($question_id_param);
    } else {
        $question_id = $question_id_param;
    }

    $result = retrieve_answers_for_question_order_by_votes($question_id);

    if (count($result) == 0) {
        $data = array();
        $data["answer_count"] = 0;
    } else {
        $data = $result[0];
        $data["answer_count"] = count($result);
    }
    return $data;
}

function retrieve_answers_for_question_order_by_votes($question_id_param) {
    global $db;

    if (!is_int($question_id_param)) {
        // ERROR
        $question_id = $db->escape_string($question_id_param);
    } else {
        $question_id = $question_id_param;
    }

    $query = "SELECT a.answer_id, a.content, a.created_timestamp, " .
             "a.profile_fk as answer_user_id, SUM(v.vote_type) as vote_count ".
             "FROM answers a LEFT JOIN votes v " .
             "ON a.answer_id = v.answer_fk " .
             "WHERE a.question_fk = " . $question_id . " " .
             "GROUP BY a.answer_id " .
             "ORDER BY vote_count DESC;";

    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        return $rows;
    }
}

function retrieve_answers_by_profile($id_param) {
    global $db;

    if (!is_int($question_id_param)) {
        // ERROR
        $id = $db->escape_string($id_param);
    } else {
        $id = $id_param;
    }

    $query = "SELECT q.*, a.answer_id FROM answers a " .
             "RIGHT JOIN questions q " .
             "ON a.question_fk = q.question_id " .
             "WHERE a.profile_fk = " . $id . " " .
             "ORDER BY a.answer_id DESC " .
             "LIMIT " . PROFILE_MAX_ANSWERS_SHOWN;

    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        return $rows;
    }
}

?>
