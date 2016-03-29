<?php
require_once 'dbaccess.php';

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

function retrieve_question_without_answer($id_param) {
  global $db;
  $id = $db->escape_string($id_param);
  $query = "SELECT title, content, answers, comments, profile_fk " .
           "FROM questions WHERE question_id = $id";
  $result = $db->query($query);
  $return_array = array();
  if ($row = $result->fetch_assoc()) {
    $return_array['question_found'] = true;
    $return_array['title'] = $row['title'];
    $return_array['content'] = $row['content'];
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
    $query = "SELECT answer_id, content, votes, comments, profile_fk " .
             "FROM answers WHERE question_fk = $id";
    $result = $db->query($query);
    $answer_array = array();
    if ($row = $result->fetch_assoc()) {
      $answer = array();
      $answer['answer_id'] = $row['answer_id'];
      $answer['content'] = $row['content'];
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
  $query = "SELECT content, votes, comments, profile_fk " .
           "FROM answers WHERE answer_id = $id";
  $result = $db->query($query);
  $return_array = array();
  if ($row = $result->fetch_assoc()) {
    $return_array['answer_found'] = true;
    $return_array['content'] = $row['content'];
    $return_array['vote_count'] = $row['votes'];
    $return_array['comment_count'] = $row['comments'];
    $return_array['profile_id'] = $row['profile_fk'];
  }
  else {
    $return_array['answer_found'] = false;
  }
  return $return_array;
}

myinterface();
?>
