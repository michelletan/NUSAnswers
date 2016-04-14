<div id="<?php echo $answer["answer_id"]; ?>" class="answer-list-item card">
    <div class="post-content card-line">
        <div class="row">
            <div class="col-xs-12 col-sm-11 col-md-11 col-lg-11">
                  <div class="post-answer">
                      <?php echo $answer["content"]; ?>
                  </div>
            </div>
            <div class="col-xs-6 col-sm-1 col-md-1 col-lg-1">
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
            </div>
        </div>
        <div class="post-subtitle row">
            <div class="col-xs-12 col-sm-9 col-md-8 col-lg-9 col-xl-9">
                By <img class="img-user img-circle" src="<?php echo $answer["user"]["image_url"]; ?>" alt="user-profile-pic" class="img-thumbnail">
                <a href="/user/<?php echo $answer["user"]["profile_id"]?>"><?php echo $answer["user"]["display_name"]?></a>
                <div class="timestamp"><?php echo $answer["created_date"]; ?></div>
            </div>
            <div class="share-buttons col-xs-12 col-sm-3 col-md-4 col-lg-3 col-xl-3"></div>
        </div>
    </div>
    <div class="post-footer">
        <div class="row center-block">
            <div class="hidden-xs col-sm-9 col-md-9 col-lg-9"></div>
            <a class="btn-view-comments col-xs-6 col-sm-3 col-md-3 col-lg-3 text-center"><?php echo "Comments (" . $answer["comment_count"] . ")";?></a>
        </div>
    </div>
</div>
<div class="post-foldout">

</div>
