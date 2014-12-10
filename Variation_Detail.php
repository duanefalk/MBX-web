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
					<a href="<?php echo $picture1; ?>" class="imagePopup" title="<?php echo $row2a["RefName"]; ?>"><img src="<?php echo $picture1; ?>" width="240"></a>
				<?php } else { ?>
					<img src="<?php echo DEFAULT_IMAGE; ?>" width="240" />
				<?php } ?>
				
				<?php
					
				$picture2 = IMAGE_URL . $row["VarID"]."_2.jpg";
				$picture2_loc = IMAGE_PATH. $row["VarID"]."_2.jpg";	
				$PhotoRefCd2= $row["VarPhoto2Ref"];
				$query2b= ("SELECT * FROM Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd2%'");
				$result2b= mysql_query($query2b);
				$row2b =mysql_fetch_array($result2b);
				
				
				if (file_exists($picture2_loc)) { ?>
					<a href="<?php echo $picture2; ?>" class="imagePopup" title="<?php echo $row2b["RefName"]; ?>"><img src="<?php echo $picture2; ?>" width="240"></a>
				<?php } else { 
					//ignore, dont put up a default for 2nd one	
				}
												
				$PhotoRefCd1= $row["VarPhoto1Ref"];
				$PhotoRefCd2= $row["VarPhoto2Ref"];
				if ($PhotoRefCd1) {
					$query2a= ("SELECT * FROM Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd1%'");
					$result2a= mysql_query($query2a);
					$row2a =mysql_fetch_array($result2a);
					if ($PhotoRefCd2) {
						$query2b= ("SELECT * FROM Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd2%'");
						$result2b= mysql_query($query2b);
						$row2b =mysql_fetch_array($result2b);
						if ($row2b==$row2a) {
							echo "<p id=\"photoref\">Photos by: ". $row2a["RefName"] . "</p>";
						} else {
							echo "<p id=\"photoref\">Photos by: ". $row2a["RefName"].", ".$row2b["RefName"]."</p>";
						}
					} else {
						echo "<p id=\"photoref\">Photo by: ". $row2a["RefName"] . "</p>";
					}
				} else {
					echo "<p id=\"photoref\">Photo by: no reference listed</p>";
				}		
				
				echo "Mack#: ". $row["Mack_No"]."<br />";
				echo "Base Name: ". $row["BaseName"]."<br />";
				echo "Base Company: ". $row["BaseCompany"]."<br />";
				echo "Manufactured in: ". $row["ManufLoc"]."<br />";
				echo "Variation Year: ". $row["VarYear"]."<br />";
				echo "Front Wheel Code: ". $row["FWhCd"]."<br />";
				echo "Rear Wheel Code: ". $row["RWhCd"]."<br />";
				echo "Window Color: ". $row["WindowColor"]."<br />";
				echo "Interior Color: ". $row["InteriorColor"]."<br />";
				echo "Base Material: ". $row["Base1Material"]."<br />";
				echo "Base Color: ". $row["Base1Color"]."<br />";
				if ($row["Base2Material"]) {
					echo "2nd Base Material: ". $row["Base2Material"]."<br />";
					echo "2nd Base Color: ". $row["Base2Color"]."<br />";
				}
				echo "Finish: ". $row["Finish"]."<br />";
				if ($row["ColorVar"]) {
					echo "Color Variation: ". $row["ColorVar"]."<br />";
				}
				if ($row["TempaVar"]) {
					echo "Tempa Variation: ". $row["TempaVar"]."<br />";
				}
				if ($row["Det1Typ"]) {
					echo "Detail 1 Type: ". $row["Det1Typ"]."<br />";
					echo "Detail 1 Variation: ". $row["Det1Var"]."<br />";
				}
				if ($row["Det2Typ"]) {
					echo "Detail 2 Type: ". $row["Det2Typ"]."<br />";
					echo "Detail 2 Variation: ". $row["Det2Var"]."<br />";
				}
				if ($row["Det3Typ"]) {
					echo "Detail 3 Type: ". $row["Det3Typ"]."<br />";
					echo "Detail 3 Variation: ". $row["Det3Var"]."<br />";
				}
				if ($row["Det4Typ"]) {
					echo "Detail 4 Type: ". $row["Det4Typ"]."<br />";
					echo "Detail 4 Variation: ". $row["Det4Var"]."<br />";
				}
				if ($row["Det5Typ"]) {	
					echo "Detail 5 Type: ". $row["Det5Typ"]."<br />";
					echo "Detail 5 Variation: ". $row["Det5Var"]."<br />";
				}

				echo "Comments: ". $row["VarComment"]."<br />";
				echo "<br></>";

				$User=$_SESSION['Username'];
				$query3=("SELECT * FROM Matchbox_User_Collections WHERE Username='$User'");								
				$result3=0;
				$rows_count3=0;									
				$result3 = mysql_query($query3);
				$row3=mysql_fetch_array($result3);
				$User_CollID=$row3["User_Coll_ID"];
		
			if ($_SESSION['Sec_Lvl'] > 1) {	
			?>
			<form name="Add_Var_to_Coll_or_Wishlist" action="Add_Var_Coll_or_Wishlist.php" method="post">
			<?php
				//see if exists in wishlist and/or collection
				echo "Variation Selected: ".$Variation_for_detail."<br /><br />";
				$query4=("SELECT * FROM Matchbox_User_Wishlist WHERE Username='$User' AND User_Coll_ID='$User_CollID' AND VarID='$Variation_for_detail'");								
				$result4=0;
				$rows_count4=0;									
				$result4 = mysql_query($query4);
				//can only have a var in wishlist once, see if have already, set option to add                    
	    
				$query5=("SELECT * FROM Matchbox_Collection WHERE Username='$User' AND User_Coll_ID='$User_CollID' AND VarID='$Variation_for_detail'");								
				$result5=0;
				$rows_count5=0;									
				$result5 = mysql_query($query5);

				if (mysql_num_rows($result4) > 0) {
				    echo "You already have this variaton on your wishlist."."<br />";
				    $Wishlist_option=0;
	    
				    if (mysql_num_rows($result5) > 0) {
						echo "You Have ".mysql_num_rows($result5)." copy/copies of ".$Variation_for_detail." in your collection."."<br />";
						echo "If you want to edit an existing record, select 'Update Models in Your Collection' from the menu bar on this page."."<br />";
						echo "Continue below if you want to add a new copy of this variation to your collection."."<br /><br />";
				    } else {
						echo "You do not have this variation in your collection. Continue below if you want to add it."."<br /><br />";
				    }
	    
				} else {
				    $Wishlist_option=1;
				    echo "This variation is not currently on your wishlist."."<br />";
				    if (mysql_num_rows($result) > 0) {
						echo "You Have ".mysql_num_rows($result5)." copy/copies of ".$Variation_for_detail." in your collection."."<br />";
						echo "If you want to edit an existing record, select 'Update Models in Your Collection' from the menu bar on this page."."<br />";
						echo "Continue below if you want to add a new copy of this variation to your collection or wishlist."."<br /><br />";
				    } else {
						echo "You do not have this variation in your collection."."<br /><br />";
						echo "Continue below if you want to add it to your collection or wishlist."."<br /><br />";
				    }	
				}
			?>
			<p>Add variation to wishlist, or to collection? (cancel to do neither)</p>
			
			<input type="radio" id="Coll_Choice" name="Coll_or_wishlist_Choice" value="Coll">
			<label for="Coll_Choice">Collection</label>
			
			<input type="radio" id="Wishlist_Choice" name="Coll_or_wishlist_Choice" value="Wishlist">
			<label for="Wishlist_Choice">Wishlist</label>
				
			<input type="submit" class="button dark" value="Add <?php echo $row["VarID"]?>" id="submit" name="Var_to_Add">
			
			<?php
				// cancel button
				$Version_to_list = $row["VerID"];
				//echo $Version_to_detail;
				$url = "Ver_Detail_and_Var_Listing.php?model=" . $Version_to_list;
			?>
			<a href="<?php echo $url; ?>" class="button dark">Cancel</a>
			
			</form>
		<?php } ?>
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