<?php
	require_once 'database_access.php';

	$user = new User();
	$user->setFirstName("first_Test");
	$user->setLastName("last_Test");
	$user->setEmail("test@test.com");
	$user->setPermissionLevel(1000);
	$user->save();
?>