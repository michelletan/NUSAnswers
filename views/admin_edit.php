<?php
require_once 'C:/xampp/htdocs/projects/CS3226/NUSAnswers/php/lib/update.php';

global $db;
if (isset($_POST['username']) && isset($_POST['admin-id'])) {
    $admin_id = escape_string(trim($_POST['admin-id']));
    $username = escape_string(trim($_POST['username']));
    if ($username !== "") {
        if (isset($_POST['password1']) && isset($_POST['password2']) && $_POST['password1'] !== "" && $_POST['password2'] !== "") {
            $password1 = escape_string(trim($_POST['password1']));
            $password2 = escape_string(trim($_POST['password2']));
            if ($password1 !== "" && $password2 !== "" && $password1 === $password2) {
                $hashed_password = crypt($password1, $password1);
                update_admin_account($admin_id, $username, $hashed_password);
            }
        } else {
            update_admin_id($admin_id, $username);
        }
    }
}
$redirect_address = 'http://localhost/projects/cs3226/nusanswers/views/admin_edit_admin_account.php?admin-id=' . $username;
header('Location: ' . $redirect_address);

// TODO: remove this temp stub
function escape_string($str) {
    return $str;
}

?>