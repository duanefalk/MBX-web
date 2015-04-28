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
	        <a href="Updt_Coll.php" class="button dark">View/Update/Delete Your Collection</a>
	    </div>           
	    <div class="large-4 columns">
	    	<a href="Collection_Code_Lists.php" class="button dark">Set up Collection Code Lists</a>
	    </div>

	</div>

</section>

<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="Manage_Collections.php">Manage Collection</a>
		<a href="index.php">Return to Main Page</a>
	</div>
</div>	

<?php include("includes/footer.php"); ?>