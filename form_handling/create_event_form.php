<?php
	require_once '../database_access.php';

	$event = new Event();
	if(isset($_POST["title"]))
		$event->setTitle($_POST["title"]);
	else
		echo "Need a title";
	if(isset($_POST["start_time"]))
		$event->setStartTime($_POST["start_time"]);
	else
		echo "Need a start time";
	if(isset($_POST["end_time"]))
		$event->setEndTime($_POST["end_time"]);
	else
		echo "Need an end time";
	if(isset($_POST["location"]))
		$event->setLocation($_POST["location"]);
	else
		echo "Need a location";
	if(isset($_POST["description"]))
		$event->setDescription($_POST["description"]);
	else
		echo "Need a description";
	if(isset($_POST["need_car"]))
		$event->setNeedCar($_POST["need_car"]);
	else
		$event->setNeedCar(0);

	// this is just a cludge for now
	$user_query = new UserQuery();
	$user = $user_query->findPk(1); //this is the test user
	$event->setCreator($user);

	if (!$event->validate()) {
	    foreach ($event->getValidationFailures() as $failure) {
	        echo '<p class="error_message">Property '.$failure->getPropertyPath().": ".$failure->getMessage()."</p>";
	    }
	}
	else {
	   echo "Everything's all right!";
	   http_redirect("../index.php");
	}

?>