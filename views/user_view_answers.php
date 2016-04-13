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
                            <h4>View Answers</h4>
                        </li>
                        <li class="list-group-item">
                            <a href="" type="button" class="btn btn-info"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
                            <button type="button" class="btn btn-info" onclick="submitAnswerIdsForDeletion()"><span class="glyphicon glyphicon-trash"></span> Delete</button>
                        </li>
                        <li class="list-group-item">
                            <table id="answers-table" class="table table-filter">
                                <form id="answers-form" method="post" action="/api/user-answer-deletion/">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="ckbox">
                                                    <input type="checkbox" id="all-answers-checkbox">
                                                    <label for="all-answers-checkbox"></label>
                                                </div>
                                            </th>
                                            <th>
                                                Answer
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            set_active_profile(1);
                                            $answers = retrieve_answers_by_user(get_active_profile());
                                            foreach ($answers as $answer) {
                                        ?>
                                            <tr data-status="good">
                                                <td>
                                                    <div class="ckbox">
                                                        <input id="<?php echo $answer['answer_id']?>-checkbox" type="checkbox" name="answer-id[]" value="<?php echo $answer['answer_id']?>">
                                                        <label for="<?php echo $answer['answer_id']?>-checkbox"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="media">
                                                        <div class="media-body">                                                        
                                                            <h4 class="title">
                                                                <a href="/user-edit-answer?answer-id=<?php echo $answer['answer_id']?>"><?php echo $answer['answer_id']?></a>
                                                            </h4>                                     
                                                            <p><?php echo $answer['content']?></p>
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
<script src="/js/user_table.js"></script>
<script src="/js/user_view_answers.js"></script>
</html>