<?php
	require_once '../database_access.php';
	$q = new EventQuery();
	$events = $q->orderByStartTime()->find();
?>
<!DOCTYPE HTML>
<html>
<head>
	<?php include_once '../basic_includes/sheets_and_scripts.php' ?>
	<link rel="stylesheet" href="../assets/css/style.css">
	<title>Event List</title>
</head>
<body>
    <div id="list_page">
	<?php include '../basic_includes/navbar.php' ?>
	<div class="panel panel-default" id="list_events">
		<table class="table table-hover">
			<thead>
				<th class="sort col-md-3" data-sort="title">Title <span class="glyphicon glyphicon-sort" aria-hidden="true"></span></th>
				<th class="sort col-md-2" data-sort="date">Date <span class="glyphicon glyphicon-sort" aria-hidden="true"></span></th>
				<th class="sort col-md-2" data-sort="start_time">Start Time <span class="glyphicon glyphicon-sort" aria-hidden="true"></span></th>
				<th class="sort col-md-2" data-sort="end_time">End Time <span class="glyphicon glyphicon-sort" aria-hidden="true"></span></th>
				<th class="sort col-md-2" data-sort="location">Location <span class="glyphicon glyphicon-sort" aria-hidden="true"></span></th>
				<th class="sort col-md-1" data-sort="open_spots">Available Spots <span class="glyphicon glyphicon-sort" aria-hidden="true"></span></th>
				<th colspan="2">
		          <input type="text" class="search" placeholder="Search" />
		        </th>
			</thead>
			<tbody class="list">
				<?php foreach($events as &$event) { ?>
				<tr>
					<td class="title"><?php echo $event->getTitle(); ?></td>
					<td class="date1"><?php echo $event->getDate()->format('m-d-y'); ?></td>
					<td class="start_time"><?php echo $event->getStartTime()->format('H:i'); ?></td>
					<td class="end_time"><?php echo $event->getEndTime()->format('H:i'); ?></td>
					<td class="location"><?php echo $event->getLocation(); ?></td>
					<td class="open_spots"><?php echo $event->getMaxAttendance() - $event->countInterests(); ?></td>
					<td>
						<a href="details.php?event_id=<?php echo $event->getPrimaryKey() ?>" >
							<button type="button" class="btn btn-info btn-sm">View</button>
						</a>
					</td>
				</tr>
				<?php } unset($event); ?>
			</tbody>
		</table>
	</div>
	<script src="http://listjs.com/no-cdn/list.js"></script>
	<script type="text/javascript">
		var options = {
		  valueNames: [ 'title', 'date', 'start_time', 'end_time', 'location',
		  	'attending', 'max_attendance', 'open_spots' ]
		};
		var userList = new List('list_events', options);
	</script>

    <script type="text/javascript">
    $("#findLink").addClass("active");
    </script>
    </div>
</body>
</html>
