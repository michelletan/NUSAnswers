<?php include_once __DIR__ . '/header.php'; ?>
<body>
    <script src="../js/fb.js"></script>
    <?php include_once __DIR__ . '/navbar.php'; ?>
    <main id="panel">
    <div class="container-fluid center-block">
        <div class="row row-offcanvas row-offcanvas-left">
            <?php include_once __DIR__ . '/sidebar.php'; ?>
            <div class="main col-sm-9 col-md-6 col-lg-6">
                <h3 class="page-title">Search Results</h3>
                <script>
                  (function() {
                    var cx = '010837751547251209214:sdqremzscyw';
                    var gcse = document.createElement('script');
                    gcse.type = 'text/javascript';
                    gcse.async = true;
                    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
                        '//cse.google.com/cse.js?cx=' + cx;
                    var s = document.getElementsByTagName('script')[0];
                    s.parentNode.insertBefore(gcse, s);
                  })();
                </script>
                <gcse:searchresults-only></gcse:searchresults-only>
            </div>
        </div>

    </div>
    </main>
    <?php include_once __DIR__ . '/footer.php'; ?>
</body>
</html>
