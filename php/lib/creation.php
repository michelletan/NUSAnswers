<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/dbaccess.php';

function create_admin_account($admin_id_param, $hashed_password_param, $profile_fk_param) {
    global $db;
    $query = "INSERT INTO admins VALUES('" . $admin_id_param . "', '" . $hashed_password_param . "', " . $profile_fk_param . ");";
    $db->query($query);
}

function create_profile($display_name_param) {
    global $db;
    $query = "INSERT INTO profiles (display_name) VALUES('" . $display_name_param . "');";
    $db->query($query);
    return $db->insert_id;
}

function create_tag($tag_name_param) {
    global $db;
    $query = "INSERT INTO tags (tag_name) VALUES('" . $tag_name_param . "');";
    $db->query($query);
}

?>