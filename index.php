<!DOCTYPE html>
<html>
<head>
	<title>RPI Wanna Hangout</title>
	<!-- <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css"> -->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
</head>
<body>

<?php include 'basic_includes/navbar.php' ?>


	<div class="panel panel-default">
		<div class="panel-heading">Event Creation Form</div>
		<div class="panel-body">
			<form role="form" action="form_handling/create_event_form.php" method="post">
				<div class="form-group">
					<label for="title">Title</label>
					<input class="form-control" type="text" id="title" placeholder="Title">
				</div>
				<div class="form-group">
					<label for="start_time">Start Time</label>
					<input class="form-control" type="datetime-local" id="start_time">
				</div>
				<div class="form-group">
					<label for="end_time">End Time</label>
					<input class="form-control" type="datetime-local" id="end_time">
				</div>
				<div class="form-group">
					<label for="location">Location</label>
					<input class="form-control" type="text" id="location" placeholder="Location">
				</div>
				<div class="form-group">
					<label for="need_car">Requires car</label>
					<input class="form-control" type="checkbox" id="need_car" value="1">
				</div>
				<div class="form-group">
					<label for="description">Description</label>
					<textarea class="form-control" rows="3"></textarea>
					<input class="form-control" type="text" id="description" placeholder="Description">
				</div>
				<button type="submit" class="btn btn-default">Submit</button>
			</form>
		</div>
	</div>


	<!-- <h1>Event list (not done yet)</h1> -->

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<!-- <script src="bootstrap/js/bootstrap.min.js"></script> -->
	<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>