<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/retrieval.php';
include_once __DIR__ . '/user_header.php';

if (isset($_GET['answer-id'])) {
    $answer_id = $_GET['answer-id'];
    $answer = retrieve_answer_for_user($answer_id);
} else {
    $redirect_address = '/user-view-answers';
    header('Location: ' . $redirect_address);
}
 ?>
<body>
    <?php include_once __DIR__ . '/user_navbar.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-lg-3">
                <?php include_once __DIR__ . '/user_sidebar.php'; ?>
            </div>
            <div class="col-md-8 col-lg-9">
                <div class="top-buffer-70px panel panel-default">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <h4>Edit Answer</h4>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-xs-12">
                                    <form method="post" action="/api/user-answer-edit/">
                                        <input hidden name="answer-id" value="<?php echo $answer['answer_id']?>">
                                        <div class="form-group">
                                            <label for="content">Content</label>
                                            <textarea class="form-control" id="content" placeholder="Content" name="content"><?php echo $answer["content"];?></textarea>
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
<?php include_once __DIR__ . '/footer.php'; ?>
</html>