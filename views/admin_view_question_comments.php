<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/retrieval.php';
include_once __DIR__ . '/admin_header.php'; ?>
<body>
    <?php include_once __DIR__ . '/admin_navbar.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <?php include_once __DIR__ . '/admin_sidebar.php'; ?>
            <div class="main col-md-9 col-lg-10">
                <div class="top-buffer-20px panel panel-default">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <h4>View Question Comments</h4>
                        </li>
                        <li class="list-group-item">
                            <a href="" type="button" class="btn btn-info"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
                            <button type="button" class="btn btn-info" onclick="submitQuestionCommentIdsForDeletion()"><span class="glyphicon glyphicon-trash"></span> Delete</button>
                        </li>
                        <li class="list-group-item summary-display">
                            <table id="question-comments-table" class="table table-filter">
                                <form id="question-comments-form" method="post" action="/api/question-comment-deletion/">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="ckbox">
                                                    <input type="checkbox" id="all-question-comments-checkbox">
                                                    <label for="all-question-comments-checkbox"></label>
                                                </div>
                                            </th>
                                            <th>
                                            </th>
                                            <th>
                                                Question Comments
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $question_comments = retrieve_all_question_comments();
                                            foreach ($question_comments as $question_comment) {
                                        ?>
                                            <tr data-status="good">
                                                <td>
                                                    <div class="ckbox">
                                                        <input id="<?php echo $question_comment['comment_id']?>-checkbox" type="checkbox" name="question-comment-id[]" value="<?php echo $question_comment['comment_id']?>">
                                                        <label for="<?php echo $question_comment['comment_id']?>-checkbox"></label>
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
                                                                <a href="/admin-edit-question-comment?comment-id=<?php echo $question_comment['comment_id']?>"><?php echo $question_comment['comment_id']?></a>
                                                            </h4>                                     
                                                            <p><?php echo $question_comment['content']?></p>
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
<script src="../js/admin_view_question_comments.js"></script>
</html>