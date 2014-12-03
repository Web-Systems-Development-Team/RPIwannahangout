<?php

	require_once '../database_access.php';

	//use session on this page
	if (!isset($_SESSION)) {
    	session_start();
  	}

	if(isset($_GET["event_id"])) {
		$event_id = $_GET["event_id"];
	} else {
		echo '<p class="error_message">Need an event ID</p>';
	}

	$q = new EventQuery();
	$event = $q->findPk($event_id);

	$interests = EventInterestQuery::create()
		->find();
?>
<!DOCTYPE HTML>
<html>
<head>
	<?php include_once '../basic_includes/sheets_and_scripts.php' ?>
	<link rel="stylesheet" href="../assets/css/style.css">
	<title>Event: <?php echo $event->getTitle(); ?></title>
</head>
<body>
    <div id="detail_page">
	<?php include '../basic_includes/navbar.php' ?>
    
	<div class="panel panel-default">
		<div class="panel-heading"><h4>Event: <?php echo $event->getTitle(); ?><h4></div>
		<div class="panel-body">
            <div class="row">
                <div class="col-md-4"><h4>Date:</h4></div>
                <div class="col-md-8 event-detail"><?php echo $event->getDate()->format('M-d');; ?></div>
            </div>
            <div class="row">
                <div class="col-md-4"><h4>Start Time:</h4></div>
                <div class="col-md-8 event-detail"><?php echo $event->getStartTime()->format('H:i');; ?></div>
            </div>
            <div class="row">
                <div class="col-md-4"><h4>End Time:</h4></div>
                <div class="col-md-8 event-detail"><?php echo $event->getEndTime()->format('H:i'); ?></div>
            </div>
            <div class="row">
                <div class="col-md-4"><h4>Location:</h4></div>
                <div class="col-md-8 event-detail"><?php echo $event->getLocation(); ?></div>
            </div>
            <div class="row">
                <div class="col-md-4"><h4>Description:</h4></div>
                <div class="col-md-8 event-detail"><?php echo $event->getDescription(); ?></div>
            </div>
            <div class="row">
                <div class="col-md-4"><h4>Attendance:</h4></div>
                <div class="col-md-8 event-detail"><?php echo $event->countInterests()."/".$event->getMaxAttendance(); ?></div>
            </div>
			<!--h4>Date:</h4><p><?php echo $event->getDate()->format('M-d');; ?></p>
			<h4>Start Time:</h4><p><?php echo $event->getStartTime()->format('H:i');; ?></p>
			<h4>End Time:</h4><p><?php echo $event->getEndTime()->format('H:i'); ?></p>
			<h4>Location:</h4><p><?php echo $event->getLocation(); ?></p>
			<h4>Description:</h4><p><?php echo $event->getDescription(); ?></p>
			<h4>Attendance:</h4><p><?php echo $event->countInterests()."/".$event->getMaxAttendance(); ?></p-->
			
			<!-- Display the Interested button only if there is a user session active (anyone can read event details, but only users can mark interest) -->
			<?php if(isset($_SESSION['uid'])) { ?>
				<form class="interested_form" method="post">
					<input type="hidden" name="interested_user_id" value="<?php echo $_SESSION['uid']; ?>">
					<input type="hidden" name="target_event_id" value="<?php echo $event->getEventId(); ?>">
					<button class="btn btn-primary" type="submit" name="interest" value="interest" id="add_interest_button">I'm Interested!</button>
				</form>
			<?php } else {?>
				<a href="/RPIWannaHangOut/login.php">
					<button class="btn btn-primary" value="interest">I'm Interested!</button>
				</a>
			<?php } ?>

            <div id="calendar-wrapper"><a href="http://example.com/link-to-your-event" title="Add to Calendar" class="addthisevent"> <!--add event to calendar -->
                Add to Calendar
                <span class="_start"><?php echo $event->getStartTime()->format('d-m-Y H:i:s'); ?></span>
                <span class="_end"><?php echo $event->getEndTime()->format('d-m-Y H:i:s'); ?></span>
                <span class="_zonecode">15</span>
                <span class="_summary"><?php echo $event->getTitle(); ?></span>
                <span class="_description"><?php echo $event->getDescription(); ?> </span>
                <span class="_location"><?php echo $event->getLocation(); ?></span>
                <span class="_date_format">DD/MM/YYYY</span>
                <span class="_alarm_reminder">15</span>
        </a></div>
		</div>
	</div>

	<div class="panel panel-default" id="interested-users">
		<div class="panel-heading">Interested Users</div>
		<table class="table table-striped">
			<tbody class="interest-table-body">
				<!-- This will be filled by AJAX -->
			</tbody>
		</table>
	</div>
	<div class="panel panel-default" id="comments">
		<div class="panel-heading">Comments</div>
		<div class="list-group" id ="comment_bin"></div>
	</div>
    <!-- Only show Add Comment when logged in -->
	<?php if(isset($_SESSION['uid'])) { ?>
	<div class="panel panel-default" id="comments">
	  <div class="panel-heading">Add Comment</div>
	  <div class="panel-body" >
	    <form role="form" id="comment_creation_form" method="post" class="comment-form">
	      <input class="form-control" type="hidden" id="creation_date" name="creation_date" step="1" value="<?php $d = new DateTime(); echo $d->format('Y-m-d\TH:i:s'); ?>">
	      <input class="form-control" type="hidden" id="author_user_id" name="author_user_id" value="<?php echo $_SESSION['uid']; ?>">
	      <input class="form-control" type="hidden" id="target_event_id" name="target_event_id" value="<?php echo $event->getEventId(); ?>">
	      <div class="form-group">
		<label for="comment_text">Comment Text</label>
		<textarea class="form-control" rows="3" name="comment_text" placeholder="Comment Text" form="comment_creation_form"></textarea>
	      </div>
	      <button type="submit" name="comment" value="comment" class="btn btn-default">Submit</button>
	    </form>
	  </div>
	</div>
    
	<?php } ?>

    <script type="text/javascript" src="https://addthisevent.com/libs/1.5.8/ate.min.js"></script>
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASdHSlIDuGvVy8w55Oy5qreCQzZfNoj10">
    </script>
	<script>
    
//add event comment
function add_comment(comment) {
    var comment_head = "<div class=comment-head>"+ comment.authorFirstName + " " + comment.authorLastName + "<div class='date'> on " + comment.CreationDate.date + "</div>";
    
    //delete button
    if (comment.AuthorUserId == <?php echo $_SESSION['uid']; ?>) {
	comment_head += "<span class=\"glyphicon glyphicon-remove\"></span>";
    }
    comment_head += "</div>";
    $("#comment_bin").append("<div class=list-group-item commentid=" + comment.CommentId + ">" + comment_head + comment.CommentText +"</div></div>");
}

// get a json of the comments and add them to the page
$.get("../comments/get_comment_json.php",
      { event_id:<?php echo $event->getEventId(); ?>},
      function(data, status) {
          var comments = $.parseJSON(data).Comments;
          for(var i=0; i<comments.length; ++i) {
              add_comment(comments[i]);
          }
	  //set up the comment delete button action
	  $(".glyphicon-remove").click(function() {
	      $.post("../comments/delete.php",
		     { comment_id:$(this).parent().parent().attr("commentid") },
		     function(data) {
			 //comment deleted: reload page
			location.reload();
		     },
		    "text");
	  });
      });

// set up the comment form action
$(".comment-form").submit(function(event) {
    event.preventDefault();
    // check stuff is valid here
    var form = event.currentTarget;
    var ary = $(form).serializeArray();

    $.ajax({
        url: "../comments/create_comment_ajax.php",
        data: ary,
        type: "POST",
        dataType:"JSON",
        success: function( json ) {
            //No checking here because you CAN double-post comments if you want
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

function add_interest(interest) {
    var row = $("<tr/>").append($("<td/>", {
        'text':(interest.authorFirstName + " " + interest.authorLastName)
    }));
    $(".interest-table-body").append(row);
}

// display interests
$.get("../interest/get_interest_ajax.php",
      { event_id:<?php echo $event->getEventId(); ?>},
      function(data, status) {
          var eventInterests = $.parseJSON(data).EventInterests;
          for(var i=0; i<eventInterests.length; ++i) {
              add_interest(eventInterests[i]);
          }
      });

// set up the I'm interested submit button action
$(".interested_form").submit(function(event) {

    event.preventDefault();
    // check stuff is valid here
    var form = event.currentTarget;
    var ary = $(form).serializeArray();

    $.ajax({
        url: "../interest/create_interest_ajax.php",
        data: ary,
        type: "POST",
        dataType:"json",
        success: function( json ) {
            //if already in database, json returned will be { "extant":1 }
            //and no new entry in event_interest will be created
            //this is to stop event interests from accumulating
            if(!json.hasOwnProperty('extant')) {
                add_interest(json);
            }
        },
        // if the request fails
        error: function( xhr, status, errorThrown ) {
            alert( "Sorry, there was a problem adding your interest! Please try again in a few moments." );
            console.log( "Error: " + errorThrown );
            console.log( "Status: " + status );
            console.dir( xhr );
        },
    });
});
    </script>
    </div>
</body>

</html>


