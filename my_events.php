<?php
	session_start();
	require_once 'database_access.php';
	$my_events = Array();
	$interested_events = Array();

	if(isset($_SESSION['uid'])) {
		$my_events = EventQuery::create()
			->filterByCreatorUserId($_SESSION['uid'])
			->orderByStartTime()
			->find();
		$interested_events = EventQuery::create()
			->useInterestQuery()
				->filterByInterestedUserId($_SESSION['uid'])
			->endUse()
			->where('Event.CreatorUserId != ?', $_SESSION['uid'])
			->orderByStartTime()
			->find();
	}
	
?>
<!DOCTYPE HTML>
<html>
<head>
	<?php include_once 'basic_includes/sheets_and_scripts.php' ?>
	<title>Event List</title>
</head>
<body>
    <div id="list_page">
	<?php include 'basic_includes/navbar.php' ?>
	<div class="panel panel-default" id="my_events_list">
		<h3>My Events</h3>
		<div class="panel-body">
			<table class="table table-hover">
				<thead>
					<th class="sort col-md-3" data-sort="title">Title</th>
					<th class="sort col-md-1" data-sort="date">Date</th>
					<th class="sort col-md-1" data-sort="start_time">Start Time</th>
					<th class="sort col-md-1" data-sort="end_time">End Time</th>
					<th class="sort col-md-2" data-sort="location">Location</th>
					<th class="sort col-md-1" data-sort="attending">Attending</th>
					<th class="sort col-md-1" data-sort="max_attendance">Max Attendance</th>
					<th class="sort col-md-1" data-sort="open_spots">Open Spots</th>
					<th colspan="2">
			          <input type="text" class="search" placeholder="Search" />
			        </th>
				</thead>
				<tbody class="list">
					<?php foreach($my_events as &$event) { ?>
					<tr>
						<td class="title"><?php echo $event->getTitle(); ?></td>
						<td class="date"><?php echo $event->getDate()->format('m-d'); ?></td>
						<td class="start_time"><?php echo $event->getStartTime()->format('H:i'); ?></td>
						<td class="end_time"><?php echo $event->getEndTime()->format('H:i'); ?></td>
						<td class="location"><?php echo $event->getLocation(); ?></td>
						<td class="attending"><?php echo $event->countInterests(); ?></td>
						<td class="max_attendance"><?php echo $event->getMaxAttendance(); ?></td>
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
	</div>
	<div class="panel panel-default" id="my_interests_list">
		<h3>Events I'm interested in</h3>
		<div class="panel-body">
			<table class="table table-hover">
				<thead>
					<th class="sort col-md-3" data-sort="title">Title</th>
					<th class="sort col-md-1" data-sort="date">Date</th>
					<th class="sort col-md-1" data-sort="start_time">Start Time</th>
					<th class="sort col-md-1" data-sort="end_time">End Time</th>
					<th class="sort col-md-2" data-sort="location">Location</th>
					<th class="sort col-md-1" data-sort="attending">Attending</th>
					<th class="sort col-md-1" data-sort="max_attendance">Max Attendance</th>
					<th class="sort col-md-1" data-sort="open_spots">Open Spots</th>
					<th colspan="2">
			          <input type="text" class="search" placeholder="Search" />
			        </th>
				</thead>
				<tbody class="list">
					<?php foreach($interested_events as &$event) { ?>
					<tr>
						<td class="title"><?php echo $event->getTitle(); ?></td>
						<td class="date"><?php echo $event->getDate()->format('m-d'); ?></td>
						<td class="start_time"><?php echo $event->getStartTime()->format('H:i'); ?></td>
						<td class="end_time"><?php echo $event->getEndTime()->format('H:i'); ?></td>
						<td class="location"><?php echo $event->getLocation(); ?></td>
						<td class="attending"><?php echo $event->countInterests(); ?></td>
						<td class="max_attendance"><?php echo $event->getMaxAttendance(); ?></td>
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
	</div>
	<script src="http://listjs.com/no-cdn/list.js"></script>
	<script type="text/javascript">
		var options = {
		  valueNames: [ 'title', 'date', 'start_time', 'end_time', 'location',
		  	'attending', 'max_attendance', 'open_spots' ]
		};
		var my_events_list = new List('my_events_list', options);
		// var my_interests_list = new List('my_interests_list', options);
	</script>

    <script type="text/javascript">
    $("#myEventsLink").addClass("active");
    </script>
    </div>
</body>
</html>
