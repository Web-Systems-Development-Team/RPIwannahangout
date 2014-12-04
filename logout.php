<?php

	//start session
	session_start();
	
	require_once 'database_access.php';

	//redirect function, sends user to index.php
	function redirect() {
		header('Location:index.php');
	}

	//if user is not logged in, redirect
	if (!isset($_SESSION['uid'])) {
		redirect();
	}

	//session_destroy returned false, 
	if (!session_destroy()) {
		// echo "ERROR: Session could not be destroyed.";
	}
	else {
		// echo "Session successfully destroyed.";
	}
	redirect();
	


	

?>