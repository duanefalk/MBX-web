<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>

<?php
    if (isset($_POST['var_copy_submit'])) {
	$VarID=$_POST['Coll_VarID'];
	$Copy=$_POST['Coll_Copy'];
	$location="Updt_Coll_Mdl_Process.php?model=".$VarID."&copy=".$No_Copy;	
	redirect_to($location);
	} 
//if post not set do initial form 
?>

<table id="structure">
<tr>
	<td id="navigation">
                <a href="Search_Models.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Search Models</p></a>
		<a href="Search_Releases.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Search Releases</p></a>
                <a href="Manage_Models_in_Collection.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Manage Collection</p></a>
		<a href="index.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Main Page</p></a>			
	</td>
	<td id="page">
		<h2>View/Update Model in Collection</h2>
		<br />

		<?php
		    $Var_to_Updt=$_GET['model'];
		    $picture1= IMAGE_URL . $Var_to_Updt."_1.jpg";
		    $picture1_loc=IMAGE_PATH. $Var_to_Updt."_1.jpg";
                    if (file_exists($picture1_loc)) {
                        echo "<img src=".$picture1." width=\"240\">";
                    } else {
                        echo "<img src=".DEFAULT_IMAGE." width=\"240\">";
                    }
		    echo "<br />";

		    if ($_GET["copy"]==1) {
			$location="Updt_Coll_Mdl_Process.php?model=".$Var_to_Updt."&copy=".$_GET["copy"];
			redirect_to($location);
		    } else {
			echo "Variation to view/edit: ".$_GET["model"]."<br />";
			echo "You have ".$_GET["copy"]." copies in your collection, select the copy to view/edit";
		    }
		    ?> 
		    <form name="Updt_Coll_Mdl_Get_Copy" action="Updt_Coll_Mdl_Get_Copy.php" method="post">
			<input type="hidden" name="Coll_VarID" value="<?php echo $_GET["model"]; ?>" size="13" id="Coll_VarID"></p>
			<p>Copy No.:      <input type="text" name="Coll_Copy" value="1" size="2" id="Coll_Copy"></p>
			<input type="submit" name="var_copy_submit" value="Submit" id="var_copy_submit"/>
		    </form>
		    <?php
			$url= "Updt_Coll_mdl.php?model=".$_GET["model"];
			echo "<a href=\"".$url."\">Cancel</a>";
		    ?>
            </td>
	</tr>
</table>
<?php include("includes/footer.php"); ?>