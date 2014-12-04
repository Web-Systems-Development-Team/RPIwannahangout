<?php

	require_once '../database_access.php';
	
	if(isset($_POST['interest_id'])) {
		$ei = EventInterestQuery::create()->findPk($_POST['interest_id']);
		if($ei) {
			$ei->delete();
			echo "Delete worked";
		} else {
			echo "Delete failed";
		}
	}
?>