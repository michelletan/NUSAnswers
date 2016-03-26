<?php include_once __DIR__ . '/admin_header.php'; ?>
<body>
    <?php include_once __DIR__ . '/admin_navbar.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <?php include_once __DIR__ . '/admin_sidebar.php'; ?>
            <div class="main col-md-9 col-lg-10">
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="todays-stats todays-stats-answers">
                            <div class="row">
                                <div class="col-xs-3 col-md-6">
                                    <span class="glyphicon glyphicon-comment"></span>
                                </div>
                                <div class="col-xs-9 col-md-6 text-right">
                                    <div class="todays-stats-quantity">
                                        100
                                    </div>
                                    <div class="todays-stats-metric">
                                        Answers given
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="todays-stats todays-stats-questions">
                            <div class="row">
                                <div class="col-xs-3 col-md-6">
                                    <span class="glyphicon glyphicon-question-sign"></span>
                                </div>                                
                                <div class="col-xs-9 col-md-6 text-right">
                                    <div class="todays-stats-quantity">
                                        100
                                    </div>
                                    <div class="todays-stats-metric">
                                        Questions asked
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="todays-stats todays-stats-users">
                            <div class="row">
                                <div class="col-xs-3 col-md-6">
                                    <span class="glyphicon glyphicon-user"></span>
                                </div>
                                <div class="col-xs-9 col-md-6 text-right">
                                    <div class="todays-stats-quantity">
                                        100
                                    </div>
                                    <div class="todays-stats-metric">
                                        New users
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="todays-stats todays-stats-votes">
                            <div class="row">
                                <div class="col-xs-3 col-md-6">
                                    <span class="glyphicon glyphicon-arrow-up"></span>
                                </div>                                
                                <div class="col-xs-9 col-md-6 text-right">
                                    <div class="todays-stats-quantity">
                                        100
                                    </div>
                                    <div class="todays-stats-metric">
                                        Upvotes given
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="top-buffer-20px panel panel-default">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h4>Answers Summary (Answer/month)</h4>
                                </li>
                                <li class="list-group-item summary-display">
                                    <canvas id="summary-canvas"></canvas>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="top-buffer-20px panel panel-default">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h4>Quick View</h4>
                                </li>
                                <li class="list-group-item">
                                    <h4>Answers</h4>
                                    <canvas id="answers-quick-view-canvas"></canvas>
                                </li>
                                <li class="list-group-item">
                                    <h4>Questions</h4>
                                    <canvas id="questions-quick-view-canvas"></canvas>
                                </li>
                                <li class="list-group-item">
                                    <h4>Users</h4>
                                    <canvas id="users-quick-view-canvas"></canvas>
                                </li>
                                <li class="list-group-item">
                                    <h4>Votes</h4>
                                    <canvas id="votes-quick-view-canvas"></canvas>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="top-buffer-20px panel panel-default">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h4>Answers Summary (Answer/month)</h4>
                                </li>
                                <li class="list-group-item summary-display">
                                    <canvas id="summary-canvas"></canvas>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include_once __DIR__ . '/admin_footer.php'; ?>