<?php include_once __DIR__ . '/header.php'; ?>
<script type="text/javascript" src="//api.filestackapi.com/filestack.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<body>
    <?php include_once __DIR__ . '/navbar.php'; ?>

    <div class="container-fluid center-block">
        <div class="row">
            <?php include_once __DIR__ . '/sidebar.php'; ?>
            <main id="panel">
            <div class="main col-md-6 col-lg-6">
                <h3 class="page-title">Post Your Question</h3>
                <div class="card">
                    <div class="post-content">
                        <div class="ask-form form-horizontal" enctype="multipart/form-data"> 
                          <div class="form-group">
                            <label for="question-title" class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="question-title" id="question-title" placeholder="What do you want to ask?">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="question-details" class="col-sm-2 control-label">Details</label>
                            <div class="col-sm-10">
                              <textarea class="form-control" name="question-details" id="question-details" placeholder="Any extra details?"></textarea>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="question-tags" class="col-sm-2 control-label">Tags</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="question-tags" placeholder="Type to find an existing tag, or press enter to create a new one!" />
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="question-file" class="col-sm-2 control-label">Image</label>
                            <div class="col-sm-10">
                                <!-- <input type="file" accept="image/*" name="question-file" id="question-file">
                                <p class="help-block">Only images with extension .jpg, .png and .gif are accepted. <br>
                                    Please keep your image size under 2MB.</p> -->
                              <input type="filepicker-dragdrop" data-fp-button-class="btn btn-primary" data-fp-apikey="Ag47cAGj4Td2gqU2gOyrLz" data-fp-button-text="Choose image" data-fp-mimetype="image/*" data-fp-mimetypeonchange="alert(event.fpfile.url)">    
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                              <div class="g-recaptcha" data-sitekey="6LfDtxsTAAAAALv8le3isdOYbxzMRYr-4GwrLJDg" data-callback="enableSubmit"></div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-8" >
                                <!-- For posting success/failure -->
                            </div>
                            <div class="text-right col-sm-offset-10 col-sm-2">
                              <button type="submit" id="btn-submit-question" onclick="postQuestion()" class="btn btn-primary">Post</button>
                            </div>
                          </div>
                        </div> <!-- originally end of form -->
                        <div class="post-answer">          
                        </div>
                    </div>
                </div>
            </div>
            </main>
        </div>
    </div>

    <?php include_once __DIR__ . '/footer.php'; ?>
    <script src="../js/ask.js"></script>
</body>
</html>

