<?php

	require_once '../database_access.php';
	$ei = new EventInterestQuery();

	if(isset($_GET['event_id'])){
		$event = EventQuery::create()->findPk($_GET['event_id']);
		if($event) {
			$ei->filterByTarget_Event($event);
		} else {
			// TODO: throw error instead of blank page
			echo "<p>tried to filter by nonexistent event</p>";
		}
	}

	$ei->join('EventInterest.Interested');
	$ei->withColumn('Interested.FirstName', 'authorFirstName');
$ei->withColumn('Interested.LastName', 'authorLastName'); 
	echo $ei->find()->toJson();

?>