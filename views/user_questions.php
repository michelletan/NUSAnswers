<?php include_once __DIR__ . '/user_header.php'; ?>
<body>
    <script src="../js/fb.js"></script>
    <?php include_once __DIR__ . '/user_navbar.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <?php include_once __DIR__ . '/user_sidebar.php'; ?>
            <section class="content">
            <div class="col-md-10 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-danger btn-filter" data-target="all" selected>All Questions</button>
                                <button type="button" class="btn btn-success btn-filter" data-target="all-questions">Without Images</button>
                                <button type="button" class="btn btn-warning btn-filter" data-target="all-images">With Images</button>
                            </div>
                        </div>
                        <div class="table-container">
                            <table class="table table-filter">
                                <tbody>
                                    <tr data-status="all-questions">
                                        <td>
                                            <div class="ckbox">
                                                <input type="checkbox" id="checkbox1">
                                                <label for="checkbox1"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="media">
                                                <div class="media-body">
                                                    <span class="media-meta pull-right">Febrero 13, 2016</span>
                                                    <h4 class="title">
                                                        Lorem Impsum
                                                        <span class="pull-right questions">(Without Images)</span>
                                                    </h4>
                                                    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <textarea id="edit-area" class="form-control"></textarea>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                                </div>
                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div><!-- /.modal -->
                                                    <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...
                                                        <a href="#"><span class="glyphicon glyphicon-trash pull-right"></span></a>
                                                        <a href="#" class="question" id="1"><span class="glyphicon glyphicon-pencil pull-right"></span></a> 
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr data-status="all-images">
                                        <td>
                                            <div class="ckbox">
                                                <input type="checkbox" id="checkbox3">
                                                <label for="checkbox3"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="media">
                                                <div class="media-body">
                                                    <span class="media-meta pull-right">Febrero 13, 2016</span>
                                                    <h4 class="title">
                                                        Lorem Impsum
                                                        <span class="pull-right images">(With Images)</span>
                                                    </h4>
                                                    <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...
                                                        <span class="glyphicon glyphicon-trash pull-right"></span>
                                                        <span class="glyphicon glyphicon-pencil pull-right"></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr data-status="all-images">
                                        <td>
                                            <div class="ckbox">
                                                <input type="checkbox" id="checkbox2">
                                                <label for="checkbox2"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="media">
                                                <div class="media-body">
                                                    <span class="media-meta pull-right">Febrero 13, 2016</span>
                                                    <h4 class="title">
                                                        Lorem Impsum
                                                        <span class="pull-right images">(With Images)</span>
                                                    </h4>
                                                    <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...
                                                        <span class="glyphicon glyphicon-trash pull-right"></span>
                                                        <span class="glyphicon glyphicon-pencil pull-right"></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr data-status="all-questions">
                                        <td>
                                            <div class="ckbox">
                                                <input type="checkbox" id="checkbox4">
                                                <label for="checkbox4"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="media">
                                                <div class="media-body">
                                                    <span class="media-meta pull-right">Febrero 13, 2016</span>
                                                    <h4 class="title">
                                                        Lorem Impsum
                                                        <span class="pull-right questions">(Without Images)</span>
                                                    </h4>
                                                    <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...
                                                        <span class="glyphicon glyphicon-trash pull-right"></span>
                                                        <span class="glyphicon glyphicon-pencil pull-right"></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr data-status="all-images">
                                        <td>
                                            <div class="ckbox">
                                                <input type="checkbox" id="checkbox5">
                                                <label for="checkbox5"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="media">
                                                <div class="media-body">
                                                    <span class="media-meta pull-right">Febrero 13, 2016</span>
                                                    <h4 class="title">
                                                        Lorem Impsum
                                                        <span class="pull-right images">(With Images)</span>
                                                    </h4>
                                                    <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...
                                                        <span class="glyphicon glyphicon-trash pull-right"></span>
                                                        <span class="glyphicon glyphicon-pencil pull-right"></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
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
<script src="../js/jquery-1.12.2.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/metisMenu.min.js"></script>
<script src="../js/Chart.min.js"></script>
<script src="../js/user_questions.js"></script>
</html>