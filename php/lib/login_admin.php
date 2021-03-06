<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/dbaccess.php';

function admin_login($login_id_param, $password_param) {
  global $db;
  $login_id = $db->escape_string($login_id_param);
  $password = $db->escape_string($password_param);
  $hashed_password = crypt($password, $password);
  $array_to_return = array();
  $query = "SELECT * FROM admins WHERE login_id='$login_id'";
  $result = $db->query($query);
  if ($row = $result->fetch_assoc()) {
    if ($hashed_password== $row['hashed_password']) {
      $array_to_return = array();
      $array_to_return['login-id'] = $row['login_id'];
      $array_to_return['profile-id'] = $row['profile_fk'];
      $subquery = "SELECT display_name, image_url FROM profiles WHERE profile_id=" . $row['profile_fk'];
      $subresult = $db->query($subquery);
      $subrow = $subresult->fetch_assoc();
      $array_to_return['display-name'] = $subrow['display_name'];
      $array_to_return['image-url'] = $subrow['image_url'];
      return $array_to_return;
    }
  }
  return null;
}
?>
