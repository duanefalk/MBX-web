<?php 
	ob_start();
	session_start();
	require_once("includes/db_connection.php");
	$pageTitle = "Add Variation to Wishlist";
	$pageDescription = "Add this Variation to your collection wishlist.";
	include("includes/header.php");
	include("includes/functions.php");
?>
<div class="row">
	<div class="large-12 columns">
		<ul class="large-block-grid-2">
			<li class="carGrid">	
				<?php
				    if (isset($_POST['var_to_add'])) {
				    
					    $User=$_SESSION['Username'];
					    $query3=("SELECT * FROM Matchbox_User_Collections WHERE Username='$User'");								
					    $result3=0;
					    $rows_count3=0;									
					    $result3 = mysql_query($query3);
					    $row3=mysql_fetch_array($result3);
					    $User_Coll_ID=$row3["User_Coll_ID"];
					
					    $VarID=$_POST["var_to_add"];
					    $VerID=substr($VarID,0,10);
					    $UMID=substr($VerID,0,6);        
					
					    $Wishlist_InactivFlg="0";
				
				
				     
				        $query="INSERT INTO Matchbox_User_Wishlist (Username, User_Coll_ID, UMID, VerID, VarID, Wishlist_InactivFlg) VALUES ('$User', '$User_Coll_ID', '$UMID','$VerID', '$VarID', '$Wishlist_InactivFlg')";
						$outcome=mysql_query($query);
				        
				        if ($outcome) {
					    redirect_to("outcomes.php?message=Var_success&model=$VarID");
        
					    //if ((mysql_query($query)) == true)
					    //echo "<p>Done and returning</p>";
					    //require_once("includes/close_db_connection.php");
					    //Return;
					    //$url= "ver-detail-var-listing.php?model=".$VerID;
					    //echo "<a href=\"".$url."\">Return to Listing</a>";
					    //exit;
					} else {
					    echo "<p>Subject creation failed. Please review entries.</p>";
					    echo "<p>".mysql_error()."</p>";
					    //drop down to form again
					}   
				    }
				//if post not set do initial form 
				?>
			
				<h2>Add Variation to Wishlist</h2>
		
		        <?php
		            $Var_to_Add=$_GET["model"];
		            $User=$_SESSION['Username'];
		
		            echo "<p><strong>Variation Selected:</strong> ".$Var_to_Add."</p>";
		
		            $picture1= IMAGE_URL . $Var_to_Add."_1.jpg";
			    $picture1_loc=IMAGE_PATH. $Var_to_Add."_1.jpg";
		
		            if (file_exists($picture1_loc)) {
		                echo "<img src=".$picture1." />";
		            } else {
		                //no photo, echo DEFAULT_IMAGE;
		                echo "<img src=".DEFAULT_IMAGE." />";
		            } 
			?>
				
			<div class="row">
			    <div class="large-6 columns">
				<form name="Add_var_to_Wishlist" action="Add_Var_to_Wishlist.php" method="post">
				    <input class="button dark" type="submit" value="<?php echo $Var_to_Add?>" id="submit" name="var_to_add">
				</form>
			    </div>
			    <div class="large-6 columns">
				<?php
				    $url= "variation-detail.php?model=".$Var_to_Add;
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
		<a href="Search_Models.php">Search Models</a>
		<a href="Search_Releases.php">Search Releases</a>
		<a href="Update_Mdls_in_Coll.php">Update Models in Your Collection</a>
		<a href="index.php">Return to Main Page</a>		
	</div>
</div>
<?php include("includes/footer.php"); ?>