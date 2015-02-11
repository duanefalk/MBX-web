<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>


<div class="row">
	<div class="large-12 columns">

		<?php
			if (isset($_POST['rel_to_add'])) {
			
				//Fields:
				$RelID=$_POST["rel_to_add"];
				$VarID=substr($RelID,0,12);
				$VerID=substr($VarID,0,10);
				$UMID=substr($VerID,0,6);        
				$Coll_Username="duanefalk";
				$User_Coll_ID="FALKCOLL1";
				$Wishlist_InactivFlg="0";
			
				$query="INSERT INTO Matchbox_User_Wishlist (Username, User_Coll_ID, UMID, VerID, VarID, RelID, Wishlist_InactivFlg) 
				VALUES ('$Coll_Username', '$User_Coll_ID', '$UMID','$VerID', '$VarID', '$RelID', '$Wishlist_InactivFlg')";
			
				$outcome=mysql_query($query);
			
				if ($outcome) {
					//if ((mysql_query($query)) == true)
					echo "<p>Done and returning</p>";
					//require_once("includes/close_db_connection.php");
					//Return;
			
					$url= "Variation_Listing.php?model=".$VerID;
					echo "<a href=\"".$url."\">Return to Listing</a>";
					exit;
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
            $User="duanefalk";
            echo "Release Selected: ".$Rel_to_Add."<br /><br />";

            $picture1= IMAGE_URL . $Rel_to_Add."_1.jpg";
			$picture1_loc=IMAGE_PATH. $Rel_to_Add."_1.jpg";

            if (file_exists($picture1_loc)) {
                echo "<img src=".$picture1." width=\"240\">";
            } else {
                //no photo, echo DEFAULT_IMAGE;
                echo "<img src=".DEFAULT_IMAGE." width=\"240\">";
            }
        ?>
              
		<form name="Add_Rel_to_Wishlist" action="Add_rel_to_Wishlist.php" method="post">
			<input class="button dark" type="submit" value="<?php echo $Rel_to_Add?>" id="submit" name="rel_to_add" />
        </form>

		<?php
		    $url= "Release_Detail.php?model=".$Rel_to_Add;
		    echo "<a href=\"".$url."\">Cancel</a>";
		?>

	</div>
</div>

<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="Search_Models.php">Search Models</a>
		<a href="Search_Releases.php">Search Releases</a>
		<a href="Update_Mdls_in_Coll.php">Update Models in Your Collection</a>
		<a href="index.php">Return to Main Page</a>		
	</div>
</div>
<?php include("includes/footer.php"); ?>