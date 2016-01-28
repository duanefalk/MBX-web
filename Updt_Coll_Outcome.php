<?php
	session_start();
	$pageTitle = "Updating Collection";
	$pageDescription = "Your Matchbox University collection was successfully updated.";
	require_once("includes/db_connection.php");
	include("includes/header.php");
	include("includes/functions.php");
?>

<div class="row">
	<div class="large-12 columns">
		
		<h2>Collection Successfully Updated!</h2>
		<p><a class='button dark' href="Manage_Collections.php">Return to Manage Collection</a></p>
		
    </div>
</div>


<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="Manage_Collections.php">Manage Collection</a>
		<a href="index.php">Return to Main Page</a>
	</div>
</div>	
         
<?php include("includes/footer.php"); ?>