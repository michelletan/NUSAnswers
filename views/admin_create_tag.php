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
                            <h4>Create Tag</h4>
                        </li>
                        <li class="list-group-item summary-display">
                            <div class="row">
                                <div class="col-md-6">
                                    <form>
                                        <div class="form-group">
                                            <label for="tag">Tag</label>
                                            <input type="text" class="form-control" id="tag" placeholder="Tag">
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