<?php

	require_once '../database_access.php';

	if(isset($_GET["event_id"])) {
		$event_id = $_GET["event_id"];
	} else {
		echo '<p class="error_message">Need an event ID</p>';
	}

	$q = new EventQuery();
	$event = $q->findPk($event_id);

?>
<!DOCTYPE HTML>
<html>
<head>
	<?php include_once '../basic_includes/head_includes.php' ?>
	<link rel="stylesheet" href="../assets/css/style.css">
	<title>Event: <?php echo $event->getTitle(); ?></title>
</head>
<body>
	<?php include '../basic_includes/navbar.php' ?>
	<?php if(isset($_GET["new"])) { ?>
		<div class="alert alert-success alert-dismissible" role="alert">
		  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		  <strong>YAY!</strong> New Event created successfully, here it is!
		</div>
	<?php } ?>

	<div class="panel panel-default">
		<div class="panel-heading">Event: <?php echo $event->getTitle(); ?></div>
		<div class="panel-body">
			<h3>Start Time:</h3><p><?php echo $event->getStartTime()->format('Y-m-d H:i');; ?></p>
			<h3>End Time:</h3><p><?php echo $event->getEndTime()->format('Y-m-d H:i'); ?></p>
			<h3>Location:</h3><p><?php echo $event->getLocation(); ?></p>
			<h3>Requires Car:</h3><p><?php echo $event->getNeedCar(); ?></p>
			<h3>Description:</h3><p><?php echo $event->getDescription(); ?></p>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">Comments</div>
		<div class="panel-body" id="comment_bin">
			<?php ?>
		</div>
	</div>

    <div class="panel panel-default">
		<div class="panel-heading">Add Comment</div>
		<div class="panel-body" >
			<form role="form" id="comment_creation_form" action="../comments/create_ajax.php" method="post" class="comment-form">
				<input class="form-control" type="datetime-local" id="creation_date" name="creation_date" step="1" value="<?php $d = new DateTime(); echo $d->format('Y-m-d\TH:i:s'); ?>">
				<input class="form-control" type="hidden" id="author_user_id" name="author_user_id" value="1">
				<input class="form-control" type="hidden" id="target_event_id" name="target_event_id" value="<?php echo $event->getEventId(); ?>">
				<div class="form-group">
					<label for="comment_text">Comment Text</label>
					<textarea class="form-control" rows="3" name="comment_text" placeholder="Comment Text" form="comment_creation_form"></textarea>
				</div>
				<button type="submit" name="submit" value="submit" class="btn btn-default">Submit</button>
			</form>
		</div>
	</div>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<script>
		function add_comment(comment) {
			var comment_box = $("<div/>", {'class':'panel panel-default'});
			comment_box.append($("<div/>", {
				'class':'panel-heading',
				'text':comment.authorName
			}));
			comment_box.append($("<div/>", {
				'class':'panel-body',
				'text':comment.CommentText
			}));
			$("#comment_bin").append(comment_box);
		}

		$(function(){
			// get a json of the comments and add them to the page
			$.get("../comments/get_list_json.php", function(data, status) {
				var comments = $.parseJSON(data).Comments;
				
				for(var i=0; i<comments.length; ++i) {
					add_comment(comments[i]);
				}
			});

			$(".comment-form").submit(function(event) {
				event.preventDefault();
				// check stuff is valid here
				var form = event.currentTarget;
				var ary = $(form).serializeArray();

				for(var i=0; i<ary.length;i++){
					console.log("("+ary[i].name+", "+ary[i].value+")");
				}
				
				$.ajax({
					url: "../comments/create_ajax.php",
					data: ary,
					type: "POST",
					dataType:"JSON",
					success: function( json ) {
				        add_comment(json);
				    },
				    // if the request fails
				    error: function( xhr, status, errorThrown ) {
				        alert( "Sorry, there was a problem posting your comment! Please try again in a few moments." );
				        console.log( "Error: " + errorThrown );
				        console.log( "Status: " + status );
				        console.dir( xhr );
				    },
				});
			});
		});
	</script>
</body>