<?php
  
  session_start();

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
        <li class="active"><a href="#">Link</a></li>
        <li><a href="#">Link</a></li>

        
        <?php if (isset($_SESSION['uid']) && $_SESSION['uid'] != '') { ?>
        <li><a href="/RPIWannaHangOut/logout.php">Log Out</a></li>
        <?php } else { ?>
	      <li><a href="/RPIWannaHangOut/login.php">Log In</a></li>
        <?php } ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Forms n' Fun <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="/RPIWannaHangOut/events/create.php">Event Input (real)</a></li>
            <li><a href="/RPIWannaHangOut/events/list.php">Event List (real)</a></li>
            <li class="divider"></li>
            <li><a href="#">Something else here</a></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
        <?php if (isset($_SESSION['uid']) && $_SESSION['uid'] != '') { ?>
        <li><a>Welcome, <?php echo $user->getFirstName(); ?></a></li>
        <?php } ?>
      </ul>
      <form class="navbar-form navbar-right" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
