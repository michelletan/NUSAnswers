<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/dbaccess.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/time_helper.php';

function myinterface() {
  if (isset($_GET['post_type']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($_GET['post_type'] == "question") {
      $result = retrieve_question_without_answer($id);
    }
    else if ($_GET['post_type'] == "question-with-answers") {
      $result = retrieve_question_with_answer($id);
    }
    else if ($_GET['post_type'] == "answer") {
      $result = retrieve_answer($id);
    }
    $result['status'] = "success";
    echo(json_encode($result));
  }
  else {
    $result = array();
    $result['status'] = "error";
    echo(json_encode($result));
  }
}

// METHODS FOR TAGS

function retrieve_tag_names($limit_param) {
    global $db;

    if (!is_int($limit_param)) {
        // ERROR
        $limit = $db->escape_string($limit_param);
    } else {
        $limit = $limit_param;
    }

    $query = "SELECT tag_name FROM tags LIMIT ". $limit;

    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        return $rows;
    }
}

// METHODS FOR QUESTIONS

function retrieve_questions_by_views($limit_param) {
    global $db;

    if (!is_int($limit_param)) {
        // ERROR
        $limit = $db->escape_string($limit_param);
    } else {
        $limit = $limit_param;
    }

    $query = "SELECT q.question_id as question_id, ".
            "q.title as question_title, ".
            "q.content as question_content, ".
            "q.comments as question_comment_count, ".
            "q.created_timestamp as question_timestamp, ".
            "q.friendly_url as question_friendly_url, ".
            "a.answer_id as answer_id, ".
            "a.content as answer_content, ".
            "a.votes as answer_vote_count, ".
            "a.comments as answer_comment_count, ".
            "a.created_timestamp as answer_timestamp, ".
            "p.profile_id as answer_user_id,".
            "p.display_name as answer_user_name, ".
            "p2.profile_id as question_user_id,".
            "p2.display_name as question_user_name, ".
            "GROUP_CONCAT(t.tag_name) as tags ".
            "FROM (SELECT * FROM questions ORDER BY views DESC) q ".
            "LEFT JOIN answers a ON a.question_fk = q.question_id " .
            "LEFT JOIN profiles p ON a.profile_fk = p.profile_id " .
            "LEFT JOIN profiles p2 ON q.profile_fk = p2.profile_id " .
            "LEFT JOIN has_tags ht ON ht.question_fk = q.question_id " .
            "LEFT JOIN tags t ON t.tag_id = ht.tag_fk ".
            "GROUP BY q.question_id ".
            "ORDER BY q.views DESC ".
            "LIMIT " . $limit ;

    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        $questions = process_result_into_question_with_answer($rows);

        return $questions;
    }
}

function retrieve_questions_by_latest($limit_param) {
    global $db;

    if (!is_int($limit_param)) {
        // ERROR
        $limit = $db->escape_string($limit_param);
    } else {
        $limit = $limit_param;
    }

    $query = "SELECT q.question_id as question_id, ".
            "q.title as question_title, ".
            "q.content as question_content, ".
            "q.comments as question_comment_count, ".
            "q.created_timestamp as question_timestamp, ".
            "q.friendly_url as question_friendly_url, ".
            "a.answer_id as answer_id, ".
            "a.content as answer_content, ".
            "a.votes as answer_vote_count, ".
            "a.comments as answer_comment_count, ".
            "a.created_timestamp as answer_timestamp, ".
            "p.profile_id as answer_user_id,".
            "p.display_name as answer_user_name, ".
            "p2.profile_id as question_user_id,".
            "p2.display_name as question_user_name, ".
            "GROUP_CONCAT(t.tag_name) as tags ".
            "FROM (SELECT * FROM questions ORDER BY question_id DESC) q ".
            "LEFT JOIN answers a ON a.question_fk = q.question_id " .
            "LEFT JOIN profiles p ON a.profile_fk = p.profile_id " .
            "LEFT JOIN profiles p2 ON q.profile_fk = p2.profile_id " .
            "LEFT JOIN has_tags ht ON ht.question_fk = q.question_id " .
            "LEFT JOIN tags t ON t.tag_id = ht.tag_fk ".
            "GROUP BY q.question_id ".
            "ORDER BY q.question_id DESC ".
            "LIMIT " . $limit ;

    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        $questions = process_result_into_question_with_answer($rows);

        return $questions;
    }
}

function retrieve_questions_with_popular_answers($limit_param) {
    global $db;

    if (!is_int($limit_param)) {
        // ERROR
        $limit = $db->escape_string($limit_param);
    } else {
        $limit = $limit_param;
    }

    $query = "SELECT q.question_id as question_id, ".
            "q.title as question_title, ".
            "q.content as question_content, ".
            "q.comments as question_comment_count, ".
            "q.created_timestamp as question_timestamp, ".
            "q.friendly_url as question_friendly_url, ".
            "a.answer_id as answer_id, ".
            "a.content as answer_content, ".
            "a.votes as answer_vote_count, ".
            "a.comments as answer_comment_count, ".
            "a.created_timestamp as answer_timestamp, ".
            "p.profile_id as answer_user_id,".
            "p.display_name as answer_user_name, ".
            "p2.profile_id as question_user_id,".
            "p2.display_name as question_user_name, ".
            "GROUP_CONCAT(t.tag_name) as tags ".
            "FROM questions q ".
            "LEFT JOIN (SELECT DISTINCT * FROM answers ORDER BY votes DESC) a ".
            "ON a.question_fk = q.question_id " .
            "LEFT JOIN profiles p ON a.profile_fk = p.profile_id " .
            "LEFT JOIN profiles p2 ON q.profile_fk = p2.profile_id " .
            "LEFT JOIN has_tags ht ON ht.question_fk = q.question_id " .
            "LEFT JOIN tags t ON t.tag_id = ht.tag_fk ".
            "WHERE answer_id is NOT NULL ".
            "GROUP BY q.question_id ".
            "ORDER BY a.votes DESC ".
            "LIMIT " . $limit ;

    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        $questions = process_result_into_question_with_answer($rows);

        return $questions;
    }
}

function retrieve_questions_with_recent_answers($limit_param) {
    global $db;

    if (!is_int($limit_param)) {
        // ERROR
        $limit = $db->escape_string($limit_param);
    } else {
        $limit = $limit_param;
    }

    $query = "SELECT q.question_id as question_id, ".
            "q.title as question_title, ".
            "q.content as question_content, ".
            "q.comments as question_comment_count, ".
            "q.created_timestamp as question_timestamp, ".
            "q.friendly_url as question_friendly_url, ".
            "a.answer_id as answer_id, ".
            "a.content as answer_content, ".
            "a.votes as answer_vote_count, ".
            "a.comments as answer_comment_count, ".
            "a.created_timestamp as answer_timestamp, ".
            "p.profile_id as answer_user_id,".
            "p.display_name as answer_user_name, ".
            "p2.profile_id as question_user_id,".
            "p2.display_name as question_user_name, ".
            "GROUP_CONCAT(t.tag_name) as tags ".
            "FROM questions q ".
            "LEFT JOIN (SELECT DISTINCT * FROM answers ORDER BY answer_id DESC) a ".
            "ON a.question_fk = q.question_id " .
            "LEFT JOIN profiles p ON a.profile_fk = p.profile_id " .
            "LEFT JOIN profiles p2 ON q.profile_fk = p2.profile_id " .
            "LEFT JOIN has_tags ht ON ht.question_fk = q.question_id " .
            "LEFT JOIN tags t ON t.tag_id = ht.tag_fk ".
            "WHERE answer_id is NOT NULL ".
            "GROUP BY q.question_id ".
            "ORDER BY a.answer_id DESC ".
            "LIMIT " . $limit ;

    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        $questions = process_result_into_question_with_answer($rows);

        return $questions;
    }
}

function retrieve_questions_with_tag($tag_param, $limit_param) {
    global $db;

    if (!is_int($limit_param)) {
        // ERROR
        $limit = $db->escape_string($limit_param);
    } else {
        $limit = $limit_param;
    }
    $tag = $db->escape_string($tag_param);

    $query = "SELECT q.question_id as question_id, ".
            "q.title as question_title, ".
            "q.content as question_content, ".
            "q.comments as question_comment_count, ".
            "q.created_timestamp as question_timestamp, ".
            "q.friendly_url as question_friendly_url, ".
            "a.answer_id as answer_id, ".
            "a.content as answer_content, ".
            "a.votes as answer_vote_count, ".
            "a.comments as answer_comment_count, ".
            "a.created_timestamp as answer_timestamp, ".
            "p.profile_id as answer_user_id,".
            "p.display_name as answer_user_name, ".
            "p2.profile_id as question_user_id,".
            "p2.display_name as question_user_name, ".
            "GROUP_CONCAT(t.tag_name) as tags ".
            "FROM (SELECT * FROM questions ORDER BY views DESC) q ".
            "LEFT JOIN answers a ON a.question_fk = q.question_id " .
            "LEFT JOIN profiles p ON a.profile_fk = p.profile_id " .
            "LEFT JOIN profiles p2 ON q.profile_fk = p2.profile_id " .
            "LEFT JOIN has_tags ht ON ht.question_fk = q.question_id " .
            "LEFT JOIN tags t ON t.tag_id = ht.tag_fk ".
            "GROUP BY a.answer_id ".
            "HAVING tags LIKE '%". $tag ."%' ".
            "ORDER BY q.views DESC ".
            "LIMIT " . $limit ;

    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        $questions = process_result_into_question_with_answer($rows);

        return $questions;
    }
}

function retrieve_questions_for_answer_page($limit_param) {
    global $db;

    if (!is_int($limit_param)) {
        // ERROR
        $limit = $db->escape_string($limit_param);
    } else {
        $limit = $limit_param;
    }

    $query = "SELECT q.question_id as question_id, ".
            "q.title as question_title, ".
            "q.content as question_content, ".
            "q.comments as question_comment_count, ".
            "q.created_timestamp as question_timestamp, ".
            "q.friendly_url as question_friendly_url, ".
            "a.answer_id as answer_id, ".
            "a.content as answer_content, ".
            "a.votes as answer_vote_count, ".
            "a.comments as answer_comment_count, ".
            "a.created_timestamp as answer_timestamp, ".
            "p.profile_id as answer_user_id,".
            "p.display_name as answer_user_name, ".
            "p2.profile_id as question_user_id,".
            "p2.display_name as question_user_name, ".
            "GROUP_CONCAT(t.tag_name) as tags ".
            "FROM (SELECT * FROM questions ORDER BY question_id DESC) q ".
            "LEFT JOIN answers a ON a.question_fk = q.question_id " .
            "LEFT JOIN profiles p ON a.profile_fk = p.profile_id " .
            "LEFT JOIN profiles p2 ON q.profile_fk = p2.profile_id " .
            "LEFT JOIN has_tags ht ON ht.question_fk = q.question_id " .
            "LEFT JOIN tags t ON t.tag_id = ht.tag_fk ".
            "WHERE answer_id is NULL ".
            "GROUP BY q.question_id ".
            "ORDER BY q.question_id DESC ".
            "LIMIT " . $limit ;

    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        $questions = process_result_into_question_with_answer($rows);

        return $questions;
    }
}

function retrieve_question_with_answer($url_param) {
    global $db;

    $url = $db->escape_string($url_param);

    $query = "SELECT q.question_id as question_id, ".
            "q.title as question_title, ".
            "q.content as question_content, ".
            "q.comments as question_comment_count, ".
            "q.created_timestamp as question_timestamp, ".
            "a.answer_id as answer_id, ".
            "a.content as answer_content, ".
            "a.votes as answer_vote_count, ".
            "a.comments as answer_comment_count, ".
            "a.created_timestamp as answer_timestamp, ".
            "p.profile_id as answer_user_id,".
            "p.display_name as answer_user_name, ".
            "p2.profile_id as question_user_id,".
            "p2.display_name as question_user_name, ".
            "GROUP_CONCAT(t.tag_name) as tags ".
            "FROM (SELECT * FROM questions WHERE friendly_url = '". $url ."') q ".
            "LEFT JOIN answers a ON a.question_fk = q.question_id " .
            "LEFT JOIN profiles p ON a.profile_fk = p.profile_id " .
            "LEFT JOIN profiles p2 ON q.profile_fk = p2.profile_id " .
            "LEFT JOIN has_tags ht ON ht.question_fk = q.question_id " .
            "LEFT JOIN tags t ON t.tag_id = ht.tag_fk ".
            "GROUP BY q.question_id ".
            "ORDER BY answer_vote_count DESC";

    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $question = array();
        $answers = array();

        // Store the answers in an array
        for ($i = 0; $i < count($rows); $i++) {
            $row = $rows[$i];

            if ($question["question_id"] == null) {
                $question["question_id"] = $row["question_id"];
                $question["question_title"] = $row["question_title"];
                $question["question_content"] = $row["question_content"];
                $question["question_comment_count"] = $row["question_comment_count"];
                $question["question_user_id"] = $row["question_user_id"];
                $question["question_user_name"] = $row["question_user_name"];
                $question["question_timestamp"] = timestamp_to_relative_date($row["question_timestamp"]);
                $tags = explode(",", $row["tags"]);
                $question["tags"] = $tags;
            }

            $answer = array();
            $answer["answer_id"] = $row["answer_id"];
            $answer["answer_content"] = $row["answer_content"];
            $answer["answer_vote_count"] = $row["answer_vote_count"];
            $answer["answer_comment_count"] = $row["answer_comment_count"];
            $answer["answer_user_id"] = $row["answer_user_id"];
            $answer["answer_user_name"] = $row["answer_user_name"];
            $answer["answer_timestamp"] = timestamp_to_relative_date($row["answer_timestamp"]);

            $answers[$i] = $answer;
        }

        $question["answers"] = $answers;

        return $question;
    }
}

// METHODS FOR COMMENTS
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

// Given an array of questions joined with answer rows, returns an array of
// distinct questions with their highest voted answer.
function process_result_into_question_with_answer($rows) {
    $questions = array();

    // Retrieve only the highest voted answer for each question
    $current_question_id = null;
    $highest_votes = -1;
    $answer_count = 0;
    for ($i = 0; $i < count($rows); $i++) {
        $row = $rows[$i];

        // Null or different question id
        if ($current_question_id == null || $current_question_id != $row["question_id"]) {
            $answer_count = 0;
            $tag_count = 0;
            $current_question_id = $row["question_id"];
            $highest_votes = $row["answer_vote_count"];
            $questions[$current_question_id] = $row;
            $questions[$current_question_id]["question_timestamp"] = timestamp_to_relative_date($row["question_timestamp"]);

            $tags = explode(",", $row["tags"]);
            $questions[$current_question_id]["tags"] = $tags;
        } else {
            // Not null, same question id

            if ($highest_votes < $row["answer_vote_count"]) {
                $current_question_id = $row["question_id"];
                $highest_votes = $row["answer_vote_count"];
                $questions[$current_question_id] = $row;
                $questions[$current_question_id]["question_timestamp"] = timestamp_to_relative_date($row["question_timestamp"]);
            }

            $tags = explode(",", $row["tags"]);
            $questions[$current_question_id]["tags"] = $tags;
        }

        // Increment answer count
        if ($row["answer_id"] != null) {
            $answer_count++;
            $questions[$current_question_id]["answer_count"] = $answer_count;
        }
    }

    return $questions;
}
?>
