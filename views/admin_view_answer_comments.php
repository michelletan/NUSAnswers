<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/retrieval.php';
include_once __DIR__ . '/admin_header.php'; ?>
<body>
    <?php include_once __DIR__ . '/admin_navbar.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <?php include_once __DIR__ . '/admin_sidebar.php'; ?>
            <div class="col-md-4 col-lg-3">
                <?php include_once __DIR__ . '/admin_sidebar.php'; ?>
            </div>
            <div class="col-md-8 col-lg-9">
                <div class="top-buffer-70px panel panel-default">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <h4>View Answer Comments</h4>
                        </li>
                        <li class="list-group-item">
                            <a href="" type="button" class="btn btn-info"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
                            <button type="button" class="btn btn-info" onclick="submitAnswerCommentIdsForDeletion()"><span class="glyphicon glyphicon-trash"></span> Delete</button>
                        </li>
                        <li class="list-group-item">
                            <table id="answer-comments-table" class="table table-filter">
                                <form id="answer-comments-form" method="post" action="/api/answer-comment-deletion/">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="ckbox">
                                                    <input type="checkbox" id="all-answer-comments-checkbox">
                                                    <label for="all-answer-comments-checkbox"></label>
                                                </div>
                                            </th>
                                            <th>
                                            </th>
                                            <th>
                                                Answer Comments
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $answer_comments = retrieve_all_answer_comments();
                                            foreach ($answer_comments as $answer_comment) {
                                        ?>
                                            <tr data-status="good">
                                                <td>
                                                    <div class="ckbox">
                                                        <input id="<?php echo $answer_comment['comment_id']?>-checkbox" type="checkbox" name="answer-comment-id[]" value="<?php echo $answer_comment['comment_id']?>">
                                                        <label for="<?php echo $answer_comment['comment_id']?>-checkbox"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="javascript:;" class="star">
                                                        <i class="glyphicon glyphicon-star"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <div class="media">
                                                        <div class="media-body">                                                        
                                                            <h4 class="title">
                                                                <a href="/admin-edit-answer-comment?comment-id=<?php echo $answer_comment['comment_id']?>"><?php echo $answer_comment['comment_id']?></a>
                                                            </h4>                                     
                                                            <p><?php echo $answer_comment['content']?></p>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </form>
							</table>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include_once __DIR__ . '/admin_scripts.php'; ?>
<script src="../js/admin_table.js"></script>
<script src="../js/admin_view_answer_comments.js"></script>
</html>