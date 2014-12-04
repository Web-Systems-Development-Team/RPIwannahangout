<?php
	
	require_once '../database_access.php';

	if (isset($_POST['event_interest_id'])) {
		$interest = EventInterestQuery::create()->findPk($_POST['event_interest_id'])

		if ($interest) {
			$interest->delete();
			echo '<p>Successfully removed interest.</p>';
		} else {
			echo '<p>Failed to access interest for removal.</p>';
		}
	}


?>