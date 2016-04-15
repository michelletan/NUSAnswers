<?php include_once __DIR__ . '/user_header.php'; ?>
<body>
    <script src="../js/fb.js"></script>
    <?php include_once __DIR__ . '/user_navbar.php'; ?>
    <div class="container-fluid center-block">
        <div class="row">
            <div class="col-md-4 col-lg-3">
                <?php include_once __DIR__ . '/user_sidebar.php'; ?>
            </div>
            <div class="col-md-8 col-lg-9">
                <div class="row">
                    <div class="col-md-4 col-lg-4">
                        <div class="todays-stats todays-stats-questions">
                            <div class="row">
                                <div class="col-xs-3 col-md-6 text-center">
                                    <span class="glyphicon glyphicon-question-sign"></span>
                                </div>
                                <div class="col-xs-9 col-md-6 text-center">
                                    <div class="todays-stats-quantity">
                                        <?php echo retrieve_question_quantity_user(get_active_profile()); ?>
                                    </div>
                                    <div class="todays-stats-metric">
                                        Questions asked
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="todays-stats todays-stats-answers">
                            <div class="row">
                                <div class="col-xs-3 col-md-6 text-center">
                                    <span class="glyphicon glyphicon-comment"></span>
                                </div>
                                <div class="col-xs-9 col-md-6 text-center">
                                    <div class="todays-stats-quantity">
                                        <?php echo retrieve_answer_quantity_user(get_active_profile()); ?>
                                    </div>
                                    <div class="todays-stats-metric">
                                        Answers given
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="todays-stats todays-stats-comments">
                            <div class="row">
                                <div class="col-xs-3 col-md-6 text-center">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </div>
                                <div class="col-xs-9 col-md-6 text-center">
                                    <div class="todays-stats-quantity">
                                         <?php echo retrieve_comment_quantity_user(get_active_profile()); ?>
                                    </div>
                                    <div class="todays-stats-metric">
                                        Comments given
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="top-buffer-20px panel panel-default">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h4>Questions, Answers and Comments (per month)</h4>
                                </li>
                                <li class="list-group-item summary-display">
                                    <canvas id="summary-canvas"></canvas>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="top-buffer-20px panel panel-default">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h4>Questions (per month)</h4>
                                </li>
                                <li class="list-group-item summary-display">
                                    <canvas id="questions-canvas"></canvas>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="top-buffer-20px panel panel-default">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h4>Answers (per month)</h4>
                                </li>
                                <li class="list-group-item summary-display">
                                    <canvas id="answers-canvas"></canvas>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="top-buffer-20px panel panel-default">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h4>Comments (per month)</h4>
                                </li>
                                <li class="list-group-item summary-display">
                                    <canvas id="comments-canvas"></canvas>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            </main>
        </div>
    </div>
</body>
<?php include_once __DIR__ . '/footer.php'; ?>
<script src="/js/Chart.min.js"></script>
<script src="/js/user_dashboard.js"></script>
</html>
