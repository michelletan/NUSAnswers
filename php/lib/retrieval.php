<?php
require_once 'C:/xampp/htdocs/projects/CS3226/NUSAnswers/php/lib/dbaccess.php';

function myinterface() {
  if (isset($_GET['post_type']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($_GET['post_type'] == "question") {
      $result = retrieve_question_without_answer($id);
    }
    else if ($_GET['post_type'] == "question-with-answers") {
      $result = retrieve_question_with_answer($id);
    }
    else if ($_GET['post_type'] == "answer") {
      $result = retrieve_answer($id);
    }
    $result['status'] = "success";
    echo(json_encode($result));
  }
  else {
    $result = array();
    $result['status'] = "error";
    echo(json_encode($result));
  }
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

function retrieve_questions_for_home_page($limit_param) {
    global $db;

    if (!is_int($limit_param)) {
        // ERROR
        $limit = $db->escape_string($limit_param);
    } else {
        $limit = $limit_param;
    }

    $query = "SELECT q.question_id as question_id, ".
            "q.title as question_title, ".
            "q.content as question_content, ".
            "q.comments as question_comment_count, ".
            "a.answer_id as answer_id, ".
            "a.content as answer_content, ".
            "a.votes as answer_vote_count, ".
            "a.comments as answer_comment_count, ".
            "p.profile_id as answer_user_id,".
            "p.display_name as answer_user_name ".
            "FROM (SELECT * FROM questions LIMIT " . $limit.") q ".
            "LEFT JOIN answers a ON a.question_fk = q.question_id " .
            "LEFT JOIN profiles p ON a.profile_fk = p.profile_id " .
            "ORDER BY question_id";
    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $questions = array();

        // Retrieve only the highest voted answer for each question
        $current_question_id = null;
        $highest_votes = -1;
        $answer_count = 0;
        for ($i = 0; $i < count($rows); $i++) {
            $row = $rows[$i];

            if ($current_question_id == null || $current_question_id != $row["question_id"] || $highest_votes < $row["answer_vote_count"]) {
                $answer_count = 0;
                $current_question_id = $row["question_id"];
                $highest_votes = $row["answer_vote_count"];
                $questions[$current_question_id] = $row;
            }

            if ($current_question_id == $row["question_id"] && $row["answer_id"] != null) {
                $answer_count++;
                $questions[$current_question_id]["answer_count"] = $answer_count;
            }
        }

        return $questions;
    }
}

function retrieve_question_with_answer($id_param) {
    global $db;

    if (!is_int($id_param)) {
        // ERROR
        $id = $db->escape_string($id_param);
    } else {
        $id = $id_param;
    }

    $query = "SELECT q.question_id as question_id, ".
            "q.title as question_title, ".
            "q.content as question_content, ".
            "q.comments as question_comment_count, ".
            "a.answer_id as answer_id, ".
            "a.content as answer_content, ".
            "a.votes as answer_vote_count, ".
            "a.comments as answer_comment_count, ".
            "p.profile_id as answer_user_id,".
            "p.display_name as answer_user_name ".
            "FROM (SELECT * FROM questions WHERE question_id = ". $id .") q ".
            "LEFT JOIN answers a ON a.question_fk = q.question_id " .
            "LEFT JOIN profiles p ON a.profile_fk = p.profile_id " .
            "ORDER BY question_id";
    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $question = array();
        $answers = array();

        // Store the answers in an array
        for ($i = 0; $i < count($rows); $i++) {
            $row = $rows[$i];

            if ($question["question_id"] == null) {
                $question["question_id"] = $row["question_id"];
                $question["question_title"] = $row["question_title"];
                $question["question_content"] = $row["question_content"];
                $question["question_title"] = $row["question_title"];
                $question["question_id"] = $row["question_id"];
                $question["question_title"] = $row["question_title"];
            }

        }

        return $questions;
    }
}

function retrieve_question_without_answer($id_param) {
  global $db;
  $id = $db->escape_string($id_param);
  $query = "SELECT title, content, created_timestamp, answers, comments, profile_fk " .
           "FROM questions WHERE question_id = $id";
  $result = $db->query($query);
  $return_array = array();
  if ($row = $result->fetch_assoc()) {
    $return_array['question_found'] = true;
    $return_array['title'] = $row['title'];
    $return_array['content'] = $row['content'];
    $return_array['created'] = $row['created_timestamp'];
    $return_array['answer_count'] = $row['answers'];
    $return_array['comment_count'] = $row['comments'];
    $return_array['profile_id'] = $row['profile_fk'];
  }
  else {
    $return_array['question_found'] = false;
  }
  return $return_array;
}

// function retrieve_question_with_answer($id_param) {
//   global $db;
//   $id = $db->escape_string($id_param);
//   $return_array = retrieve_question_without_answer($id);
//   if ($return_array['question_found']) {
//     $query = "SELECT answer_id, content, created_timestamp, votes, comments, profile_fk " .
//              "FROM answers WHERE question_fk = $id";
//     $result = $db->query($query);
//     $answer_array = array();
//     if ($row = $result->fetch_assoc()) {
//       $answer = array();
//       $answer['answer_id'] = $row['answer_id'];
//       $answer['content'] = $row['content'];
//       $answer['created'] = $row['created_timestamp'];
//       $answer['votes'] = $row['votes'];
//       $answer['comment_count'] = $row['comments'];
//       $answer['profile_id'] = $row['profile_fk'];
//       $answer_array[] = $answer;
//     }
//     $return_array['answers'] = $answer_array;
//   }
//   return $return_array;
// }

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

function retrieve_all_moderator_records() {
  global $db;
  $query = "SELECT moderator_id, profile_fk FROM moderators;";
  $moderators = $db->query($query);
  $return_array = array();
  while ($moderator = $moderators->fetch_assoc()) {
    $query = "SELECT display_name FROM profiles WHERE profile_id = " . $moderator['profile_fk'];
    $moderator_profiles = $db->query($query); 
    $moderator_record['moderator_id'] = $moderator['moderator_id'];
    if ($moderator_profile = $moderator_profiles->fetch_assoc()) {
      $moderator_record['display_name'] = $moderator_profile['display_name'];
    } else {
      $moderator_record['display_name'] = "";
    }
    $return_array[] = $moderator_record;
  }
  return $return_array;
}

function retrieve_moderator($id_param) {
  global $db;
  $id = $db->escape_string($id_param);
  $query = "SELECT * FROM moderator WHERE moderator_id = '". $id ."'";
  $result = $db->query($query);
  $return_array = array();
  if ($row = $result->fetch_assoc()) {
    $return_array['moderator_found'] = true;
    $return_array['moderator_id'] = $row['moderator_id'];
    $return_array['profile_fk'] = $row['profile_fk'];
  }
  else {
    $return_array['moderator_found'] = false;
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
