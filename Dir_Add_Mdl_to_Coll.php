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

<table id="structure">
<tr>
	<td id="navigation">
                <a href="Search_Models.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Search Models</p></a>
		<a href="Search_Releases.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Search Releases</p></a>
                <a href="Update_Mdls_in_Coll.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Update Models in Your Collection</p></a>
		<a href="index.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Main Page</p></a>			
	</td>
	<td id="page">
		<h2>Add Variation/Release to Collection</h2>
		<br />            
		<form name="Dir_Add_Mdl_to_Coll" action="Dir_Add_Mdl_to_Coll.php" method="post">
		    <p>Enter Variation ID for model: <input type="text" name="Coll_VarID" value="" size="13" id="Coll_VarID"></p>
		    <input type="submit" value="Submit" id="var_submit" name="var_submit"><br/>
        	</form>
                <?php
		    $url= "Dir_Add_Mdl_to_Coll.php";
		    echo "<a href=\"".$url."\">Cancel</a>";
		?>
            </td>
	</tr>
</table>
<?php include("includes/footer.php"); ?>