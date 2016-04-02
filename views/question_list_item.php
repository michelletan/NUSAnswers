<div id="<?php echo $data["question_id"]?>" class="question-list-item card">
    <div class="post-header">
        <div class="post-title row center-block">
            <a href="/question/<?php echo $data["question_id"]?>"><?php echo $data["question_title"]?></a>
        </div>
    </div>
    <div class="post-content card-line">
        <?php if ($data["answer_content"]) { ?>
        <div class="row">
            <div class="col-md-10 col-lg-10">
                  <div class="post-answer">
                      <?php echo $data["answer_content"]; ?>
                  </div>
            </div>
            <div class="col-md-2 col-lg-2">
                <div class="row center-block">
                    <div class="post-vote center-block">
                        <div class="center-block text-center">
                            <a><span class="glyphicon glyphicon-chevron-up"></span><a>
                        </div>
                        <div class="post-vote-count text-center">
                            <?php echo $data["answer_vote_count"]?>
                        </div>
                        <div class="center-block text-center">
                            <a><span class="glyphicon glyphicon-chevron-down"></span></a>
                        </div>

                    </div>
                </div>
                <div class="post-user row center-block text-center">
                        <img class="img-user img-circle" src="/img/profile01.png" alt="user-profile-pic" class="img-thumbnail"><br>
                        <a href="/user/<?php echo $data["answer_user_id"]?>"><?php echo $data["answer_user_name"]?></a>
                </div>
            </div>
        </div>
        <div class="post-tags row text-left">
                <div class="col-md-1 col-lg-1">
                    Tags:
                </div>
                <div class="col-md-11 col-lg-11">
                    <a href="">#cors</a>,
                    <a href="">#celc</a>,
                     <a href="">#newstudent</a>,
                      <a href="">#needtoknow</a>,
                      <a href="">#cors</a>,
                      <a href="">#celc</a>,
                       <a href="">#newstudent</a>,
                       <a href="">#cors</a>,
                       <a href="">#celc</a>,
                        <a href="">#newstudent</a>
                </div>
        </div>
        <?php } else { ?>
            <?php echo DEFAULT_NO_ANSWER; ?>
        <?php }?>
    </div>
    <div class="post-footer">
        <div class="row center-block">
            <div class="timestamp col-md-4 col-lg-4">Posted: 2 hours ago</div>
            <?php if ($data["answer_count"] > 0) { ?>
                <a class="btn-view-answers col-md-3 col-lg-3 text-center">View Answers(<?php echo $data["answer_count"]; ?>)</a>
            <?php } else { ?>
                <div class="col-md-3 col-lg-3"></div>
            <?php } ?>
            <?php if ($data["question_comment_count"] > 0) { ?>
                <a class="col-md-3 col-lg-3 text-center">View Comments(<?php echo $data["question_comment_count"]; ?>)</a>
            <?php } else { ?>
                <a class="col-md-3 col-lg-3 text-center">Comment</a>
            <?php } ?>
            <a class="col-md-2 col-lg-2 text-center"><span class="glyphicon glyphicon-share" aria-hidden="true"></span> Share</a>
        </div>
    </div>
</div>
<div class="post-foldout">
    Some answers here!
</div>
