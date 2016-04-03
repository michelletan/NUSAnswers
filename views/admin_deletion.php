<?php
require_once 'C:/xampp/htdocs/projects/CS3226/NUSAnswers/php/lib/deletion.php';
require_once 'C:/xampp/htdocs/projects/CS3226/NUSAnswers/php/lib/retrieval.php';

// Cascades deletion to profile of admin
global $db;
if (isset($_POST['admin-id'])) {
    foreach ($_POST['admin-id'] as $admin_id) {
        $admin_account = retrieve_admin_account($admin_id);
        delete_profile($admin_account['profile_fk']);
        delete_admin_account($admin_id);
    }
}
$redirect_address = 'http://localhost/projects/cs3226/nusanswers/views/admin_view_admin_accounts.php';
header('Location: ' . $redirect_address);

?>