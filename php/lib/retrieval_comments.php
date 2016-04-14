<?php
function retrieve_question_comment_with_id($id_param) {
    global $db;

    if (!is_int($id_param)) {
        // ERROR
        $id = $db->escape_string($id_param);
    } else {
        $id = $id_param;
    }

    $query = "SELECT * FROM question_comments qc ".
            "JOIN profiles p ON p.profile_id = qc.profile_fk ".
            "WHERE qc.comment_id = ". $id;

    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $rows = add_relative_time_to_comment($rows);
        return $rows;
    }
}

function retrieve_answer_comment_with_id($id_param) {
    global $db;

    if (!is_int($id_param)) {
        // ERROR
        $id = $db->escape_string($id_param);
    } else {
        $id = $id_param;
    }

    $query = "SELECT * FROM answer_comments ac ".
            "JOIN profiles p ON p.profile_id = ac.profile_fk ".
            "WHERE ac.comment_id = ". $id;

    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $rows = add_relative_time_to_comment($rows);
        return $rows;
    }
}

function retrieve_comment_count_for_question($id_param) {
    global $db;

    if (!is_int($id_param)) {
        // ERROR
        $id = $db->escape_string($id_param);
    } else {
        $id = $id_param;
    }

    $results = retrieve_comments_for_question($id);
    return count($results);
}

function retrieve_comment_count_for_answer($id_param) {
    global $db;

    if (!is_int($id_param)) {
        // ERROR
        $id = $db->escape_string($id_param);
    } else {
        $id = $id_param;
    }

    $results = retrieve_comments_for_answer($id);
    return count($results);
}

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
        $rows = add_relative_time_to_comments($rows);
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
        $rows = add_relative_time_to_comments($rows);
        return $rows;
    }
}

function add_relative_time_to_comment($comment) {
    $comment["created_date"] = timestamp_to_browser_locale($comment["created_timestamp"]);
    return $comment;
}

function add_relative_time_to_comments($array) {
    for ($i = 0; $i < count($array); $i++) {
        $array[$i] = add_relative_time_to_comment($array[$i]);
    }
    return $array;
}

// function retrieve_comments_with_query($query) {
//     global $db;
//
//     $result = $db->query($query);
//
//     if ($result->num_rows == 0) {
//         return array();
//     } else {
//         $comments = $result->fetch_all(MYSQLI_ASSOC);
//
//         for ($i = 0; $i < count($rows); $i++) {
//             $comment = $comments[$i];
//             // Retrieve user info
//
//             $comments[$i] = $comment;
//         }
//
//         return $comments;
//     }
// }

?>
