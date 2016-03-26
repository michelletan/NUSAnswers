<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid center-block">
    <div class="row">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="col-md-2 col-lg-2"></div>
    <div class="navbar-header col-sm-1 col-md-1 col-lg-1">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand logo" href="<?php echo APP_HOME_URL; ?>"><?php echo APP_TITLE;?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <form class= "navbar-left col-md-4 col-lg-4" role="search">
          <input type="text" id="nav-search-bar" class="form-control" placeholder="Search">
      </form>
      <ul class="nav navbar-nav col-md-2 col-lg-2">
        <li><a href="/ask"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Ask</a></li>
        <li><a href="/answer"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Answer</a></li>
      </ul>
      <ul class="nav navbar-nav col-md-2 col-lg-2">
        <li id="non-login-view" style="display:none"><a href="javascript:login();"><?php $is_logged_in = false; ?>Login</a></li>
        <li class="dropdown login-view" style="display:none">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="username"><?php $is_logged_in = true; ?>Username <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php if ($is_admin) {?><li><a href="#">Admin Dashboard</a></li><?php } ?>
            <li><a href="#">User Dashboard</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="javascript:logout();">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</nav>
