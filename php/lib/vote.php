<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/dbaccess.php';

function upvote_answer($answer_id_param) {
    global $db;
    $answer_id = $db->escape_string($answer_id_param); 
    return vote_answer($answer_id_param, 1);
}

function downvote_answer($answer_id_param) {
    global $db;
    $answer_id = $db->escape_string($answer_id_param);
    return vote_answer($answer_id_param, -1);
}

function vote_answer($answer_id, $type) {
    global $db;
    $change_type = 0;
    $profile_id = get_active_profile();    
    $query = "SELECT vote_type FROM votes WHERE answer_fk = " . $answer_id . " AND profile_fk = " . $profile_id;
    $result = $db->query($query);
    
    if ($row = $result->fetch_assoc()) {
        $original_type = $row['vote_type'];
        if ($original_type + $type == 0) {
            $query = "DELETE FROM votes WHERE answer_fk = " . $answer_id . " AND profile_fk = " . $profile_id;
            $change_type = $type;
        }
    } else {
        $query = "INSERT INTO votes VALUES ($profile_id, $answer_id, $type)";
        $change_type = $type;
    }
    $db->query($query);
    
    $query = "SELECT SUM(*) as num_votes FROM votes WHERE answer_fk = " . $answer_id;
    if ($row = $result->fetch_assoc()) {
        $num_votes = $row['num_votes'];
        $query = "UPDATE answers SET votes = " . $num_votes . " WHERE answer_fk = " . $answer_id;
        $db->query($query);
    }
    return $change_type;
}

?>