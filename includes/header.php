<html>
	<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<title>Matchbox University</title>
		<?php
		// variety of color schemes bases on random number
		$color_choice=rand(1,4);
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
		<link href="stylesheets/style.css" media="all" rel="stylesheet" type="text/css" />	
	</head> 
	<body>
		<div id="header">
			<a href="Main_Page.php"><img src="MODLOGO.png" width="180" /></a>
			<a href="Main_Page.php"><h1>The Matchbox University</h1></a>
		</div>
		<div id="main">