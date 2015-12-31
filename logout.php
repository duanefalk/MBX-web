<?php
	session_start();
	session_destroy();
	
	$pageTitle = "Logging Out";

	// now that the user is logged out, go to login page
	header('Location: Authenticate-test.php');
?>