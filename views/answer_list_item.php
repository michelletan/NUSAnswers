<div id="<?php echo $answer["answer_id"]; ?>" class="answer-list-item card">
    <div class="post-content card-line">
        <div class="row">
            <div class="col-md-10 col-lg-10">
                  <div class="post-answer">
                      <?php echo $answer["content"]; ?>
                  </div>
            </div>
            <div class="col-md-2 col-lg-2">
                <div class="row center-block">
                    <div class="post-vote center-block">
                        <div class="post-vote-up center-block text-center">
                            <a onclick="upvoteAnswer(<?php echo $answer['answer_id']?>)"><span class="glyphicon glyphicon-chevron-up"></span><a>
                        </div>
                        <div id="answer-<?php echo $answer['answer_id']?>-vote-count" class="post-vote-count text-center">
                            <?php echo $answer["vote_count"]; ?>
                        </div>
                        <div class="post-vote-down center-block text-center">
                            <a onclick="downvoteAnswer(<?php echo $answer['answer_id']?>)"><span class="glyphicon glyphicon-chevron-down"></span></a>
                        </div>

                    </div>
                </div>
                <div class="post-user row center-block text-center">
                        <img class="img-user img-circle" src="/img/profile01.png" alt="user-profile-pic" class="img-thumbnail"><br>
                        <a href="/user/<?php echo $answer["user"]["user_id"]; ?>"><?php echo $answer["user"]["display_name"]; ?></a>
                </div>
            </div>
        </div>
    </div>
    <div class="post-footer">
        <div class="row center-block">
            <div class="timestamp col-md-7 col-lg-7">Posted: <?php echo $answer["created_date"]; ?></div>
            <?php if ($answer["answer_comment_count"] > 0) { ?>
                <a class="btn-view-comments col-md-3 col-lg-3 text-center">View Comments(<?php echo $answer["answer_comment_count"]; ?>)</a>
            <?php } else { ?>
                <a class="btn-view-comments col-md-3 col-lg-3 text-center">Comment</a>
            <?php } ?>
            <a class="col-md-2 col-lg-2 text-center"><span class="glyphicon glyphicon-share" aria-hidden="true"></span> Share</a>
        </div>
    </div>
</div>
<div class="post-foldout">

</div>
