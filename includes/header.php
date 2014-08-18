<?php
ob_start(); 
session_start();
?>


<!doctype html>
<html class="no-js" lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Matchbox Cars Database and Collections">
	<meta name="keywords" content="Matchbox,Matchbox cars,Superfast,Regular Wheels,Matchbox packages,Matchbox wheels">
	<meta name="author" content="Duane Falk">
</head>
	
	<title>Matchbox University</title>
		
	<link href='http://fonts.googleapis.com/css?family=Lato:400,400italic,700' rel='stylesheet' type='text/css'>
	<link href="stylesheets/foundation.css" media="all" rel="stylesheet" type="text/css" />
	<link href="stylesheets/jquery.bxslider.css" media="all" rel="stylesheet" type="text/css" />
	<link href="stylesheets/style.css" media="all" rel="stylesheet" type="text/css" />
	<link href="stylesheets/interior.css" media="all" rel="stylesheet" type="text/css" />
	
	<script src="js/vendor/modernizr.js"></script>	
</head>

<body>
	
	<div id="header">
	
		<?php include("includes/navUtility.php"); ?>
		
		<div class="row">
			<div class="large-4 columns">
				<a href="index.php" id="logo"><img src="images/logo.png" width="225" height="59" /></a>
			</div>
			
			<div class="large-8 columns">
				<ul id="mainNav">
					<li><a href="About_site.php">About</a></li>
					<li><a href="Search_Models_Menu.php">Search Models</a></li>
					<li><a href="Search_Releases_Menu.php">Search Releases</a></li>
					<?php 
						if ($_SESSION['Sec_Lvl'] > 1) {
							echo "<li><a href='Collections_Menu.php'>Your Collections</a></li>";
							echo "<li><a href='User_Upload.php'>Upload</a></li>";
						}
					?>
				</ul>
			</div>
		</div>
	</div>
	
	<div id="main">