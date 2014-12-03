<?php

//Redirects to the previous page, or to index.php if not specified in GET.
function redirect() {
    $prevpage = 'index.php';
    if(isset($_GET['source'])) 
        $prevpage = $_GET['source'];
    header("Location:" . $prevpage);
}

//If user went to login.php but already has a session, redirect
if(isset($_SESSION['uid'])) {
    redirect();
}

//Same getData() as in the other forms.
function getData($formName) {
    if(isset($_POST[$formName]))
        echo $_POST[$formName];
}

//Starts a session and then redirects back to the main page.
function beginSession($user_id) {
    if(!session_start()) {
        echo "ERROR: session could not be started.";
    }
    else {
        echo "Successfully beginning session " . $user_id;
        $_SESSION['uid'] = $user_id;
    }
    redirect();
}
    
//propel functionality
require_once 'database_access.php';

//User has logged in and the form has sent them back to this.
if(!isset($_POST['submit'])) {
    
    //phpCAS library
    require_once 'phpCAS/CAS.php';
    
    $uid = 0;
    
    //Force login
    phpCAS::client(CAS_VERSION_2_0,"cas-auth.rpi.edu",443,"/cas");
    phpCAS::setNoCasServerValidation();
    phpCAS::forceAuthentication();
    
    //If authentication succeeded
    if(phpCAS::checkAuthentication()) {
        /* This creates its own session, so replace the RPICAS session with ours
           We won't destroy the cookie set by CAS though.
           So if you log out, then go to log in again, it should not need you to
           go through the CAS portal.
        */
        session_unset();
        session_destroy();
        
        $rcs_id = phpCAS::getUser();
        //Check to see if the user already existed in the database.
        //If not, create a user account for them.
        
        $q = UserQuery::create()->filterByRcsId($rcs_id)->findOne();
        //Note: there should only be zero or one results here
        //is there anything we can do to make RCS IDs uniquely identified?

        if(empty($q)) {
            //No rcsid found in database, so we need to add a new user
            //The form will be displayed, so just fall through
        }
        else {
            $uid = $q->getUserId();
            //rcsid found in database   
        
            //Set up session and return to the main page
            beginSession($uid);
        }

    } else {
        echo "Not authenticated";
    }
} else {
    //In this block, POST['submit'] is set, so the user is returning
    //from submitting the form.

    //Init variables
    $rcsid='';
    $fname='';
    $lname='';
    $email='';

    //Set variables to form
    if(isset($_POST['rcsid']))
        $rcsid = htmlspecialchars($_POST['rcsid']);
    if(isset($_POST['fname']))
        $fname = htmlspecialchars($_POST['fname']);
    if(isset($_POST['lname']))
        $lname = htmlspecialchars($_POST['lname']);
    if(isset($_POST['email']))
        $email = htmlspecialchars($_POST['email']);

    //Create user object
    $user = new User();
    $user->setRcsId($rcsid);
    $user->setFirstName($fname);
    $user->setLastName($lname);
    $user->setEmail($email);

    if(!$user->validate()) {
        $failure_messages = Array();
        foreach ($user->getValidationFailures() as $failure) {
            $message = '<p><strong>Error in '.$failure->getPropertyPath().' field!</strong> '.$failure->getMessage().'</p>';
            array_push($failure_messages, $message);
            // clear out the bad data
            $_POST[$failure->getPropertyPath()] = '';
        }
        unset($message);
    }
    else {
        $user->save();
        $uid = $user->getUserId();
        beginSession($uid);
        redirect();
    }
}
        

?>

<html>
<head>
  <?php include_once 'basic_includes/sheets_and_scripts.php' ?>
  <link rel="stylesheet" href="assets/css/style.css">
  <title>New User</title>
</head>
<body>
  <?php include 'basic_includes/navbar.php' ?>

  <div class="panel panel-default">
    <div class="panel-heading">Please Register</div>
    <div class="panel-body">
      <form role="form" id="user_creation_form" action="login.php" method="post">
    <input type="hidden" name="rcsid" value="<?php echo $rcs_id; ?>">
	<div class="form-group">
	  <label for="fname">First Name</label>
	  <input class="form-control" type="text" id="fname" name="fname" value="<?php getData('fname'); ?>">
	  <label for="lname">Last Name</label>
	  <input class="form-control" type="text" id="lname" name="lname" value="<?php getData('lname'); ?>">
	  <label for="email">Preferred Email Address</label>
	  <input class="form-control" type="text" id="email" name="email" value="<?php getData('email'); ?>">
	</div>
	<button type="submit" name="submit" value="submit" class="btn btn-default">Submit</button>
      </form>
    </div>
  </div>
</body>
</html>
