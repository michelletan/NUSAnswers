    <?php include_once __DIR__ . '/user_header.php'; ?>
    <body>
        <script src="../js/fb.js"></script>
        <?php include_once __DIR__ . '/user_navbar.php'; ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-lg-3">
                    <?php include_once __DIR__ . '/user_sidebar.php'; ?>
                </div>
                <section class="content">
                <div class="col-md-8 col-lg-9">
                    <div class="top-buffer-70px panel panel-default">
                        <div class="panel-body">
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger btn-filter" data-target="all" selected>All Answers</button>
                                    <button type="button" class="btn btn-success btn-filter" data-target="all-answers">Without Images</button>
                                    <button type="button" class="btn btn-warning btn-filter" data-target="all-images">With Images</button>
                                </div>
                            </div>
                            <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Edit Answer</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form class="ask-form form-horizontal">
                                                <div class="form-group">
                                                    <label for="question-title" class="col-sm-2 control-label">Title</label>
                                                    <div class="col-sm-10">
                                                        <p id="question-title">[Question Title]</p>
                                                    </div> 
                                                </div> 
                                                <div class="form-group"> 
                                                    <label for="answer-details" class="col-sm-2 control-label">Answer</label> 
                                                    <div class="col-sm-10"> 
                                                        <textarea class="form-control" id="answer-details">[Answer Details]</textarea>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="saveAnswerChanges">Save changes</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                            <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Delete Answer</h4>
                                        </div>
                                        <div class="modal-body">
                                            Do you want to delete this answer?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" id="deleteAnswer">Yes</button>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                            <div class="table-container">
                                <table class="table table-filter" id="questionsAndAnswers">
                                    <tbody>
                                        <?php 
                                            $answers = retrieve_answers_by_user(get_active_profile()); // to be replaced by display name
                                            foreach($answers as $answer) {
                                                $ans = $answer[0];
                                                $ques = $answer[1];
                                        ?>
                                        <?php if($ans["image_url"] == null) { ?>
                                        <tr data-status="all-answers">
                                        <?php } else {?>
                                        <tr data-status="all-images">
                                        <?php } ?>
                                            <td>
                                                <div class="media">
                                                    <div class="media-body">
                                                        <span class="media-meta pull-right"><?php echo $ans['created_timestamp']; ?></span>
                                                        <h4 class="title">
                                                            <a href="/question/<?php echo $ques["friendly_url"]?>" id="title">
                                                                <?php echo $ques['title']; ?>
                                                            </a>
                                                            <?php if($ans["image_url"] == null) ?>
                                                            <span class="pull-right questions">(Without Images)</span>
                                                            <?php } else { ?>
                                                            <span class="pull-right questions">(With Images)</span>
                                                            <?php } ?>
                                                        </h4>
                                                        <p class="summary" id="content">
                                                            <?php 
                                                                echo $ans['content'];
                                                            ?>
                                                        </p>
                                                        <span class="glyphicon glyphicon-trash pull-right" id="<?php echo $ans['answer_id']; ?>" onclick="deleteAnswer(this.id)"></span>
                                                        <span class="glyphicon glyphicon-pencil pull-right" id="<?php echo $ans['answer_id']; ?>" onclick="editAnswer(this.id, '<?php echo $ques['title']; ?>', '<?php echo $ans['content']; ?>')"></span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            </div>
        </div>
    </body> 
    <?php include_once __DIR__ . '/footer.php'; ?>
    <script src="../js/metisMenu.min.js"></script>
    <script src="../js/Chart.min.js"></script>
    <script src="../js/user_details.js"></script>
</html>