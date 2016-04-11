<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/dbaccess.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/time_helper.php';

function retrieve_questions_by_user($name_param) {
    global $db;
    $name = $db->escape_string($name_param);
    
    $query = "SELECT * FROM questions q " . 
            "JOIN profiles p ON p.profile_id = q.profile_fk " . 
            "WHERE p.profile_id = '1'"; //change: WHERE p.display_name = $name

    $questions = $db->query($query);

    $return_array = array();
    while ($question = $questions->fetch_assoc()) {
        $return_array[] = $question;
    }

    return $return_array;
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


function retrieve_answers_by_user($name_param) {
    global $db;
    $name = $db->escape_string($name_param);
    
    $query = "SELECT * FROM answers a " . 
            "JOIN profiles p ON p.profile_id = a.profile_fk " . 
            "WHERE p.profile_id = '1'"; //change: WHERE p.display_name = $name

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


function retrieve_comments_for_answer_by_user($name_param) {
    global $db;
    $name = $db->escape_string($name_param);

    $query = "SELECT * FROM answer_comments ac " . 
            "JOIN profiles p ON p.profile_id = ac.profile_fk " . 
            "WHERE p.profile_id = 1"; 

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

function retrieve_question_quantity_user($name_param) {
    global $db;
    $name = $db->escape_string($name_param);

    $query = "SELECT COUNT(*) as quantity FROM questions WHERE profile_fk = 1";
    $result = $db->query($query);
    if ($row = $result->fetch_assoc()) {
        $num_rows = $row['quantity'];
    } else {
        $num_rows = 0;
    }
    return $num_rows;
}

function retrieve_answer_quantity_user($name_param) {
    global $db;
    $name = $db->escape_string($name_param);

    $query = "SELECT COUNT(*) as quantity FROM answers WHERE profile_fk = 1";
    $result = $db->query($query);
    if ($row = $result->fetch_assoc()) {
        $num_rows = $row['quantity'];
    } else {
        $num_rows = 0;
    }
    return $num_rows;
}

function retrieve_comment_quantity_user($name_param) {
    global $db;
    $name = $db->escape_string($name_param);

    $query = "SELECT COUNT(*) as quantityQues FROM question_comments WHERE profile_fk = 1";
    $result = $db->query($query);

    if ($row = $result->fetch_assoc()) {
        $num_rows = $row['quantityQues'];
    } else {
        $num_rows = 0;
    }

    $query = "SELECT COUNT(*) as quantityAns FROM answer_comments WHERE profile_fk = 1";
    $result = $db->query($query);

    if ($row = $result->fetch_assoc()) {
        $num_rows += $row['quantityAns'];
    } else {
        $num_rows += 0;
    }    
    
    return $num_rows;
}
?>