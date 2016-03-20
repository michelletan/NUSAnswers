<?php
session_start();
// if (isset($_SESSION["userRole"])) {
    $is_logged_in = true;
    $is_admin = $_SESSION["user_role"] == USER_ROLE_ADMIN;
// }
?>
