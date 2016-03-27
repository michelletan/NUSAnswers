<?php
require_once('dbaccess.php');

function ask_question_anonymously($title_param, $content_param) {
  global $db;
  $title = $db->escape_string($title_param);
  $content = $db->escape_string($content_param);
  $query = "INSERT INTO questions (title, content) " .
           "VALUES ('$title', '$content')";
  $db->query($query);
}

function ask_question($title_param, $content_param, $profile_id_param) {
  global $db;
  $title = $db->escape_string($title_param);
  $content = $db->escape_string($content_param);
  $profile_id = $db->escape_string($profile_id_param);
  $query = "INSERT INTO questions (title, content, profile_fk) " .
           "VALUES ('$title', '$content', $profile_id)";
  $db->query($query);
}

ask_question_anonymously("hello", "this is a text");
echo("success");
?>
