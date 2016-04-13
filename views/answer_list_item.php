<div id="<?php echo $answer["answer_id"]; ?>" class="answer-list-item card">
    <div class="post-content card-line">
        <div class="row">
            <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                  <div class="post-answer">
                      <?php echo $answer["content"]; ?>
                  </div>
            </div>
            <div class="col-xs-6 hidden-sm hidden-md hidden-lg hidden-xl post-user row center-block text-center">
                <div class="col-xs-7">
                    <img class="img-user img-circle" src="/img/profile01.png" alt="user-profile-pic" class="img-thumbnail"><br>
                </div>
                <a class="col-xs-5" href="/user/<?php echo $answer["user"]["user_id"]; ?>"><?php echo $answer["user"]["display_name"]; ?></a>
            </div>
            <div class="col-xs-6 col-sm-2 col-md-2 col-lg-2">
                <div class="row center-block">
                    <div class="post-vote center-block">
                        <div class="post-vote-up center-block text-center">
                            <a onclick="upvoteAnswer(<?php echo $answer['answer_id']?>)"><span class="glyphicon glyphicon-chevron-up"></span></a>
                        </div>
                        <div id="answer-<?php echo $answer['answer_id']?>-vote-count" class="post-vote-count text-center">
                            <?php if ($answer["vote_count"]) { echo $answer["vote_count"]; } else { echo 0; }?>
                        </div>
                        <div class="post-vote-down center-block text-center">
                            <a onclick="downvoteAnswer(<?php echo $answer['answer_id']?>)"><span class="glyphicon glyphicon-chevron-down"></span></a>
                        </div>

                    </div>
                </div>
                <div class="hidden-xs post-user row center-block text-center">
                        <img class="img-user img-circle" src="<?php echo $answer["user"]["image_url"]; ?>" alt="user-profile-pic" class="img-thumbnail"><br>
                        <a href="/user/<?php echo $answer["user"]["user_id"]; ?>"><?php echo $answer["user"]["display_name"]; ?></a>
                </div>
            </div>
        </div>
    </div>
    <div class="post-footer">
        <div class="row center-block">
            <div class="timestamp col-xs-12 col-sm-3 col-md-7 col-lg-7">Posted: <?php echo $answer["created_date"]; ?></div>
            <div class="hidden-xs col-sm-3 col-md-3 col-lg-3"></div>
            <a class="btn-view-comments col-xs-6 col-sm-3 col-md-3 col-lg-3 text-center"><?php echo "Comments (" . $answer["comment_count"] . ")";?></a>
            <a class="col-xs-6 col-sm-3 col-md-2 col-lg-2 text-center" onclick="share('/question/<?php echo $data["question_friendly_url"]?>')" id="share"><span class="glyphicon glyphicon-share" aria-hidden="true"></span> Share</a>
        </div>
    </div>
</div>
<div class="post-foldout">

</div>
