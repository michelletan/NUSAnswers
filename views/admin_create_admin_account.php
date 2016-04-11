<?php include_once __DIR__ . '/admin_header.php'; ?>
<body>
    <?php include_once __DIR__ . '/admin_navbar.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <?php include_once __DIR__ . '/admin_sidebar.php'; ?>
            <div class="main col-md-9 col-lg-10">
                <div class="top-buffer-20px panel panel-default">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <h4>Create Admin Account</h4>
                        </li>
                        <li class="list-group-item summary-display">
                            <div class="row">
                                <div class="col-md-6">
                                    <form method="post" action="/api/admin-creation/">
                                        <div class="form-group">
                                            <label for="login-id">Login ID</label>
                                            <input required type="text" class="form-control" id="login-id" placeholder="Login ID" name="login-id">
                                        </div>
                                        <div class="form-group">
                                            <label for="password1">Password</label>
                                            <input required type="password" class="form-control" id="password1" placeholder="Password" name="password1">
                                        </div>
                                        <div class="form-group">
                                            <label for="password2">Re-enter Password</label>
                                            <input required type="password" class="form-control" id="password2" placeholder="Re-enter Password" name="password2">
                                        </div>
                                        <button type="submit" class="btn btn-info">Add Account</button>
                                        <button type="reset" class="btn btn-default">Clear</button>
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