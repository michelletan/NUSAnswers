<!-- Menu for mobile -->
<nav id="mobile-menu" class="affix col-xs-5 col-sm-5 hidden-md hidden-lg hidden-xl">
    <div class="container-fluid center-block">
        <div class="row">
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
        </div>
    </div>
</nav>
<!-- Menu for desktop -->
<div class="hidden-xs hidden-sm hidden-md col-lg-3 col-lg-3">
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
    </div>
</div>
