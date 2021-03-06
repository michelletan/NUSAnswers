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
           "display_name VARCHAR(128) NOT NULL," .
           "image_url VARCHAR(255) NOT NULL DEFAULT '/img/profile02.png'" .
           ")";
  $db->query($query);
}

function create_user_table () {
  global $db;
  $query = "CREATE TABLE users (" .
           "user_id INTEGER AUTO_INCREMENT PRIMARY KEY," .
           "login_id VARCHAR(128) UNIQUE NOT NULL," .
           "role INTEGER NOT NULL," .
           "profile_fk INTEGER NOT NULL," .
           "FOREIGN KEY(profile_fk) REFERENCES profiles(profile_id)" .
           ")";
  $db->query($query);
}

function create_admin_table () {
  global $db;
  $query = "CREATE TABLE admins (" .
           "admin_id INTEGER AUTO_INCREMENT PRIMARY KEY," .
           "login_id VARCHAR(128) UNIQUE NOT NULL," .
           "hashed_password VARCHAR(256) NOT NULL," .
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
           "title TEXT NOT NULL," .
           "content MEDIUMTEXT NOT NULL," .
           "created_timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP," .
           "views INTEGER NOT NULL DEFAULT 0, " .
           "visible TINYINT NOT NULL DEFAULT 1, " .
           "answers INTEGER NOT NULL DEFAULT 0," .
           "comments INTEGER NOT NULL DEFAULT 0," .
           "friendly_url VARCHAR(255) NOT NULL," .
           "image_url VARCHAR(255) NULL," .
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
           "created_timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP," .
           "visible TINYINT NOT NULL DEFAULT 1, " .
           "votes INTEGER NOT NULL DEFAULT 0," .
           "comments INTEGER NOT NULL DEFAULT 0," .
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
           "created_timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP," .
           "profile_fk INTEGER NOT NULL," .
           "question_fk INTEGER NOT NULL," .
           "parent INTEGER NULL, " .
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
           "created_timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP," .
           "profile_fk INTEGER NOT NULL," .
           "answer_fk INTEGER NOT NULL," .
           "parent INTEGER NULL, " .
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
           "question_fk INTEGER PRIMARY KEY," .
           "image_content LONGBLOB NOT NULL," .
           "FOREIGN KEY(question_fk) REFERENCES questions(question_id) ON DELETE CASCADE" .
           ")";
  $db->query($query);
}

function create_answer_image_table () {
  global $db;
  $query = "CREATE TABLE answer_images (" .
           "answer_fk INTEGER PRIMARY KEY," .
           "image_content LONGBLOB NOT NULL," .
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
           "FOREIGN KEY(tag_fk) REFERENCES tags(tag_id) ON DELETE CASCADE," .
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
  drop_moderator_table();
  drop_user_table();
  drop_profile_table();
}

function drop_profile_table () {
  drop_table_by_name("profiles");
}

// obsolete table
function drop_moderator_table () {
  drop_table_by_name("moderators");
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

function insert_admin() {
    global $db;
    $query = "INSERT INTO profiles (display_name) VALUES ('Admin');";
    $db->query($query);

    $query = "INSERT INTO admins (login_id, hashed_password, profile_fk) VALUES ('admin', 'papAq5PwY/QQM', 1);";
    $db->query($query);
}

function insert_users() {
  global $db;
  $query = "INSERT INTO profiles (profile_id, display_name) VALUES " .
  "(0, 'Anonymous')" .
  ";";
  $db->query($query);
  // $query = "INSERT INTO users (login_id, role, profile_fk) VALUES " .
  // " ('curien', 0, 2)," .
  // " ('goldman', 1, 3)," .
  // " ('catherine', 0, 4)" .
  // ";";
  // $db->query($query);
}

function insert_questions() {
    global $db;
    $query = "INSERT INTO questions(title, content, friendly_url, profile_fk) VALUES ".
    "('Question Title 1', 'I am a new student. Bidding has commenced, but I still have not received notice whether I have passed the QET and whether I am required to allocate part of my schedule to attend compulsory English support modules. What should I do?', 'question-title-1', 1),".
    "('Question Title 2', 'I am a new student. Bidding has commenced, but I still have not received notice whether I have passed the QET and whether I am required to allocate part of my schedule to attend compulsory English support modules. What should I do?', 'question-title-2', 1),".
    "('Question Title 3', 'I am a new student. Bidding has commenced, but I still have not received notice whether I have passed the QET and whether I am required to allocate part of my schedule to attend compulsory English support modules. What should I do?', 'question-title-3', 1),".
    "('Question Title 4', 'I am a new student. Bidding has commenced, but I still have not received notice whether I have passed the QET and whether I am required to allocate part of my schedule to attend compulsory English support modules. What should I do?', 'question-title-4', 1),".
    "('Question Title 5', 'I am a new student. Bidding has commenced, but I still have not received notice whether I have passed the QET and whether I am required to allocate part of my schedule to attend compulsory English support modules. What should I do?', 'question-title-5', 1),".
    "('Question Title 6', 'I am a new student. Bidding has commenced, but I still have not received notice whether I have passed the QET and whether I am required to allocate part of my schedule to attend compulsory English support modules. What should I do?', 'question-title-6', 1),".
    "('Question Title 7', 'I am a new student. Bidding has commenced, but I still have not received notice whether I have passed the QET and whether I am required to allocate part of my schedule to attend compulsory English support modules. What should I do?', 'question-title-7', 1),".
    "('Question Title 8', 'I am a new student. Bidding has commenced, but I still have not received notice whether I have passed the QET and whether I am required to allocate part of my schedule to attend compulsory English support modules. What should I do?', 'question-title-8', 1),".
    "('Question Title 9', 'I am a new student. Bidding has commenced, but I still have not received notice whether I have passed the QET and whether I am required to allocate part of my schedule to attend compulsory English support modules. What should I do?', 'question-title-9', 1),".
    "('Question Title 10', 'I am a new student. Bidding has commenced, but I still have not received notice whether I have passed the QET and whether I am required to allocate part of my schedule to attend compulsory English support modules. What should I do?', 'question-title-10', 1),".
    "('Question Title 11', 'I am a new student. Bidding has commenced, but I still have not received notice whether I have passed the QET and whether I am required to allocate part of my schedule to attend compulsory English support modules. What should I do?', 'question-title-11', 1),".
    "('Question Title 12', 'I am a new student. Bidding has commenced, but I still have not received notice whether I have passed the QET and whether I am required to allocate part of my schedule to attend compulsory English support modules. What should I do?', 'question-title-12', 1),".
    "('Question Title 13', 'I am a new student. Bidding has commenced, but I still have not received notice whether I have passed the QET and whether I am required to allocate part of my schedule to attend compulsory English support modules. What should I do?', 'question-title-13', 1),".
    "('Question Title 14', 'I am a new student. Bidding has commenced, but I still have not received notice whether I have passed the QET and whether I am required to allocate part of my schedule to attend compulsory English support modules. What should I do?', 'question-title-14', 1),".
    "('Question Title 15', 'I am a new student. Bidding has commenced, but I still have not received notice whether I have passed the QET and whether I am required to allocate part of my schedule to attend compulsory English support modules. What should I do?', 'question-title-15', 1),".
    "('Question Title 16', 'I am a new student. Bidding has commenced, but I still have not received notice whether I have passed the QET and whether I am required to allocate part of my schedule to attend compulsory English support modules. What should I do?', 'question-title-16', 1),".
    "('Question Title 17', 'I am a new student. Bidding has commenced, but I still have not received notice whether I have passed the QET and whether I am required to allocate part of my schedule to attend compulsory English support modules. What should I do?', 'question-title-17', 1),".
    "('Question Title 18', 'I am a new student. Bidding has commenced, but I still have not received notice whether I have passed the QET and whether I am required to allocate part of my schedule to attend compulsory English support modules. What should I do?', 'question-title-18', 1),".
    "('Question Title 19', 'I am a new student. Bidding has commenced, but I still have not received notice whether I have passed the QET and whether I am required to allocate part of my schedule to attend compulsory English support modules. What should I do?', 'question-title-19', 1),".
    "('Question Title 20', 'I am a new student. Bidding has commenced, but I still have not received notice whether I have passed the QET and whether I am required to allocate part of my schedule to attend compulsory English support modules. What should I do?', 'question-title-20', 1)".
    ";";
    $db->query($query);
}

function insert_answers() {
    global $db;
    $query = "INSERT INTO answers (content, votes, comments, profile_fk, question_fk) VALUES ".
    "('The Centre for English Language Communication (CELC) will endeavour to release the QET results before the commencement of bidding for faculty and ULR modules by new students. However, in the unforeseen event that the results are not yet available, students should proceed to bid for their faculty and ULR modules on the understanding that priority be given to CELCs English support courses (Basic English Course and English for Academic Purposes Course) if students are required to take them in the current semester when the QET results are subsequently released.', 0, 0, 1, 1),".
    "('The Centre for English Language Communication (CELC) will endeavour to release the QET results before the commencement of bidding for faculty and ULR modules by new students. However, in the unforeseen event that the results are not yet available, students should proceed to bid for their faculty and ULR modules on the understanding that priority be given to CELCs English support courses (Basic English Course and English for Academic Purposes Course) if students are required to take them in the current semester when the QET results are subsequently released.', 1, 0, 1, 1),".
    "('The Centre for English Language Communication (CELC) will endeavour to release the QET results before the commencement of bidding for faculty and ULR modules by new students. However, in the unforeseen event that the results are not yet available, students should proceed to bid for their faculty and ULR modules on the understanding that priority be given to CELCs English support courses (Basic English Course and English for Academic Purposes Course) if students are required to take them in the current semester when the QET results are subsequently released.', 1, 0, 1, 1),".
    "('The Centre for English Language Communication (CELC) will endeavour to release the QET results before the commencement of bidding for faculty and ULR modules by new students. However, in the unforeseen event that the results are not yet available, students should proceed to bid for their faculty and ULR modules on the understanding that priority be given to CELCs English support courses (Basic English Course and English for Academic Purposes Course) if students are required to take them in the current semester when the QET results are subsequently released.', 2, 0, 1, 1),".
    "('The Centre for English Language Communication (CELC) will endeavour to release the QET results before the commencement of bidding for faculty and ULR modules by new students. However, in the unforeseen event that the results are not yet available, students should proceed to bid for their faculty and ULR modules on the understanding that priority be given to CELCs English support courses (Basic English Course and English for Academic Purposes Course) if students are required to take them in the current semester when the QET results are subsequently released.', 0, 0, 1, 2),".
    "('The Centre for English Language Communication (CELC) will endeavour to release the QET results before the commencement of bidding for faculty and ULR modules by new students. However, in the unforeseen event that the results are not yet available, students should proceed to bid for their faculty and ULR modules on the understanding that priority be given to CELCs English support courses (Basic English Course and English for Academic Purposes Course) if students are required to take them in the current semester when the QET results are subsequently released.', 1, 0, 1, 4),".
    "('The Centre for English Language Communication (CELC) will endeavour to release the QET results before the commencement of bidding for faculty and ULR modules by new students. However, in the unforeseen event that the results are not yet available, students should proceed to bid for their faculty and ULR modules on the understanding that priority be given to CELCs English support courses (Basic English Course and English for Academic Purposes Course) if students are required to take them in the current semester when the QET results are subsequently released.', 4, 0, 1, 5),".
    "('The Centre for English Language Communication (CELC) will endeavour to release the QET results before the commencement of bidding for faculty and ULR modules by new students. However, in the unforeseen event that the results are not yet available, students should proceed to bid for their faculty and ULR modules on the understanding that priority be given to CELCs English support courses (Basic English Course and English for Academic Purposes Course) if students are required to take them in the current semester when the QET results are subsequently released.', 1, 0, 1, 6),".
    "('The Centre for English Language Communication (CELC) will endeavour to release the QET results before the commencement of bidding for faculty and ULR modules by new students. However, in the unforeseen event that the results are not yet available, students should proceed to bid for their faculty and ULR modules on the understanding that priority be given to CELCs English support courses (Basic English Course and English for Academic Purposes Course) if students are required to take them in the current semester when the QET results are subsequently released.', 3, 0, 1, 7),".
    "('The Centre for English Language Communication (CELC) will endeavour to release the QET results before the commencement of bidding for faculty and ULR modules by new students. However, in the unforeseen event that the results are not yet available, students should proceed to bid for their faculty and ULR modules on the understanding that priority be given to CELCs English support courses (Basic English Course and English for Academic Purposes Course) if students are required to take them in the current semester when the QET results are subsequently released.', 0, 0, 1, 8),".
    "('The Centre for English Language Communication (CELC) will endeavour to release the QET results before the commencement of bidding for faculty and ULR modules by new students. However, in the unforeseen event that the results are not yet available, students should proceed to bid for their faculty and ULR modules on the understanding that priority be given to CELCs English support courses (Basic English Course and English for Academic Purposes Course) if students are required to take them in the current semester when the QET results are subsequently released.', 0, 0, 1, 10),".
    "('The Centre for English Language Communication (CELC) will endeavour to release the QET results before the commencement of bidding for faculty and ULR modules by new students. However, in the unforeseen event that the results are not yet available, students should proceed to bid for their faculty and ULR modules on the understanding that priority be given to CELCs English support courses (Basic English Course and English for Academic Purposes Course) if students are required to take them in the current semester when the QET results are subsequently released.', -1, 0, 1, 11),".
    "('The Centre for English Language Communication (CELC) will endeavour to release the QET results before the commencement of bidding for faculty and ULR modules by new students. However, in the unforeseen event that the results are not yet available, students should proceed to bid for their faculty and ULR modules on the understanding that priority be given to CELCs English support courses (Basic English Course and English for Academic Purposes Course) if students are required to take them in the current semester when the QET results are subsequently released.', 0, 0, 1, 12)".
    ";";
    $db->query($query);
}

function insert_votes() {
  global $db;
  $query = "INSERT INTO votes (profile_fk, answer_fk, vote_type) VALUES " .
  "(1, 1, 1), " .
  "(1, 2, 1), " .
  "(1, 3, 1), " .
  "(1, 4, 1), " .
  "(1, 5, 1), " .
  "(1, 6, 1), " .
  "(1, 7, 1), " .
  "(1, 8, 1), " .
  "(1, 9, 1), " .
  "(1, 10, 1), " .
  "(2, 2, 1), " .
  "(2, 5, -1), " .
  "(2, 7, 1), " .
  "(2, 9, 1), " .
  "(2, 10, -1), " .
  "(2, 12, -1), " .
  "(3, 1, -1), " .
  "(3, 2, -1), " .
  "(3, 4, 1), " .
  "(3, 7, 1), " .
  "(3, 9, 1), " .
  "(4, 7, 1) " .
  ";";
  $db->query($query);
}

function insert_tags() {
    global $db;
    $query = "INSERT INTO tags (tag_name) ".
            "VALUES('cors'),".
            "('newstudent'),".
            "('admin'),".
            "('needtoknow'),".
            "('random'),".
            "('bidding'),".
            "('help');";
    $db->query($query);
}

function insert_tag_links() {
    global $db;
    $query = "INSERT INTO has_tags (question_fk, tag_fk) ".
            "VALUES(1, 1),".
            "(1, 2),".
            "(1, 3),".
            "(1, 4),".
            "(1, 5),".
            "(1, 6),".
            "(1, 7),".
            "(2, 1),".
            "(2, 2),".
            "(2, 3),".
            "(2, 4),".
            "(2, 5),".
            "(3, 6),".
            "(3, 7),".
            "(4, 2),".
            "(4, 3),".
            "(4, 4),".
            "(4, 5),".
            "(5, 1),".
            "(6, 1),".
            "(7, 1),".
            "(8, 1),".
            "(9, 1),".
            "(10, 2),".
            "(10, 3),".
            "(10, 4),".
            "(10, 5),".
            "(11, 2),".
            "(12, 3),".
            "(13, 4),".
            "(14, 5),".
            "(14, 1);";
    $db->query($query);
}

function insert_question_comments() {
    global $db;
    $query = "INSERT INTO question_comments (content, profile_fk, question_fk) ".
            "VALUES('Hello this is a comment!', 1, 1),".
            "('This is a very looooooooooong looooong looooooooooong loooooooong comment.', 1, 1),".
            "('short', 1, 1),".
            "('FIRST', 1, 2),".
            "('SECOND', 1, 2),".
            "('Good question 1', 1, 3),".
            "('Good question 1', 1, 4),".
            "('Good question 2', 1, 4),".
            "('Good question 1', 1, 5),".
            "('Random question 1', 1, 6),".
            "('Good question 1', 1, 7),".
            "('Bad question 2', 1, 7),".
            "('Good question 3', 1, 7),".
            "('Good question 1', 1, 8),".
            "('Good question 2', 1, 8),".
            "('Good question 3', 1, 8),".
            "('Good question 1', 1, 9),".
            "('Good question 2', 1, 9),".
            "('Good question 1', 1, 11),".
            "('Good question 1', 1, 12),".
            "('Good question 1', 1, 13),".
            "('Good question 1', 1, 14),".
            "('Good question 2', 1, 14),".
            "('Good question 3', 1, 14),".
            "('help', 1, 14);";
    $db->query($query);
}

function insert_answer_comments() {
    global $db;
    $query = "INSERT INTO answer_comments (content, profile_fk, answer_fk) ".
            "VALUES('Hello this is a comment!', 1, 1),".
            "('This is a very looooooooooong looooong looooooooooong loooooooong comment.', 1, 1),".
            "('short', 1, 1),".
            "('FIRST', 1, 2),".
            "('SECOND', 1, 2),".
            "('Good answer 1', 1, 3),".
            "('Good answer 1', 1, 4),".
            "('Good answer 2', 1, 4),".
            "('Good answer 1', 1, 5),".
            "('Random answer', 1, 6),".
            "('Good answer 1', 1, 7),".
            "('Bad answer 2', 1, 7),".
            "('Good answer 3', 1, 7),".
            "('Good answer 1', 1, 8),".
            "('Good answer 2', 1, 8),".
            "('Good answer 3', 1, 8),".
            "('Good answer 1', 1, 9),".
            "('Good answer 2', 1, 9),".
            "('Good answer 1', 1, 11),".
            "('Good answer 1', 1, 12),".
            "('Good answer 1', 1, 13),".
            "('help', 1, 13);";
    $db->query($query);
}

/************************* HELPER METHODS *************************/
function drop_table_by_name($name) {
  global $db;
  $query = "DROP TABLE IF EXISTS " . $name;
  $db->query($query);
}

function setup_test_data() {
    insert_admin();
    insert_users();
    insert_questions();
    insert_answers();
    insert_votes();
    insert_tags();
    insert_tag_links();
    insert_question_comments();
    insert_answer_comments();
}

drop_tables();
create_tables();
setup_test_data();
echo("success");
?>
