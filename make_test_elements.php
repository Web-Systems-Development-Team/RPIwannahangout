<?php
	require_once 'database_access.php';

	$user = new User();
	$user->setFirstName("first_Test");
	$user->setLastName("last_Test");
	$user->setEmail("test@test.com");
	$user->setPermissionLevel(1000);
	$user->save();

	$event = new Event();
	$event->setTitle("Test_event");
	$event->setStartTime(strtotime("2014-11-18 18:00:00"));
	$event->setEndTime(strtotime("2014-11-18 20:00:00"));
	$event->setLocation("RPI");
	$event->setDescription("This is a test description.");
	$event->setNeedsCar(1);
	$event->setCreationUserId(1);
	$event->save();
?>