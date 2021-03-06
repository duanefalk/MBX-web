<?php 
	require_once("includes/db_connection.php");
	$pageTitle = "Add Variation/Release to Collection";
	$pageDescription = "Add a variation or release to your Matchbox University collection.";
	include("includes/header.php");
	include("includes/functions.php"); 
?>

<?php
    if (isset($_POST['var_submit'])) {
	$VarID=$_POST['Coll_VarID'];
	// $location="Dir_Add_Mdl_to_Coll_Process_old.php?model=".$VarID;
	echo "ready to go";	
	redirect_to("dir-add-mdl-to-coll-process.php?model=".$VarID);
    }
?>

<div class="row">
	<div class="large-12 columns">
		<h2>Add Variation/Release to Collection</h2>
		
		<form name="Dir_Add_Mdl_to_Coll" action="dir-add-mdl-to-coll.php" method="post">
		    <label for="Coll_VarID">Enter Variation ID for model:</label>
		    <input type="text" id="Coll_VarID" name="Coll_VarID" value="" size="13" id="Coll_VarID">
		    
		    <input type="submit" class="button dark" value="Submit" id="var_submit" name="var_submit">
		    <a href="manage-models-in-collection.php" class="button dark">Cancel</a>
        </form>
		
		
	</div>
</div>

<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="manage-models-in-collection.php">Manage Mdls in Collection</a>
		<a href="search-models-menu.php">Search Models</a>
		<a href="search-releases-menu.php">Search Releases</a>
		<a href="index.php">Return to Main Page</a>
	</div>
</div>	

<?php include("includes/footer.php"); ?>