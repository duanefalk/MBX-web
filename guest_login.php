<?php
	session_start();
	
	$pageTitle = "Logging in as Guest";
	
	// set security level to 1 for guest
	$_SESSION['sec_level']=1;
	$_SESSION['Username']="guest";
	 
	// set the session
	$_SESSION['basic_is_logged_in'] = true;
	
	// move to the main page
	header('Location: index.php');
	exit;
?>