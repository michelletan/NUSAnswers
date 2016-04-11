<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid center-block">
        <div class="row">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header col-sm-12 col-sm-12 col-md-12 col-lg-2">
                <div class="row">
                    <div class="col-xs-1 col-sm-1 hidden-md hidden-lg hidden-xl">
                        <button type="button" id="btn-toggle-menu">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="glyphicon glyphicon-menu-hamburger"></span>
                        </button>
                    </div>
                    <a class="logo pull-right" href="<?php echo APP_HOME_URL; ?>"><img class="navbar-logo" src="/img/logo.png"/><span>NUS</span>Answers</a>
                </div>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="hidden-xs hidden-sm hidden-md">
                <div class= "navbar-left hidden-xs hidden-sm hidden-md col-lg-8 col-xl-8"></div>
                <ul class="nav navbar-nav col-md-2 col-lg-2">
                    <?php if (true) {?>
                    <li><a href="#">Login</a></li>
                    <?php } ?>
                    <?php if (true) {?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Username <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php if ($is_admin) {?>
                            <li><a href="#">Admin Dashboard</a></li>
                            <?php } ?>
                            <li><a href="#">User Dashboard</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Logout</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</nav>
