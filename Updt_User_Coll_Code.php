<?php
// we must never forget to start the session
session_start();
?>
<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>

<?php
    if (isset($_POST['var_submit'])) {
	$CollCode=$_POST['Coll_Code'];
        $User=$_SESSION['Username'];

	$result=0;
	$query=("SELECT * FROM Matchbox_User_Coll_Value_Lists WHERE Username='$User' AND Coll_List_Value='$CollCode' AND Coll_List_Val_InactivFlg=\"0\"");								
	$result=mysql_query($query);
	if (mysql_num_rows($result) != 0) {
	    $location="Updt_User_Coll_Code_Process.php?code=".$CollCode;
	    //echo "ready to go";	
	    redirect_to($location);
	} else {
	    echo "You do not have that code in your collection<br></><br></>";
	}

    } else {
?>

<table id="structure">
	<tr>
		<td id="page">
			<h2>Update/Delete Seller or Location Codes</h2>
			<br />            
			<form name="Updt_User_Coll_Code" action="Updt_User_Coll_Code.php" method="post">
				<p>Enter Seller or Location Code to Update/Delete: <input type="text" name="Coll_Code" value="" size="60" id="Coll_Code"></p>
				<input type="submit" value="Submit" class="button dark" id="var_submit" name="var_submit"><br/>
				<a href=\"Updt_User_Coll_Code.php\">Cancel</a>
	        	</form>
	            </td>
	</tr>
</table>

	<?php } ?>

<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="Manage_Collections.php">Manage Collection</a>
		<a href="index.php">Return to Main Page</a>
	</div>
</div>	

<?php include("includes/footer.php"); ?>