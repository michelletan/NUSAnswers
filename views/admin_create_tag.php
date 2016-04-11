<?php include_once __DIR__ . '/admin_header.php'; ?>
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
                        <li class="list-group-item">
                            <h4>Create Tag</h4>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-6">
                                    <form method="post" action="/api/tag-creation/">
                                        <div class="form-group">
                                            <label for="tag">Tag</label>
                                            <input required type="text" class="form-control" id="tag" placeholder="Tag" name="tag-name">
                                        </div>
                                        <button type="submit" class="btn btn-info">Add Tag</button>
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