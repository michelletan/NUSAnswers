<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/retrieval.php';
include_once __DIR__ . '/admin_header.php'; 

if (isset($_GET['admin-id'])) {
    $admin_id = $_GET['admin-id'];
    $admin_account = retrieve_admin_account($admin_id);
    $admin_profile = retrieve_profile($admin_account['profile_fk']);
} else {
    $redirect_address = '/admin_view_admin_accounts';
    header('Location: ' . $redirect_address);
}
?>

<body>
    <?php include_once __DIR__ . '/admin_navbar.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-lg-3">
                <?php include_once __DIR__ . '/admin_sidebar.php'; ?>
            </div>
            <div class="col-md-8 col-lg-9">
                <div class="top-buffer-70px panel panel-default">
                    <ul class="list-group">
                        <form method="post" action="/api/admin-edit/">
                            <input hidden name="admin-id" value="<?php echo $admin_account['admin_id']?>">
                            <li class="list-group-item">
                                <h4>Edit Admin Account</h4>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Login ID</label>
                                            <input required type="text" class="form-control" id="login-id" placeholder="Login ID" name="login-id" value="<?php echo $admin_account['login_id']?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="password1">New Password</label>
                                            <input type="password" class="form-control" id="password1" placeholder="Password" name="password1">
                                        </div>
                                        <div class="form-group">
                                            <label for="password2">Re-enter Password</label>
                                            <input type="password" class="form-control" id="password2" placeholder="Re-enter Password" name="password2">
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <h4>Edit Admin Profile</h4>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Display Name</label>
                                            <input required type="text" class="form-control" id="display-name" placeholder="Display Name" name="display-name" value="<?php echo $admin_profile['display_name']?>">
                                        </div>
                                        <button type="submit" class="btn btn-info">Save Changes</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                    </div>
                                </div>
                            </li>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include_once __DIR__ . '/admin_scripts.php'; ?>
</html>