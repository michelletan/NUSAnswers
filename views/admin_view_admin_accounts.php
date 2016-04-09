<?php 
require_once 'C:/xampp/htdocs/projects/CS3226/NUSAnswers/php/lib/retrieval.php';
include_once __DIR__ . '/admin_header.php'; 
?>
<body>
    <?php include_once __DIR__ . '/admin_navbar.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <?php include_once __DIR__ . '/admin_sidebar.php'; ?>
            <div class="main col-md-9 col-lg-10">
                <div class="top-buffer-20px panel panel-default">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <h4>View Admin Accounts</h4>
                        </li>
                        <li class="list-group-item">
                            <button type="button" class="btn btn-info"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>
                            <button type="button" class="btn btn-info" onclick="submitAdminIdsForDeletion()"><span class="glyphicon glyphicon-trash"></span> Delete</button>
                            <div class="btn-group pull-right">
                                <button type="button" class="btn btn-success btn-filter" data-target="good">Good</button>
                                <button type="button" class="btn btn-warning btn-filter" data-target="suspended">Suspended</button>
                                <button type="button" class="btn btn-danger btn-filter" data-target="deleted">Deleted</button>
                                <button type="button" class="btn btn-default btn-filter" data-target="all">Clear Filter</button>
                            </div>
                        </li>
                        <li class="list-group-item summary-display">
                            <table id="admin-accounts-table" class="table table-filter">
                                <form id="admin-accounts-form" method="post" action="/api/admin-deletion/">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="ckbox">
                                                    <input type="checkbox" id="all-accounts-checkbox">
                                                    <label for="all-accounts-checkbox"></label>
                                                </div>
                                            </th>
                                            <th>
                                            </th>
                                            <th>
                                                Admin Account
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $admin_records = retrieve_all_admin_records();
                                            foreach ($admin_records as $admin_record) {
                                        ?>
                                            <tr data-status="good">
                                                <td>
                                                    <div class="ckbox">
                                                        <input id="<?php echo $admin_record['admin_id']?>-checkbox" type="checkbox" name="admin-id[]" value="<?php echo $admin_record['admin_id']?>">
                                                        <label for="<?php echo $admin_record['admin_id']?>-checkbox"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="javascript:;" class="star">
                                                        <i class="glyphicon glyphicon-star"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <div class="media">
                                                        <div class="media-body">                                                        
                                                            <h4 class="title">
                                                                <a href="/admin-edit-admin-account?admin-id=<?php echo $admin_record['admin_id']?>"><?php echo $admin_record['admin_id']?></a>
                                                            </h4>                                     
                                                            <p><?php echo $admin_record['display_name']?></p>
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
<script src="../js/admin_view_admin_accounts.js"></script>
</html>