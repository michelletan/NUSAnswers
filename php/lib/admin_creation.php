<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/dbaccess.php';

function create_admin_account($admin_id_param, $hashed_password_param, $profile_fk_param) {
    global $db;
    $id = $db->escape_string($admin_id_param);
    $hashed_password = $db->escape_string($hashed_password_param);
    $profile_fk = $db->escape_string($profile_fk_param);
    $query = "INSERT INTO admins VALUES('" . $id . "', '" . $hashed_password . "', " . $profile_fk . ");";
    $db->query($query);
}

function create_profile($display_name_param) {
    global $db;
    $display_name = $db->escape_string($display_name_param);
    $query = "INSERT INTO profiles (display_name) VALUES('" . $display_name . "');";
    $db->query($query);
    return $db->insert_id;
}

function create_tag($tag_name_param) {
    global $db;
    $tag_name = $db->escape_string($tag_name_param);
    $query = "INSERT INTO tags (tag_name) VALUES('" . $tag_name . "');";
    $db->query($query);
}

?>