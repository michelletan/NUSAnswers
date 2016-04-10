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
        return array();
    } else {
        $data = $result[0];
        $data["answer_count"] = count($result);
        return $data;
    }
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
             "FROM answers a, votes v " .
             "WHERE a.question_fk = " . $question_id . " " .
             "AND a.answer_id = v.answer_fk " .
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

?>
