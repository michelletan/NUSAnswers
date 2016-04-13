<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/dbaccess.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/time_helper.php';

function retrieve_questions_by_user($id_param) {
    global $db;
    $profile_id = $db->escape_string($id_param);
    
    $query = "SELECT * FROM questions WHERE profile_fk = '" . $profile_id . "'"; //change: WHERE p.display_name = $name

    $questions = $db->query($query);

    $return_array = array();
    while ($question = $questions->fetch_assoc()) {
        $return_array[] = $question;
    }

    return $return_array;
}

function retrieve_question_for_user($id_param) {
    global $db;
    $question_id = $db->escape_string($id_param);

    $query = "SELECT * FROM questions WHERE question_id = '" . $question_id . "'";

    $result = $db->query($query);

    $return_array = array();
    if($row = $result->fetch_assoc()) {
        $return_array = $row;
    } 

    return $return_array;
}

function retrieve_question_comments_by_user($id_param) {
    global $db;
    $profile_id = $db->escape_string($id_param);

    $query = "SELECT * FROM question_comments WHERE profile_fk = '" . $profile_id . "'"; 

    $result = $db->query($query);

    $return_array = array();
    while ($row = $result->fetch_assoc()) {
    //        $query = "SELECT * FROM questions WHERE question_id = " . $row["question_fk"];
    //        $res = $db->query($query);

    //        while($ques = $res->fetch_assoc()) {
            $return_array[] = $row;
    //        }
    }

    return $return_array;
}

function retrieve_question_comment_for_user($id_param) {
    global $db;
    $question_comment_id = $db->escape_string($id_param);

    $query = "SELECT * FROM question_comments WHERE comment_id = '" . $question_comment_id . "'";

    $result = $db->query($query);

    $return_array = array();
    if($row = $result->fetch_assoc()) {
        $return_array = $row;
    }

    return $return_array;
}

function retrieve_answers_by_user($id_param) {
    global $db;
    $profile_id = $db->escape_string($id_param);
    
    $query = "SELECT * FROM answers WHERE profile_fk = '" . $profile_id . "'"; //change: WHERE p.display_name = $name

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


function retrieve_comments_for_answer_by_user($id_param) {
    global $db;
    $profile_id = $db->escape_string($id_param);

    $query = "SELECT * FROM answer_comments WHERE profile_fk = '" . $profile_id . "'"; 

    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        while ($row = $result->fetch_assoc()) {
            $query = "SELECT * FROM answers WHERE answer_id = '" . $row["answer_fk"] . "'";
            $res = $db->query($query);

            while($ans = $res->fetch_assoc()) {
                $query = "SELECT * FROM questions WHERE question_id = '" . $ans["question_fk"] . "'";
                $res = $db->query($query);

                while($ques = $res->fetch_assoc()) {
                    $return_array[] = array($row, $ans, $ques);
                }
            }
        }

        return $return_array;
    }
}

function retrieve_question_quantity_user($id_param) {
    global $db;
    $profile_id = $db->escape_string($id_param);

    $query = "SELECT COUNT(*) as quantity FROM questions WHERE profile_fk = '" . $profile_id . "'";
    $result = $db->query($query);
    if ($row = $result->fetch_assoc()) {
        $num_rows = $row['quantity'];
    } else {
        $num_rows = 0;
    }
    return $num_rows;
}

function retrieve_answer_quantity_user($id_param) {
    global $db;
    $profile_id = $db->escape_string($id_param);

    $query = "SELECT COUNT(*) as quantity FROM answers WHERE profile_fk = '" . $profile_id . "'";
    $result = $db->query($query);
    if ($row = $result->fetch_assoc()) {
        $num_rows = $row['quantity'];
    } else {
        $num_rows = 0;
    }
    return $num_rows;
}

function retrieve_comment_quantity_user($id_param) {
    global $db;
    $profile_id = $db->escape_string($id_param);

    $query = "SELECT COUNT(*) as quantityQues FROM question_comments WHERE profile_fk = '" . $profile_id . "'";
    $result = $db->query($query);

    if ($row = $result->fetch_assoc()) {
        $num_rows = $row['quantityQues'];
    } else {
        $num_rows = 0;
    }

    $query = "SELECT COUNT(*) as quantityAns FROM answer_comments WHERE profile_fk = '" . $profile_id . "'";
    $result = $db->query($query);

    if ($row = $result->fetch_assoc()) {
        $num_rows += $row['quantityAns'];
    } else {
        $num_rows += 0;
    }    
    
    return $num_rows;
}
?>