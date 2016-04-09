<div id="<?php echo $data["question_id"]?>" class="question-list-item card">
    <div class="post-header">
        <div class="post-title row center-block">
            <a href="/question/<?php echo $data["question_friendly_url"]?>"><?php echo $data["question_title"]?></a>
        </div>
    </div>
    <div class="post-content card-line">
        <?php if ($data["question_content"]) { ?>
            <div class="post-content-block card-line">
                <div class="row">
                    <div class="col-md-10 col-lg-10">
                          <div class="post-answer">
                              <?php echo $data["question_content"]; ?>
                          </div>
                    </div>
                    <div class="col-md-2 col-lg-2">
                        <div class="post-user row center-block text-center">
                                <img class="img-user img-circle" src="/img/profile01.png" alt="user-profile-pic" class="img-thumbnail"><br>
                                <a href="/user/<?php echo $data["question_user_id"]?>"><?php echo $data["question_user_name"]?></a>
                        </div>
                    </div>
                </div>
                <div class="post-tags row text-left">
                        <div class="col-md-1 col-lg-1 text-center">
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
        <?php } ?>
        <?php if ($data["answer_content"]) { ?>
        <div class="row center-block">
            <h5>Best Answer</h5>
        </div>
        <div class="row">
            <div class="col-md-2 col-lg-2">
                <div class="post-user row center-block text-center">
                        <img class="img-user img-circle" src="/img/profile01.png" alt="user-profile-pic" class="img-thumbnail"><br>
                        <a href="/user/<?php echo $data["answer_user_id"]?>"><?php echo $data["answer_user_name"]?></a>
                </div>
            </div>
            <div class="col-md-9 col-lg-9">
                  <div class="post-answer">
                      <?php echo $data["answer_content"]; ?>
                  </div>
            </div>
            <div class="col-md-1 col-lg-1">
                <div class="row center-block">
                    <div class="post-vote center-block">
                        <div class="center-block text-center">
                            <a onclick="upvoteAnswer(<?php echo $data['answer_id']?>)"><span class="glyphicon glyphicon-chevron-up"></span><a>
                        </div>
                        <div id="answer-<?php echo $data['answer_id']?>-vote-count" class="post-vote-count text-center">
                            <?php echo $data["answer_vote_count"]?>
                        </div>
                        <div class="center-block text-center">
                            <a onclick="downvoteAnswer(<?php echo $data['answer_id']?>)"><span class="glyphicon glyphicon-chevron-down"></span></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php } else { ?>
        <div class="row center-block">
            <h5>Your Answer</h5>
        </div>
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
        <?php }?>
    </div>
    <div class="post-footer">
        <div class="row center-block">
            <div class="timestamp col-md-4 col-lg-4">Posted: <?php echo $data["question_timestamp"]; ?></div>
            <?php if ($data["answer_count"] > 0) { ?>
                <a href="/question/<?php echo $data["question_friendly_url"]?>" class="btn-view-answers col-md-3 col-lg-3 text-center">View Answers(<?php echo $data["answer_count"]; ?>)</a>
            <?php } else { ?>
                <div class="col-md-3 col-lg-3"></div>
            <?php } ?>
            <?php if ($data["question_comment_count"] > 0) { ?>
                <a class="btn-view-comments col-md-3 col-lg-3 text-center">View Comments(<?php echo $data["question_comment_count"]; ?>)</a>
            <?php } else { ?>
                <a class="btn-view-comments col-md-3 col-lg-3 text-center">Comment</a>
            <?php } ?>
            <a class="col-md-2 col-lg-2 text-center"><span class="glyphicon glyphicon-share" aria-hidden="true"></span> Share</a>
        </div>
    </div>
</div>
<div class="post-foldout">
    
</div>
