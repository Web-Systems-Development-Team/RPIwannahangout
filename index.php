<!DOCTYPE html>
<html>
<head>
	<?php include_once 'basic_includes/head_includes.php' ?>
    <title>RPI Wanna Hangout</title>
</head>
<body>
	<?php include 'basic_includes/navbar.php' ?>

	<div class="panel panel-default">
		<div class="panel-heading">Event Creation Form</div>
		<div class="panel-body">
			<form role="form" id="event_creation_form" action="form_handling/create_event_form.php" method="post">
				<div class="form-group">
					<label for="title">Title</label>
					<input class="form-control" type="text" id="title" name="title" placeholder="Title">
				</div>
				<div class="form-group">
					<label for="start_time">Start Time</label>
					<input class="form-control" type="datetime-local" id="start_time"name="start_time">
				</div>
				<div class="form-group">
					<label for="end_time">End Time</label>
					<input class="form-control" type="datetime-local" id="end_time"name="end_time">
				</div>
				<div class="form-group">
					<label for="location">Location</label>
					<input class="form-control" type="text" id="location" name="location" placeholder="Location">
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="need_car" value="1">Requires car
					</label>
					
				</div>
				<div class="form-group">
					<label for="description">Description</label>
					<textarea class="form-control" rows="3" name="description" placeholder="Description" form="event_creation_form"></textarea>
					<!-- <input class="form-control" type="text" id="description" placeholder="Description"> -->
				</div>
				<button type="submit" class="btn btn-default">Submit</button>
			</form>
		</div>
	</div>


	<!-- <h1>Event list (not done yet)</h1> -->

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<!-- <script src="assets/bootstrap/js/bootstrap.min.js"></script> -->
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>