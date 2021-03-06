<?php
	session_start();
	$pageTitle = "Collection Successfully Deleted";
	$pageDescription = "Processing the deletion of a Seller or Location code from your Matchbox University collection.";
	require_once("includes/db_connection.php");
	include("includes/header.php");
	include("includes/functions.php");
?>

<div class="row">
	<div class="large-12 columns">

		<h2>Collection Successfully Deleted</h2>
		<p>If you deleted this in error, please contact the system administrator at info@mbx-u.com for help.</p>
		<p><a class='button dark' href="manage-collections.php">Return to Manage Collection</a></p>

    </div>
</div>


<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="manage-collections.php">Manage Collection</a>
		<a href="index.php">Return to Main Page</a>
	</div>
</div>

<?php include("includes/footer.php"); ?>