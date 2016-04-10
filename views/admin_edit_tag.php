<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/retrieval.php';
include_once __DIR__ . '/admin_header.php';

if (isset($_GET['tag-id'])) {
    $tag_id = $_GET['tag-id'];
    $tag = retrieve_tag($tag_id);
} else {
    $redirect_address = 'http://localhost/projects/cs3226/nusanswers/views/admin_view_tags.php';
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
                            <h4>Edit Tag</h4>
                        </li>
                        <li class="list-group-item summary-display">
                            <div class="row">
                                <div class="col-md-6">
                                    <form method="post" action="/api/tag-edit/">
                                        <input hidden name="tag-id" value="<?php echo $tag['tag_id']?>">
                                        <div class="form-group">
                                            <label for="tag">Tag Name</label>
                                            <input required type="text" class="form-control" id="tag" placeholder="Tag" name="tag-name" value="<?php echo $tag['tag_name']?>">
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