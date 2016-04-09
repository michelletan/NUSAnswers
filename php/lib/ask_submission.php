<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/constants.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/dbaccess.php';

// constants to get the data from later
// change values on the right side if naming of fields in the form is different
define("title_field", "title_field");
define("content_field", "content_field");
define("tags_field", "tags_field");
define("image_field", "image_field");

function submission_interface() {
  if (isset($_POST[title_field]) && strlen($_POST[title_field]) != 0) {
    $title = $_POST[title_field];
  }
  else {
    header('Location: ' . APP_HOME_URL . 'ask');
    exit;
  }

  if (isset($_POST[content_field]) && strlen($_POST[content_field]) != 0) {
    $content = $_POST[content_field];
  }
  else {
    header('Location: ' . APP_HOME_URL . 'ask');
    exit;
  }

  // this part may depend on how user should input tags
  if (isset($_POST[tags_field])) {
    $tags = explode(",", $_POST[tags_field]);
  }
  else {
    $tags = array();
  }

  // check if person is logged in, and get the profile id here
  // left blank for now
  $profile = NULL;
  submit_question($title, $content, $tags, $profile);
}


function submit_question($title_param, $content_param, $tags_param, $profile_id_param) {
  global $db;
  $title = $db->escape_string($title_param);
  $content = $db->escape_string($content_param);

  // handle profile differently depending on whether user is logged in
  if ($profile_id_param) {
    $profile_id = $db->escape_string($profile_id_param);
  }
  else {
    $profile_id = NULL;
  }
  $tags = array();
  foreach ($tags_param as $value) {
    $tags[] = $db->escape_string($value);
  }

  // handle input differently depending on whether user is logged in
  if ($profile_id) {
    $query = "INSERT INTO questions (title, content, profile_fk) " .
           "VALUES ('$title', '$content', $profile_id)";
  }
  else {
    $query = "INSERT INTO questions (title, content) " .
           "VALUES ('$title', '$content')";
  }

  $result = $db->query($query);
  if ($result) {
    $id = $db->insert_id;
    submit_tags($tags, $id);
    return $id;
  }
  return false;
}


function submit_tags($tags, $question_id) {
  global $db;

  if (count($tags) == 0) {
    return;
  }

  // get which tags are already present
  $parameters = "(";
  foreach ($tags as $value) {
    $parameters = $parameters . "'$value',";
  }
  $parameters = substr($parameters, 0, -1) . ")";
  $query = "SELECT tag_name FROM tags WHERE tag_name IN $parameters";
  $result = $db->query($query);
  $present_tags = array();
  while ($row = $result->fetch_assoc()) {
    $present_tags[$row['tag_name']] = 1;
  }

  // insert tags that aren't present yet
  $insert_parameters = "";
  foreach($tags as $value) {
    if (!array_key_exists($value, $present_tags)) {
      $insert_parameters = $insert_parameters . "('$value'),";
    }
  }
  $insert_parameters = substr($insert_parameters, 0, -1);
  $query = "INSERT INTO tags (tag_name) VALUES $insert_parameters";
  $db->query($query);

  // get ids of tags
  // reuses $parameters from earlier
  $query = "SELECT tag_id FROM tags WHERE tag_name IN $parameters";
  $result = $db->query($query);

  // insert tag association into has_tag
  $insert_parameters = "";
  while ($row = $result->fetch_assoc()) {
    $insert_parameters = $insert_parameters . "(" . $question_id . "," . $row['tag_id'] . "),";
  }
  $insert_parameters = substr($insert_parameters, 0, -1);
  $query = "INSERT INTO has_tags (question_fk, tag_fk) VALUES $insert_parameters";
  $db->query($query);
}

submission_interface();


?>
