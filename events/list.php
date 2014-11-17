<?php
	require_once '../database_access.php';
	$q = new EventQuery();
	$events = $q->orderByStartTime()->find();
?>
<!DOCTYPE HTML>
<html>
<head>
	<?php include_once '../basic_includes/head_includes.php' ?>
	<link rel="stylesheet" href="../assets/css/style.css">
	<title>Event List</title>
</head>
<body>
	<?php include '../basic_includes/navbar.php' ?>
	<div class="panel panel-default">
		<table class="table table-striped">
			<thead>
				<th>Title</th>
				<th>Start Time</th>
				<th>End Time</th>
				<th>Location</th>
				<!-- <th>Description</th> -->
				<th>Need Car</th>
				<th>View</th>
			</thead>
			<tbody>
				<?php foreach($events as &$event) { ?>
				<tr>
					<td><?php echo $event->getTitle(); ?></td>
					<td><?php echo $event->getStartTime()->format('Y-m-d H:i'); ?></td>
					<td><?php echo $event->getEndTime()->format('Y-m-d H:i'); ?></td>
					<td><?php echo $event->getLocation(); ?></td>
					<!-- <td><?php echo $event->getDescription(); ?></td> -->
					<td><?php echo $event->getNeedCar(); ?></td>
					<td>
						<a href="details.php?event_id=<?php echo $event->getPrimaryKey() ?>" >
							<button type="button" class="btn btn-info btn-sm">
							  View
							</button>
						</a>
					</td>
				</tr>
				<?php } unset($event); ?>
			</tbody>
		</table>
	</div>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>