<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/dbaccess.php';

function upvote_answer($answer_id_param) {
    return vote_answer($answer_id_param, 1);
}

function downvote_answer($answer_id_param) {
    return vote_answer($answer_id_param, -1);
}

function vote_answer($answer_id, $type) {
    global $db;
    $query = "SELECT votes FROM answers WHERE answer_id = " . $answer_id;
    $result = $db->query($query);

    if ($row = $result->fetch_assoc()) {
        $num_votes_changed = $row['votes'];
        if ($type === 1) {
            $num_votes_changed = $num_votes_changed + 1;
        } else if ($type === -1) {
            $num_votes_changed = $num_votes_changed - 1;
        }
        $query = "UPDATE answers SET votes = " . $num_votes_changed . " WHERE answer_id = " . $answer_id;
        $db->query($query);
        $query = "SELECT votes FROM answers WHERE answer_id = " . $answer_id;
        $result = $db->query($query);
        if ($row = $result->fetch_assoc()) {
            $new_num_votes = $row['votes'];
            return $new_num_votes;
        };
    }
}

?>