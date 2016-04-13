<?php

function retrieve_questions_by_views($limit_param, $page_param) {
    global $db;

    if (!is_int($limit_param)) {
        // ERROR
        $limit = $db->escape_string($limit_param);
        $param = $db->escape_string($page_param);
    } else {
        $limit = $limit_param;
        $page = $page_param;
    }

    $query = "SELECT * FROM questions ORDER BY views DESC ".
             "LIMIT " . ($limit + 1) . " OFFSET " . ($page - 1) * $limit;

    $result = retrieve_questions_with_query($query, $limit);

    return $result;
}

function retrieve_questions_by_latest($limit_param, $page_param) {
    global $db;

    if (!is_int($limit_param)) {
        // ERROR
        $limit = $db->escape_string($limit_param);
        $param = $db->escape_string($page_param);
    } else {
        $limit = $limit_param;
        $page = $page_param;
    }

    $query = "SELECT * FROM questions ORDER BY question_id DESC ".
             "LIMIT " . ($limit + 1) . " OFFSET " . ($page - 1) * $limit;

    $result = retrieve_questions_with_query($query, $limit);

    return $result;
}

function retrieve_questions_with_popular_answers($limit_param, $page_param) {
    global $db;

    if (!is_int($limit_param)) {
        // ERROR
        $limit = $db->escape_string($limit_param);
        $param = $db->escape_string($page_param);
    } else {
        $limit = $limit_param;
        $page = $page_param;
    }

    $query = "SELECT DISTINCT q.question_id, q.*, a.answer_id, SUM(v.vote_type) AS vote_count ".
             "FROM questions q, answers a, votes v " .
             "WHERE q.question_id = a.question_fk " .
             "AND a.answer_id = v.answer_fk " .
             "GROUP BY q.question_id " .
             "ORDER BY vote_count DESC ".
             "LIMIT " . ($limit + 1) . " OFFSET " . ($page - 1) * $limit;

    $result = retrieve_questions_with_query($query, $limit);

    return $result;
}

function retrieve_questions_with_recent_answers($limit_param, $page_param) {
    global $db;

    if (!is_int($limit_param)) {
        // ERROR
        $limit = $db->escape_string($limit_param);
        $param = $db->escape_string($page_param);
    } else {
        $limit = $limit_param;
        $page = $page_param;
    }

    $query = "SELECT * FROM questions q " .
             "INNER JOIN (SELECT * FROM answers ORDER BY answer_id DESC) a ".
             "ON q.question_id = a.question_fk " .
             "WHERE a.answer_id IS NOT NULL " .
             "LIMIT " . ($limit + 1) . " OFFSET " . ($page - 1) * $limit;

    $result = retrieve_questions_with_query($query, $limit);

    return $result;
}

function retrieve_questions_with_tag($tag_param, $limit_param, $page_param) {
    global $db;

    if (!is_int($limit_param)) {
        // ERROR
        $limit = $db->escape_string($limit_param);
        $page = $db->escape_string($page_param);
    } else {
        $limit = $limit_param;
        $page = $page_param;
    }
    $tag = $db->escape_string($tag_param);

    $query = "SELECT q.* FROM questions q, tags t, has_tags ht " .
             "WHERE q.question_id = ht.question_fk " .
             "AND t.tag_id = ht.tag_fk " .
             "AND t.tag_name = '" . $tag . "' " .
             "ORDER BY q.question_id DESC ".
             "LIMIT " . ($limit + 1) . " OFFSET " . ($page - 1) * $limit;

    $result = retrieve_questions_with_query($query, $limit);

    return $result;
}

function retrieve_questions_without_answers($limit_param, $page_param) {
    global $db;

    if (!is_int($limit_param)) {
        // ERROR
        $limit = $db->escape_string($limit_param);
        $param = $db->escape_string($page_param);
    } else {
        $limit = $limit_param;
        $page = $page_param;
    }

    $query = "SELECT q.* FROM questions q " .
             "LEFT JOIN answers a ON q.question_id = a.question_fk " .
             "WHERE a.answer_id IS NULL " .
             "ORDER BY q.question_id DESC ".
             "LIMIT " . ($limit + 1) . " OFFSET " . ($page - 1) * $limit;

    $result = retrieve_questions_with_query($query, $limit);

    return $result;
}

function retrieve_question_with_answers($url_param) {
    global $db;

    $url = $db->escape_string($url_param);

    $query = "SELECT * FROM questions WHERE friendly_url = '". $url ."'";

    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        $data = retrieve_answers_tags_users_for_question($rows[0]);

        return $data;
    }
}

function retrieve_questions_by_profile($id_param, $limit_param, $page_param) {
    global $db;

    if (!is_int($id_param)) {
        // ERROR
        $id = $db->escape_string($id_param);
    } else {
        $id = $id_param;
    }

    if (!is_int($limit_param)) {
        // ERROR
        $limit = $db->escape_string($limit_param);
        $param = $db->escape_string($page_param);
    } else {
        $limit = $limit_param;
        $page = $page_param;
    }

    $query = "SELECT * FROM questions q " .
             "WHERE q.profile_fk = $id " .
             "ORDER BY q.question_id DESC ".
             "LIMIT " . ($limit + 1) . " OFFSET " . ($page - 1) * $limit;

    $result = retrieve_questions_with_query($query, $limit);

    return $result;
}

function retrieve_questions_by_answers_by_profile($id_param, $limit_param, $page_param) {
    global $db;

    if (!is_int($id_param)) {
        // ERROR
        $id = $db->escape_string($id_param);
    } else {
        $id = $id_param;
    }

    if (!is_int($limit_param)) {
        // ERROR
        $limit = $db->escape_string($limit_param);
        $param = $db->escape_string($page_param);
    } else {
        $limit = $limit_param;
        $page = $page_param;
    }

    $query = "SELECT q.* FROM questions q " .
             "LEFT JOIN answers a ON q.question_id = a.question_fk " .
             "WHERE a.profile_fk = $id " .
             "ORDER BY q.question_id DESC ".
             "LIMIT " . ($limit + 1) . " OFFSET " . ($page - 1) * $limit;

    $result = retrieve_questions_with_query($query, $limit);

    return $result;
}

function retrieve_questions_by_profile_for_profile($id_param) {
    global $db;

    if (!is_int($id_param)) {
        // ERROR
        $id = $db->escape_string($id_param);
    } else {
        $id = $id_param;
    }

    $query = "SELECT * FROM questions " .
             "WHERE profile_fk = $id ".
             "ORDER BY question_id DESC ".
             "LIMIT " . PROFILE_MAX_QUESTIONS_SHOWN;

    $result = retrieve_questions_with_query($query, $limit);

    return $result;
}

function retrieve_questions_with_query($query, $limit) {
    global $db;

    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        $return_result = array();

        // For pagination, check if there is a next page
        if ($result->num_rows > $limit) {
            // Remove the extra result from the return
            array_pop($rows);
            $return_result["has_next_page"] = true;
        } else {
            $return_result["has_next_page"] = false;
        }

        $questions = array();

        for ($i = 0; $i < count($rows); $i++) {
            $question_row = $rows[$i];
            $data = retrieve_best_answer_tags_users_for_question($question_row);
            array_push($questions, $data);
        }

        $return_result["questions"] = $questions;

        return $return_result;
    }
}

function retrieve_best_answer_tags_users_for_question($question_row) {
    $question = $question_row;
    $data = array();
    $question_id = $question_row["question_id"];

    // Retrieve answers, tags, user profiles
    $answer = retrieve_highest_voted_answer_for_question($question_id);
    $tags = retrieve_tags_for_question($question_id);
    $comment_count = retrieve_comment_count_for_question($question_id);
    $question_user = retrieve_profile_by_id($question["profile_fk"]);

    if ($answer["answer_count"] > 0) {
        $answer_user = retrieve_profile_by_id($answer["answer_user_id"]);

        if (count($answer_user) > 0) {
            $answer["user"] = $answer_user[0];
        }
    }

    if (count($question_user) > 0) {
        $question["user"] = $question_user[0];
    }

    // Add answer count to question
    $question["answer_count"] = $answer["answer_count"];

    // Add comment count to question
    $question["comment_count"] = $comment_count;

    // Change timestamp to relative one
    $question["created_date"] = timestamp_to_relative_date($question["created_timestamp"]);

    $data["question"] = $question;
    $data["answer"] = $answer;
    $data["tags"] = $tags;

    return $data;
}

function retrieve_answers_tags_users_for_question($question_row) {
    $question = $question_row;
    $data = array();
    $question_id = $question_row["question_id"];

    // Retrieve answers, tags, user profiles
    $answers = retrieve_answers_for_question_order_by_votes($question_id);
    $tags = retrieve_tags_for_question($question_id);
    $comment_count = retrieve_comment_count_for_question($question_id);
    $question_user = retrieve_profile_by_id($question["profile_fk"]);

    // Retrieve profiles for each answer and question
    for ($i = 0; $i < count($answers); $i++) {
        $answer = $answers[$i];

        $answer["created_date"] = timestamp_to_relative_date($answer["created_timestamp"]);
        $answer_user = retrieve_profile_by_id($answer["answer_user_id"]);
        $comment_count = retrieve_comment_count_for_answer($answer["answer_id"]);
        $answer["user"] = $answer_user[0];
        $answer["comment_count"] = $comment_count;

        $answers[$i] = $answer;
    }

    if (count($question_user) > 0) {
        $question["user"] = $question_user[0];
    }

    // Add answer count to question
    $question["answer_count"] = $answer["answer_count"];

    // Add comment count to question
    $question["comment_count"] = $comment_count;

    // Change timestamp to relative one
    $question["created_date"] = timestamp_to_relative_date($question["created_timestamp"]);

    $data["question"] = $question;
    $data["answers"] = $answers;
    $data["tags"] = $tags;

    return $data;
}

?>
