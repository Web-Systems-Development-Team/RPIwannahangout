<?php
	require_once 'database_access.php';
	$q = new EventQuery();
	$events = $q->orderByStartTime()->find();
?>
<!DOCTYPE html>
<html>
<head>
  <?php include_once 'basic_includes/head_includes.php' ?>
  <link rel="stylesheet" href="assets/css/style.css">
  <title>RPI Wanna Hangout</title>
</head>
<body>
	<?php include 'basic_includes/navbar.php' //create menu ?> 
    <div class="block"><div id='step1'>Step 1: </div><div class="explore_info"> Login using RPI credentials to submit and search for events </div></div>
    <div class="block"><div id='step2'>Step 2: </div><div class="explore_info"> Submit events by navigating to the "Create an Event" page and filling out the required information </div></div>
    <div class="block"><div id='step3'>Step 3: </div><div class="explore_info"> Find Events by navigating to the "Find an Event" page and scrolling through event listings </div></div>
    <div class="block"><div id='step4'>Step 4: </div><div class="explore_info"> Express interest, attend and post comments about events you have attended! </div></div>
    
</body>
</html>