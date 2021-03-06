<!-- Menu for mobile -->
<nav id="mobile-menu" class="affix col-xs-5 col-sm-5 hidden-md hidden-lg hidden-xl">
    <div class="container-fluid center-block">
        <div class="row">
            <div class="col-md-10 col-lg-10">
                <div class="card login-card">
                    <div class="sidebar-body">
                        <?php if(!is_logged_in()) { ?>
                        <div id="non-login-view" class="row center-block">
                            <a href="javascript:login();">Login</a>
                        </div>
                        <?php } else { ?>
                        <div class="row login-card">
                            <div class="post-user row center-block text-center">
                                <div class="col-xs-3 col-sm-12">
                                    <img class="img-user img-circle" src="<?php echo get_active_profile_picture(); ?>" alt="user-profile-pic" class="img-thumbnail"><br>
                                </div>
                                <a class="col-xs-4 col-sm-12" href="/user/<?php echo get_active_profile(); ?>"><?php echo get_active_display_name(); ?></a>
                            </div>
                            <div class="row center-block">
                                <a href="/user-dashboard">User Dashboard</a>
                                <a href="javascript:logout();">Logout</a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
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
                        <a href="/my-questions/" class="login-view" style="display:none">My Questions</a>
                    </div>
                </div>
                <div class="card">
                    <div class="sidebar-title">Answers</div>
                    <div class="sidebar-body">
                        <a href="/popular-answers/">Popular</a><br>
                        <a href="/new-answers/">New</a><br>
                        <a href="/my-answers/" class="login-view" style="display:none">My Answers</a>
                    </div>
                </div>
                <div class="card">
                    <div class="sidebar-title">Tags</div>
                    <div class="sidebar-body">
                        <?php
                        $tags = retrieve_tag_names_with_limit(SIDEBAR_TAG_NUMBER);
                        foreach ($tags as $tag) { ?>
                            <a href="/tagged/<?php echo $tag["tag_name"]; ?>/">#<?php echo $tag["tag_name"]; ?></a>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
<!-- Menu for desktop -->
<div class="hidden-xs hidden-sm col-md-3 col-lg-3 col-lg-3">
</div>
<div class="sidebar affix hidden-xs hidden-sm col-md-3 col-lg-3 col-xl-3">
    <div class="row">
        <div class="col-md-2 col-lg-2">
        </div>
        <div class="sidebar-inner col-md-10 col-lg-10">
            <div class="card">
                <div class="sidebar-title">Questions</div>
                <div class="sidebar-body">
                    <a href="/popular-questions/">Popular</a><br>
                    <a href="/new-questions/">New</a><br>
                    <?php if (is_logged_in()) {?><a href="/my-questions/">My Questions</a><?php } ?>
                </div>
            </div>
            <div class="card">
                <div class="sidebar-title">Answers</div>
                <div class="sidebar-body">
                    <a href="/popular-answers/">Popular</a><br>
                    <a href="/new-answers/">New</a><br>
                    <?php if (is_logged_in()) {?><a href="/my-answers/">My Answers</a><?php } ?>
                </div>
            </div>
            <div class="card">
                <div class="sidebar-title">Tags</div>
                <div class="sidebar-body">
                    <?php
                    $tags = retrieve_tag_names_with_limit(SIDEBAR_TAG_NUMBER);
                    foreach ($tags as $tag) { ?>
                        <a href="/tagged/<?php echo $tag["tag_name"]; ?>/">#<?php echo $tag["tag_name"]; ?></a>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>
