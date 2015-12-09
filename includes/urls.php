<?php
	require 'includes/altorouter.php';
	$router = new AltoRouter();
	$router->setBasePath('');
	
	/* Setup the URL routing. This is production ready. */
	// Main routes that non-customers see
	//$router->map( 'GET', '/brandPlan.php', 'brand-plan' );
	$router = new AltoRouter();
	
	$router->map('GET','/',function() {require 'index.php';});
	$router->map('GET','/about',function() {require 'About_site.php';});
	$router->map('GET','/search-models',function() {require 'Search_Models_Menu.php';});
	$router->map('GET','/search-releases',function() {require 'Search_Releases_Menu.php';});
	$router->map('GET','/log-in',function() {require 'Authenticate-test.php';});
	$router->map('GET','/create-account',function() {require 'Create_User_Account_Form.php';});
	$router->map('GET','/your-collections',function() {require 'Collections_Menu.php';});
	$router->map('GET','/upload',function() {require 'User_Upload.php';});	
	
	$match = $router->match();
	
	if( $match) {
		//calls in the brandPlan.pph and replaces the home page
		call_user_func_array( $match['target'], $match['params'] ); 
	} else {
		// no route was matched
		header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
	}
	//the normal home page header imports
	//include 'includes/header.php';
?>