<?php include_once __DIR__ . '/header.php'; ?>
<body>

    <?php include_once __DIR__ . '/navbar.php'; ?>
    <div class="container-fluid center-block">
        <div class="row">
            <?php include_once __DIR__ . '/sidebar.php'; ?>
            <div class="main col-md-6 col-lg-6">
                <h3 class="page-title">Admin Login</h3>
                <div class="card">
                    <div class="post-content">
                        <form class="form-horizontal" action="/api/login/admin" method="POST">
                          <div class="form-group">
                            <label for="inputLoginID3" class="col-sm-2 control-label">Login ID</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputLoginID3" name="admin-id" placeholder="Login ID">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" id="inputPassword3" name="password" placeholder="Password">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox"> Remember me
                                </label>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                              <button type="submit" class="btn btn-primary">Sign in</button>
                            </div>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once __DIR__ . '/footer.php'; ?>
</body>
</html>
