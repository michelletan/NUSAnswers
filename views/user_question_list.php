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
                                    <button type="button" class="btn btn-danger btn-filter" data-target="all" selected>All Questions</button>
                                    <button type="button" class="btn btn-success btn-filter" data-target="all-questions">Without Images</button>
                                    <button type="button" class="btn btn-warning btn-filter" data-target="all-images">With Images</button>
                                </div>
                            </div>
                            <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Edit Question</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form class="ask-form form-horizontal">
                                                <div class="form-group">
                                                    <label for="question-title" class="col-sm-2 control-label">Title</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="question-title" value="[Title]">
                                                    </div> 
                                                </div> 
                                                <div class="form-group"> 
                                                    <label for="question-details" class="col-sm-2 control-label">Details</label> 
                                                    <div class="col-sm-10"> 
                                                        <textarea class="form-control" id="question-details">[Details]</textarea>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="saveQuestionChanges">Save changes</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                            <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Delete Question</h4>
                                        </div>
                                        <div class="modal-body">
                                            Do you want to delete this question?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" id="deleteQuestion">Yes</button>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                            <div class="table-container">
                                <table class="table table-filter" id="questionsAndAnswers">
                                    <tbody>
                                        <?php 
                                            $questions = retrieve_questions_by_user('Curien'); // to be replaced by display name
                                            foreach($questions as $question) {
                                        ?>
                                        <tr data-status="all-questions">
                                            <td>
                                                <div class="media">
                                                    <div class="media-body">
                                                        <span class="media-meta pull-right"><?php echo $question['created_timestamp']; ?></span>
                                                        <h4 class="title">
                                                            <a href="/question/<?php echo $question["friendly_url"]?>" id="title">
                                                                <?php echo $question['title']; ?>
                                                            </a>
                                                            <span class="pull-right questions">(Without Images)</span>
                                                        </h4>
                                                        <p class="summary" id="content">
                                                            <?php 
                                                                echo $question['content'];
                                                            ?>
                                                        </p>
                                                        <span class="glyphicon glyphicon-trash pull-right" id="<?php echo $question['question_id']; ?>" onclick="deleteQuestion(this.id)"></span>
                                                        <span class="glyphicon glyphicon-pencil pull-right" id="<?php echo $question['question_id']; ?>" onclick="editQuestion(this.id, '<?php echo $question['title']; ?>', '<?php echo $question['content']; ?>')"></span>
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