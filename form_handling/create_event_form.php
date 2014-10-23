<?php
require_once '../database_access.php';

$event = new Event();
if(isset($_POST["title"]))
	$event->setTitle($_POST["title"]);
else
	echo "<p>Need a title</p>";

if(isset($_POST["start_time"]))
	$event->setStartTime($_POST["start_time"]);
else
	echo "<p>Need a start time</p>";

if(isset($_POST["end_time"]))
	$event->setEndTime($_POST["end_time"]);
else
	echo "<p>Need an end time</p>";

if(isset($_POST["location"]))
	$event->setLocation($_POST["location"]);
else
	echo "<p>Need a location</p>";

if(isset($_POST["description"]))
	$event->setDescription($_POST["description"]);
else
	echo "<p>Need a description</p>";

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
	$event->save();
    // echo "Everything's all right!";
    $event_id = $event->getEventId();
    header("Location:../event_details.php?event_id=$event_id");
    // http_redirect("../event_details.php?event_id=$event_id");
}
?>