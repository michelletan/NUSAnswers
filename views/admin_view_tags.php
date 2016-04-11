<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/lib/retrieval.php';
include_once __DIR__ . '/admin_header.php'; ?>
<body>
    <?php include_once __DIR__ . '/admin_navbar.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-lg-3">
                <?php include_once __DIR__ . '/admin_sidebar.php'; ?>
            </div>
            <div class="col-md-8 col-lg-9">
                <div class="top-buffer-70px panel panel-default">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <h4>View Tags</h4>
                        </li>
                        <li class="list-group-item">
                            <button type="button" class="btn btn-info"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>
                            <button type="button" class="btn btn-info" onclick="submitTagIdsForDeletion()"><span class="glyphicon glyphicon-trash"></span> Delete</button>
                        </li>
                        <li class="list-group-item summary-display">
                            <table id="tags-table" class="table table-filter">
                                <form id="tags-form" method="post" action="/api/tag-deletion/">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="ckbox">
                                                    <input type="checkbox" id="all-tags-checkbox">
                                                    <label for="all-tags-checkbox"></label>
                                                </div>
                                            </th>
                                            <th>
                                            </th>
                                            <th>
                                                Tags
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $tags = retrieve_all_tags();
                                            foreach ($tags as $tag) {
                                        ?>
                                            <tr data-status="good">
                                                <td>
                                                    <div class="ckbox">
                                                        <input id="<?php echo $tag['tag_id']?>-checkbox" type="checkbox" name="tag-id[]" value="<?php echo $tag['tag_id']?>">
                                                        <label for="<?php echo $tag['tag_id']?>-checkbox"></label>
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
                                                                <a href="/admin-edit-tag?tag-id=<?php echo $tag['tag_id']?>" ><?php echo $tag['tag_name']?></a>
                                                            </h4>                                     
                                                            <p><?php echo $tag['tag_name']?></p>
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
<script src="../js/admin_view_tags.js"></script>
</html>