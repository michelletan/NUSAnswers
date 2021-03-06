<?php
// function submit_question_anonymously($title_param, $content_param, $tags_param) {
//   global $db;
//   $title = $db->escape_string($title_param);
//   $content = $db->escape_string($content_param);
//   $friendly_url = get_seo_string($title);
//   $tags = array();
//   foreach ($tags_param as $value) {
//     $tags[] = $db->escape_string($value);
//   }
//   $query = "INSERT INTO questions (title, content, friendly_url) " .
//            "VALUES ('$title', '$content', '$friendly_url')";

//   $result = $db->query($query);
//   if ($result) {
//     $id = $db->insert_id;
//     submit_tags($tags, $id);
//     return $id;
//   }
//   return false;
// }

function submit_question($title_param, $content_param, $tags_param, $profile_id_param, $image_param) {
  global $db;
  $title = $db->escape_string($title_param);
  $content = $db->escape_string($content_param);
  $image_url = $db->escape_string($image_param);
  $friendly_url = get_seo_string($title);

  // Check if friendly url has been used
  $url_count = retrieve_count_of_questions_with_url($friendly_url);
  if ($url_count > 0) { // Question with this url exists
      // Append number to back
      $friendly_url = $friendly_url . "-" . ($url_count + 1);
  }

  // handle profile differently depending on whether user is logged in
  if ($profile_id_param) {
    $profile_id = $db->escape_string($profile_id_param);
  } else {
    $profile_id = NULL;
  }
  $tags = array();
  foreach ($tags_param as $value) {
    $tags[] = $db->escape_string($value);
  }

  // handle input differently depending on whether user is logged in
  if ($profile_id) {
    $query = "INSERT INTO questions (title, content, profile_fk, friendly_url, image_url) " .
           "VALUES ('$title', '$content', $profile_id, '$friendly_url', '$image_url')";
  }
  else {
    $query = "INSERT INTO questions (title, content, friendly_url, image_url) " .
           "VALUES ('$title', '$content', '$friendly_url', '$image_url')";
  }

  $result = $db->query($query);
  if ($result) {
    $id = $db->insert_id;
    submit_tags($tags, $id);
    return $id;
  }
  return false;
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

    $vp_string = str_replace(array('.', ',', '/'), '' , $vp_string);

    // Don't allow hyphen at end of string
    if (substr($vp_string, -1) == "-") {
        $vp_string = substr($vp_string, 0, -1);
    }

    // If string becomes empty
    if (strlen($vp_string) == 0) {
        $vp_string = "question";
    }

    return $vp_string;
}



?>
