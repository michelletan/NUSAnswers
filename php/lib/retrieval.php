<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/dbaccess.php';

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
            "a.answer_id as answer_id, ".
            "a.content as answer_content, ".
            "a.votes as answer_vote_count, ".
            "a.comments as answer_comment_count, ".
            "p.profile_id as answer_user_id,".
            "p.display_name as answer_user_name ".
            "FROM (SELECT * FROM questions LIMIT " . $limit.") q ".
            "LEFT JOIN answers a ON a.question_fk = q.question_id " .
            "LEFT JOIN profiles p ON a.profile_fk = p.profile_id " .
            "ORDER BY question_id";
    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $questions = array();

        // Retrieve only the highest voted answer for each question
        $current_question_id = null;
        $highest_votes = -1;
        $answer_count = 0;
        for ($i = 0; $i < count($rows); $i++) {
            $row = $rows[$i];

            if ($current_question_id == null || $current_question_id != $row["question_id"] || $highest_votes < $row["answer_vote_count"]) {
                $answer_count = 0;
                $current_question_id = $row["question_id"];
                $highest_votes = $row["answer_vote_count"];
                $questions[$current_question_id] = $row;
            }

            if ($current_question_id == $row["question_id"]) {
                $answer_count++;
                $questions[$current_question_id]["answer_count"] = $answer_count;
            }
        }

        return $questions;
    }
}

function retrieve_question_without_answer($id_param) {
  global $db;
  $id = $db->escape_string($id_param);
  $query = "SELECT title, content, created_timestamp, answers, comments, profile_fk " .
           "FROM questions WHERE question_id = $id";
  $result = $db->query($query);
  $return_array = array();
  if ($row = $result->fetch_assoc()) {
    $return_array['question_found'] = true;
    $return_array['title'] = $row['title'];
    $return_array['content'] = $row['content'];
    $return_array['created'] = $row['created_timestamp'];
    $return_array['answer_count'] = $row['answers'];
    $return_array['comment_count'] = $row['comments'];
    $return_array['profile_id'] = $row['profile_fk'];
  }
  else {
    $return_array['question_found'] = false;
  }
  return $return_array;
}

function retrieve_question_with_answer($id_param) {
  global $db;
  $id = $db->escape_string($id_param);
  $return_array = retrieve_question_without_answer($id);
  if ($return_array['question_found']) {
    $query = "SELECT answer_id, content, created_timestamp, votes, comments, profile_fk " .
             "FROM answers WHERE question_fk = $id";
    $result = $db->query($query);
    $answer_array = array();
    if ($row = $result->fetch_assoc()) {
      $answer = array();
      $answer['answer_id'] = $row['answer_id'];
      $answer['content'] = $row['content'];
      $answer['created'] = $row['created_timestamp'];
      $answer['votes'] = $row['votes'];
      $answer['comment_count'] = $row['comments'];
      $answer['profile_id'] = $row['profile_fk'];
      $answer_array[] = $answer;
    }
    $return_array['answers'] = $answer_array;
  }
  return $return_array;
}

function retrieve_answer($id_param) {
  global $db;
  $id = $db->escape_string($id_param);
  $query = "SELECT content, created_timestamp, votes, comments, profile_fk " .
           "FROM answers WHERE answer_id = $id";
  $result = $db->query($query);
  $return_array = array();
  if ($row = $result->fetch_assoc()) {
    $return_array['answer_found'] = true;
    $return_array['content'] = $row['content'];
    $return_array['created'] = $row['created_timestamp'];
    $return_array['vote_count'] = $row['votes'];
    $return_array['comment_count'] = $row['comments'];
    $return_array['profile_id'] = $row['profile_fk'];
  }
  else {
    $return_array['answer_found'] = false;
  }
  return $return_array;
}

// myinterface();
?>
