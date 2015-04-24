<?php 
	session_start();
	require_once("includes/functions.php");
	require_once("includes/db_connection.php");
	
	$pageTitle = "Home";
	include("includes/header.php");
?>


<!--div class="row slider">
	<div class="large-12 columns">
		<ul class="bxslider">
			<li><img src="images/banner1.jpg" title="" /></li>
			<li><img src="images/NoRelImageAvail.jpg" title="" /></li>
			<li><img src="images/NoImageAvail.jpg" title="" /></li>
		</ul>
	</div>
</div-->


<div class="row">
	<div class="large-5 columns">
		<h4>The Matchbox Professor welcomes you to MBX University!!</h4>
		<p>This site is for Matchbox collectors and anyone interested in Matchbox models. Do a quick lookup of a model using the MAN# (box to the right), or check out the more extensive search abilities in 'Search Models' and 'Search Releases' above.</p>
	</div>
	
	<div class="large-7 columns">
		<div id="quick_search">
			<h3>Quick Search</h3>
			<form action="Search_Models_Process.php" method="post">			
				<label for="MAN_No_1">MAN (FAB) # (i.e. '800'):</label>
				<input type="text" name="Spec_MAN" value="" id="Spec_MAN">
				<input type="submit" class="button" name="submit" value="Search"/>
			</form>
		</div>
	</div>
</div>

<?php require("includes/footer.php"); ?>