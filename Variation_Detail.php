<?php
// we must never forget to start the session
session_start();

?>
<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>

<div class="row">
	<div class="large-12 columns">

		<h2>Variation Details</h2>
			
		<form name="Add_Var_to_Coll_or_Wishlist" action="Add_Var_Coll_or_Wishlist.php" method="post">
			<ul class="large-block-grid-2">
				<li class="carGrid">
			
		<?php
			$result=0;
			$rows=0;
			$Variation_for_detail=$_GET["model"];
			echo "<h3>Variation ID: ".$Variation_for_detail."</h3>";
			$query= ("SELECT * FROM Matchbox_Variations WHERE VarID LIKE '%$Variation_for_detail%'");
			$result= mysql_query($query);
		
			//if not found			
			if(!$result) {
				echo "No matching results found"; //mysql_error();
				exit;
			}
  			
				$row = mysql_fetch_array($result);

				$picture1 = IMAGE_URL . $row["VarID"]."_1.jpg";
				$picture1_loc = IMAGE_PATH. $row["VarID"]."_1.jpg";
				$PhotoRefCd1= $row["VarPhoto1Ref"];
				$query2a = ("SELECT * FROM Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd1%'");
				$result2a = mysql_query($query2a);
				$row2a = mysql_fetch_array($result2a);
				
				
				$Variation_to_detail= $row["VarID"];
				$url= "Variation_Detail.php?model=".$Variation_to_detail;				
				
				if (file_exists($picture1_loc)) { ?>
					<a href="<?php echo $picture1; ?>" class="imagePopup" title="<?php echo $row2a["RefName"]; ?>"><img src="<?php echo $picture1; ?>" /></a>
				<?php } else { ?>
					<img src="<?php echo DEFAULT_IMAGE; ?>" />
				<?php } ?>
				
				<?php
					
				$picture2 = IMAGE_URL . $row["VarID"]."_2.jpg";
				$picture2_loc = IMAGE_PATH. $row["VarID"]."_2.jpg";	
				$PhotoRefCd2= $row["VarPhoto2Ref"];
				$query2b= ("SELECT * FROM Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd2%'");
				$result2b= mysql_query($query2b);
				$row2b =mysql_fetch_array($result2b);
				
				
				if (file_exists($picture2_loc)) { ?>
					<a href="<?php echo $picture2; ?>" class="imagePopup" title="<?php echo $row2b["RefName"]; ?>"><img src="<?php echo $picture2; ?>"></a>
				<?php }
												
				$PhotoRefCd1 = $row["VarPhoto1Ref"];
				$PhotoRefCd2 = $row["VarPhoto2Ref"];
				if ($PhotoRefCd1) {
					$query2a = ("SELECT * FROM Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd1%'");
					$result2a = mysql_query($query2a);
					$row2a = mysql_fetch_array($result2a);
					if ($PhotoRefCd2) {
						$query2b = ("SELECT * FROM Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd2%'");
						$result2b = mysql_query($query2b);
						$row2b = mysql_fetch_array($result2b);
						if ($row2b == $row2a) {
							echo "<p class=\"photoref\">Photos by: " . $row2a["RefName"] . "</p>";
						} else {
							echo "<p class=\"photoref\">Photos by: " . $row2a["RefName"] . ", " . $row2b["RefName"] . "</p>";
						}
					} else {
						echo "<p class=\"photoref\">Photo by: " . $row2a["RefName"] . "</p>";
					}
				} else {
					echo "<p class=\"photoref\">Photo by: no reference listed</p>";
				}		
				
				echo "<p><strong>Mack#:</strong> ". $row["Mack_No"]."</p>";
				echo "<p><strong>Base Name:</strong> ". $row["BaseName"]."</p>";
				echo "<p><strong>Base Company:</strong> ". $row["BaseCompany"]."</p>";
				echo "<p><strong>Manufactured in:</strong> ". $row["ManufLoc"]."</p>";
				echo "<p><strong>Variation Year:</strong> ". $row["VarYear"]."</p>";
				
				
				echo "<div class='carDetails'>";
						
					echo "<p><strong>Front Wheel Code:</strong> ". $row["FWhCd"]."</p>";
					echo "<p><strong>Rear Wheel Code:</strong> ". $row["RWhCd"]."</p>";
					echo "<p><strong>Window Color:</strong> ". $row["WindowColor"]."</p>";
					echo "<p><strong>Interior Color:</strong> ". $row["InteriorColor"]."</p>";
					echo "<p><strong>Base Material:</strong> ". $row["Base1Material"]."</p>";
					echo "<p><strong>Base Color:</strong> ". $row["Base1Color"]."</p>";
					if ($row["Base2Material"]) {
						echo "<p><strong>2nd Base Material:</strong> ". $row["Base2Material"]."</p>";
						echo "<p><strong>2nd Base Color:</strong> ". $row["Base2Color"]."</p>";
					}
					echo "<strong>Finish:</strong> ". $row["Finish"]."</p>";
					if ($row["ColorVar"]) {
						echo "<p><strong>Color Variation:</strong> ". $row["ColorVar"]."</p>";
					}
					if ($row["TempaVar"]) {
						echo "<p><strong>Tempa Variation:</strong> ". $row["TempaVar"]."</p>";
					}
					if ($row["Det1Typ"]) {
						echo "<p><strong>Detail 1 Type:</strong> ". $row["Det1Typ"]."</p>";
						echo "<p><strong>Detail 1 Variation:</strong> ". $row["Det1Var"]."</p>";
					}
					if ($row["Det2Typ"]) {
						echo "<p><strong>Detail 2 Type:</strong> ". $row["Det2Typ"]."</p>";
						echo "<p><strong>Detail 2 Variation:</strong> ". $row["Det2Var"]."</p>";
					}
					if ($row["Det3Typ"]) {
						echo "<p><strong>Detail 3 Type:</strong> ". $row["Det3Typ"]."</p>";
						echo "<p><strong>Detail 3 Variation:</strong> ". $row["Det3Var"]."</p>";
					}
					if ($row["Det4Typ"]) {
						echo "<p><strong>Detail 4 Type:</strong> ". $row["Det4Typ"]."</p>";
						echo "<p><strong>Detail 4 Variation:</strong> ". $row["Det4Var"]."</p>";
					}
					if ($row["Det5Typ"]) {	
						echo "<p><strong>Detail 5 Type:</strong> ". $row["Det5Typ"]."</p>";
						echo "<p><strong>Detail 5 Variation:</strong> ". $row["Det5Var"]."</p>";
					}
	
					echo "<p><strong>Comments:</strong> ". $row["VarComment"]."</p>";
					
				echo "</div>"; ?>
							
				<?php
				if ($_SESSION['Sec_Lvl'] > 1) {
				
					$User = $_SESSION['Username'];
					$query3 = ("SELECT * FROM Matchbox_User_Collections WHERE Username='$User'");								
					$result3 = 0;
					$rows_count3 = 0;									
					$result3 = mysql_query($query3);
					if ($result3) {
						$rows3= mysql_num_rows($result3);
						if ($rows3 > 0) {
							$row3 = mysql_fetch_array($result3);
							$User_CollID = $row3["User_Coll_ID"];
							
							//see if exists in wishlist and/or collection
							echo "<p><strong>Variation Selected:</strong> " . $Variation_for_detail . "</p>";
						
							$query4 = ("SELECT * FROM Matchbox_User_Wishlist WHERE Username='$User' AND User_Coll_ID='$User_CollID' AND VarID='$Variation_for_detail'");								
							$result4 = 0;
							$rows_count4 = 0;									
							$result4 = mysql_query($query4);
							//can only have a var in wishlist once, see if have already, set option to add                    
			    
							$query5=("SELECT * FROM Matchbox_Collection WHERE Username='$User' AND User_Coll_ID='$User_CollID' AND VarID='$Variation_for_detail'");								
							$result5 = 0;
							$rows_count5 = 0;									
							$result5 = mysql_query($query5);
							?>
				
							<div class="row">
								<div class="large-6 columns">
									<h5>Collection</h5>
									<?php 
									if (mysql_num_rows($result5) > 0) {
										echo "<p>You Have ".mysql_num_rows($result5)." copy/copies of ".$Variation_for_detail." in your collection.</p>";
										echo "<p>If you want to edit an existing record, select 'Update Models in Your Collection' from the menu bar on this page.</p>";
										echo "<p>Continue below if you want to add a new copy of this variation to your collection.</p>";
									} else {
										echo "<p>You do not have this variation in your collection. Continue below if you want to add it.</p>";
									}
									?>
									<p>Add variation to wishlist, or to collection? (cancel to do neither)</p>
									<input type="radio" id="Coll_Choice" name="Coll_or_wishlist_Choice" value="Coll"><label for="Coll_Choice">Collection</label>		
								</div>
						
								<div class="large-6 columns">
									<h5>Wishlist</h5>
									<?php if (mysql_num_rows($result4) > 0) {
										echo "<p>You already have this variation on your wishlist (you can only have one entry for a variation on the wishlist).</p>";
										echo "<p><a href='Collection_Report_W.php'>View Wishlist</a></p>";
										echo "<p><a href='Search_Models_Menu.php'>Return to search page</a></p>";
										$Wishlist_option = 0;
									} else {
										$Wishlist_option = 1;
										echo "<p>You do not have this variation on your wishlist.</p>";							 
										echo "<p>Would you like to add it to your wishlist? (cancel to return to version details)</p>";
										?>
										<input type="radio" id="Wishlist_Choice" name="Coll_or_wishlist_Choice" value="Wishlist"><label for="Wishlist_Choice">Wishlist</label>
									<?php } ?>
								</div>
							</div>
					
							<div class="row">
								<div class="large-6 columns">
									<input type="hidden" id="Var_to_Add" value= "<?php echo $row["VarID"]?>" name="Var_to_Add">
									<input type="submit" class="button dark" value="Add <?php echo $row["VarID"]?>" id="submit" name="submit">
								</div>
								
								<div class="large-6 columns">
									<?php
									// cancel button
									$Version_to_list = $row["VerID"];
									//echo $Version_to_detail;
									$url = "Ver_Detail_and_Var_Listing.php?model=" . $Version_to_list;
									?>
									<a class="button cancel" href="<?php echo $url; ?>">Cancel</a>
								</div>
							</div>	
						<?php } else {
							echo "In order to enter models in your collection or a wishlist, go to <a href=\"Collections_Menu.php\">Manage Collections </a> and create a collection. The option to add models to that collection or wishlist will then be availabel to you.";
						}						
					}
				} ?>
			
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