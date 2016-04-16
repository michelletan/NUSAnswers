<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/dbaccess.php';

// Remember to cascade admin account deletion to the profile of the admin account when using this method
function delete_admin_account($admin_id_param)
{
    if (get_active_role() == USER_ROLE_ADMIN) {
        global $db;
        $id    = $db->escape_string($admin_id_param);
        $query = "DELETE FROM admins WHERE admin_id = '" . $id . "';";
        $db->query($query);
    }
}

function delete_user($user_id_param)
{
    if (get_active_role() == USER_ROLE_ADMIN) {
        global $db;
        $id    = $db->escape_string($user_id_param);
        $query = "DELETE FROM users WHERE user_id = '" . $id . "';";
        $db->query($query);
    }
}

function delete_profile($profile_id_param)
{
    if (get_active_role() == USER_ROLE_ADMIN) {
        global $db;
        $id    = $db->escape_string($profile_id_param);
        $query = "DELETE FROM profiles WHERE profile_id = " . $id . ";";
        $db->query($query);
    }
}

function delete_tag($tag_id_param)
{
    if (get_active_role() == USER_ROLE_ADMIN) {
        global $db;
        $id    = $db->escape_string($tag_id_param);
        $query = "DELETE FROM tags WHERE tag_id = " . $id . ";";
        $db->query($query);
    }
}

function delete_question($question_id_param)
{
    if (get_active_role() == USER_ROLE_ADMIN) {
        global $db;
        $id    = $db->escape_string($question_id_param);
        $query = "DELETE FROM questions WHERE question_id = " . $id . ";";
        $db->query($query);
    }
}

function delete_question_comment($question_comment_id_param)
{
    if (get_active_role() == USER_ROLE_ADMIN) {
        global $db;
        $id    = $db->escape_string($question_comment_id_param);
        $query = "DELETE FROM question_comments WHERE comment_id = " . $id . ";";
        $db->query($query);
    }
}

function delete_answer($answer_id_param)
{
    if (get_active_role() == USER_ROLE_ADMIN) {
        global $db;
        $id    = $db->escape_string($answer_id_param);
        $query = "DELETE FROM answers WHERE answer_id = " . $id . ";";
        $db->query($query);
    }
}

function delete_answer_comment($answer_comment_id_param)
{
    if (get_active_role() == USER_ROLE_ADMIN) {
        global $db;
        $id    = $db->escape_string($answer_comment_id_param);
        $query = "DELETE FROM answer_comments WHERE comment_id = " . $id . ";";
        $db->query($query);
    }
}
?>
