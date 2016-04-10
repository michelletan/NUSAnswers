<?php 
require_once 'C:/xampp/htdocs/projects/CS3226/NUSAnswers/php/lib/retrieval.php';
include_once __DIR__ . '/admin_header.php'; 

if (isset($_GET['user-id'])) {
    $user_id = $_GET['user-id'];
    $user = retrieve_user($user_id);
    $user_profile = retrieve_profile($user['profile_fk']);
} else {
    $redirect_address = '/admin_view_users';
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
                        <form method="post" action="/api/user-edit/">
                            <input hidden name="user-id" value="<?php echo $user['user_id']?>">
                            <li class="list-group-item">
                                <h4>Edit User Details</h4>
                            </li>
                            <li class="list-group-item summary-display">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>User ID</label>
                                            <input disabled type="text" class="form-control" id="username" placeholder="Username" name="username" value="<?php echo $user['user_id']?>">
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="role" <?php $user['role'] == 1 ? $checked = "checked" : $checked = ""; echo $checked;?>> Is Moderator?
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <h4>Edit User Profile</h4>
                            </li>
                            <li class="list-group-item summary-display">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Display Name</label>
                                            <input required type="text" class="form-control" id="display-name" placeholder="Display Name" name="display-name" value="<?php echo $user_profile['display_name']?>">
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