<?php
require_once 'C:/xampp/htdocs/projects/CS3226/NUSAnswers/php/lib/creation.php';

// Creates an admin profile and an admin account
global $db;
if (isset($_POST['username']) && isset($_POST['password1']) && isset($_POST['password2'])) {
    $username = escape_string(trim($_POST['username']));
    $password1 = escape_string(trim($_POST['password1']));
    $password2 = escape_string(trim($_POST['password2']));
    if ($username !== "" && $password1 !== "" && $password2 !== "" && $password1 === $password2) {
        $profile_fk = create_profile($username);
        $hashed_password = crypt($password1, $password1);
        create_admin_account($username, $hashed_password, 0, $profile_fk);
    }
}
$redirect_address = 'http://localhost/projects/cs3226/nusanswers/views/admin_create_admin_account.php';
header('Location: ' . $redirect_address);

// TODO: remove this temp stub
function escape_string($str) {
    return $str;
}
?>