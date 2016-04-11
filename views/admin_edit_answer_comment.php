<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/retrieval.php';
include_once __DIR__ . '/admin_header.php';

if (isset($_GET['comment-id'])) {
    $comment_id = $_GET['comment-id'];
    $answer_comment = retrieve_answer_comment($comment_id);
} else {
    $redirect_address = '/admin-view-answer-comments';
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
                        <li class="list-group-item">
                            <h4>Edit Answer Comment</h4>
                        </li>
                        <li class="list-group-item summary-display">
                            <div class="row">
                                <div class="col-md-6">
                                    <form method="post" action="/api/answer-comment-edit/">
                                        <input hidden name="comment-id" value="<?php echo $answer_comment['comment_id']?>">
                                        <div class="form-group">
                                            <label for="content">Content</label>
                                            <textarea class="form-control" id="content" placeholder="Content" name="content"><?php echo $answer_comment['content']?></textarea>
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