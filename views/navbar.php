<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid center-block">
    <div class="row">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="col-md-1 col-lg-1"></div>
    <div class="navbar-header col-sm-1 col-md-2 col-lg-2 text-right">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <img class="navbar-logo" src="/img/logo.png"/>
      <a class="navbar-brand logo pull-right" href="<?php echo APP_HOME_URL; ?>"><span>NUS</span>Answers</a>
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
          <li id="non-login-view" style="display:none"><a href="javascript:login();">Login</a></li>
          <li class="dropdown login-view" style="display:none">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="username">Username<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <?php if ($is_admin) {?><li><a href="#">Admin Dashboard</a></li><?php } ?>
              <li><a href="/user-dashboard">User Dashboard<?php echo $user;?></a></li>
              <li role="separator" class="divider"></li>
              <li><a href="javascript:logout();">Logout</a></li>
            </ul>
          </li>
      </ul>
    </div><!-- /.navbar-collapse -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</nav>
