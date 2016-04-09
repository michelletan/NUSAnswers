<?php
require_once 'C:/xampp/htdocs/projects/CS3226/NUSAnswers/php/lib/dbaccess.php';

// Remember to cascade admin account deletion to the profile of the admin account when using this method
function delete_admin_account($admin_id_param) {
    global $db;
    $query = "DELETE FROM admins WHERE admin_id = '" . $admin_id_param . "';";
    $db->query($query);    
}

function delete_user($user_id_param) {
    global $db;
    $query = "DELETE FROM users WHERE user_id = '" . $user_id_param . "';";
    $db->query($query);    
}

function delete_profile($profile_id_param) {
    global $db;
    $query = "DELETE FROM profiles WHERE profile_id = " . $profile_id_param . ";";
    $db->query($query);    
}

function delete_tag($tag_id_param) {
    global $db;
    $query = "DELETE FROM tags WHERE tag_id = " . $tag_id_param . ";";
    $db->query($query);    
}

function delete_question($question_id_param) {
    global $db;
    $query = "DELETE FROM questions WHERE question_id = " . $question_id_param . ";";
    $db->query($query); 
}

function delete_question_comment($question_comment_id_param) {
    global $db;
    $query = "DELETE FROM question_comments WHERE comment_id = " . $question_comment_id_param . ";";
    $db->query($query); 
}

function delete_answer($answer_id_param) {
    global $db;
    $query = "DELETE FROM answers WHERE answer_id = " . $answer_id_param . ";";
    $db->query($query); 
}

function delete_answer_comment($answer_comment_id_param) {
    global $db;
    $query = "DELETE FROM answer_comments WHERE comment_id = " . $answer_comment_id_param . ";";
    $db->query($query); 
}
?>