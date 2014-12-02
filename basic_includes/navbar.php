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
      <a class="navbar-brand" href="/RPIWannaHangOut/index.php">RPIWannaHangOut</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="/RPIWannaHangOut/explore.php">Explore</a></li>

        <?php if (isset($_SESSION['uid']) && $_SESSION['uid'] != '') { ?>
        <li id="createLink"><a href="/RPIWannaHangOut/events/create.php">Create Event</a></li>
        <li id="findLink"><a href="/RPIWannaHangOut/events/list.php">Find Event</a></li>
          <li id="aboutLink"><a href="/RPIWannaHangOut/about.php">About</a></li>
        <li><a href="/RPIWannaHangOut/logout.php">Log Out</a></li>
        <li><a>Welcome, <?php echo $user->getFirstName(); ?></a></li>
        <?php } else { ?>
        <li id="findLink"><a href="/RPIWannaHangOut/events/list.php">Find Event</a></li>
        <li id="aboutLink"><a href="/RPIWannaHangOut/about.php">About</a></li>
	      <li><a href="/RPIWannaHangOut/login.php">Log In</a></li>
        <?php } ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
