<!doctype html>
<html class="no-js" lang="en">
<head>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>Matchbox University</title>

<?php
	// variety of color schemes bases on random number
	$color_choice = rand(1,4);
	
	switch ($color_choice)
		{
		case 1:
		  echo '<link href="stylesheets/public1.css" media="all" rel="stylesheet" type="text/css" />';
		  break;
		case 2:
		  echo '<link href="stylesheets/public2.css" media="all" rel="stylesheet" type="text/css" />';
		  break;
		case 3:
		  echo '<link href="stylesheets/public4.css" media="all" rel="stylesheet" type="text/css" />';
		  break;
		default:
		  echo '<link href="stylesheets/public3.css" media="all" rel="stylesheet" type="text/css" />';
		}
	?>
<link href="stylesheets/foundation.css" media="all" rel="stylesheet" type="text/css" />
<link href="stylesheets/style.css" media="all" rel="stylesheet" type="text/css" />
<link href="stylesheets/interior.css" media="all" rel="stylesheet" type="text/css" />

<script src="js/vendor/modernizr.js"></script>

</head> 
<body>
	
	<div id="header">
		<a href="index.php"><img src="MODLOGO.png" width="180" /></a>
		<h1><a href="index.php">The Matchbox University</a></h1>
	</div>
	<div id="main">