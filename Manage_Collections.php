<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php require_once("includes/functions.php"); ?>
            
<section class="row">
	<h2>Create/Configure Your Collections</h2>
	
	<div class="row actionButtons">
		<div class="large-4 columns">
			<a href="Create_Collection.php" class="button dark">Create a Collection</a>
		</div>
		<div class="large-4 columns">
	    	<a href="Collection_Code_Lists.php" class="button dark">Set up Collection Code Lists</a>
	    </div>
	    <div class="large-4 columns">   
	        <a href="Updt_Coll.php" class="button dark">View/Update Your Collections</a>
	    </div>
	</div>
	<div class="row actionButtons">
		<div class="large-4 columns">
			<a href="Delete_Collection.php" class="button dark">Delete a Collection</a>
		</div>
		<div class="large-4 columns end">
	    	<a href="Collections_Menu.php" class="button dark">Return to Collections Menu</a>
	    </div>
	</div>
</section>

<?php include("includes/footer.php"); ?>