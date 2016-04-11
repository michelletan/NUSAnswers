<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/dbaccess.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/submission_comments.php';


function json_submission_interface() {
  $array_to_return = array();
  if (isset($_POST['type'])) {
    $type = $_POST['type'];
    if ($type == "question") {
      if (!isset($_POST['title'])) {
        $array_to_return['status'] = "error";
        $array_to_return['message'] = "Error: no title";
      }
      else if (!isset($_POST['content'])) {
        $array_to_return['status'] = "error";
        $array_to_return['message'] = "Error: no content";
      }
      else {
        $tags = [];
        if (isset($_POST['tags'])) {
          $tags = json_decode($_POST['tags']);
        }

        // check if person is logged in, and get the profile id here
        // left blank for now
        $profile = NULL;
        $id = submit_question($_POST['title'], $_POST['content'], $tags, $profile);

        if ($id) {
          $array_to_return['status'] = "success";
          $array_to_return['message'] = "Question submitted successfully";
          $array_to_return['question_id'] = $id;
        }
        else {
          $array_to_return['status'] = "error";
          $array_to_return['message'] = "Question submission not successful";
        }
      }
    }
  $json_to_return = json_encode($array_to_return);
  echo ($json_to_return);
  }
}

function submit_question_anonymously($title_param, $content_param, $tags_param) {
  global $db;
  $title = $db->escape_string($title_param);
  $content = $db->escape_string($content_param);
  $tags = array();
  foreach ($tags_param as $value) {
    $tags[] = $db->escape_string($value);
  }
  $query = "INSERT INTO questions (title, content) " .
           "VALUES ('$title', '$content')";
  $result = $db->query($query);
  if ($result) {
    $id = $db->insert_id;
    submit_tags($tags, $id);
    return $id;
  }
  return false;
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

function get_question_url($title_param) {
    global $db;

    $title = $db->escape_string($title_param);
    $title = get_seo_string($title);

    // Check if the friendly url already exists
    $query =  "SELECT * FROM questions WHERE friendly_url LIKE '". $title ."')";
    $result = $db->query($query);

    // If the friendly url already exists, append the count to the end
    if ($result->num_rows > 0) {
        $title = $title . "-" . $result->num_rows;
    }
    return $title;
}

function get_seo_string($vp_string){

    $vp_string = trim($vp_string);

    $vp_string = html_entity_decode($vp_string);

    $vp_string = strip_tags($vp_string);

    $vp_string = strtolower($vp_string);

    $vp_string = preg_replace('~[^ a-z0-9_.]~', ' ', $vp_string);

    $vp_string = preg_replace('~ ~', '-', $vp_string);

    $vp_string = preg_replace('~-+~', '-', $vp_string);

    return $vp_string;
}

json_submission_interface();
?>
