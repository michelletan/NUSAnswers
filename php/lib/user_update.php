<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/dbaccess.php';

function update_user_question($id_param, $title_param, $content_param) {
  global $db;
  $id = $db->escape_string($id_param);
  $title = $db->escape_string($title_param);
  $content = $db->escape_string($content_param);
  $query = "UPDATE questions SET title = '" . $title . "', content = '" . $content . "' WHERE question_id = '". $id ."';";
  $db->query($query);
}

function update_user_question_comment($id_param, $content_param) {
  global $db;
  $id = $db->escape_string($id_param);
  $content = $db->escape_string($content_param);
  $query = "UPDATE question_comments SET content = '" . $content . "' WHERE comment_id = ". $id .";";
  $db->query($query);
}

function update_user_answer($id_param, $content_param) {
  global $db;
  $id = $db->escape_string($id_param);
  $content = $db->escape_string($content_param);
  $query = "UPDATE answers SET content = '" . $content . "' WHERE answer_id = ". $id .";";
  $db->query($query);
}
?>