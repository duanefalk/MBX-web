<!doctype html>
<html class="no-js" lang="en">

<head>
	
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
	<title>Matchbox University</title>
	
	<?php
		// variety of color schemes bases on random number
		//$color_choice = rand(1,4);
		
		//switch ($color_choice)
			//{
			//case 1:
			//  echo '<link href="stylesheets/public1.css" media="all" rel="stylesheet" type="text/css" />';
			//  break;
			//case 2:
			//  echo '<link href="stylesheets/public2.css" media="all" rel="stylesheet" type="text/css" />';
			//  break;
			//case 3:
			//  echo '<link href="stylesheets/public4.css" media="all" rel="stylesheet" type="text/css" />';
			//  break;
			//default:
			//  echo '<link href="stylesheets/public3.css" media="all" rel="stylesheet" type="text/css" />';
			//}
		?>
		
	<link href='http://fonts.googleapis.com/css?family=Lato:400,400italic,700' rel='stylesheet' type='text/css'>
	<link href="stylesheets/foundation.css" media="all" rel="stylesheet" type="text/css" />
	<link href="stylesheets/jquery.bxslider.css" media="all" rel="stylesheet" type="text/css" />
	<link href="stylesheets/style.css" media="all" rel="stylesheet" type="text/css" />
	<link href="stylesheets/interior.css" media="all" rel="stylesheet" type="text/css" />
	
	<script src="js/vendor/modernizr.js"></script>
	

</head>

<body class="home">
	
	<div id="header-home">
	
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
							echo "<li><a href='Collections_Menu.php'>Manage Collections</a></li>";
							echo "<li><a href='User_Upload.php'>Upload</a></li>";
						}
					?>
				</ul>
			</div>
		</div>
		
		<div class="row" id="banner">
			<div class="large-7 columns" id="bannerText">
				<h2>What is the Matchbox University?</h2>
				<p>The Matchbox University is an on-line database of Matchbox ‘miniatures’, from regular wheels models up through this year’s versions.</p>
				<p>The listings are built in a relational database to catalog and categorize the models uniquely.</p>
				<p><a href="About_site.php" class="button">Learn More</a></p>
			</div>
			<div class="large-5 columns">
				<img src="images/banners/professor.png" />
			</div>
		</div>
	</div>
	
	<div id="main">