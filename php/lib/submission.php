<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/dbaccess.php';

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
  }
}

function submit_question($title_param, $content_param, $tags_param, $profile_id_param) {
  global $db;
  $title = $db->escape_string($title_param);
  $content = $db->escape_string($content_param);
  $profile_id = $db->escape_string($profile_id_param);
  $query = "INSERT INTO questions (title, content, profile_fk) " .
           "VALUES ('$title', '$content', $profile_id)";
  $result = $db->query($query);
  if ($result) {
    $id = $db->insert_id;
    submit_tags($tags, $id);
  }
}

function submit_answer($content_param, $profile_id_param, $question_id_param) {
  global $db;
  $content = $db->escape_string($content_param);
  $profile_id = $db->escape_string($profile_id_param);
  $question_id = $db->escape_string($question_id_param);
  $query = "INSERT INTO answers (content, profile_fk, question_fk) " .
           "VALUES ('$content', '$profile_id', '$question_id')";
  $result = $db->query($query);
}

function submit_tags($tags, $question_id) {
  global $db;

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
?>
