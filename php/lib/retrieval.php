<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/dbaccess.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/time_helper.php';


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

// METHODS FOR TAGS
function retrieve_tag_names($limit_param) {
    global $db;

    if (!is_int($limit_param)) {
        // ERROR
        $limit = $db->escape_string($limit_param);
    } else {
        $limit = $limit_param;
    }

    $query = "SELECT tag_name FROM tags LIMIT ". $limit;

    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        return $rows;
    }
}

// METHODS FOR QUESTIONS

function retrieve_questions_by_views($limit_param, $page_param) {
    global $db;

    if (!is_int($limit_param)) {
        // ERROR
        $limit = $db->escape_string($limit_param);
        $param = $db->escape_string($page_param);
    } else {
        $limit = $limit_param;
        $page = $page_param;
    }

    $query = "SELECT q.question_id as question_id, ".
            "q.title as question_title, ".
            "q.content as question_content, ".
            "q.comments as question_comment_count, ".
            "q.created_timestamp as question_timestamp, ".
            "q.friendly_url as question_friendly_url, ".
            "a.answer_id as answer_id, ".
            "COUNT(DISTINCT a.answer_id) as answer_count, ".
            "a.content as answer_content, ".
            "MAX(a.votes) as answer_vote_count, ".
            "a.comments as answer_comment_count, ".
            "a.created_timestamp as answer_timestamp, ".
            "p.profile_id as answer_user_id,".
            "p.display_name as answer_user_name, ".
            "p2.profile_id as question_user_id,".
            "p2.display_name as question_user_name, ".
            "GROUP_CONCAT(DISTINCT t.tag_name) as tags ".
            "FROM (SELECT * FROM questions ORDER BY views DESC) q ".
            "LEFT JOIN answers a ON a.question_fk = q.question_id " .
            "LEFT JOIN profiles p ON a.profile_fk = p.profile_id " .
            "LEFT JOIN profiles p2 ON q.profile_fk = p2.profile_id " .
            "LEFT JOIN has_tags ht ON ht.question_fk = q.question_id " .
            "LEFT JOIN tags t ON t.tag_id = ht.tag_fk ".
            "GROUP BY q.question_id ".
            "ORDER BY q.views DESC ".
            "LIMIT " . ($limit + 1) . " OFFSET " . ($page - 1) * $limit;

    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        $questions = process_result_into_question_with_answer($rows);

        $data = array();

        // If the results had an extra row over the limit, there exists a next page
        if ($result->num_rows >= $limit) {
            // Remove the extra result from the return
            array_pop($questions);
            $data["has_next_page"] = true;
        } else {
            $data["has_next_page"] = false;
        }

        $data["questions"] = $questions;

        return $data;
    }
}

function retrieve_questions_by_latest($limit_param, $page_param) {
    global $db;

    if (!is_int($limit_param)) {
        // ERROR
        $limit = $db->escape_string($limit_param);
        $param = $db->escape_string($page_param);
    } else {
        $limit = $limit_param;
        $page = $page_param;
    }

    $query = "SELECT q.question_id as question_id, ".
            "q.title as question_title, ".
            "q.content as question_content, ".
            "q.comments as question_comment_count, ".
            "q.created_timestamp as question_timestamp, ".
            "q.friendly_url as question_friendly_url, ".
            "a.answer_id as answer_id, ".
            "a.content as answer_content, ".
            "a.votes as answer_vote_count, ".
            "a.comments as answer_comment_count, ".
            "a.created_timestamp as answer_timestamp, ".
            "p.profile_id as answer_user_id,".
            "p.display_name as answer_user_name, ".
            "p2.profile_id as question_user_id,".
            "p2.display_name as question_user_name, ".
            "GROUP_CONCAT(DISTINCT t.tag_name) as tags ".
            "FROM (SELECT * FROM questions ORDER BY question_id DESC) q ".
            "LEFT JOIN answers a ON a.question_fk = q.question_id " .
            "LEFT JOIN profiles p ON a.profile_fk = p.profile_id " .
            "LEFT JOIN profiles p2 ON q.profile_fk = p2.profile_id " .
            "LEFT JOIN has_tags ht ON ht.question_fk = q.question_id " .
            "LEFT JOIN tags t ON t.tag_id = ht.tag_fk ".
            "GROUP BY q.question_id ".
            "ORDER BY q.question_id DESC ".
            "LIMIT " . ($limit + 1) . " OFFSET " . ($page - 1) * $limit;

    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        $questions = process_result_into_question_with_answer($rows);

        $data = array();

        // If the results had an extra row over the limit, there exists a next page
        if ($result->num_rows >= $limit) {
            // Remove the extra result from the return
            array_pop($questions);
            $data["has_next_page"] = true;
        } else {
            $data["has_next_page"] = false;
        }

        $data["questions"] = $questions;

        return $data;
    }
}

function retrieve_questions_with_popular_answers($limit_param, $page_param) {
    global $db;

    if (!is_int($limit_param)) {
        // ERROR
        $limit = $db->escape_string($limit_param);
        $param = $db->escape_string($page_param);
    } else {
        $limit = $limit_param;
        $page = $page_param;
    }

    $query = "SELECT q.question_id as question_id, ".
            "q.title as question_title, ".
            "q.content as question_content, ".
            "q.comments as question_comment_count, ".
            "q.created_timestamp as question_timestamp, ".
            "q.friendly_url as question_friendly_url, ".
            "a.answer_id as answer_id, ".
            "a.content as answer_content, ".
            "a.votes as answer_vote_count, ".
            "a.comments as answer_comment_count, ".
            "a.created_timestamp as answer_timestamp, ".
            "p.profile_id as answer_user_id,".
            "p.display_name as answer_user_name, ".
            "p2.profile_id as question_user_id,".
            "p2.display_name as question_user_name, ".
            "GROUP_CONCAT(DISTINCT t.tag_name) as tags ".
            "FROM questions q ".
            "LEFT JOIN (SELECT DISTINCT * FROM answers ORDER BY votes DESC) a ".
            "ON a.question_fk = q.question_id " .
            "LEFT JOIN profiles p ON a.profile_fk = p.profile_id " .
            "LEFT JOIN profiles p2 ON q.profile_fk = p2.profile_id " .
            "LEFT JOIN has_tags ht ON ht.question_fk = q.question_id " .
            "LEFT JOIN tags t ON t.tag_id = ht.tag_fk ".
            "WHERE answer_id is NOT NULL ".
            "GROUP BY q.question_id ".
            "ORDER BY a.votes DESC ".
            "LIMIT " . ($limit + 1) . " OFFSET " . ($page - 1) * $limit;

    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        $questions = process_result_into_question_with_answer($rows);

        $data = array();

        // If the results had an extra row over the limit, there exists a next page
        if ($result->num_rows >= $limit) {
            // Remove the extra result from the return
            array_pop($questions);
            $data["has_next_page"] = true;
        } else {
            $data["has_next_page"] = false;
        }

        $data["questions"] = $questions;

        return $data;
    }
}

function retrieve_questions_with_recent_answers($limit_param, $page_param) {
    global $db;

    if (!is_int($limit_param)) {
        // ERROR
        $limit = $db->escape_string($limit_param);
        $param = $db->escape_string($page_param);
    } else {
        $limit = $limit_param;
        $page = $page_param;
    }

    $query = "SELECT q.question_id as question_id, ".
            "q.title as question_title, ".
            "q.content as question_content, ".
            "q.comments as question_comment_count, ".
            "q.created_timestamp as question_timestamp, ".
            "q.friendly_url as question_friendly_url, ".
            "a.answer_id as answer_id, ".
            "a.content as answer_content, ".
            "a.votes as answer_vote_count, ".
            "a.comments as answer_comment_count, ".
            "a.created_timestamp as answer_timestamp, ".
            "p.profile_id as answer_user_id,".
            "p.display_name as answer_user_name, ".
            "p2.profile_id as question_user_id,".
            "p2.display_name as question_user_name, ".
            "GROUP_CONCAT(DISTINCT t.tag_name) as tags ".
            "FROM questions q ".
            "LEFT JOIN (SELECT DISTINCT * FROM answers ORDER BY answer_id DESC) a ".
            "ON a.question_fk = q.question_id " .
            "LEFT JOIN profiles p ON a.profile_fk = p.profile_id " .
            "LEFT JOIN profiles p2 ON q.profile_fk = p2.profile_id " .
            "LEFT JOIN has_tags ht ON ht.question_fk = q.question_id " .
            "LEFT JOIN tags t ON t.tag_id = ht.tag_fk ".
            "WHERE answer_id is NOT NULL ".
            "GROUP BY q.question_id ".
            "ORDER BY a.answer_id DESC ".
            "LIMIT " . ($limit + 1) . " OFFSET " . ($page - 1) * $limit;

    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        $questions = process_result_into_question_with_answer($rows);

        $data = array();

        // If the results had an extra row over the limit, there exists a next page
        if ($result->num_rows >= $limit) {
            // Remove the extra result from the return
            array_pop($questions);
            $data["has_next_page"] = true;
        } else {
            $data["has_next_page"] = false;
        }

        $data["questions"] = $questions;

        return $data;
    }
}

function retrieve_questions_with_tag($tag_param, $limit_param, $page_param) {
    global $db;

    if (!is_int($limit_param)) {
        // ERROR
        $limit = $db->escape_string($limit_param);
        $page = $db->escape_string($page_param);
    } else {
        $limit = $limit_param;
        $page = $page_param;
    }
    $tag = $db->escape_string($tag_param);

    $query = "SELECT q.question_id as question_id, ".
            "q.title as question_title, ".
            "q.content as question_content, ".
            "q.comments as question_comment_count, ".
            "q.created_timestamp as question_timestamp, ".
            "q.friendly_url as question_friendly_url, ".
            "a.answer_id as answer_id, ".
            "a.content as answer_content, ".
            "a.votes as answer_vote_count, ".
            "a.comments as answer_comment_count, ".
            "a.created_timestamp as answer_timestamp, ".
            "p.profile_id as answer_user_id,".
            "p.display_name as answer_user_name, ".
            "p2.profile_id as question_user_id,".
            "p2.display_name as question_user_name, ".
            "GROUP_CONCAT(DISTINCT t.tag_name) as tags ".
            "FROM (SELECT * FROM questions ORDER BY views DESC) q ".
            "LEFT JOIN answers a ON a.question_fk = q.question_id " .
            "LEFT JOIN profiles p ON a.profile_fk = p.profile_id " .
            "LEFT JOIN profiles p2 ON q.profile_fk = p2.profile_id " .
            "LEFT JOIN has_tags ht ON ht.question_fk = q.question_id " .
            "LEFT JOIN tags t ON t.tag_id = ht.tag_fk ".
            "GROUP BY a.answer_id ".
            "HAVING tags LIKE '%". $tag ."%' ".
            "ORDER BY q.views DESC ".
            "LIMIT " . ($limit + 1) . " OFFSET " . ($page - 1) * $limit;

    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        $questions = process_result_into_question_with_answer($rows);

        $data = array();

        // If the results had an extra row over the limit, there exists a next page
        if ($result->num_rows >= $limit) {
            // Remove the extra result from the return
            array_pop($questions);
            $data["has_next_page"] = true;
        } else {
            $data["has_next_page"] = false;
        }

        $data["questions"] = $questions;

        return $data;
    }
}

function retrieve_questions_for_answer_page($limit_param, $page_param) {
    global $db;

    if (!is_int($limit_param)) {
        // ERROR
        $limit = $db->escape_string($limit_param);
        $param = $db->escape_string($page_param);
    } else {
        $limit = $limit_param;
        $page = $page_param;
    }

    $query = "SELECT q.question_id as question_id, ".
            "q.title as question_title, ".
            "q.content as question_content, ".
            "q.comments as question_comment_count, ".
            "q.created_timestamp as question_timestamp, ".
            "q.friendly_url as question_friendly_url, ".
            "a.answer_id as answer_id, ".
            "a.content as answer_content, ".
            "a.votes as answer_vote_count, ".
            "a.comments as answer_comment_count, ".
            "a.created_timestamp as answer_timestamp, ".
            "p.profile_id as answer_user_id,".
            "p.display_name as answer_user_name, ".
            "p2.profile_id as question_user_id,".
            "p2.display_name as question_user_name, ".
            "GROUP_CONCAT(DISTINCT t.tag_name) as tags ".
            "FROM (SELECT * FROM questions ORDER BY question_id DESC) q ".
            "LEFT JOIN answers a ON a.question_fk = q.question_id " .
            "LEFT JOIN profiles p ON a.profile_fk = p.profile_id " .
            "LEFT JOIN profiles p2 ON q.profile_fk = p2.profile_id " .
            "LEFT JOIN has_tags ht ON ht.question_fk = q.question_id " .
            "LEFT JOIN tags t ON t.tag_id = ht.tag_fk ".
            "WHERE answer_id is NULL ".
            "GROUP BY q.question_id ".
            "ORDER BY q.question_id DESC ".
            "LIMIT " . ($limit + 1) . " OFFSET " . ($page - 1) * $limit;

    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        $questions = process_result_into_question_with_answer($rows);

        $data = array();

        // If the results had an extra row over the limit, there exists a next page
        if ($result->num_rows >= $limit) {
            // Remove the extra result from the return
            array_pop($questions);
            $data["has_next_page"] = true;
        } else {
            $data["has_next_page"] = false;
        }

        $data["questions"] = $questions;

        return $data;
    }
}

function retrieve_question_with_answer($url_param) {
    global $db;

    $url = $db->escape_string($url_param);

    $query = "SELECT q.question_id as question_id, ".
            "q.title as question_title, ".
            "q.content as question_content, ".
            "q.comments as question_comment_count, ".
            "q.created_timestamp as question_timestamp, ".
            "a.answer_id as answer_id, ".
            "a.content as answer_content, ".
            "a.votes as answer_vote_count, ".
            "a.comments as answer_comment_count, ".
            "a.created_timestamp as answer_timestamp, ".
            "p.profile_id as answer_user_id,".
            "p.display_name as answer_user_name, ".
            "p2.profile_id as question_user_id,".
            "p2.display_name as question_user_name, ".
            "GROUP_CONCAT(DISTINCT t.tag_name) as tags ".
            "FROM (SELECT * FROM questions WHERE friendly_url = '". $url ."') q ".
            "LEFT JOIN answers a ON a.question_fk = q.question_id " .
            "LEFT JOIN profiles p ON a.profile_fk = p.profile_id " .
            "LEFT JOIN profiles p2 ON q.profile_fk = p2.profile_id " .
            "LEFT JOIN has_tags ht ON ht.question_fk = q.question_id " .
            "LEFT JOIN tags t ON t.tag_id = ht.tag_fk ".
            "GROUP BY q.question_id ".
            "ORDER BY answer_vote_count DESC";

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
                $question["question_comment_count"] = $row["question_comment_count"];
                $question["question_user_id"] = $row["question_user_id"];
                $question["question_user_name"] = $row["question_user_name"];
                $question["question_timestamp"] = timestamp_to_relative_date($row["question_timestamp"]);
                $tags = explode(",", $row["tags"]);
                $question["tags"] = $tags;
            }

            $answer = array();
            $answer["answer_id"] = $row["answer_id"];
            $answer["answer_content"] = $row["answer_content"];
            $answer["answer_vote_count"] = $row["answer_vote_count"];
            $answer["answer_comment_count"] = $row["answer_comment_count"];
            $answer["answer_user_id"] = $row["answer_user_id"];
            $answer["answer_user_name"] = $row["answer_user_name"];
            $answer["answer_timestamp"] = timestamp_to_relative_date($row["answer_timestamp"]);

            $answers[$i] = $answer;
        }

        $question["answers"] = $answers;

        return $question;
    }
}

// METHODS FOR COMMENTS
function retrieve_comments_for_question($id_param) {
    global $db;

    if (!is_int($id_param)) {
        // ERROR
        $id = $db->escape_string($id_param);
    } else {
        $id = $id_param;
    }

    $query = "SELECT * FROM question_comments qc ".
            "JOIN profiles p ON p.profile_id = qc.profile_fk ".
            "WHERE qc.question_fk = ". $id;

    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        return $rows;
    }
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

function retrieve_comments_for_answer($id_param) {
    global $db;

    if (!is_int($id_param)) {
        // ERROR
        $id = $db->escape_string($id_param);
    } else {
        $id = $id_param;
    }

    $query = "SELECT * FROM answer_comments ac " .
            "JOIN profiles p ON p.profile_id = ac.profile_fk ".
            "WHERE ac.answer_fk = ". $id;

    $result = $db->query($query);

    if ($result->num_rows == 0) {
        return array();
    } else {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        return $rows;
    }
}

// Given an array of questions joined with answer rows, returns an array of
// distinct questions with their highest voted answer.
function process_result_into_question_with_answer($rows) {
    $questions = array();

    for ($i = 0; $i < count($rows); $i++) {
        $row = $rows[$i];

        $question_id = $row["question_id"];

        $questions[$question_id] = $row;

        // Change tag concat string into array
        $tags = explode(",", $row["tags"]);
        $questions[$question_id]["tags"] = $tags;

    }

    return $questions;
}

?>
