<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/dbaccess.php';

function update_admin_id($id_param, $new_id_param) {
  global $db;
  $id = $db->escape_string($id_param);
  $new_id = $db->escape_string($new_id_param);
  $query = "UPDATE admins SET admin_id = '" . $new_id . "' WHERE admin_id = '". $id ."';";
  $db->query($query);
  echo $query;
}


function update_admin_account($id_param, $new_id_param, $hashed_password_param) {
  global $db;
  $id = $db->escape_string($id_param);
  $new_id = $db->escape_string($new_id_param);
  $hashed_password = $db->escape_string($hashed_password_param);
  $query = "UPDATE admins SET admin_id = '" . $new_id . "', hashed_password = '" . $hashed_password . "' WHERE admin_id = '". $id ."';";
  $db->query($query);
}

function update_tag($id_param, $new_tag_name_param) {
  global $db;
  $id = $db->escape_string($id_param);
  $new_tag_name = $db->escape_string($new_tag_name_param);
  $query = "UPDATE tags SET tag_name = '" . $new_tag_name . "' WHERE tag_id = ". $id .";";
  $db->query($query);
}

function update_user($id_param, $role_param) {
  global $db;
  $id = $db->escape_string($id_param);
  $role = $db->escape_string($role_param);
  $query = "UPDATE users SET role = " . $role . " WHERE user_id = '". $id ."';";
  $db->query($query);
}

function update_profile($id_param, $display_name_param) {
  global $db;
  $id = $db->escape_string($id_param);
  $display_name = $db->escape_string($display_name_param);
  $query = "UPDATE profiles SET display_name = '" . $display_name . "' WHERE profile_id = ". $id .";";
  $db->query($query);
}

function update_question($id_param, $title_param, $content_param, $visible_param) {
  global $db;
  $id = $db->escape_string($id_param);
  $title = $db->escape_string($title_param);
  $content = $db->escape_string($content_param);
  $visible = $db->escape_string($visible_param);
  $query = "UPDATE questions SET title = '" . $title . "', content = '" . $content . "', visible = " . $visible . " WHERE question_id = ". $id .";";
  $db->query($query);
}

function update_question_comment($id_param, $content_param) {
  global $db;
  $id = $db->escape_string($id_param);
  $content = $db->escape_string($content_param);
  $query = "UPDATE question_comments SET content = '" . $content . "' WHERE comment_id = ". $id .";";
  $db->query($query);
}

function update_answer($id_param, $content_param, $visible_param) {
  global $db;
  $id = $db->escape_string($id_param);
  $content = $db->escape_string($content_param);
  $visible = $db->escape_string($visible_param);
  $query = "UPDATE answers SET content = '" . $content . "', visible = " . $visible . " WHERE answer_id = ". $id .";";
  $db->query($query);
}

function update_answer_comment($id_param, $content_param) {
  global $db;
  $id = $db->escape_string($id_param);
  $content = $db->escape_string($content_param);
  $query = "UPDATE answer_comments SET content = '" . $content . "' WHERE comment_id = ". $id .";";
  $db->query($query);
}

?>