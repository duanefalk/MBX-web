<?php ob_start(); ?>
<?php
// we must never forget to start the session
session_start();
?>

<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>

<?php
    if (isset($_POST['var_copy_submit'])) {
	$VarID=$_POST['Coll_VarID'];
	$Copy=$_POST['Coll_Copy'];
	$location="Updt_Coll_Mdl_Process.php?model=".$VarID."&copy=".$Copy;	
	redirect_to($location);
	} 
//if post not set do initial form 
?>

<div class="row">
	<div class="large-12 columns">
		<h2>View/Update/Delete Model in Collection</h2>
		
		<?php
		    $Var_to_Updt=$_GET["model"];
		    $No_of_Copies= $_GET["copy"];

		    $picture1= IMAGE_URL . $Var_to_Updt."_1.jpg";
		    $picture1_loc=IMAGE_PATH. $Var_to_Updt."_1.jpg";
                    if (file_exists($picture1_loc)) {
                        echo "<img src=".$picture1." width=\"240\">";
                    } else {
                        echo "<img src=".DEFAULT_IMAGE." width=\"240\">";
                    }
		    echo "<br />";
		    
		    if ($No_of_Copies=="1") {
				//echo "in 1 copy loop";
				//echo $Var_to_Updt." ".$No_of_Copies;
				//exit;
				$location="Updt_Coll_Mdl_Process.php?model=".$Var_to_Updt."&copy=".$No_of_Copies;
				redirect_to($location);
		    } else {
				echo "<p>Variation to view/edit: " . $Var_to_Updt . "</p>";
				echo "<p>You have " . $No_of_Copies . " copies in your collection, select the copy to view/edit</p>";
		    } 
		?> 
		    
		    <form name="Updt_Coll_Mdl_Get_Copy" action="Updt_Coll_Mdl_Get_Copy.php" method="post">
				<input type="hidden" name="Coll_VarID" value="<?php echo $_GET["model"]; ?>" size="13" id="Coll_VarID">
				
				<label for="Coll_Copy">Copy No.:</label>
				<input type="text" id="Coll_Copy" name="Coll_Copy" value="1" size="2" id="Coll_Copy">
				
				<input type="submit" name="var_copy_submit" class="button dark" value="Submit" id="var_copy_submit"/>
		    </form>
		    
		    <?php
				$url= "Updt_Coll_mdl.php?model=".$_GET["model"];
			?>
			<a href="<?php echo $url; ?>" class="button dark">Cancel</a>
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