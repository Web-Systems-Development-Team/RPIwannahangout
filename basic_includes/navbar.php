<?php
  
  if (!isset($_SESSION)) {
    session_start();
  }
  

  if (isset($_SESSION['uid'])) {
    //get user from uid
    $q = new UserQuery();
    $user = $q->findPk($_SESSION['uid']);
  }
  

?>

<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <!-- these three spans are decoration for the expand button -->
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/index.php">
        <img alt="Brand" src="../logo-small.png"> RPIWannaHangOut</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="/explore.php">Explore the Site</a></li>

        <?php if (isset($_SESSION['uid']) && $_SESSION['uid'] != '') { ?>
        <li><a href="/events/create.php">Create an Event</a></li>
        <li><a href="/events/list.php">Find an Event</a></li>
          <li><a href="/about.php">About Us</a></li>
        <li><a href="/logout.php">Log Out</a></li>
        <?php } else { ?>
          <li><a href="/about.php">About Us</a></li>
	      <li><a href="/login.php">Log In</a></li>
        <?php } ?>
      </ul>
      <form class="navbar-form navbar-right" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Submit</button>
      </form>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
