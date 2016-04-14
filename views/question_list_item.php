<div class="question-list-item">
    <div id="<?php echo $question["question_id"]?>" class="card">
        <div class="post-content card-line">
            <div class="post-title row center-block">
                <a href="/question/<?php echo $question["friendly_url"]?>"><?php echo $question["title"]?></a>
            </div>
            <div class="post-subtitle row">
                <div class="col-xs-12 col-sm-9 col-md-8 col-lg-9 col-xl-9">
                    By <img class="img-user img-circle" src="<?php echo $question["user"]["image_url"]; ?>" alt="user-profile-pic" class="img-thumbnail">
                    <a href="/user/<?php echo $question["user"]["profile_id"]?>"><?php echo $question["user"]["display_name"]?></a>
                    <div class="timestamp"><?php echo $question["created_date"]; ?></div>
                </div>
                <!-- <a class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 text-center" onclick="share('/question/<?php echo $question["friendly_url"]?>')" id="share"><span class="glyphicon glyphicon-share" aria-hidden="true"></span> Share</a> -->
                <div class="share-buttons col-xs-12 col-sm-3 col-md-4 col-lg-3 col-xl-3"></div>
            </div>
            <?php if ($question["content"]) { ?>
                <div class="post-content-block card-line">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                              <div class="post-question-content post-answer">
                                  <?php echo $question["content"];
                                  if($question["image_url"] != NULL) {echo '<br><img class="post-content-image col-md-11 col-lg-11" src="'. $question["image_url"] . '"alt="question-img">';}
                                  ?>
                              </div>
                        </div>
                    </div>
                    <div class="post-tags row text-left">
                            <div class="col-xs-2 col-sm-1 col-md-1 col-lg-1 text-center">
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
            <?php } ?>
            <?php if ($answer["content"]) { ?>
            <div class="row center-block">
                <h5>Best Answer</h5>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-11 col-md-11 col-lg-11">
                      <div class="post-answer">
                          <?php echo $answer["content"]; ?>
                      </div>
                </div>
                <div class="hidden-xs col-sm-1 col-md-1 col-lg-1">
                    <div class="row center-block">
                        <div class="post-vote center-block">
                            <div class="center-block text-center">
                                <a onclick="upvoteAnswer(<?php echo $answer['answer_id']?>)"><span class="glyphicon glyphicon-chevron-up"></span></a>
                            </div>
                            <div id="answer-<?php echo $answer['answer_id']?>-vote-count" class="post-vote-count text-center">
                                <?php if ($answer["vote_count"]) { echo $answer["vote_count"]; } else { echo 0; }?>
                            </div>
                            <div class="center-block text-center">
                                <a onclick="downvoteAnswer(<?php echo $answer['answer_id']?>)"><span class="glyphicon glyphicon-chevron-down"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="post-subtitle row">
                <div class="col-xs-8 col-sm-6 col-md-6 col-lg-9 col-xl-9">
                    By <img class="img-user img-circle" src="<?php echo $answer["user"]["image_url"]; ?>" alt="user-profile-pic" class="img-thumbnail">
                    <a href="/user/<?php echo $answer["user"]["profile_id"]?>"><?php echo $answer["user"]["display_name"]?></a>
                </div>
                <div class="col-xs-4 hidden-sm hidden-md hidden-lg hidden-xl">
                    <div class="row center-block">
                        <div class="post-vote center-block">
                            <div class="center-block text-center">
                                <a onclick="upvoteAnswer(<?php echo $answer['answer_id']?>)"><span class="glyphicon glyphicon-chevron-up"></span></a>
                            </div>
                            <div id="answer-<?php echo $answer['answer_id']?>-vote-count" class="post-vote-count text-center">
                                <?php if ($answer["vote_count"]) { echo $answer["vote_count"]; } else { echo 0; }?>
                            </div>
                            <div class="center-block text-center">
                                <a onclick="downvoteAnswer(<?php echo $answer['answer_id']?>)"><span class="glyphicon glyphicon-chevron-down"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } else if (is_logged_in()) { ?>
            <div class="row center-block">
                <h5>Your Answer</h5>
            </div>
            <div class="row center-block">
              <div class="answer-text-box">
                <textarea class="form-control" id="<?php echo $question["question_id"]?>-answer-text" placeholder="What's your answer?"></textarea>
              </div>
          </div>
          <div class="row center-block text-right">
              <input type="hidden" id="<?php echo $question["question_id"]?>-question-friendly-url" value="<?php echo $question['friendly_url'];?>">
              <button type="submit" id="<?php echo $question["question_id"]?>-btn-submit-answer" class="btn btn-primary answer-button">Answer</button>
          </div>
          <?php } else {?>
              <div class="row center-block no-content">
                  Please login to answer questions.
              </div>
          <?php } ?>
        </div>
        <div class="post-footer">
            <div class="row center-block">
                <div class="hidden-xs col-sm-6 col-md-6 col-lg-6"></div>
                <?php if ($question["answer_count"] > 0) { ?>
                    <a href="/question/<?php echo $question["friendly_url"]?>" class="btn-view-answers col-xs-6 col-sm-3 col-md-3 col-lg-3 text-center">Answers (<?php echo $question["answer_count"]; ?>)</a>
                <?php } else { ?>
                    <div class="hidden-xs hidden-sm col-md-3 col-lg-3"></div>
                <?php } ?>
                <a class="btn-view-comments col-xs-6 col-sm-3 col-md-3 col-lg-3 text-center"><?php echo "Comments (" . $question["comment_count"] . ")";?></a>
            </div>
        </div>
    </div>
    <div class="post-foldout" style="display:none;">

    </div>
</div>
