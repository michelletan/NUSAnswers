<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid center-block">
        <div class="row">
            <input type="hidden" id="is-logged-in" value="<?php echo is_logged_in();?>" />
            <input type="hidden" id="has-admin-rights" value="<?php echo has_admin_rights();?>" />
            <input type="hidden" id="has_mod_rights" value="<?php echo has_mod_rights();?>" />
            <input type="hidden" id="user-display-name" value="<?php echo get_active_display_name();?>" />
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
            <div class="hidden-xs hidden-sm col-md-1 col-lg-1 col-xl-1"></div>
            <!-- Shown in navbar on desktop -->
            <div class="hidden-xs hidden-sm hidden-md">
                <form method="get" action="/search" class= "navbar-left col-md-4 col-lg-4 hidden-xs hidden-sm" role="search">
                    <input type="text" id="nav-search-bar" class="form-control" placeholder="Search" name="q">
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
    </div>
</nav>
