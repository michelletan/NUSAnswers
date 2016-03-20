<?php
session_start();
// if (isset($_SESSION["userRole"])) {
    $isLoggedIn = true;
    $isAdmin = $_SESSION["userRole"] == USER_ROLE_ADMIN;
// }
?>
