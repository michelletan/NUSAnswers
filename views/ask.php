<?php include_once __DIR__ . '/header.php'; ?>
<body>
    <!-- Include CAPTCHA script -->
    <script src='https://www.google.com/recaptcha/api.js'></script>

    <?php include_once __DIR__ . '/navbar.php'; ?>
    <div class="container-fluid center-block">
        <div class="row">
            <?php include_once __DIR__ . '/sidebar.php'; ?>
            <div class="main col-md-6 col-lg-6">
                <h3 class="page-title">Post Your Question</h3>
                <div class="card">
                    <div class="post-content">
                        <form class="ask-form form-horizontal" action=""> <!-- TODO -->
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
                                <input type="file" accept="image/*" id="question-file">
                                <p class="help-block">Only images with extension .jpg, .png and .gif are accepted. <br>
                                    Please keep your image size under 2MB.</p>
                            </div>
                          </div>
                          <!-- AREA FOR CAPTCHA -->
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                              <div class="g-recaptcha" data-sitekey="6LfDtxsTAAAAALv8le3isdOYbxzMRYr-4GwrLJDg" data-callback="enableSubmit"></div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-8" id=''>
                                <!-- For posting success/failure -->
                            </div>  
                            <div class="text-right col-sm-offset-10 col-sm-2">
                              <button type="submit" id="btn-submit-question" class="btn btn-primary" >Post</button>
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
<<<<<<< HEAD
=======
<script type="text/javascript">
  document.getElementById("btn-submit-question").disabled = true;
  
  function enableSubmit(){
   document.getElementById("btn-submit-question").disabled = false;
  }
</script>
<?php include_once __DIR__ . '/footer.php'; ?>
=======
>>>>>>> recaptcha-branch
</html>
