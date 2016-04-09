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


?>