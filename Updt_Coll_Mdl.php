<?php
	session_start();
	$pageTitle = "View/Update/Delete Collection Model";
	require_once("includes/db_connection.php");
	include("includes/header.php");
	include("includes/functions.php");
?>

<div class="row">
	<div class="large-12 columns">
		<h2>View/Update/Delete Model in Collection</h2>
		
		<?php
		    if (isset($_POST['var_submit'])) {
				$VarID=$_POST['Coll_VarID'];
			    $User=$_SESSION['Username'];
				
				// check for model in coll
				
				$query=("SELECT * FROM Matchbox_Collection WHERE Username='$User' AND VarID='$VarID'");								
				$result=0;
				$result=mysql_query($query);
				
				if (mysql_num_rows($result) != 0) { 
				    $No_Copies= (mysql_num_rows($result));
				    $location="Updt_Coll_Mdl_Get_Copy.php?model=".$VarID."&copy=".$No_Copies;
				    //echo "ready to go";	
				    redirect_to($location);
				} else {
				    echo "<h4>You do not have that model in your collection</h4>";
				}
		    }
		?>
		
		
		<form name="Updt_Coll_Mdl" action="Updt_Coll_Mdl.php" method="post">
		    <label for="Coll_VarID">Enter Variation ID for model:</label>
		    <input type="text" name="Coll_VarID" placeholder="Variation ID" value="" id="Coll_VarID">
		    <div class="row">
			    <div class="large-3 small-6 columns">
				    <input type="submit" value="Submit" class="button dark" id="var_submit" name="var_submit">
			    </div>
			    <div class="large-3 small-6 columns end">
				    <a class="button dark cancel" href="Manage_Models_in_Collection.php">Cancel</a>
			    </div>
		    </div>
		    <?php
				$User=$_SESSION['Username'];
		    ?>
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