<?php

require_once 'database_access.php';

if(isset($_GET["event_id"])) {
	$event_id = $_GET["event_id"];
} else {
	echo '<p class="error_message">Need an event ID</p>';
}

$q = new EventQuery();
$event = $q->findPk($event_id);

?>
<!DOCTYPE HTML>
<html>
<head>
	<?php include_once 'basic_includes/head_includes.php' ?>
	<title>Event: <?php echo $event->getTitle(); ?></title>
</head>
<body>
	<?php include 'basic_includes/navbar.php' ?>

	<div class="panel panel-default">
		<div class="panel-heading">Event: <?php echo $event->getTitle(); ?></div>
		<div class="panel-body">
			<h3>Start Time:</h3><p><?php echo $event->getStartTime()->format('Y-m-d H:i');; ?></p>
			<h3>End Time:</h3><p><?php echo $event->getEndTime()->format('Y-m-d H:i'); ?></p>
			<h3>Location:</h3><p><?php echo $event->getLocation(); ?></p>
			<h3>Requires Car:</h3><p><?php echo $event->getNeedCar(); ?></p>
			<h3>Description:</h3><p><?php echo $event->getDescription(); ?></p>
		</div>
	</div>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>