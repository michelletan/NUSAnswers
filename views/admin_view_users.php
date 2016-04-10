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
                            <h4>View Users</h4>
                        </li>
                        <li class="list-group-item">
                            <a href="" type="button" class="btn btn-info"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
                            <button type="button" class="btn btn-info" onclick="submitUserIdsForDeletion()"><span class="glyphicon glyphicon-trash"></span> Delete</button>
                            <div class="btn-group pull-right">
                                <button type="button" class="btn btn-success btn-filter" data-target="good">Good</button>
                                <button type="button" class="btn btn-warning btn-filter" data-target="suspended">Suspended</button>
                                <button type="button" class="btn btn-danger btn-filter" data-target="deleted">Deleted</button>
                                <button type="button" class="btn btn-default btn-filter" data-target="all">Clear Filter</button>
                            </div>
                        </li>
                        <li class="list-group-item summary-display">
                            <table id="users-table" class="table table-filter">
                                <form id="users-form" method="post" action="/api/user-deletion/">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="ckbox">
                                                    <input type="checkbox" id="all-users-checkbox">
                                                    <label for="all-users-checkbox"></label>
                                                </div>
                                            </th>
                                            <th>
                                            </th>
                                            <th>
                                                User
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $user_records = retrieve_all_user_records();
                                            foreach ($user_records as $user_record) {
                                        ?>
                                            <tr data-status="good">
                                                <td>
                                                    <div class="ckbox">
                                                        <input id="<?php echo $user_record['user_id']?>-checkbox" type="checkbox" name="user-id[]" value="<?php echo $user_record['user_id']?>">
                                                        <label for="<?php echo $user_record['user_id']?>-checkbox"></label>
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
                                                                <?php echo $user_record['user_id']?>                                                            
                                                            </h4>                                     
                                                            <p><?php echo $user_record['display_name']?></p>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </form>
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
<script src="../js/admin_view_users.js"></script>
</html>