<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/dbaccess.php';

function update_user_question($id_param, $title_param, $content_param) {
  global $db;
  $id = $db->escape_string($id_param);
  $title = $db->escape_string($title_param);
  $content = $db->escape_string($content_param);

  $query = "SELECT * FROM questions WHERE question_id = $id AND profile_fk = " . get_active_profile();

  $result = $db->query($query);

  if ($result->num_rows != 0) {
      $query = "UPDATE questions SET title = '" . $title . "', content = '" . $content . "' WHERE question_id = '". $id ."';";
      $db->query($query);
  }

}

function update_user_question_comment($id_param, $content_param) {
  global $db;
  $id = $db->escape_string($id_param);
  $content = $db->escape_string($content_param);

  $query = "SELECT * FROM question_comments WHERE comment_id = $id AND profile_fk = " . get_active_profile();

  $result = $db->query($query);

  if ($result->num_rows != 0) {
      $query = "UPDATE question_comments SET content = '" . $content . "' WHERE comment_id = ". $id .";";
      $db->query($query);
  }
}

function update_user_answer($id_param, $content_param) {
  global $db;
  $id = $db->escape_string($id_param);
  $content = $db->escape_string($content_param);

  $query = "SELECT * FROM answers WHERE answer_id = $id AND profile_fk = " . get_active_profile();

  $result = $db->query($query);

  if ($result->num_rows != 0) {
      $query = "UPDATE answers SET content = '" . $content . "' WHERE answer_id = ". $id .";";
      $db->query($query);
  }
}

function update_user_answer_comment($id_param, $content_param) {
  global $db;
  $id = $db->escape_string($id_param);
  $content = $db->escape_string($content_param);

  $query = "SELECT * FROM answer_comments WHERE comment_id = $id AND profile_fk = " . get_active_profile();

  $result = $db->query($query);

  if ($result->num_rows != 0) {
      $query = "UPDATE answer_comments SET content = '" . $content . "' WHERE comment_id = ". $id .";";
      $db->query($query);
  }
}
?>
