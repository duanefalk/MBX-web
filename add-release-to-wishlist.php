<?php
	ob_start();
	session_start();
	require_once("includes/db_connection.php");
	$pageTitle = "Add Release to Wishlist";
	$pageDescription = "Add a this matchbox model release to your wishlist collection.";
	include("includes/header.php");
	include("includes/functions.php");
?>

<div class="row">
    <div class="large-12 columns">

	<ul class="large-block-grid-2">
	    <li class="carGrid">
	
		<?php
			if (isset($_POST['rel_to_add'])) {
			
			
			    $User=$_SESSION['Username'];
			    $query3=("SELECT * FROM Matchbox_User_Collections WHERE Username='$User'");								
			    $result3=0;
			    $rows_count3=0;									
			    $result3 = mysql_query($query3);
			    $row3=mysql_fetch_array($result3);
			    $User_Coll_ID=$row3["User_Coll_ID"];
			    
			    //Fields:
			    $RelID=$_POST["rel_to_add"];
			    $VarID=substr($RelID,0,-3);
			    $VerID=substr($VarID,0,10);
			    $UMID=substr($VerID,0,6);
				
			    $Wishlist_InactivFlg="0";
			
			    $query="INSERT INTO Matchbox_User_Wishlist (Username, User_Coll_ID, UMID, VerID, VarID, RelID, Wishlist_InactivFlg) 
			    VALUES ('$User', '$User_Coll_ID', '$UMID','$VerID', '$VarID', '$RelID', '$Wishlist_InactivFlg')";
			
			    $outcome=mysql_query($query);
			
			    if ($outcome) {
			        redirect_to("outcomes.php?message=Rel_success&model=$RelID");
			    } else {
			        echo "<p>Subject creation failed. Please review entries.</p>";
			        echo "<p>".mysql_error()."</p>";
			        //drop down to form again
			    }   
			}
			//if post not set do initial form 
		?>
		
		<h2>Add Release to Wishlist</h2>

		<?php
		    $Rel_to_Add=$_GET["model"];
		    $User=$_SESSION['Username'];
		    echo "<p><strong>Release Selected:</strong> " . $Rel_to_Add . "</p>";
		
		    $picture1 = IMAGE_URL . $Rel_to_Add . "_1.jpg";
		    $picture1_loc = IMAGE_PATH . $Rel_to_Add . "_1.jpg";
		
		    if (file_exists($picture1_loc)) {
		        echo "<p><img src=".$picture1." /></p>";
		    } else {
		        //no photo, echo DEFAULT_IMAGE;
		        echo "<p><img src=".DEFAULT_IMAGE." /></p>";
		    }
		?>
		
		<div class="row">
		    <div class="large-3 small-6 columns">
		        <form name="Add_Rel_to_Wishlist" action="add-release-to-wishlist.php" method="post">
			    <input class="button dark" type="submit" value="<?php echo $Rel_to_Add?>" id="submit" name="rel_to_add" />
			</form>
		</div>
		<div class="large-6 columns">
		    <?php
			$url = "release-detail.php?model=" . $Rel_to_Add;
			echo "<a href=\"".$url."\">Cancel</a>";
		    ?>
		</div>
	    </div>
	    </li>
	</ul>	    
		
    </div>
</div>

<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="search-models-menu.php">Search Models</a>
		<a href="search-releases-menu.php">Search Releases</a>
		<a href="Update_Mdls_in_Coll.php">Update Models in Your Collection</a>
		<a href="index.php">Return to Main Page</a>		
	</div>
</div>
<?php include("includes/footer.php"); ?>