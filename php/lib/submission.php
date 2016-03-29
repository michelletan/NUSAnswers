<?php
require_once('dbaccess.php');

function submit_question_anonymously($title_param, $content_param) {
  global $db;
  $title = $db->escape_string($title_param);
  $content = $db->escape_string($content_param);
  $query = "INSERT INTO questions (title, content) " .
           "VALUES ('$title', '$content')";
  $result = $db->query($query);
}

function submit_question($title_param, $content_param, $profile_id_param) {
  global $db;
  $title = $db->escape_string($title_param);
  $content = $db->escape_string($content_param);
  $profile_id = $db->escape_string($profile_id_param);
  $query = "INSERT INTO questions (title, content, profile_fk) " .
           "VALUES ('$title', '$content', $profile_id)";
  $db->query($query);
}

function submit_answer($content_param, $profile_id_param, $question_id_param) {
  global $db;
  $content = $db->escape_string($content_param);
  $profile_id = $db->escape_string($profile_id_param);
  $question_id = $db->escape_string($question_id_param);
  $query = "INSERT INTO answers (content, profile_fk, question_fk) " .
           "VALUES ('$content', '$profile_id', '$question_id')";
  $db->query($query);
}
?>
