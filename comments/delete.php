<?php
	

	require_once '../database_access.php';



	if (isset($_GET['comment_id'])) {
		$comment = CommentQuery::create()->findPk($_GET['comment_id']);
		if ($comment) {
			$comment->delete();
			echo '<p>Successfully deleted comment</p>';
		} else {
			echo "<p>Tried to delete nonexistent comment</p>";
		}
			
	}
	

?>