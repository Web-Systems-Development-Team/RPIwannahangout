<?php
	session_start();
	require_once 'database_access.php';
	$q = new EventQuery();
	$events = $q->orderByStartTime()->find();
?>
<!DOCTYPE html>
<html>
<head>
  <?php include_once 'basic_includes/sheets_and_scripts.php' ?>
  <title>RPI Wanna Hangout</title>

</head>
<body>
    <div id="index">
	<?php include 'basic_includes/navbar.php' ?> 
    <div class="jumbotron jBack">
    <div class="container">
    <h1>Let's Hangout!</h1>
    <p>Easily find and share events occuring on or off campus. Connect with your classmates.</p>
        <p>Live. Learn. Experience.</p>
    <div class="btn-group" role="group" aria-label="...">
        <a class="btn btn-info" type="button" href="explore.php">Learn More</a>
        <a class="btn btn-info" type="button" href="events/create.php">Create an Event</a>
    </div>
	</div>
    </div>
	<div id="container">
	<div class="panel panel-default" id="events">
		<div class="panel-heading">What's going on now</div>
			<div class="newtable">
				<div class="row">
					<div class="hcell">Title</div>
					<div class="hcell">Date</div>
					<div class="hcell">Start Time</div>
					<div class="hcell">End Time</div>
	                <div class="hcell">Location</div>
					<div class="hcell">Description</div>
					<div class="hcell">Attendance</div>
				</div>
	            <div class="ticker1">
		            <div class="innerWrap">
						<?php foreach($events as &$event) { ?> 
		                <div class="row">
						<div class="list"><div class="cell"><?php echo $event->getTitle(); ?></div>
						<div class="cell"><?php echo $event->getDate()->format('M-d'); ?></div>
						<div class="cell"><?php echo $event->getStartTime()->format('H:i'); ?></div>
						<div class="cell"><?php echo $event->getEndTime()->format('H:i'); ?></div>
						<div class="cell"><?php echo $event->getLocation(); ?></div>
						<div class="cell"><?php echo $event->getDescription(); ?></div>
						<div class="cell"><?php echo $event->countInterests()."/".$event->getMaxAttendance(); ?></div>
						<div class="bcell">
							<a href="events/details.php?event_id=<?php echo $event->getPrimaryKey() ?>" >
								<button type="button" class="btn btn-info btn-sm">View</button>
		                    </a>
		                </div>
	                </div>
	            </div>
					<?php } unset($event); ?>
	        </div>
        </div>
    </div>
    </div>
    </div>

    <script src="/easyticker/jquery.easy-ticker.js"></script>
    <script> //apply easyTicker function on "what's going on now"
        $('.ticker1').easyTicker({
	       direction: 'up',
	       easing: 'swing',
	       speed: 'slow',
	       interval: 2000,
	       height: 'auto',
	       visible: 3, //only show three events at a time
	       mousePause: 1,
	       controls: {
		      up: '',
		      down: '',
		      toggle: '',
		      playText: 'Play',
		      stopText: 'Stop'
	       }
        });
    </script>
</body>
</html>
