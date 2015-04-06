<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>

<?php
    if (isset($_POST['var_submit'])) {
	$VarID=$_POST['Coll_VarID'];
	// $location="Dir_Add_Mdl_to_Coll_Process_old.php?model=".$VarID;
	echo "ready to go";	
	redirect_to("Dir_Add_Mdl_to_Coll_Process.php?model=".$VarID);
    }
?>

<div class="row">
	<div class="large-12 columns">
		<h2>Add Variation/Release to Collection</h2>
		
		<form name="Dir_Add_Mdl_to_Coll" action="Dir_Add_Mdl_to_Coll.php" method="post">
		    <label for="Coll_VarID">Enter Variation ID for model:</label>
		    <input type="text" id="Coll_VarID" name="Coll_VarID" value="" size="13" id="Coll_VarID">
		    
		    <input type="submit" class="button dark" value="Submit" id="var_submit" name="var_submit">
		    <a href="Manage_Models_in_Collection.php" class="button dark">Cancel</a>
        </form>
		
		
	</div>
</div>

<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="Manage_Models_in_Collection.php">Manage Mdls in Collection</a>
		<a href="Search_Models.php">Search Models</a>
		<a href="Search_Releases.php">Search Releases</a>
		<a href="index.php">Return to Main Page</a>
	</div>
</div>	

<?php include("includes/footer.php"); ?>