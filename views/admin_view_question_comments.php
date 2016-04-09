<?php 
require_once 'C:/xampp/htdocs/projects/CS3226/NUSAnswers/php/lib/retrieval.php';
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
                            <button type="button" class="btn btn-info"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>
                            <button type="button" class="btn btn-info"><span class="glyphicon glyphicon-trash"></span> Delete</button>
                        </li>
                        <li class="list-group-item summary-display">
                            <table class="table table-filter">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="ckbox">
                                                <input type="checkbox" id="checkbox0">
                                                <label for="checkbox0"></label>
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
                                                            <?php echo $question_comment['comment_id']?>                                                            
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
</html>