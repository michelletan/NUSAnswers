<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/dbaccess.php';

function create_admin_account($login_id_param, $hashed_password_param, $profile_fk_param)
{
    if (get_active_role() == USER_ROLE_ADMIN) {
        global $db;
        $id              = $db->escape_string($login_id_param);
        $hashed_password = $db->escape_string($hashed_password_param);
        $profile_fk      = $db->escape_string($profile_fk_param);
        $query           = "INSERT INTO admins (login_id, hashed_password, profile_fk) VALUES('" . $id . "', '" . $hashed_password . "', " . $profile_fk . ");";
        $db->query($query);
    }
}

function create_profile($display_name_param)
{
    if (get_active_role() == USER_ROLE_ADMIN) {
        global $db;
        $display_name = $db->escape_string($display_name_param);
        $query        = "INSERT INTO profiles (display_name) VALUES('" . $display_name . "');";
        $db->query($query);
        return $db->insert_id;
    }
}

function create_tag($tag_name_param)
{
    if (get_active_role() == USER_ROLE_ADMIN) {
        global $db;
        $tag_name = $db->escape_string($tag_name_param);
        $query    = "INSERT INTO tags (tag_name) VALUES('" . $tag_name . "');";
        $db->query($query);
    }
}

?>
