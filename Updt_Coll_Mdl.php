<?php
// we must never forget to start the session
session_start();
?>
<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>

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
	} ELSE {
	    echo "You do not have that model in your collection";
	}

    }
?>

<table id="structure">
<tr>

	<td id="page">
		<h2>View/Update/Delete Model in Collection</h2>
		<br />            
		<form name="Updt_Coll_Mdl" action="Updt_Coll_Mdl.php" method="post">
		    <p>Enter Variation ID for model: <input type="text" name="Coll_VarID" value="" size="13" id="Coll_VarID"></p>
		    <input type="submit" value="Submit" class="button dark" id="var_submit" name="var_submit"><br/>
		    <?php
			$User=$_SESSION['Username'];

		    ?>
        	</form>
                <?php
		    $url= "Updt_Coll_Mdl.php";
		    echo "<a href=\"Updt_Coll_Mdl.php\">Cancel</a>";
		?>
            </td>
	</tr>
</table>

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