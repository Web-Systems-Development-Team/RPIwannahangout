<?php

	require_once '../database_access.php';

	// $user = new User();
	// $user->setFirstName("first_Test");
	// $user->setLastName("last_Test");
	// $user->setEmail("test@test.com");
	// $user->setPermissionLevel(1000);
	// $user->save();
	
	// $event = EventQuery::create()->findPk(1);
	$user = UserQuery::create()->findPk(1);
	
	$comment = new Comment();
	$comment->setAuthor($user)
		->setCommentText("comment text")
		->setTargetEventId(1)
		->save();

?>