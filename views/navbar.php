<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid center-block">
        <div class="row">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="col-md-1 col-lg-1"></div>
            <div class="navbar-header col-sm-1 col-md-2 col-lg-2">
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
            <!-- Shown in navbar on desktop -->
            <div class="hidden-xs hidden-sm">
                <form class= "navbar-left col-md-4 col-lg-4 hidden-xs hidden-sm" role="search">
                    <input type="text" id="nav-search-bar" class="form-control" placeholder="Search">
                </form>
                <ul class="nav navbar-nav col-md-2 col-lg-2">
                    <li><a href="/ask/"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Ask</a></li>
                    <li><a href="/answer/"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Answer</a></li>
                </ul>
                <ul class="nav navbar-nav col-md-2 col-lg-2">
                    <li id="non-login-view" style="display:none"><a href="javascript:login();"><?php $is_logged_in = false; ?>Login</a></li>
                    <li class="dropdown login-view" style="display:none">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="username"><?php $is_logged_in = true; ?>Username <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php if ($is_admin) {?>
                            <li><a href="#">Admin Dashboard</a></li>
                            <?php } ?>
                            <li><a href="/user-dashboard">User Dashboard</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="javascript:logout();">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- end Shown in navbar on desktop -->
        </div>
        <!-- /.row -->
        <nav id="mobile-menu" class="col-xs-3 col-sm-3 col-md-3">
            <div class="col-md-10 col-lg-10">
                <div class="card">
                    <div class="sidebar-body">
                        <form class= "navbar-left col-xs-12 col-sm-12 col-md-4 col-lg-4" role="search">
                            <input type="text" id="nav-search-bar" class="form-control" placeholder="Search">
                        </form>
                        <a href="/ask/"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Ask</a><br>
                        <a href="/answer/"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Answer</a><br>
                    </div>
                </div>
                <div class="card">
                    <div class="sidebar-title">Questions</div>
                    <div class="sidebar-body">
                        <a href="/popular-questions/">Popular</a><br>
                        <a href="/new-questions/">New</a><br>
                        <a class="login-view" style="display:none">My Questions</a>
                    </div>
                </div>
                <div class="card">
                    <div class="sidebar-title">Answers</div>
                    <div class="sidebar-body">
                        <a href="/popular-answers/">Popular</a><br>
                        <a href="/new-answers/">New</a><br>
                        <a class="login-view" style="display:none">My Answers</a>
                    </div>
                </div>
                <div class="card">
                    <div class="sidebar-title">Tags</div>
                    <div class="sidebar-body">
                        <?php
                        $tags = retrieve_tag_names(SIDEBAR_TAG_NUMBER);
                        foreach ($tags as $tag) { ?>
                            <a href="/tagged/<?php echo $tag["tag_name"]; ?>/">#<?php echo $tag["tag_name"]; ?></a>
                        <?php }?>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</nav>
