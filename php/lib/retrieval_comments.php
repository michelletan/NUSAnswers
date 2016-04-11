<?php
function retrieve_comment_with_id($id_param) {
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
        return $rows;
    }
}

function retrieve_comments_for_question_by_user($name_param) {
    global $db;
    $name = $db->escape_string($name_param);

    $query = "SELECT * FROM question_comments qc " . 
            "JOIN profiles p ON p.profile_id = qc.profile_fk " . 
            "WHERE p.profile_id = 1"; 

    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        while ($row = $result->fetch_assoc()) {
            $query = "SELECT * FROM questions WHERE question_id = '" . $row["question_fk"] . "'";
            $res = $db->query($query);

            while($ques = $res->fetch_assoc()) {
                $return_array[] = array($row, $ques);
            }
        }

        return $return_array;
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
