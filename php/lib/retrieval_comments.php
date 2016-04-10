<?php
function retrieve_comments_for_question($id_param) {
    global $db;

    if (!is_int($id_param)) {
        // ERROR
        $id = $db->escape_string($id_param);
    } else {
        $id = $id_param;
    }

    $query = "SELECT * FROM question_comments qc ".
            "JOIN profiles p ON p.profile_id = qc.profile_fk ".
            "WHERE qc.question_fk = ". $id;

    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        return $rows;
    }
}

function retrieve_comments_for_answer($id_param) {
    global $db;

    if (!is_int($id_param)) {
        // ERROR
        $id = $db->escape_string($id_param);
    } else {
        $id = $id_param;
    }

    $query = "SELECT * FROM answer_comments ac " .
            "JOIN profiles p ON p.profile_id = ac.profile_fk ".
            "WHERE ac.answer_fk = ". $id;

    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        return $rows;
    }
}

?>
