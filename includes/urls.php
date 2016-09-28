<?php
	require 'includes/altorouter.php';
	$router = new AltoRouter();
	$router->setBasePath('');
	
	/* Setup the URL routing. This is production ready. */
	// Main routes that non-customers see
	//$router->map( 'GET', '/brandPlan.php', 'brand-plan' );
	$router = new AltoRouter();
	
	$router->map('GET','/',function() {require 'index.php';});
	$router->map('GET','/about',function() {require 'about-site.php';});
	$router->map('GET','/search-models',function() {require 'Search_Models_Menu.php';});
	$router->map('GET','/search-releases',function() {require 'Search_Releases_Menu.php';});
	$router->map('GET','/log-in',function() {require 'authenticate-test.php';});
	$router->map('GET','/edit-account',function() {require 'edit-account-form.php';});
	$router->map('GET','/log-out',function() {require 'logout.php';});
	$router->map('GET','/create-account',function() {require 'create-user-account-form.php';});
	$router->map('GET','/your-collections',function() {require 'collections-menu.php';});
	$router->map('GET','/upload',function() {require 'user-upload.php';});
	$router->map('GET','/website-updates',function() {require 'website-updates.php';});	
	
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