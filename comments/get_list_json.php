<?php

	require_once '../database_access.php';
	$q = new CommentQuery();
	$q->join("Comment.Author")
		->withColumn("Author.first_name", 'authorName');


	if(isset($_GET['event_id'])){
		$event = EventQuery::create()->findPk($_GET['event_id']);
		if($event) {
			$q->filterByTarget_Event($event);
		} else {
			// TODO: throw error instead of blank page
			echo "<p>tried to filter by nonexistent event</p>";
		}
	}

	
	echo $q->find()->toJson();

?>