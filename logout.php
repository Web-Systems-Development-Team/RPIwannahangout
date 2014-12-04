<?php
	session_start();

	if(isset($_SESSION['uid'])) {
    	$_SESSION['uid']  = '';
	}

	require_once 'phpCAS/CAS.php';
	phpCAS::client(CAS_VERSION_2_0,"cas-auth.rpi.edu",443,"/cas");
	phpCAS::setNoCasServerValidation();

	if (phpCAS::checkAuthentication()) {
		// phpCAS::logout();
		phpCAS::logoutWithUrl('http://rpiwannahangout.website/index.php');
		session_unset();
		session_destroy();
	} else {
		session_unset();
		session_destroy();
		header('Location:index.php');
	}

?>