<?php 
	require_once("includes/db_connection.php");	
	$pageTitle = "Manage Models in Collection";
	$pageDescription = "Add, view, update, or delete a matchbox car model from your Matchbox University collection.";
	include("includes/header.php");
	require_once("includes/functions.php"); 
?>

<div class="row">
	<div class="large-12 columns">
		<h2>Manage the Models in Your Collection</h2>
	</div>
</div>

<div class="row actionButtons">
	<div class="large-4 columns">
		<a href="dir-add-mdl-to-coll.php" class="button dark">Add a Model</a>
	</div>
	<div class="large-4 columns end">
        <a href="update-collection-model.php" class="button dark">View/Update/Delete a Model</a>
    </div>

</div>

<div class="row">
	<div class="large-4 large-centered columns end">
        <a href="collections-menu.php" class="button dark block">Return to Collections Menu</a>	
	</div>
</div>

<?php include("includes/footer.php"); ?>