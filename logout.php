<?php
	session_start();
	session_destroy();

	// now that the user is logged out, go to login page
	header('Location: Authenticate-test.php');
?>