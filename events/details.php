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

   <!--  <div class="panel panel-default">
		<div class="panel-heading">Add Comment</div>
		<div class="panel-body" >
			<?php ?>
		</div>
	</div> -->

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<script>
$(function(){
	// can get "website.json" or "build_json.php"
	$.get("../comments/get_list_json.php", function(data, status) {
		var comments = $.parseJSON(data).Comments; // use with build_json.php
		
		for(var i=0; i<comments.length; ++i) {
			var comment = comments[i];
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
		
	});
});

// function add_folders_to_menu(nav, folders, name) {
// 	var menu_item_class = name + "_menu_item";
// 	nav.append($('<li/>', {
// 		'text':name,
// 		'class':"ui-state-disabled menu_header"
// 	}).on('click', function(){
// 	    $("."+menu_item_class).each(function() {$(this).toggle();});
// 	}).append($('<i class="fa fa-bars menu-icon"></i>')));
// 	for(var i=0; i<folders.length; ++i) {
// 		nav.append($('<li/>', {
// 			'text':folders[i].name,
// 			'href':folders[i].instructions,
// 			'class':menu_item_class
// 		}).on('click', function(){
// 		    display_in_window($(this).attr("href"), this.outerText);
// 		}));
// 	}
// }

	</script>
</body>