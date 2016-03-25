<?php
require_once 'dbaccess.php';

/* The purpose of this php file is to create empty tables
 * in the database for use in the application.
 */

/************************* CREATE METHODS **************************/
function create_tables () {
  create_all_user_tables();
  create_all_post_tables();
  create_all_post_support_tables();
}

/************************* USER PROFILE TABLES *************************/
function create_all_user_tables () {
  create_profile_table();
  create_user_table();
  create_admin_table();
}

function create_profile_table () {
  global $db;
  $query = "CREATE TABLE profiles (" .
           "profile_id INTEGER AUTO_INCREMENT PRIMARY KEY," .
           "display_name VARCHAR(32) NOT NULL" .
           ")";
  $db->query($query);
}

function create_user_table () {
  global $db;
  $query = "CREATE TABLE users (" .
           "user_id VARCHAR(32) PRIMARY KEY," .
           "profile_fk INTEGER NOT NULL," .
           "FOREIGN KEY(profile_fk) REFERENCES profiles(profile_id)" .
           ")";
  $db->query($query);
}

function create_admin_table () {
  global $db;
  $query = "CREATE TABLE admins (" .
           "admin_id VARCHAR(32) PRIMARY KEY," .
           "hashed_password VARCHAR(256) NOT NULL," .
           "role INTEGER NOT NULL," .
           "profile_fk INTEGER NOT NULL," .
           "FOREIGN KEY(profile_fk) REFERENCES profiles(profile_id)" .
           ")";
  $db->query($query);
}

/******************** QUESTIONS, ANSWERS, COMMENTS TABLES ********************/
function create_all_post_tables () {
  create_question_table();
  create_answer_table();
  create_question_comment_table();
  create_answer_comment_table();
}

function create_question_table () {
  global $db;
  $query = "CREATE TABLE questions (" .
           "question_id INTEGER AUTO_INCREMENT PRIMARY KEY," .
           "content MEDIUMTEXT NOT NULL," .
           "profile_fk INTEGER," .
           "FOREIGN KEY(profile_fk) REFERENCES profiles(profile_id)" .
           ")";
  $db->query($query);
}

function create_answer_table () {
  global $db;
  $query = "CREATE TABLE answers (" .
           "answer_id INTEGER AUTO_INCREMENT PRIMARY KEY," .
           "content MEDIUMTEXT NOT NULL," .
           "votes INTEGER NOT NULL,"
           "profile_fk INTEGER NOT NULL," .
           "question_fk INTEGER NOT NULL," .
           "FOREIGN KEY(profile_fk) REFERENCES profiles(profile_id)," .
           "FOREIGN KEY(question_fk) REFERENCES questions(question_id) ON DELETE CASCADE" .
           ")";
  $db->query($query);
}

function create_question_comment_table () {
  global $db;
  $query = "CREATE TABLE question_comments (" .
           "comment_id INTEGER AUTO_INCREMENT PRIMARY KEY," .
           "content MEDIUMTEXT NOT NULL," .
           "profile_fk INTEGER NOT NULL," .
           "question_fk INTEGER NOT NULL," .
           "FOREIGN KEY(profile_fk) REFERENCES profiles(profile_id)," .
           "FOREIGN KEY(question_fk) REFERENCES questions(question_id) ON DELETE CASCADE" .
           ")";
  $db->query($query);
}

function create_answer_comment_table () {
  global $db;
  $query = "CREATE TABLE answer_comments (" .
           "comment_id INTEGER AUTO_INCREMENT PRIMARY KEY," .
           "content MEDIUMTEXT NOT NULL," .
           "profile_fk INTEGER NOT NULL," .
           "answer_fk INTEGER NOT NULL," .
           "FOREIGN KEY(profile_fk) REFERENCES profiles(profile_id)," .
           "FOREIGN KEY(answer_fk) REFERENCES answers(answer_id) ON DELETE CASCADE" .
           ")";
  $db->query($query);
}

/************************* POST SUPPORT TABLES *************************/
function create_all_post_support_tables () {
  create_question_image_table();
  create_answer_image_table();
  create_vote_table();
  create_tag_table();
  create_has_tag_table();
}

function create_question_image_table () {
  global $db;
  $query = "CREATE TABLE question_images (" .
           "image_id INTEGER AUTO_INCREMENT PRIMARY KEY," .
           "location VARCHAR(256) NOT NULL," .
           "question_fk INTEGER NOT NULL," .
           "FOREIGN KEY(question_fk) REFERENCES questions(question_id) ON DELETE CASCADE" .
           ")";
  $db->query($query);
}

function create_answer_image_table () {
  global $db;
  $query = "CREATE TABLE answer_images (" .
           "image_id INTEGER AUTO_INCREMENT PRIMARY KEY," .
           "location VARCHAR(256) NOT NULL," .
           "answer_fk INTEGER NOT NULL," .
           "FOREIGN KEY(answer_fk) REFERENCES answers(answer_id) ON DELETE CASCADE" .
           ")";
  $db->query($query);
}

function create_vote_table () {
  global $db;
  $query = "CREATE TABLE votes (" .
           "profile_fk INTEGER NOT NULL," .
           "answer_fk INTEGER NOT NULL," .
           "vote_type INTEGER NOT NULL," .
           "FOREIGN KEY(profile_fk) REFERENCES profiles(profile_id)," .
           "FOREIGN KEY(answer_fk) REFERENCES answers(answer_id) ON DELETE CASCADE," .
           "PRIMARY KEY(profile_fk, answer_fk)" .
           ")";
  $db->query($query);
}

function create_tag_table () {
  global $db;
  $query = "CREATE TABLE tags (" .
           "tag_id INTEGER AUTO_INCREMENT PRIMARY KEY," .
           "tag_name VARCHAR(64) NOT NULL UNIQUE" .
           ")";
  $db->query($query);
}

function create_has_tag_table () {
  global $db;
  $query = "CREATE TABLE has_tags (" .
           "question_fk INTEGER NOT NULL," .
           "tag_fk INTEGER NOT NULL," .
           "FOREIGN KEY(question_fk) REFERENCES questions(question_id) ON DELETE CASCADE," .
           "FOREIGN KEY(tag_fk) REFERENCES tags(tag_id)," .
           "PRIMARY KEY(question_fk, tag_fk)" .
           ")";
  $db->query($query);
}

/************************* DELETE METHODS *************************/
// note: all drop methods should be in reverse order from creation
function drop_tables () {
  drop_all_post_support_tables();
  drop_all_post_tables();
  drop_all_user_tables();
}

/************************* USER PROFILE TABLES *************************/
function drop_all_user_tables () {
  drop_admin_table();
  drop_user_table();
  drop_profile_table();
}

function drop_profile_table () {
  drop_table_by_name("profiles");
}

function drop_user_table () {
  drop_table_by_name("users");
}

function drop_admin_table () {
  drop_table_by_name("admins");
}

/******************** QUESTIONS, ANSWERS, COMMENTS TABLES ********************/
function drop_all_post_tables () {
  drop_answer_comment_table();
  drop_question_comment_table();
  drop_answer_table();
  drop_question_table();
}

function drop_question_table () {
  drop_table_by_name("questions");
}

function drop_answer_table () {
  drop_table_by_name("answers");
}

function drop_question_comment_table () {
  drop_table_by_name("question_comments");
}

function drop_answer_comment_table () {
  drop_table_by_name("answer_comments");
}

/************************* POST SUPPORT TABLES *************************/
function drop_all_post_support_tables () {
  drop_has_tag_table();
  drop_tag_table();
  drop_answer_image_table();
  drop_question_image_table();
  drop_vote_table();
}

function drop_question_image_table () {
  drop_table_by_name("question_images");
}

function drop_answer_image_table () {
  drop_table_by_name("answer_images");
}

function drop_vote_table () {
  drop_table_by_name("votes");
}

function drop_tag_table () {
  drop_table_by_name("tags");
}

function drop_has_tag_table () {
  drop_table_by_name("has_tags");
}

/************************* HELPER METHODS *************************/
function drop_table_by_name($name) {
  global $db;
  $query = "DROP TABLE IF EXISTS " . $name;
  $db->query($query);
}

drop_tables();
create_tables();
echo("success5");
?>
