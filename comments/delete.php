<?php	
	require_once '../database_access.php';

	session_start();
	// make sure only the correct user can delete things
	if(!isset($_SESSION['uid'])) die();

	if (isset($_POST['comment_id'])) {
		$comment = CommentQuery::create()->findPk($_POST['comment_id']);
		if ($comment && $comment->getAuthorUserId() == $_SESSION['uid']) {
			$comment->delete();
			echo '<p>Successfully deleted comment</p>';
		} else {
			echo "<p>Tried to delete nonexistent comment</p>";
		}
			
	}

?>