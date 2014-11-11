<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php require_once("includes/functions.php"); ?>

<div class="row">
	<div class="large-12 columns">
		<h2>Manage the Models in Your Collection</h2>
	</div>
</div>

<div class="row actionButtons">
	<div class="large-4 columns">
		<a href="Dir_Add_Mdl_to_Coll.php" class="button dark">Add a Model</a>
	</div>
	<div class="large-4 columns end">
        <a href="Updt_Coll_Mdl.php" class="button dark">View/Update/Delete a Model</a>
    </div>

</div>

<div class="row">
	<div class="large-4 large-centered columns end">
        <a href="Collections_Menu.php" class="button dark block">Return to Collections Menu</a>	
	</div>
</div>

<?php include("includes/footer.php"); ?>