<?php	
	require_once '../database_access.php';

echo "text";

	if (isset($_POST['comment_id'])) {
		$comment = CommentQuery::create()->findPk($_POST['comment_id']);
		if ($comment) {
			$comment->delete();
			echo '<p>Successfully deleted comment</p>';
		} else {
			echo "<p>Tried to delete nonexistent comment</p>";
		}
			
	}
	

?>