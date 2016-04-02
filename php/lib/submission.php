<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/dbaccess.php';

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
