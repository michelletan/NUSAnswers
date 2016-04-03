<?php include_once __DIR__ . '/header.php'; ?>
<body>
    <script src="../js/fb.js"></script>
    <?php include_once __DIR__ . '/navbar.php'; ?>
    <div class="container-fluid center-block">
        <div class="row row-offcanvas row-offcanvas-left">
            <?php include_once __DIR__ . '/sidebar.php'; ?>
            <div class="main col-sm-9 col-md-6 col-lg-6">
                <?php
                foreach ($questions as $data) {
                    include __DIR__ . '/question_list_item.php';
                }?>
            </div>
        </div>
    </div>
    <?php include_once __DIR__ . '/footer.php'; ?>
    <script src="../js/home.js"></script>
</body>
</html>
