<?php
	// we must never forget to start the session
	session_start();
?>

<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>

<div class="row">
	<div class="large-12 columns">
	
		<h2>Release Details</h2>		
	
		<?php
			$result=0;
			$rows=0;
			$Release_for_detail=$_GET["model"];
			$Var_for_detail= substr($Release_for_detail,0,12);
		
			echo "The picture you clicked on was: ".$Release_for_detail."<br />";
			$query= ("SELECT * FROM Matchbox_Releases WHERE RelID LIKE '%$Release_for_detail%'");

			$result = mysql_query($query);
			
			if (!$result) {
				echo "Error in database- No matching results found"; //mysql_error();
				exit;
			}
		?>
	
		<form action="Add_Rel_Coll_or_Wishlist.php" method="post">
			<ul class="large-block-grid-2">
				<li class="carGrid">
					<?php	
						$row = mysql_fetch_array($result);
						
						//look up and hsow photos
						$picture1 = IMAGE_URL . $row["RelID"]."_1.jpg";
						$picture1_loc = IMAGE_PATH. $row["RelID"]."_1.jpg";
						
						$PhotoRefCd = $row["RelPkgPhotoRef"];
						$query2a = ("SELECT * FROM Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd%'");
						$result2a = mysql_query($query2a);
						$row2a = mysql_fetch_array($result2a);				
						
					?>
					
					<h3>Release ID: <?php echo $row["RelID"]; ?></h3>
					
					<?php if (file_exists($picture1_loc)) { ?>
						<a href="<?php echo $picture1; ?>" class="imagePopup" title="<?php echo $row2a["RefName"]; ?>"><img src="<?php echo $picture1; ?>" /></a>
					<?php } else { ?>
						<img src="<?php echo DEFAULT_REL_IMAGE; ?>" />
					<?php }
					
					$picture2 = IMAGE_URL . $row["RelID"]."_2.jpg";
					$picture2_loc = IMAGE_PATH. $row["RelID"]."_2.jpg";
					
					
					if (file_exists($picture2_loc)) { ?>
						<a href="<?php echo $picture2; ?>" class="imagePopup" title="<?php echo $row2a["RefName"]; ?>"><img src="<?php echo $picture2; ?>" /></a>
					<?php } else {
						//ignore, dont put up a default for 2nd one	
					}			
		
					//get photo ref codes and lookup names
					$PhotoRefCd = $row["RelPkgPhotoRef"];
					$query2a= ("SELECT * FROM Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd%'");
					$result2a= mysql_query($query2a);
					$row2a =mysql_fetch_array($result2a);
					?>
					
					<p class="photoref">Photo by: <?php echo $row2a["RefName"]; ?></p>
					
					
					<!-- display remainder of rel info -->				
					<p>Rel Yr: <?php echo $row["RelYr"]; ?></p>
					
					<?php
					echo "<p><strong>Country of Sale:</strong> ".$row["CountryOfSale"]."</p>";
					echo "<p><strong>Product Line:</strong> ".$row["Line"]."</p>";
					if ($row["Theme"]) {
						echo "<p><strong>Rel Theme:</strong> ".$row["Theme"]."</p>";
					}
					if ($row["SeriesID"] AND ($row["ShowSeriesID"]=1)) {
						echo "<p><strong>Series:</strong> ".$row["Series"]."  Series ID:  ".$row["SeriesID"]."</p>";
					} else {
						echo "<p><strong>Series:</strong> " . $row["Series"] . "</p>";
					}
					if ($row["SubSeries"]) {
						if ($row["SubSeriesID"] AND ($row["ShowSubSeriesID"]=1)) {
							echo "<p><strong>SubSeries:</strong> " . $row["SubSeries"] . "  SubSeries ID: " . $row["SubSeriesID"] . "</p>";
						} else {
							echo "<p><strong>SubSeries:</strong> ".$row["SubSeries"]."</p>";
						}
					}
					if ($row["PkgName"]) {
						echo "<p><strong>Name of the Pkg:</strong> ".$row["PkgName"]."</p>";
					}
					if ($row["MdlNameOnPkg"]) {
						echo "<p><strong>Model Name on the Pkg:</strong> ".$row["MdlNameOnPkg"]."</p>";
					}
					
					echo "<div class='carDetails'>";
						
						if ($row["PkgID"]) { ?>
							<p><strong>Package ID#:</strong> <?php echo $row["PkgID"]; ?></strong></p>
						<?php } else {
							echo "<p><strong>Package ID#:</strong>  UNKNOWN" . "</p>";
						}
						if ($row["SeriesID"] AND ($row["ShowSeriesID"]=1)) {
							echo "<p><strong>Package Type Code:</strong> " . $row["PkgVarCd"] . "</p>";
						} else {
							echo "<p><strong>Package Type:</strong> UNKNOWN" . "</p>";
						}
						if ($row["RelComm"]) {
							echo "<p><strong>Comments:</strong> " . $row["RelComm"] . "</p>";
						}
						
					echo "</div>";					
						
					//check on existing collection or wishlist records
					$User=$_SESSION['Username'];
					
					//get the collection ID
					$query3 = ("SELECT * FROM Matchbox_User_Collections WHERE Username='$User'");								
					$result3 = 0;
					$rows_count3 = 0;									
					$result3 = mysql_query($query3);
					$row3 = mysql_fetch_array($result3);
					$User_Coll_ID = $row3['User_Coll_ID']; 
		    
					//see if rel or variation exist in wish list and advise user
					echo "<p><strong>Variation Selected:</strong> " . $Var_for_detail . "</p>";
					
					//scrap this option, just vars in wishlist
					//$query4a = ("SELECT * FROM Matchbox_User_Wishlist WHERE Username='$User' AND User_Coll_ID='$User_Coll_ID' AND RelID='$Release_for_detail'");								
					//$result4a = 0;
					//$rows_count4a = 0;									
					//$result4a = mysql_query($query4a);
					//$rows4a = mysql_num_rows($result4a);
	
					$query4b=("SELECT * FROM Matchbox_User_Wishlist WHERE Username='$User' AND User_Coll_ID='$User_Coll_ID' AND VarID='$Var_for_detail'");																
					$result4b = mysql_query($query4b);
					
					//can only have a var in wishlist once, see if have already, set option to add release to it                   
		    
					$query5a = ("SELECT * FROM Matchbox_Collection WHERE Username='$User' AND User_Coll_ID='$User_Coll_ID' AND RelID='$Release_for_detail'");														
					$result5a = mysql_query($query5a);
		
					$query5b = ("SELECT * FROM Matchbox_Collection WHERE Username='$User' AND User_Coll_ID='$User_Coll_ID' AND VarID='$Var_for_detail'");																	
					$result5b = mysql_query($query5b);

			
					?> 
					
					<div class="row">
						<div class="large-6 columns">
							<h5>Collection</h5>
							<?php
								$rows5a= mysql_num_rows($result5a);
								$rows5b= mysql_num_rows($result5b);
								if ($rows5a >0) {
									echo "<p>You have ". $rows5a." copy/copies of this release in your collection.</p>";
									echo "<p>If you want to edit one of those, select Manage Models in Collection under Your Collections. Click the button below to add another, or cancel to return to version details.</p>";
								} elseif ($rows5b >0) {
									echo "<p>You have this variation, but not this release. If you want to add the release to the existing variation record, go to 'Update Models in Your Collection' from the menu bar on this page. To add another record with this release, click the burron below below.</p>";
								} else {
									echo "<p>You don't have this variation/release in your collection. To add it click the button below.</p>";
								}
							?>
							<input type="radio" name="Coll_or_wishlist_Choice" id="rblCollection" value="Coll" /><label for="rblCollection">Collection</label>
						</div>
						<div class="large-6 columns">
							<h5>Wishlist</h5>		
							<?php
							
							$rows4b= mysql_num_rows($result4b);
							if ($rows4b > 0) {
								echo "<p>You already have this variation/release on your wishlist (you can only have one entry for a variation on the wishlist). <a href='Search_Models_Menu'>Return to search page</a>.</p>";
							} else {								
							    echo "<p>You do not have this variation/release on your wishlist.</p>";
								echo "<p>Would you like to add it to your wishlist? (cancel to return to version details)</p>";
							?>
								<input type="radio" name="Coll_or_wishlist_Choice" id="rblWishlist" value="Wishlist"><label for="rblWishlist">Wishlist</label>
							<?php } ?>
						</div>
					</div>
					<div class="row">
						<div class="large-6 columns">
							<input class="button dark" type="submit" value="<?php echo $row["RelID"]?>" id="submit" name="Rel_to_Add" />
						</div>
						<div class="large-6 columns">
							<?php
							$Ver_for_detail= substr($Release_for_detail,0,10);
							//$url = "Ver_Detail_and_Var_Listing.php?model = ".$Ver_for_detail;
							$url="Search_Models_Menu.php";
							?>
							<a class="button cancel" href="<?php echo $url; ?>">Cancel</a>
						</div>
					</div>			
				</li>
			</ul>
		</form>
		
	</div>
</div>

<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="Search_Models_Menu.php">Search Models</a>
		<a href="Search_Releases_Menu.php">Search Releases</a>
	</div>
</div>		
			
<?php include("includes/footer.php"); ?>