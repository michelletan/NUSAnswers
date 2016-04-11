<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/constants.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/login_check.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/dbaccess.php';

function submit_answer($id_param, $content_param, $profile) {
  global $db;
  $id = $db->escape_string($id_param);
  $content = $db->escape_string($content_param);
  $query = "SELECT question_id FROM questions WHERE question_id=$id";
  $question_result = $db->query($query);
  $query = "SELECT profile_id FROM profiles WHERE profile_id=$profile";
  $profile_result = $db->query($query);

  // if question and profile exists
  if ($question_result->num_rows > 0 && $profile_result->num_rows > 0) {
    $query = "INSERT INTO answers (content, profile_fk, question_fk) " .
             "VALUES ('$content', $profile, $id)";
    $result = $db->query($query);
    if ($result) {
      $query = "SELECT COUNT(question_fk) FROM answers WHERE question_fk=$id";
      $count_result = $db->query($query);
      $count_row = $count_result->fetch_row();
      $answers = $count_row[0];
      $query = "UPDATE questions SET answers=$answers WHERE question_id=$id";
      $db->query($query);
      return true;
    }
  }
  return false;
}
?>
