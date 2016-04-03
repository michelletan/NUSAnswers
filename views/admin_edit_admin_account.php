<?php 
require_once 'C:/xampp/htdocs/projects/CS3226/NUSAnswers/php/lib/retrieval.php';
include_once __DIR__ . '/admin_header.php'; 

if (isset($_GET['admin-id'])) {
    $admin_id = $_GET['admin-id'];
    $admin_account = retrieve_admin_account($admin_id);
} else {
    $redirect_address = 'http://localhost/projects/cs3226/nusanswers/views/admin_view_admin_accounts.php';
    header('Location: ' . $redirect_address);
}
?>

<body>
    <?php include_once __DIR__ . '/admin_navbar.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <?php include_once __DIR__ . '/admin_sidebar.php'; ?>
            <div class="main col-md-9 col-lg-10">
                <div class="top-buffer-20px panel panel-default">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <h4>Edit Admin Account</h4>
                        </li>
                        <li class="list-group-item summary-display">
                            <div class="row">
                                <div class="col-md-6">
                                    <form method="post" action="admin_edit.php">
                                        <input hidden name="admin-id" value="<?php echo $admin_account['admin_id']?>">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input required type="text" class="form-control" id="username" placeholder="Username" name="username" value="<?php echo $admin_account['admin_id']?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="password1">New Password</label>
                                            <input type="password" class="form-control" id="password1" placeholder="Password" name="password1">
                                        </div>
                                        <div class="form-group">
                                            <label for="password2">Re-enter Password</label>
                                            <input type="password" class="form-control" id="password2" placeholder="Re-enter Password" name="password2">
                                        </div>
                                        <button type="submit" class="btn btn-info">Save Changes</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include_once __DIR__ . '/admin_scripts.php'; ?>
</html>