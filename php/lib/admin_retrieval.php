<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/dbaccess.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/time_helper.php';

function retrieve_question($id_param) {
  global $db;
  $id = $db->escape_string($id_param);
  $query = "SELECT * FROM questions WHERE question_id = " . $id;
  $result = $db->query($query);
  $return_array = array();
  if ($row = $result->fetch_assoc()) {
    $return_array['question_found'] = true;
    $return_array['question_id'] = $row['question_id'];
    $return_array['title'] = $row['title'];
    $return_array['content'] = $row['content'];
  }
  else {
    $return_array['question_found'] = false;
  }
  return $return_array;
}

function retrieve_all_questions() {
  global $db;
  $query = "SELECT * FROM questions;";
  $questions = $db->query($query);
  $return_array = array();
  while ($question = $questions->fetch_assoc()) {
    $return_array[] = $question;
  }
  return $return_array;
}

function retrieve_all_question_comments() {
  global $db;
  $query = "SELECT * FROM question_comments;";
  $question_comments = $db->query($query);
  $return_array = array();
  while ($question_comment = $question_comments->fetch_assoc()) {
    $return_array[] = $question_comment;
  }
  return $return_array;
}

function retrieve_answer($id_param) {
  global $db;
  $id = $db->escape_string($id_param);
  $query = "SELECT content, created_timestamp, votes, comments, profile_fk " .
           "FROM answers WHERE answer_id = $id";
  $result = $db->query($query);
  $return_array = array();
  if ($row = $result->fetch_assoc()) {
    $return_array['answer_found'] = true;
    $return_array['content'] = $row['content'];
    $return_array['created'] = $row['created_timestamp'];
    $return_array['vote_count'] = $row['votes'];
    $return_array['comment_count'] = $row['comments'];
    $return_array['profile_id'] = $row['profile_fk'];
  }
  else {
    $return_array['answer_found'] = false;
  }
  return $return_array;
}

function retrieve_all_answers() {
  global $db;
  $query = "SELECT * FROM answers;";
  $answers = $db->query($query);
  $return_array = array();
  while ($answer = $answers->fetch_assoc()) {
    $return_array[] = $answer;
  }
  return $return_array;
}

function retrieve_all_answer_comments() {
  global $db;
  $query = "SELECT * FROM answer_comments;";
  $answer_comments = $db->query($query);
  $return_array = array();
  while ($answer_comment = $answer_comments->fetch_assoc()) {
    $return_array[] = $answer_comment;
  }
  return $return_array;
}

// myinterface();

function retrieve_all_admin_records() {
  global $db;
  $query = "SELECT admin_id, profile_fk FROM admins;";
  $admin_accounts = $db->query($query);
  $return_array = array();
  while ($admin_account = $admin_accounts->fetch_assoc()) {
    $query = "SELECT display_name FROM profiles WHERE profile_id = " . $admin_account['profile_fk'];
    $admin_profiles = $db->query($query); 
    $admin_record['admin_id'] = $admin_account['admin_id'];
    if ($admin_profile = $admin_profiles->fetch_assoc()) {
      $admin_record['display_name'] = $admin_profile['display_name'];
    } else {
      $admin_record['display_name'] = "";
    }
    $return_array[] = $admin_record;
  }
  return $return_array;
}

function retrieve_admin_account($id_param) {
  global $db;
  $id = $db->escape_string($id_param);
  $query = "SELECT * FROM admins WHERE admin_id = '". $id ."'";
  $result = $db->query($query);
  $return_array = array();
  if ($row = $result->fetch_assoc()) {
    $return_array['admin_account_found'] = true;
    $return_array['admin_id'] = $row['admin_id'];
    $return_array['hashed_password'] = $row['hashed_password'];
    $return_array['role'] = $row['role'];
    $return_array['profile_fk'] = $row['profile_fk'];
  }
  else {
    $return_array['admin_account_found'] = false;
  }
  return $return_array;
}

function retrieve_all_user_records() {
  global $db;
  $query = "SELECT user_id, profile_fk FROM users;";
  $users = $db->query($query);
  $return_array = array();
  while ($user = $users->fetch_assoc()) {
    $query = "SELECT display_name FROM profiles WHERE profile_id = " . $user['profile_fk'];
    $user_profiles = $db->query($query); 
    $user_record['user_id'] = $user['user_id'];
    if ($user_profile = $user_profiles->fetch_assoc()) {
      $user_record['display_name'] = $user_profile['display_name'];
    } else {
      $user_record['display_name'] = "";
    }
    $return_array[] = $user_record;
  }
  return $return_array;
}

function retrieve_user($id_param) {
  global $db;
  $id = $db->escape_string($id_param);
  $query = "SELECT * FROM users WHERE user_id = '". $id ."'";
  $result = $db->query($query);
  $return_array = array();
  if ($row = $result->fetch_assoc()) {
    $return_array['user_found'] = true;
    $return_array['user_id'] = $row['user_id'];
    $return_array['role'] = $row['role'];
    $return_array['profile_fk'] = $row['profile_fk'];
  }
  else {
    $return_array['user_found'] = false;
  }
  return $return_array;
}

function retrieve_profile($id_param) {
  global $db;
  $id = $db->escape_string($id_param);
  $query = "SELECT * FROM profiles WHERE profile_id = '". $id ."'";
  $result = $db->query($query);
  $return_array = array();
  if ($row = $result->fetch_assoc()) {
    $return_array['profile_found'] = true;
    $return_array['profile_id'] = $row['profile_id'];
    $return_array['display_name'] = $row['display_name'];
  }
  else {
    $return_array['profile_found'] = false;
  }
  return $return_array;
}

function retrieve_tag($id_param) {
  global $db;
  $id = $db->escape_string($id_param);
  $query = "SELECT * FROM tags WHERE tag_id = '". $id ."'";
  $result = $db->query($query);
  $return_array = array();
  if ($row = $result->fetch_assoc()) {
    $return_array['tag_found'] = true;
    $return_array['tag_id'] = $row['tag_id'];
    $return_array['tag_name'] = $row['tag_name'];
  }
  else {
    $return_array['tag_found'] = false;
  }
  return $return_array;
}

function retrieve_all_tags() {
  global $db;
  $query = "SELECT * FROM tags;";
  $tags = $db->query($query);
  $return_array = array();
  while ($tag = $tags->fetch_assoc()) {
    $return_array[] = $tag;
  }
  return $return_array;
}
?>
