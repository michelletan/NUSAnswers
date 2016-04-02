<?php include_once __DIR__ . '/user_header.php'; ?>
<body>
    <script src="../js/fb.js"></script>
    <?php include_once __DIR__ . '/user_navbar.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <?php include_once __DIR__ . '/user_sidebar.php'; ?>
            <div class="main col-md-9 col-lg-10">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="todays-stats todays-stats-questions">
                            <div class="row">
                                <div class="col-xs-3 col-md-6 text-center">
                                    <span class="glyphicon glyphicon-question-sign"></span>
                                </div>
                                <div class="col-xs-9 col-md-6 text-center">
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
                    <div class="col-md-6 col-lg-6">
                        <div class="todays-stats todays-stats-answers">
                            <div class="row">
                                <div class="col-xs-3 col-md-6 text-center">
                                    <span class="glyphicon glyphicon-comment"></span>
                                </div>                                
                                <div class="col-xs-9 col-md-6 text-center">
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
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="top-buffer-20px panel panel-default">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h4>Questions and Answers (per month)</h4>
                                </li>
                                <li class="list-group-item summary-display">
                                    <canvas id="summary-canvas"></canvas>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
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
                    <div class="col-lg-6">
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
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../js/jquery-1.12.2.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/metisMenu.min.js"></script>
<script src="../js/Chart.min.js"></script>
<script src="../js/user_dashboard.js"></script>
</html>