<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/retrieval.php';
include_once __DIR__ . '/user_header.php'; ?>
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
                            <h4>View Questions</h4>
                        </li>
                        <li class="list-group-item">
                            <a href="" type="button" class="btn btn-info"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
                            <button type="button" class="btn btn-info" onclick="submitQuestionIdsForDeletion()"><span class="glyphicon glyphicon-trash"></span> Delete</button>
                        </li>
                        <li class="list-group-item">
                            <table id="questions-table" class="table table-filter">
                                <form id="questions-form" method="post" action="/api/user-question-deletion/">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="ckbox">
                                                    <input type="checkbox" id="all-questions-checkbox">
                                                    <label for="all-questions-checkbox"></label>
                                                </div>
                                            </th>
                                            <th>
                                                Question
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $questions = retrieve_questions_by_user(get_active_profile()); 
                                            foreach($questions as $question) {
                                        ?>
                                            <tr data-status="good">
                                                <td>
                                                    <div class="ckbox">
                                                        <input id="<?php echo $question['question_id']?>-checkbox" type="checkbox" name="question-id[]" value="<?php echo $question['question_id']?>">
                                                        <label for="<?php echo $question['question_id']?>-checkbox"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="media">
                                                        <div class="media-body">                                                        
                                                            <h4 class="title">
                                                                <a href="/user-edit-question?question-id=<?php echo $question['question_id']?>" ><?php echo $question['title']?></a>
                                                            </h4>                                     
                                                            <p><?php echo $question['content']?></p>
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
<?php include_once __DIR__ . '/footer.php'; ?>
<script src="/js/Chart.min.js"></script>
<script src="/js/user_table.js"></script>
<script src="/js/user_view_questions.js"></script>
</html>