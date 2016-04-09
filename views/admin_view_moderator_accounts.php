<?php 
require_once 'C:/xampp/htdocs/projects/CS3226/NUSAnswers/php/lib/retrieval.php';
include_once __DIR__ . '/admin_header.php'; ?>
<body>
    <?php include_once __DIR__ . '/admin_navbar.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <?php include_once __DIR__ . '/admin_sidebar.php'; ?>
            <div class="main col-md-9 col-lg-10">
                <div class="top-buffer-20px panel panel-default">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <h4>View Moderator Accounts</h4>
                        </li>
                        <li class="list-group-item">
                            <button type="button" class="btn btn-info"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>
                            <button type="button" class="btn btn-info"><span class="glyphicon glyphicon-trash"></span> Delete</button>
                            <div class="btn-group pull-right">
                                <button type="button" class="btn btn-success btn-filter" data-target="good">Good</button>
                                <button type="button" class="btn btn-warning btn-filter" data-target="suspended">Suspended</button>
                                <button type="button" class="btn btn-danger btn-filter" data-target="deleted">Deleted</button>
                                <button type="button" class="btn btn-default btn-filter" data-target="all">Clear Filter</button>
                            </div>
                        </li>
                        <li class="list-group-item summary-display">
                            <table class="table table-filter">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="ckbox">
                                                <input type="checkbox" id="all-moderators-checkbox">
                                                <label for="all-moderators-checkbox"></label>
                                            </div>
                                        </th>
                                        <th>
                                        </th>
                                        <th>
                                            Moderator Account
                                        </th>
                                    </tr>
                                </thead>
								<tbody>
                                    <?php
                                        $moderator_records = retrieve_all_moderator_records();
                                        foreach ($moderator_records as $moderator_record) {
                                    ?>
                                        <tr data-status="good">
                                            <td>
                                                <div class="ckbox">
                                                    <input id="<?php echo $moderator_record['moderator_id']?>-checkbox" type="checkbox" name="moderator-id[]" value="<?php echo $moderator_record['moderator_id']?>">
                                                    <label for="<?php echo $moderator_record['moderator_id']?>-checkbox"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="javascript:;" class="star">
                                                    <i class="glyphicon glyphicon-star"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <div class="media">
                                                    <a href="#" class="pull-left">
                                                        <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                                                    </a>
                                                    <div class="media-body">                                                        
                                                        <h4 class="title">
                                                            <?php echo $moderator_record['moderator_id']?>                                                            
                                                        </h4>                                     
                                                        <p><?php echo $moderator_record['display_name']?></p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                        }
                                    ?>
								</tbody>
							</table>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include_once __DIR__ . '/admin_scripts.php'; ?>
<script src="../js/admin_table.js"></script>
</html>