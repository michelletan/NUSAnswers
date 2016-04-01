<?php include_once __DIR__ . '/header.php'; ?>
<body>
    <?php include_once __DIR__ . '/navbar.php'; ?>
    <div class="container-fluid center-block">
        <div class="row">
            <?php include_once __DIR__ . '/sidebar.php'; ?>
            <div class="main col-md-6 col-lg-6">
                <h3 class="page-title"><?php if ($data) { echo $data["question_title"]; } else { echo "Default question title"; }?></h3>
                <div class="card">
                    <div class="post-content card-line">
                        <div class="post-details row center-block">
                            <div class="col-md-10 col-lg-10">
                                <?php if ($data) { echo $data["question_details"]; } else { echo "Default question details"; }?>
                            </div>
                            <div class="col-md-2 col-lg-2">
                                <div class="post-user row center-block text-center">
                                        <img class="img-user img-circle" src="/img/profile01.png" alt="user-profile-pic" class="img-thumbnail"><br>
                                        <a href="">John Doe</a>
                                </div>
                            </div>
                        </div>
                        <div class="post-tags row text-left">
                            <div class="col-md-1 col-lg-1">
                                Tags:
                            </div>
                            <div class="col-md-11 col-lg-11">
                                <a href="">#cors</a>,
                                <a href="">#celc</a>,
                                 <a href="">#newstudent</a>,
                                  <a href="">#needtoknow</a>,
                                  <a href="">#cors</a>,
                                  <a href="">#celc</a>,
                                   <a href="">#newstudent</a>,
                                   <a href="">#cors</a>,
                                   <a href="">#celc</a>,
                                    <a href="">#newstudent</a>
                            </div>
                        </div>
                    </div>
                    <div class="post-footer">
                        <div class="row center-block">
                            <div class="timestamp col-md-7 col-lg-7">Posted: 2 hours ago</div>
                            <a class="col-md-3 col-lg-3 text-center">View Comments(10)</a>
                            <a class="col-md-2 col-lg-2 text-center"><span class="glyphicon glyphicon-share" aria-hidden="true"></span> Share</a>
                        </div>
                    </div>
                </div>
                <h4 class="heading">Your Answer</h4>
                <div class="card">
                    <div class="post-content">
                        <div class="row">
                            <div class="answer-user col-sm-2 col-md-2 col-lg-2">
                                <div class="post-user row center-block text-center">
                                    <img class="img-user img-circle" src="/img/profile01.png" alt="user-profile-pic" class="img-thumbnail"><br>
                                    <a href="">John Doe</a>
                                </div>
                            </div>
                          <div class="answer-text-box col-sm-10 col-md-10 col-lg-10">
                            <textarea class="form-control" id="answer-text" placeholder="What's your answer?"></textarea>
                          </div>
                      </div>
                      <div class="row form-group">
                          <label class="col-sm-2 col-md-2 col-lg-2">Image Upload</label>
                          <div class="col-sm-10 col-md-10 col-lg-10">
                            <input type="file" accept="image/*" id="question-file">
                            <p class="help-block">Only images with extension .jpg, .png and .gif are accepted. <br>
                                Please keep your image size under 2MB.</p>
                          </div>
                      </div>    
                      <div class="row center-block text-right">
                          <button type="submit" id="btn-submit-answer" class="btn btn-primary">Answer</button>
                      </div>
                    </div>
                </div>
                <h4 class="heading">Answers (2)</h4>
                <?php include __DIR__ . '/answer_list_item.php'; ?>
                <?php include __DIR__ . '/answer_list_item.php'; ?>
            </div>
        </div>
    </div>
</body>
<?php include_once __DIR__ . '/footer.php'; ?>
