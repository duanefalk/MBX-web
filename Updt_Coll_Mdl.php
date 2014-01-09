<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>

<?php
    if (isset($_POST['var_submit'])) {
	$VarID=$_POST['Coll_VarID'];
        $User="duanefalk";
        $User_CollID="FALKCOLL1";
	$query=("SELECT * FROM Test_Matchbox_Collection WHERE Username='$User' AND User_Coll_ID='$User_CollID' AND VarID='$VarID'");								
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
	<td id="navigation">
                <a href="Search_Models.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Search Models</p></a>
		<a href="Search_Releases.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Search Releases</p></a>
                <a href="Manage_Models_in_Collection.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Manage Models in Collection</p></a>
		<a href="index.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Main Page</p></a>			
	</td>
	<td id="page">
		<h2>View/Update Model in Collection</h2>
		<br />            
		<form name="Updt_Coll_Mdl" action="Updt_Coll_Mdl.php" method="post">
		    <p>Enter Variation ID for model: <input type="text" name="Coll_VarID" value="" size="13" id="Coll_VarID"></p>
		    <input type="submit" value="Submit" id="var_submit" name="var_submit"><br/>
		    <?php
			$User="duanefalk";
			$User_CollID="FALKCOLL1";
		    ?>
        	</form>
                <?php
		    $url= "Updt_Coll_Mdl.php";
		    echo "<a href=\"".$url."\">Cancel</a>";
		?>
            </td>
	</tr>
</table>
<?php include("includes/footer.php"); ?>