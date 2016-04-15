<?php include_once __DIR__ . '/admin_header.php'; ?>
<body>
    <?php include_once __DIR__ . '/admin_navbar.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-lg-3">
                <?php include_once __DIR__ . '/admin_sidebar.php'; ?>
            </div>
            <div class="col-md-8 col-lg-9">
                <div class="row">
                    <div class="top-buffer-40px">
                    <div class="col-md-6 col-lg-3">
                        <div class="todays-stats todays-stats-answers">
                            <div class="row">
                                <div class="col-xs-3 col-md-6">
                                    <span class="glyphicon glyphicon-comment"></span>
                                </div>
                                <div class="col-xs-9 col-md-6 text-right">
                                    <div id="todays-stats-answers-quantity" class="todays-stats-quantity">
                                        <?php echo $answers_quantity?>
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
                                    <div id="todays-stats-questions-quantity" class="todays-stats-quantity">
                                        <?php echo $questions_quantity?>
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
                                    <div id="todays-stats-users-quantity" class="todays-stats-quantity">
                                        <?php echo $users_quantity?>
                                    </div>
                                    <div class="todays-stats-metric">
                                        New users
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="todays-stats todays-stats-upvotes">
                            <div class="row">
                                <div class="col-xs-3 col-md-6">
                                    <span class="glyphicon glyphicon-arrow-up"></span>
                                </div>                                
                                <div class="col-xs-9 col-md-6 text-right">
                                    <div id="todays-stats-upvotes-quantity" class="todays-stats-quantity">
                                        <?php echo $upvotes_quantity?>
                                    </div>
                                    <div class="todays-stats-metric">
                                        Upvotes given
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-9">
                        <div class="row">
                            <div id="summary-column" class="col-lg-12">
                                <ul class="top-buffer-20px list-group">
                                    <li class="list-group-item">
                                        <h4>Answers Summary (Answer/month)</h4>
                                    </li>
                                    <li class="list-group-item summary-display">
                                        <canvas id="summary-canvas"></canvas>
                                    </li>
                                </ul>
                            </div>
                            <!--<div id="summary-breakdown-column" class="top-buffer-20px visible-lg col-lg-4">                                    
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <h4>Summary Breakdown</h4>
                                        <li class="list-group-item summary-display">
                                            <canvas id="summary-breakdown-canvas"></canvas>
                                            <div id="summary-breakdown-legend">
                                            </div>
                                        </li>
                                    </li>
                                </ul>
                            </div>-->
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <h4>Questions</h4>
                                        <canvas id="questions-quick-view-canvas"></canvas>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-4">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <h4>Users</h4>
                                        <canvas id="users-quick-view-canvas"></canvas>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-4">                                
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <h4>Upvotes</h4>
                                        <canvas id="upvotes-quick-view-canvas"></canvas>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <ul class="top-buffer-20px list-group">
                            <li class="list-group-item">
                                <h4>Real-time User Statistics</h4>
                            </li>
                            <li class="list-group-item">
                                <h4>Users Online</h4>
                                <canvas id="real-time-users-online-canvas"></canvas>
                            </li>
                            <li class="list-group-item">
                                <h4>Viewing Answers</h4>
                                <canvas id="real-time-users-viewing-answers-canvas"></canvas>
                            </li>
                            <li class="list-group-item">
                                <h4>Viewing Questions</h4>
                                <canvas id="real-time-users-viewing-questions-canvas"></canvas>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-9">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <h4>Notifications</h4>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include_once __DIR__ . '/admin_scripts.php'; ?>
<script src="../js/Chart.min.js"></script>
<script src="../js/admin.js"></script>
<script src="../js/admin_table.js"></script>
</html>