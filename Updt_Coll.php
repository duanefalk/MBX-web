<?php
// we must never forget to start the session
session_start();
?>
<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>

<?php
    if (isset($_POST['submit'])) {
	$CollID=$_POST['Coll_ID'];
        $User=$_SESSION['Username'];

	$result=0;
	$query=("SELECT * FROM Matchbox_User_Collections WHERE Username='$User' AND User_Coll_ID='$CollID' AND User_Coll_Inactiv_Flag=\"0\"");								
	$result=mysql_query($query);
	if (mysql_num_rows($result) != 0) {
	    $location="Updt_Coll_Process.php?CollID=".$CollID;
	    //echo "ready to go";	
	    redirect_to($location);
	} else {
	    echo "You do not have a collection with that name<br></><br></>";
	}

    }
?>

<div class="row">
	<div class="large-12 columns">
		<h2>Update/Delete Collection</h2>
		<br />            
		<form name="Updt_Coll" action="Updt_Coll.php" method="post">
			<p>Enter ID of collection to Update/Delete: <input type="text" name="Coll_ID" value="" size="60" id="Coll_ID"></p>
			<div class="row">
				<div class="large-2 small-6 columns">
					<input type="submit" value="Submit" class="button dark" id="submit" name="submit"><br/>
				</div>
				<div class="large-2 small-6 columns end">
					<a class="button dark cancel" href="Manage_Collections.php">Cancel</a>
				</div>
			</div>			
    	</form>
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