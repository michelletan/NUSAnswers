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
                            <h4>View Answer Comments</h4>
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
                                                            <?php echo $answer_comment['comment_id']?>                                                            
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