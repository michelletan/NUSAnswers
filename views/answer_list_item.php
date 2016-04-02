<div class="card">
    <div class="post-content card-line">
        <div class="row">
            <div class="col-md-10 col-lg-10">
                  <div class="post-answer">
                      <?php echo $answer["answer_content"]; ?>
                  </div>
            </div>
            <div class="col-md-2 col-lg-2">
                <div class="row center-block">
                    <div class="post-vote center-block">
                        <div class="post-vote-up center-block text-center">
                            <span class="glyphicon glyphicon-chevron-up"></span>
                        </div>
                        <div class="post-vote-count text-center">
                            <?php echo $answer["answer_vote_count"]; ?>
                        </div>
                        <div class="post-vote-down center-block text-center">
                            <span class="glyphicon glyphicon-chevron-down"></span>
                        </div>

                    </div>
                </div>
                <div class="post-user row center-block text-center">
                        <img class="img-user img-circle" src="/img/profile01.png" alt="user-profile-pic" class="img-thumbnail"><br>
                        <a href="/user/<?php echo $answer["answer_user_id"]; ?>"><?php echo $answer["answer_user_name"]; ?></a>
                </div>
            </div>
            <!-- <div class="post-votes-box col-md-2 col-lg-2 pull-right">
                <a class="block text-success">
                    <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> 103
                </a><br><br>
                <a class="block text-danger">
                    <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span> 9999
                </a>
            </div> -->
        </div>
    </div>
    <div class="post-footer">
        <div class="row center-block">
            <div class="timestamp col-md-7 col-lg-7">Posted: 2 hours ago</div>
            <?php if ($data["question_comment_count"] > 0) { ?>
                <a class="col-md-3 col-lg-3 text-center">View Comments(<?php echo $answer["answer_comment_count"]; ?>)</a>
            <?php } else { ?>
                <a class="col-md-3 col-lg-3 text-center">Comment</a>
            <?php } ?>
            <a class="col-md-2 col-lg-2 text-center"><span class="glyphicon glyphicon-share" aria-hidden="true"></span> Share</a>
        </div>
    </div>
</div>
