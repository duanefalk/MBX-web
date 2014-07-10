<?php
// we must never forget to start the session
session_start();

?>
<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>
<table id="structure">
	<tr>
		<td id="navigation">
			<?php echo "<a href=\"javascript:history.go(-1)\">Return to Variations List Page</a>"; ?>
			<a href="Search_Models_Menu.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Search Models</p></a>
			<a href="Search_Releases_Menu.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Search Releases</p></a>
			<a href="index.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Main Page</p></a>
		</td>
		<td id="page">
			<h2>Variation Details</h2>
			<br />
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
      			
					$row=mysql_fetch_array($result);

					$picture1= IMAGE_URL . $row["VarID"]."_1.jpg";
					$picture1_loc=IMAGE_PATH. $row["VarID"]."_1.jpg";
					//echo $picture1."<br />";
					$picture2= IMAGE_URL . $row["VarID"]."_2.jpg";
					$picture2_loc=IMAGE_PATH. $row["VarID"]."_2.jpg";	
				
					$Variation_to_detail= $row["VarID"];
					$url= "Variation_Detail.php?model=".$Variation_to_detail;				
					if (file_exists($picture1_loc)) {
						//echo "picture exists";
						echo "<img src=".$picture1." width=\"240\">";
					} else {
						//echo "cant find picture";
						//echo DEFAULT_IMAGE;
						echo "<img src=".DEFAULT_IMAGE." width=\"240\">";
					}
	
					if (file_exists($picture2_loc)) {
						//echo "picture exists";
						echo "<img src=".$picture2." width=\"240\">";
					} else {
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
							echo "<p id=\"photoref\">Photos by: ". $row2a["RefName"].", ".$row2b["RefName"];
						} ELSE {
							echo "<p id=\"photoref\">Photo by: ". $row2a["RefName"];
						}
					} ELSE {
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

					echo "Est. Value: ".$row["StdValue"]."<br /><br />";
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
					    } ELSE {
						echo "You do not have this variation in your collection. Continue below if you want to add it."."<br /><br />";
					    }
		    
					} ELSE {
					    $Wishlist_option=1;
					    echo "This variation is not currently on your wishlist."."<br />";
					    if (mysql_num_rows($result) > 0) {
						echo "You Have ".mysql_num_rows($result5)." copy/copies of ".$Variation_for_detail." in your collection."."<br />";
						echo "If you want to edit an existing record, select 'Update Models in Your Collection' from the menu bar on this page."."<br />";
						echo "Continue below if you want to add a new copy of this variation to your collection or wishlist."."<br /><br />";
					    } ELSE {
						echo "You do not have this variation in your collection."."<br /><br />";
						echo "Continue below if you want to add it to your collection or wishlist."."<br /><br />";
					    }	
					}
				?>
				<p>Add variation to wishlist, or to collection? (cancel to do neither)</>
				<br />
				<input type="radio" name="Coll_or_wishlist_Choice" value="Coll">Collection<br>
				<input type="radio" name="Coll_or_wishlist_Choice" value="Wishlist">Wishlist<br>	
				<input type="submit" value="<?php echo $row["VarID"]?>" id="submit" name="Var_to_Add">Add<br/>
				
				<?php   // cancel button
					$Version_to_list=$row["VerID"];
					//echo $Version_to_detail;
					$url= "Ver_Detail_and_Var_Listing.php?model=".$Version_to_list;
					echo "<a href=\"".$url."\">Cancel</a>";
				?>
				</form>
				<?php
				}
			?>
		</td>
	</tr>
</table>

<?php include("includes/footer.php"); ?>	