<?php include_once __DIR__ . '/header.php'; ?>
<body>
    <script src="../js/fb.js"></script>
    <?php include_once __DIR__ . '/navbar.php'; ?>
    <div class="container-fluid center-block">
        <div class="row">
            <?php include_once __DIR__ . '/sidebar.php'; ?>
            <main id="panel">
            <div class="main col-md-6 col-lg-6">
                <h3 class="page-title"><?php if ($user) { echo $user["display_name"]; } else { echo "John Doe"; }?></h3>
                <div class="card">
                  <div class="post-content">
                      <div class="row">
                          <div class="col-md-2 col-lg-2">
                              <img class="img-user img-circle" src="<?php if ($user) { echo $user["image_url"]; } else { echo "/img/profile02.png";}?>" alt="user-profile-pic" class="img-thumbnail"><br>
                          </div>
                          <div class="col-md-10 col-lg-10">
                              <div class="row">
                                  <div class="col-md-1 col-lg-1">
                                  </div>
                                  <div class="col-md-11 col-lg-11">
                                      
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
</body>
</html>
