<?php

session_start();

// a non-user should not be able to see this page
// send user to login.php if no session
if(!isset($_SESSION['uid'])) {
    header('Location: ../login.php?source=events/create.php');
}

require_once '../database_access.php';

// a function to populate the form if it's been submitted already and is coming back
// likely because of invalid data
function getData($formName) {
    if(isset($_POST[$formName]))
        echo $_POST[$formName];
}

// set up vars to hold form info
$title = '';
$date = '';
$start_time = '';
$end_time = '';
$location = '';
$description = '';
$max_attendance = '';
$failure_messages = Array();

if(isset($_POST["submit"]) && $_POST["submit"] == "submit") {
    // populate vars
    if(isset($_POST["title"])) {
        $title = htmlspecialchars($_POST["title"]);
    }
    if(isset($_POST["date"])) {
        $date = htmlspecialchars($_POST["date"]);
    }
    if(isset($_POST["start_time"])) {
        $start_time = htmlspecialchars($_POST["start_time"]);
    }
    if(isset($_POST["end_time"])) {
        $end_time = htmlspecialchars($_POST["end_time"]);
    }
    if(isset($_POST["location"])) {
        $location = htmlspecialchars($_POST["location"]);
    }
    if(isset($_POST["description"])) {
        $description = htmlspecialchars($_POST["description"]);
    }
    if(isset($_POST["max_attendance"])) {
        $max_attendance = htmlspecialchars($_POST["max_attendance"]);
    }
    // set up event object
    $event = new Event();
    $event->setTitle($title);
    $event->setDate($date);
    $event->setStartTime($start_time);
    $event->setEndTime($end_time);
    $event->setLocation($location);
    $event->setDescription($description);
    $event->setMaxAttendance($max_attendance);
    $event->setCreatorUserId($_SESSION['uid']);
    
    if (!$event->validate()) {
        foreach ($event->getValidationFailures() as $failure) {
            $message = '<p><strong>Error in '.$failure->getPropertyPath().' field!</strong> '.$failure->getMessage().'</p>';
            array_push($failure_messages, $message);
            // clear out the bad data
            $_POST[$failure->getPropertyPath()] = '';
        }
        unset($message);
    }
    else {
        $event->save();
        $ei = new EventInterest();
        $ei->setInterestedUserId($_SESSION['uid']);
        $event_id = $event->getEventId();
        $ei->setTargetEventId($event_id);
        $ei->save();
        header("Location:../events/details.php?event_id=$event_id");
    }
    // var_dump($failure_messages);
} // end if for was submitted
?>
<!DOCTYPE html>
<html>
<head>
    <?php include_once '../basic_includes/sheets_and_scripts.php' ?>
    <title>RPI Wanna Hangout</title>
</head>
<body>
    <div id="create_event">
    <?php include '../basic_includes/navbar.php' ?>

    <?php foreach($failure_messages as $message) { ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <!-- <strong>Warning!</strong> Better check yourself, you're not looking too good. -->
      <?php echo $message; ?>
    </div>
    <?php }?>

	<div class="panel panel-default">
        <div class="panel-heading">Event Creation Form</div>
        <div class="panel-body">
            <form role="form" id="event_creation_form" action="create.php" method="post">
            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" type="text" id="title" name="title" value="<?php getData('title'); ?>" placeholder="Title">
            </div>
            <div class="form-group">
                <label for="start_time">Date</label>
                <div class="input-group date">
                  <input type="text" class="form-control" id="date" name="date" value="<?php getData('date'); ?>">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
            </div>
            <div class="form-group">
                <label for="start_time">Start Time</label>
               <!--  <div class="input-group date">
                  <input type="text" class="form-control" id="start_time" name="start_time" value="<?php getData('start_time'); ?>">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                </div> -->
                <div class="input-group bootstrap-timepicker">
                    <input type="text" class="form-control" id="start_time" name="start_time" value="<?php getData('start_time'); ?>">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                </div>
            </div>
            <div class="form-group">
                <label for="end_time">End Time</label>
                <!-- <input class="form-control" type="time" id="end_time" name="end_time" value="<?php getData('end_time'); ?>"> -->
                <!-- <div class="input-group date">
                  <input type="text" class="form-control" id="end_time" name="end_time" value="<?php getData('end_time'); ?>" name="start_time" value="<?php getData('start_time'); ?>">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                </div> -->
                <div class="input-group bootstrap-timepicker">
                    <input type="text" class="form-control" id="end_time" name="end_time" value="<?php getData('end_time'); ?>">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                </div>
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <input class="form-control" type="text" id="location" name="location" placeholder="Location" value="<?php getData('location'); ?>">
            </div>
            <div class="form-group">
                <label for="location">Max Attendance</label>
                <input class="form-control" type="number" min="0" id="max_attendance" name="max_attendance" default="2" value="<?php getData('max_attendance'); ?>">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" rows="3" name="description" placeholder="Description" form="event_creation_form"><?php getData('description'); ?></textarea>
            </div>
            <button type="submit" name="submit" value="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        // mark the Create Event button in the nav bar as active
        $("#createLink").addClass("active");

        // create date and time pickers
        $('.input-group.date').datepicker({
            startDate: "+0d",
            endDate: "+14d",
            todayBtn: "linked",
            todayHighlight: true
        });
        $('#start_time').timepicker();
        $('#end_time').timepicker();
    </script>

    </div>
</body>
</html>
