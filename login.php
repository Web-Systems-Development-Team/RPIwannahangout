<?php

//CAS class is a wrapper for using the RPI CAS library on top of the phpCAS library.
//Used in: https://github.com/joshdk/rpi-housing/blob/master/src/api/core/cas.php
class cas{
//Class constructor
//ex. $cas = new cas();
    public function __construct(){
    }
//Connect to CAS server
//ex. $cas->connect();
    public function connect(){
        phpCAS::client(CAS_VERSION_2_0,"cas-auth.rpi.edu",443,"/cas");
        phpCAS::setNoCasServerValidation();
    }
//Force CAS login
//ex. $cas->login();
    public function login(){
        return phpCAS::forceAuthentication();
    }
//Force CAS logout
//ex. $cas->logout();
    public function logout(){
        return phpCAS::logout();
    }
//Check if user is authenticated
//ex. $cas->is_authenticated();
    public function is_authenticated(){
        return phpCAS::checkAuthentication();
    }
//Get an authenticated user's name
//ex. $cas->get_user();
    public function get_user(){
        return phpCAS::getUser();
    }
}

//phpCAS library
require_once 'phpCAS/CAS.php';

//propel functionality
require_once 'database_access.php';

//Force login
$cas = new cas();
$cas->connect();
$cas->login();

//If authentication succeeded
if($cas->is_authenticated()) {
    $rcs_id = $cas->get_user();
    //Check to see if the user already existed in the database.
    //If not, create a user account for them.
    $q = new UserQuery();
    $user = $q->findPK($rcs_id);
    var_dump($user);
} else {
    echo "Not authenticated";
}

?>

<html>
<head>
  <?php include_once 'basic_includes/head_includes.php' ?>
  <link rel="stylesheet" href="assets/css/style.css">
  <title>Log In</title>
</head>
<body>
  <?php include 'basic_includes/navbar.php' ?>
  <p>This HTML probably will not need to exist in the final product.</p>
</body>
</html>
