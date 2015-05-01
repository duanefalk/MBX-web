<?php
// we must never forget to start the session
session_start();
?>
<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>

<div class="row">
	<div class="large-12 columns">

<?php
    if (isset($_POST['var_submit'])) {
	$CollCode=$_POST['Coll_Code'];
        $User=$_SESSION['Username'];

	$result=0;
	$query=("SELECT * FROM Matchbox_User_Coll_Value_Lists WHERE Username='$User' AND Coll_List_Val_InactivFlg=\"0\"");								
	$result=mysql_query($query);
	if ($result) {
	    $rows=mysql_num_rows($result);
	    if ($rows > 0) {
		$location="Updt_User_Coll_Code_Process.php?code=".$CollCode;
		//echo "ready to go";	
		redirect_to($location);
	    } else {
		echo "<p>You have no codes for your collection</p>";
	    }
	}

    } else { ?>

		<h2>Update/Delete Seller or Location Codes</h2>
		<form name="Updt_User_Coll_Code" action="Updt_User_Coll_Code.php" method="post" data-parsley-validate>
			<div class="formRow">
				<label for="Coll_Code">Enter Seller or Location Code to Update/Delete:</label>
				<input type="text" name="Coll_Code" value="" size="60" id="Coll_Code"  required>
			</div>
			
			<div class="row">
				<div class="large-2 small-6 columns">
					<input type="submit" value="Submit" class="button dark" id="var_submit" name="var_submit">
				</div>
				<div class="large-2 small-6 columns end">
					<a class="button dark cancel" href="Updt_User_Coll_Code.php">Cancel</a>
				</div>
			</div>
    	</form>

    <?php } ?>

	</div>
</div>


<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="Collection_Code_Lists.php">Manage Code Lists</a>
		<a href="index.php">Return to Main Page</a>
	</div>
</div>	

<?php include("includes/footer.php"); ?>