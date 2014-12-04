<?php

	require_once '../database_access.php';
	session_start();
	// make sure only the correct user can delete things
	if(!isset($_SESSION['uid'])) die();
	
	if(isset($_POST['interest_id'])) {
		$ei = EventInterestQuery::create()->findPk($_POST['interest_id']);
		if($ei && $ei->getInterestedUserId() == $_SESSION['uid']) {
			$ei->delete();
			echo "Delete worked";
		} else {
			echo "Delete failed";
		}
	}
?>