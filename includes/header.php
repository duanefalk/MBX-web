<?php
ob_start(); 
session_start();

include_once("includes/analyticstracking.php");
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Matchbox Cars Database and Collections">
	<meta name="keywords" content="Matchbox,Matchbox cars,Superfast,Regular Wheels,Matchbox packages,Matchbox wheels">
	<meta name="author" content="Duane Falk">
	<link rel="icon" href="favicon.ico" type="image/x-icon" />
	<link rel="apple-touch-icon" href="apple-touch-icon.png" />

	<title>Matchbox University<?php if ($pageTitle) { echo " | " . $pageTitle; } ?></title>
	
	<link href='http://fonts.googleapis.com/css?family=Lato:400,400italic,700' rel='stylesheet' type='text/css'>
	<link href="stylesheets/foundation.css" media="all" rel="stylesheet" type="text/css" />
	<link href="stylesheets/lightbox.css" media="all" rel="stylesheet" type="text/css" />
	<link href="stylesheets/jquery.bxslider.css" media="all" rel="stylesheet" type="text/css" />
	<link href="stylesheets/style.css" media="all" rel="stylesheet" type="text/css" />
	<link href="stylesheets/interior.css" media="all" rel="stylesheet" type="text/css" />
	<link href="stylesheets/print.css" media="all" rel="stylesheet" type="text/css" />
	
	<script src="js/vendor/modernizr.js"></script>	
</head>

<?php
	//Adding Page Title to <body> as a class="";
	$pageTitle = strtolower($pageTitle);
	$pageTitle = str_replace(' ', '_', $pageTitle);
?>

<body <?php if ($pageTitle) { echo "class='" . $pageTitle . "'"; } ?>>
	
	<div id="header">
	
		<?php include("includes/navUtility.php"); ?>
		
		<div class="row">
			<div class="large-3 columns">
				<a href="index.php" id="logo"><img src="images/logo.png" width="225" height="59" /></a>
			</div>
			
			<div class="large-9 columns">
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
					<li><a href="MBX101_Menu.php">MBX 101</a></li>
				</ul>
			</div>
		</div>
		
		<?php if ($pageTitle == 'home') { ?>
			<div class="row" id="banner">
				<div class="large-7 columns" id="bannerText">
					<h2>What is the Matchbox University?</h2>
					<p>The Matchbox University is an on-line database of Matchbox ‘miniatures’, from regular wheels models up through this year’s versions.</p>
					<p>The listings are built in a relational database to catalog and categorize the models uniquely.</p>
					<p><a href="About_site.php" class="button">Learn More</a></p>
				</div>
				<div class="large-5 columns" id="bannerImage">
					<img src="images/banners/professor.png" />
				</div>
			</div>
		<?php } ?>		
		
	</div>
	
	<div id="main">