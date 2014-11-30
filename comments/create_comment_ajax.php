<?php
	require_once '../database_access.php';

	$comment = new Comment();
	if(isset($_POST['creation_date'])) {
		$comment->setCreationDate($_POST['creation_date']);
	}
	if(isset($_POST['edit_date'])) {
		$comment->setEditDate($_POST['edit_date']);
	}
	if(isset($_POST['author_user_id'])) {
		$comment->setAuthorUserId($_POST['author_user_id']);
	}
	if(isset($_POST['target_event_id'])) {
		$comment->setTargetEventId($_POST['target_event_id']);
	}
	if(isset($_POST['comment_text'])) {
		$comment->setCommentText($_POST['comment_text']);
	}
	
	if (!$comment->validate()) {
		foreach ($comment->getValidationFailures() as $failure) {
		    echo '<p><strong>Error in '.$failure->getPropertyPath().' field!</strong> '.$failure->getMessage().'</p>';
		}
		unset($failure);
	}
	else {
		$comment->save();
		// add the author name and return the JSON
		$comment_json = json_decode($comment->toJSON());
		$author = $comment->getAuthor();
		$comment_json->authorName = $author->getFirstName();
		echo json_encode($comment_json);
	}



?>