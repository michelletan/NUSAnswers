<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/dbaccess.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/time_helper.php';

function retrieve_questions_by_user($id_param) {
    global $db;
    $profile_id = $db->escape_string($id_param);
    
    $query = "SELECT * FROM questions WHERE profile_fk = '" . $profile_id . "' ORDER BY created_timestamp DESC"; //change: WHERE p.display_name = $name

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

    $query = "SELECT * FROM question_comments WHERE profile_fk = '" . $profile_id . "' ORDER BY created_timestamp DESC"; 

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
    
    $query = "SELECT * FROM answers WHERE profile_fk = '" . $profile_id . "' ORDER BY created_timestamp DESC"; //change: WHERE p.display_name = $name

    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        while ($row = $result->fetch_assoc()) {
        //    $query = "SELECT * FROM questions WHERE question_id = '" . $row["question_fk"] . "'";
        //    $res = $db->query($query);

        //    while($ques = $res->fetch_assoc()) {
            $return_array[] = $row;
        //    }
        }

        return $return_array;
    }
}

function retrieve_answer_for_user($id_param) {
    global $db;
    $answer_id = $db->escape_string($id_param);

    $query = "SELECT * FROM answers WHERE answer_id = '" . $answer_id . "'";

    $result = $db->query($query);

    $return_array = array();
    if($row = $result->fetch_assoc()) {
        $return_array = $row;
    } 

    return $return_array;
}

function retrieve_answer_comments_by_user($id_param) {
    global $db;
    $profile_id = $db->escape_string($id_param);
    
    $query = "SELECT * FROM answer_comments WHERE profile_fk = '" . $profile_id . "' ORDER BY created_timestamp DESC"; //change: WHERE p.display_name = $name

    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        while ($row = $result->fetch_assoc()) {
        //    $query = "SELECT * FROM questions WHERE question_id = '" . $row["question_fk"] . "'";
        //    $res = $db->query($query);

        //    while($ques = $res->fetch_assoc()) {
            $return_array[] = $row;
        //    }
        }

        return $return_array;
    }
}

function retrieve_answer_comment_for_user($id_param) {
    global $db;
    $answer_comment_id = $db->escape_string($id_param);

    $query = "SELECT * FROM answer_comments WHERE comment_id = '" . $answer_comment_id . "'";

    $result = $db->query($query);

    $return_array = array();
    if($row = $result->fetch_assoc()) {
        $return_array = $row;
    }

    return $return_array;
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

function retrieve_user_stats($id_param) {
    global $db;
    $profile_id = $db->escape_string($id_param);

    $date = getdate();
    $today = $date["wday"];
    $today_date = $date["mday"];

    $questions = retrieve_questions_by_date($id_param, $today);
    $answers = retrieve_answers_by_date($id_param, $today);
    $comments = retrieve_comments_by_date($id_param, $today);

    $stats = array("questions" => $questions, "answers" => $answers, "comments" => $comments);

    return json_encode($stats);
}

function retrieve_questions_by_date($id_param, $today_date){
    global $db;
    $profile_id = $db->escape_string($id_param);

    $query = "SELECT * FROM questions WHERE (created_timestamp BETWEEN DATE_SUB(NOW(), INTERVAL " . $today_date . " DAY) AND NOW()) AND profile_fk = '" . $profile_id . "'";
    $result = $db->query($query);

    $return_array = array_fill(0, 7, 0);
    while($row = $result->fetch_assoc()) {
        $return_array[date('N', strtotime($row["created_timestamp"]))] += 1;
    }

    return $return_array;
}

function retrieve_answers_by_date($id_param, $today_date){
    global $db;
    $profile_id = $db->escape_string($id_param);

    $query = "SELECT * FROM answers WHERE (created_timestamp BETWEEN DATE_SUB(NOW(), INTERVAL " . $today_date . " DAY) AND NOW()) AND profile_fk = '" . $profile_id . "'";
    $result = $db->query($query);

    $return_array = array_fill(0, 7, 0);
    while($row = $result->fetch_assoc()) {
        $return_array[date('N', strtotime($row["created_timestamp"]))] += 1;
    }

    return $return_array;
}

function retrieve_comments_by_date($id_param, $today_date){
    global $db;
    $profile_id = $db->escape_string($id_param);

    $query = "SELECT * FROM question_comments WHERE (created_timestamp BETWEEN DATE_SUB(NOW(), INTERVAL " . $today_date . " DAY) AND NOW()) AND profile_fk = '" . $profile_id . "'";
    $result = $db->query($query);

    $return_array = array_fill(0, 7, 0);
    while($row = $result->fetch_assoc()) {
        $return_array[date('N', strtotime($row["created_timestamp"]))] += 1;
    }

    $query = "SELECT * FROM answer_comments WHERE (created_timestamp BETWEEN DATE_SUB(NOW(), INTERVAL " . $today_date . " DAY) AND NOW()) AND profile_fk = '" . $profile_id . "'";
    $result = $db->query($query);
    
    while($row = $result->fetch_assoc()) {
        $return_array[date('N', strtotime($row["created_timestamp"]))] += 1;
    }

    return $return_array;
}
    
?>