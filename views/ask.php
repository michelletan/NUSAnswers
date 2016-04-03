<?php include_once __DIR__ . '/header.php'; ?>
<body>
    <?php include_once __DIR__ . '/navbar.php'; ?>
    <div class="container-fluid center-block">
        <div class="row">
            <?php include_once __DIR__ . '/sidebar.php'; ?>
            <div class="main col-md-6 col-lg-6">
                <h3 class="page-title">Post Your Question</h3>
                <div class="card">
                    <div class="post-content">
                        <form class="ask-form form-horizontal">
                          <div class="form-group">
                            <label for="question-title" class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="question-title" placeholder="What do you want to ask?">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="question-details" class="col-sm-2 control-label">Details</label>
                            <div class="col-sm-10">
                              <textarea class="form-control" id="question-details" placeholder="Any extra details?"></textarea>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="question-file" class="col-sm-2 control-label">Image</label>
                            <div class="col-sm-10">
                                <input type="file" id="question-file">
                                <p class="help-block">Only images with extension .jpg, .png and .gif are accepted. <br>
                                    Please keep your image size under 2MB.</p>
                            </div>
                          </div>
                          <!-- AREA FOR CAPTCHA -->
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                              <div class="checkbox">
                                <label>
                                  <input type="checkbox"> I'm human!
                                </label>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="text-right col-sm-offset-10 col-sm-2">
                              <button type="submit" id="btn-submit-question" class="btn btn-primary">Post</button>
                            </div>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once __DIR__ . '/footer.php'; ?>
</body>
</html>
