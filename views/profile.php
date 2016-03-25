<?php include_once __DIR__ . '/header.php'; ?>
<body>
    <?php include_once __DIR__ . '/navbar.php'; ?>
    <div class="container-fluid center-block">
        <div class="row">
            <?php include_once __DIR__ . '/sidebar.php'; ?>
            <div class="main col-md-6 col-lg-6">
                <h3 class="page-title"><?php if ($data) { echo $data["user_name"]; } else { echo "John Doe"; }?></h3>
                <div class="panel panel-default">
                  <!-- List group -->
                  <ul class="list-group">
                      <li class="list-group-item">
                          <div class="row">
                              <div class="col-md-2 col-lg-2">
                                  <img class="img-user" src="" alt="user-profile-pic" class="img-thumbnail">
                              </div>
                              <div class="col-md-10 col-lg-10">
                                  <div class="row">
                                      <div class="col-md-1 col-lg-1">
                                      </div>
                                      <div class="col-md-11 col-lg-11">
                                          <?php if ($data) { echo $data["question_owner"]; } else { echo "John Doe"; }?><br>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </li>
                  </ul>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <h4>Recent Questions</h4>
                        <div class="panel panel-default">
                            <ul>
                                <li><a href="">Question 1</a></li>
                                <li><a href="">Question 2</a></li>
                                <li><a href="">Question 3</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <h4>Recent Answers</h4>
                        <div class="panel panel-default">
                            <ul>
                                <li>Posted an answer on <a href="">Question title</a></li>
                                <li>Posted an answer on <a href="">Question title</a></li>
                                <li>Posted an answer on <a href="">Question title</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include_once __DIR__ . '/footer.php'; ?>
