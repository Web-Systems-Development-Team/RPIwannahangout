<?php
  session_start();
	require_once 'database_access.php';
?>
<!DOCTYPE html>
<html>
<head>
  <?php include_once 'basic_includes/sheets_and_scripts.php' ?>
  <link rel="stylesheet" href="assets/css/style.css">
  <title>Explore</title>
</head>
<body>
    <div id="explore">
	<?php include 'basic_includes/navbar.php' //create menu ?> 
    <div id='step1'>
        <video width="50%" controls>
          <source src="/sitetutorial.webm" type="video/webm">
          <source src="/sitetutorial.mp4" type="video/mp4">
          Your browser does not support the video tag.
        </video>
    <p><h3>Step 1: </h3> Login using RPI credentials to submit and search for events </p></div>
    <div id='step2'><h3>Step 2: </h3> Submit events by navigating to the "Create an Event" page and filling out the required information </div>
    <div id='step3'><h3>Step 3: </h3> Find Events by navigating to the "Find an Event" page and scrolling through event listings </div>
    <div id='step4'><h3>Step 4: </h3> Express interest, attend and post comments about events you have attended! </div>
    </div>
</body>
</html>