<?php include_once __DIR__ . '/header.php'; ?>
<body>
    <script src="../js/fb.js"></script>
    <?php include_once __DIR__ . '/navbar.php'; ?>
    <div class="container-fluid center-block">
        <div class="row">
            <?php include_once __DIR__ . '/sidebar.php'; ?>
            <main id="panel">
            <div class="main col-md-6 col-lg-6">
                <h3 class="page-title"><?php if ($question) { echo $question["title"]; } else { echo "Default question title"; }?></h3>
                <div id="<?php if ($question) { echo $question["question_id"]; } ?>" class="card">
                    <div class="post-content card-line">
                        <div class="post-details row center-block">
                            <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                                <?php if ($question) { echo $question["content"]; if($question["image_url"] != NULL) {echo '<br><img class="col-md-11 col-lg-11" src="'. $question["image_url"] . '"alt="question-img">';}} else { echo "Default question details"; }?>
                            </div>
                            <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                                <div class="post-user row center-block text-center">
                                    <div class="col-xs-3 col-sm-12">
                                        <img class="img-user img-circle" src="/img/profile01.png" alt="user-profile-pic" class="img-thumbnail"><br>
                                    </div>
                                    <a class="col-xs-4 col-sm-12" href="/user/<?php echo $question["user"]["user_id"]; ?>"><?php echo $question["user"]["display_name"]; ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="post-tags row text-left">
                            <div class="col-xs-2 col-sm-1 col-md-1 col-lg-1">
                                Tags:
                            </div>
                            <div class="col-xs-10 col-sm-11 col-md-11 col-lg-11">
                                <?php
                                $tags = $data["tags"];
                                $tag_count = count($tags);
                                if ($tag_count == 0) { echo "No tags yet"; }
                                $count = 0;
                                foreach ($tags as $tag) { ?>
                                    <a href="/tagged/<?php echo $tag["tag_name"]; ?>">#<?php echo $tag["tag_name"]; if ($count < $tag_count - 1) { echo ', '; } $count++;?></a>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                    <div class="post-footer">
                        <div class="row center-block">
                            <div class="timestamp col-xs-12 col-sm-3 col-md-4 col-lg-4">Posted: <?php echo $question["created_date"]; ?></div>
                            <div class="hidden-xs col-sm-3 col-md-3 col-lg-3"></div>
                            <a class="btn-view-comments col-xs-6 col-sm-3 col-md-3 col-lg-3 text-center"><?php echo "Comments (" . $question["comment_count"] . ")";?></a>
                            <a class="col-xs-6 col-sm-3 col-md-2 col-lg-2 text-center" onclick="share('/question/<?php echo $question["friendly_url"]?>')" id="share"><span class="glyphicon glyphicon-share" aria-hidden="true"></span> Share</a>
                        </div>
                    </div>
                </div>
                <div class="post-foldout">

                </div>
                <?php if (is_logged_in()) { ?>
                <h4 class="heading">Your Answer</h4>
                <div class="card">
                    <div class="post-content">
                        <form class="form-horizontal" action="/api/answer/submit/question" method="POST">
                            <div class="row center-block">
                                <div class="answer-user col-xs-12 col-sm-2 col-md-2 col-lg-2">
                                    <div class="post-user row center-block text-center">
                                        <div class="col-xs-3">
                                            <img class="img-user img-circle" src="<?php echo get_active_profile_picture() ?>" alt="user-profile-pic" class="img-thumbnail"><br>
                                        </div>
                                        <a class="col-xs-4" href="/user/<?php echo get_active_profile() ?>"><?php echo get_active_display_name(); ?></a>
                                    </div>
                                </div>
                              <div class="answer-text-box col-xs-12 col-sm-10 col-md-10 col-lg-10">
                                <textarea class="form-control" id="answer-text" placeholder="What's your answer?" name="answer-content"></textarea>
                              </div>
                            </div>
                            <div class="row center-block text-right">
                                <input type="hidden" id="question-id-value" name="question-id" value="<?php echo $question['question_id']?>">
                                <input type="hidden" id="question-friendly-url-value" name="question-friendly-url" value="<?php echo $url?>">
                                <button type="submit" id="btn-submit-answer" class="btn btn-primary">Answer</button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php } else { ?>
                <?php } ?>
                <?php if ($answers) { ?>
                    <h4 class="heading">Answers (<?php echo count($answers); ?>)</h4>
                    <?php
                    for ($i = 0; $i < count($answers); $i++) {
                        $answer = $answers[$i];
                        include __DIR__ . '/answer_list_item.php';
                    }?>
                <?php } else { ?>
                <?php } ?>
            </div>
            </main>
        </div>
    </div>
    <?php include_once __DIR__ . '/footer.php'; ?>
    <script src="/js/question.js"></script>
    <script src="/js/vote-ajax.js"></script>
</body>
</html>
