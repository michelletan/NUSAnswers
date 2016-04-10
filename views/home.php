<?php include_once __DIR__ . '/header.php'; ?>
<body>
    <script src="../js/fb.js"></script>
    <div class="container-fluid center-block">
        <div class="row">
            <?php include_once __DIR__ . '/navbar.php'; ?>
            <main id="panel" class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <div class="container-fluid center-block">
                <div class="row row-offcanvas row-offcanvas-left">
                    <?php include_once __DIR__ . '/sidebar.php'; ?>
                    <div class="main col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <?php
                        foreach ($questions as $data) {
                            $question = $data["question"];
                            $answer = $data["answer"];
                            // echo var_dump($answer);
                            include __DIR__ . '/question_list_item.php';
                        }?>
                        <?php include_once __DIR__ . '/pagination_bar.php'; ?>
                    </div>
                </div>

            </div>
            </main>
        </div>
    </div>
    <?php include_once __DIR__ . '/footer.php'; ?>
    <script src="../js/home.js"></script>
    <script src="../js/vote-ajax.js"></script>
</body>
</html>
