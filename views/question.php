<?php include_once __DIR__ . '/header.php'; ?>
<body>
    <?php include_once __DIR__ . '/navbar.php'; ?>
    <div class="container-fluid center-block">
        <div class="row">
            <?php include_once __DIR__ . '/sidebar.php'; ?>
            <div class="main col-md-6 col-lg-6">
                <h3 class="page-title"><?php if ($data) { echo $data["question_title"]; } else { echo "Default question title"; }?></h3>
                <div class="panel panel-default">
                  <!-- List group -->
                  <ul class="list-group">
                      <li class="list-group-item">
                          <div class="row center-block">
                              Tags: <a href="">#utown</a>, <a href="">#gym</a>, <a href="">#random</a>, <a href="">#needtoknow</a>
                              <p class="pull-right">Posted: 2 hours ago</p>
                          </div>
                          <div class="row center-block">
                              <?php if ($data) { echo $data["question_details"]; } else { echo "Default question details"; }?>
                          </div>
                          <div class="row">
                              <div class="col-md-2 col-lg-2">
                                  <img class="img-user" src="" alt="user-profile-pic" class="img-thumbnail">
                              </div>
                              <div class="col-md-10 col-lg-10">
                                  <a href=""><h5><?php if ($data) { echo $data["question_owner"]; } else { echo "John Doe"; }?></h5></a>
                              </div>
                          </div>
                      </li>
                      <li class="list-group-item">
                          <div class="row">
                              <div class="col-md-4 col-lg-4"></div>
                              <a class="col-md-3 col-lg-3 text-center"></a>
                              <a class="col-md-3 col-lg-3 text-center">View Comments(10)</a>
                              <a class="col-md-2 col-lg-2 text-center"><span class="glyphicon glyphicon-share" aria-hidden="true"></span> Share</a>
                          </div>
                      </li>
                  </ul>
                </div>
                <h4>Your Answer</h4>
                <div class="panel panel-default">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <form  class="form-horizontal">
                                <div class="form-group">
                                  <div class="col-sm-12">
                                    <textarea class="form-control" id="answer-text" placeholder="What's your answer?"></textarea>
                                  </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-2 col-lg-2">
                                        <img class="img-user" src="" alt="user-profile-pic" class="img-thumbnail">
                                    </div>
                                    <div class="col-md-2 col-lg-2">
                                        <a href=""><h5>John Doe</h5></a>
                                    </div>
                                    <div class="col-sm-offset-6 col-sm-2">
                                        <button type="submit" id="btn-submit-answer" class="btn btn-primary">Answer</button>
                                    </div>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
                <h4>Answers (2)</h4>
                <?php include __DIR__ . '/answer_list_item.php'; ?>
                <?php include __DIR__ . '/answer_list_item.php'; ?>
            </div>
        </div>
    </div>
</body>
<?php include_once __DIR__ . '/footer.php'; ?>
