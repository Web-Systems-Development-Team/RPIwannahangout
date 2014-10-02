<!DOCTYPE html>
<html>
<head>
	<title>RPI Wanna Hangout</title>
	<!-- <link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.css"> -->
	<!-- <script src="bootstrap/bootstrap.min.js"></script> -->
</head>
<body>
	<h1>Simple event creator</h1>

	<form action="form_handling/create_event_form.php" method="post">
		Title: <input type="text" name="title"><br>
		Start Time: <input type="datetime-local" name="start_time"><br>
		End Time: <input type="datetime-local" name="end_time"><br>
		Location: <input type="text" name="location"><br>
		Requires car:<input type="checkbox" name="need_car" value="1"><br>
		Description: <input type="text" name="description"><br>
		<input type="submit">
	</form>

	<h1>Event list (not done yet)</h1>


</body>
</html>