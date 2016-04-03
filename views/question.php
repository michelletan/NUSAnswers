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
                                <?php if ($data) { echo $data["question_content"]; } else { echo "Default question details"; }?>
                            </div>
                            <div class="col-md-2 col-lg-2">
                                <div class="post-user row center-block text-center">
                                        <img class="img-user img-circle" src="/img/profile01.png" alt="user-profile-pic" class="img-thumbnail"><br>
                                        <a href="/user/<?php echo $data["question_user_id"]; ?>"><?php echo $data["question_user_name"]; ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="post-tags row text-left">
                            <div class="col-md-1 col-lg-1">
                                Tags:
                            </div>
                            <div class="col-md-11 col-lg-11">
                                <?php
                                $tags = $data["tags"];
                                $tag_count = count($tags);
                                $count = 0;
                                foreach ($tags as $tag) { ?>
                                    <a href="/tagged/<?php echo $tag; ?>">#<?php echo $tag; if ($count < $tag_count - 1) { echo ', '; } $count++;?></a>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                    <div class="post-footer">
                        <div class="row center-block">
                            <div class="timestamp col-md-7 col-lg-7">Posted: <?php echo $data["question_timestamp"]; ?></div>
                            <?php if ($data["question_comment_count"] > 0) { ?>
                                <a class="col-md-3 col-lg-3 text-center">View Comments(<?php echo $data["question_comment_count"]; ?>)</a>
                            <?php } else { ?>
                                <a class="col-md-3 col-lg-3 text-center">Comment</a>
                            <?php } ?>
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
                      <div class="row center-block text-right">
                          <button type="submit" id="btn-submit-answer" class="btn btn-primary">Answer</button>
                      </div>
                    </div>
                </div>
                <?php if ($data["answers"]) { ?>
                    <h4 class="heading">Answers (<?php echo count($data["answers"]); ?>)</h4>
                    <?php
                    $answers = $data["answers"];
                    for ($i = 0; $i < count($answers); $i++) {
                        $answer = $answers[$i];
                        include __DIR__ . '/answer_list_item.php';
                    }?>
                <?php } else { ?>

                <?php } ?>
            </div>
        </div>
    </div>
    <?php include_once __DIR__ . '/footer.php'; ?>
</body>
</html>
