<?php include_once __DIR__ . '/user_header.php'; ?>
<body>
    <script src="../js/fb.js"></script>
    <?php include_once __DIR__ . '/navbar.php'; ?>
    <div class="container-fluid center-block">
        <div class="row">
            <?php include_once __DIR__ . '/sidebar.php'; ?>
            <main id="panel">
            <div class="main col-md-6 col-lg-6">
                <div class="card">
                    <div class="post-title row center-block">
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-1 col-xl-1">
                            <img class="img-user-profile img-circle" src="<?php if ($user) { echo $user["image_url"]; } else { echo "/img/profile02.png";}?>" alt="user-profile-pic" class="img-thumbnail"><br>
                        </div>
                        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-11 col-xl-11">
                            <h3><?php if ($user) { echo $user["display_name"]; } else { echo "John Doe"; }?></h3>
                        </div>
                    </div>
                  <div class="post-content stats-container">
                          <div class="row">
                              <div class="col-md-4 col-lg-4">
                                  <div class="todays-stats todays-stats-questions">
                                      <div class="row">
                                          <div class="col-xs-3 col-md-6 text-center">
                                              <span class="glyphicon glyphicon-question-sign"></span>
                                          </div>
                                          <div class="col-xs-9 col-md-6 text-center">
                                              <div class="todays-stats-quantity">
                                                  <?php echo retrieve_question_quantity_user($user["profile_id"]); ?>
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
                                                  <?php echo retrieve_answer_quantity_user($user["profile_id"]); ?>
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
                                                   <?php echo retrieve_comment_quantity_user($user["profile_id"]); ?>
                                              </div>
                                              <div class="todays-stats-metric">
                                                  Comments given
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                      </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <h4 class="heading">Recent Questions</h4>
                        <div class="card">
                            <div class="post-content">
                                <ul>
                                    <?php foreach ($questions as $question) { ?>
                                        <li><a href="<?php echo $question["question"]["friendly_url"]; ?>"><?php echo $question["question"]["title"]; ?></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <h4 class="heading">Recent Answers</h4>
                        <div class="card">
                            <div class="post-content">
                                <ul>
                                    <?php foreach ($answers as $answer) { ?>
                                    <li>Posted an answer on <a href="<?php echo $answer["friendly_url"]; ?>"><?php echo $answer["title"]; ?></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </main>
        </div>
    </div>
    <?php include_once __DIR__ . '/footer.php'; ?>
    <script src="/js/Chart.min.js"></script>
</body>
</html>
