<?php
// i will keep yelling this
// DON'T FORGET TO START THE SESSION !!!
session_start();

// if the user is logged in, unset the session
//if (isset($_SESSION['basic_is_logged_in'])) {
//   unset($_SESSION['basic_is_logged_in']);
//}


session_destroy();


// now that the user is logged out,
// go to login page
header('Location: Authenticate-test.php');
?>