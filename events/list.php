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
    <div id="list_page">
	<?php include '../basic_includes/navbar.php' ?>
	<div class="panel panel-default" id="list_events">
		<table class="table table-striped">
			<thead>
				<th class="sort" data-sort="title">Title <span class="glyphicon glyphicon-sort" aria-hidden="true"></span></th>
				<th class="sort" data-sort="start_time">Start Time <span class="glyphicon glyphicon-sort" aria-hidden="true"></span></th>
				<th class="sort" data-sort="end_time">End Time <span class="glyphicon glyphicon-sort" aria-hidden="true"></span></th>
				<th class="sort" data-sort="location">Location <span class="glyphicon glyphicon-sort" aria-hidden="true"></span></th>
				<!-- <th>Description</th> -->
				<th>Need Car</th>
				<th colspan="2">
		          <input type="text" class="search" placeholder="Search" />
		        </th>
			</thead>
			<tbody class="list">
				<?php foreach($events as &$event) { ?>
				<tr>
					<td class="title"><?php echo $event->getTitle(); ?></td>
					<td class="start_time"><?php echo $event->getStartTime()->format('Y-m-d H:i'); ?></td>
					<td class="end_time"><?php echo $event->getEndTime()->format('Y-m-d H:i'); ?></td>
					<td class="location"><?php echo $event->getLocation(); ?></td>
					<!-- <td><?php echo $event->getDescription(); ?></td> -->
					<td><?php 
		                        if($event->getNeedCar()==1) {echo "YES";}
		                        else{echo "NO";}
		                        ?></td>
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
	<script src="http://listjs.com/no-cdn/list.js"></script>
	<script type="text/javascript">
		var options = {
		  valueNames: [ 'title', 'start_time', 'end_time', 'location' ]
		};

		var userList = new List('list_events', options);

	</script>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $("#findLink").addClass("active");
    </script>
    </div>
</body>
</html>