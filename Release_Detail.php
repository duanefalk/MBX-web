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
			<?php echo "<a href=\"javascript:history.go(-1)\">Return to Previous Page</a><br></><br></>"; ?>
			<a href="Search_Models_Menu.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Search Models</p></a>
			<a href="Search_Releases_Menu.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Search Releases</p></a>
			<a href="index.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Main Page</p></a>
		</td>
		<td id="page">
			<h2>Release Details</h2>
			<br />
			<?php
			$result=0;
			$rows=0;
			$Release_for_detail=$_GET["model"];
			$Var_for_detail= substr($Release_for_detail,0,12);
			echo "The picture you clicked on was: ".$Release_for_detail."<br />";
			$query= ("SELECT * FROM Test_Matchbox_Releases WHERE RelID LIKE '%$Release_for_detail%'");

			$result = mysql_query($query);
			if(!$result) {
				echo "Error in database- No matching results found"; //mysql_error();
				exit;
				}
			?>
			<form action="Add_Rel_Coll_or_Wishlist" action="Add_Rel_Coll_or_Wishlist.php" method="post">
				<?php	
					$row=mysql_fetch_array($result);
					
					//look up and hsow photos
					$picture1= IMAGE_URL . $row["RelID"]."_1.jpg";
					$picture1_loc=IMAGE_PATH. $row["RelID"]."_1.jpg";
					//echo $picture1."<br />";
					$picture2= IMAGE_URL . $row["RelID"]."_2.jpg";
					$picture2_loc=IMAGE_PATH. $row["RelID"]."_2.jpg";
					//echo $picture2."<br />";					
					echo "<h3>Release ID: ". $row["RelID"]."</h3><br></>";			
					if (file_exists($picture1_loc)) {
						//echo "picture exists";
						echo "<img src=".$picture1." width=\"240\">";
					} else {
						//echo "cant find picture";
						//echo DEFAULT_IMAGE;
						echo "<img src=".DEFAULT_REL_IMAGE." width=\"240\">";
					}
					if (file_exists($picture2_loc)) {
						//echo "picture exists";
						echo "<img src=".$picture2." width=\"240\">";
					} else {
						//ignore, dont put up a default for 2nd one	
					}			

					//get photo ref codes and lookup names
					$PhotoRefCd= $row["RelPkgPhotoRef"];
					if ($PhotoRefCd) {
						$query2a= ("SELECT * FROM Test_Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd%'");
						$result2a= mysql_query($query2a);
						$row2a =mysql_fetch_array($result2a);
						echo "<p id=\"photoref\">Photo by: ". $row2a["RefName"]."</p>";
					} ELSE {
						echo "<p id=\"photoref\">Photo by: no reference listed</p>";
					}

					//display remainder of rel info
					//echo "<br />";
					echo "Rel Yr:   ".$row["RelYr"]."   Rel Dt:  ".$row["RelDt"]."<br />";
					if ($row["Theme"]) {
						echo "Rel Theme:   ".$row["Theme"]."<br />";
					}
					if ($row["SeriesID"] AND ($row["ShowSeriesID"]=1)) {
						echo "Series:   ".$row["Series"]."  Series ID:  ".$row["SeriesID"]."<br />";
					} ELSE {
						echo "Series:   ".$row["Series"]."<br />";
					}
					if ($row["SubSeries"]) {
						if ($row["SubSeriesID"] AND ($row["ShowSubSeriesID"]=1)) {
							echo "SubSeries:   ".$row["SubSeries"]."  SubSeries ID:  ".$row["SubSeriesID"]."<br />";
						} ELSE {
							echo "SubSeries:   ".$row["SubSeries"]."<br />";
						}
					}
					if ($row["PkgName"]) {
						echo "Name of the Pkg:   ".$row["PkgName"]."<br />";
					}
					if ($row["MdlNameOnPkg"]) {
						echo "Model Name on the Pkg:   ".$row["MdlNameOnPkg"]."<br />";
					}
					if ($row["PkgID"]) {
						echo "Pkg ID#:   ".$row["PkgID"]."<br />";
					} ELSE {
						echo "Pkg ID#:  UNKNOWN"."<br />";
					}
					if ($row["SeriesID"] AND ($row["ShowSeriesID"]=1)) {
						echo "Pkg Type Cd:   ".$row["PkgVarCd"]."<br />";
					} ELSE {
						echo "Pkg Type:  UNKNOWN"."<br />";
					}
					if ($row["PkgValAdj"] != 0) {
						echo "Value Adj. for this pkg: ".$row["PkgValAdj"]."<br />";
					}
					if ($row["RelComm"]) {
						echo "Comments:   ".$row["RelComm"]."<br />";
					}
					echo "<br />";
				
					//check on existing collection or wishlist records
					$User="duanefalk";
					//get the collection ID
					$query3=("SELECT * FROM Test_Matchbox_User_Collections WHERE Username='$User'");								
					$result3=0;
					$rows_count3=0;									
					$result3 = mysql_query($query3);
					$row3=mysql_fetch_array($result3);
					$User_CollID=$row3['User_Coll_ID']; 
		    
					//see if rel or variation exist in wish list and advise user
					echo "Variation Selected: ".$Var_to_Add."<br /><br />";
					$query4a=("SELECT * FROM Test_Matchbox_User_Wishlist WHERE Username='$User' AND User_Coll_ID='$User_CollID' AND RelID='$Release_for_detail'");								
					$result4a=0;
					$rows_count4a=0;									
					$result4a = mysql_query($query4a);
					
	
					$query4b=("SELECT * FROM Test_Matchbox_User_Wishlist WHERE Username='$User' AND User_Coll_ID='$User_CollID' AND VarID='$Var_for_detail'");								
					$result4b=0;
					$rows_count4b=0;									
					$result4b = mysql_query($query4b);			
					//can only have a var in wishlist once, see if have already, set option to add                    
		    
					$query5a=("SELECT * FROM Test_Matchbox_Collection WHERE Username='$User' AND User_Coll_ID='$User_CollID' AND RelID='$Release_for_detail'");								
					$result5a=0;
					$rows_count5a=0;									
					$result5a = mysql_query($query5a);
	
					$query5b=("SELECT * FROM Test_Matchbox_Collection WHERE Username='$User' AND User_Coll_ID='$User_CollID' AND VarID='$Var_for_detail'");								
					$result5b=0;
					$rows_count5b=0;									
					$result5b = mysql_query($query5b);
	
					if ($result4a!=false) {
					    echo "You already have this release on your wishlist."."<br />";
					    $Wishlist_option=0;
		    
					    if ($result5a != false) {
						echo "You have ".mysql_num_rows($result5a)." copy/copies of release ".$Rel_to_Add." in your collection."."<br />";
						echo "If you want to edit an existing record, select 'Update Models in Your Collection' from the menu bar on this page."."<br />";
						echo "Continue below if you want to add a new copy of this release to your collection."."<br /><br />";
					    } ELSE {
						echo "You do not have this release in your collection.";
						if ($result5b != false) {
							echo "Nor do you have this model variation in your collection."."<br />";
							echo "Continue below if you want to add a new copy of this release to your collection."."<br /><br />";
						} ELSE {
							echo "You do have ".mysql_num_rows($result5b)." copy/copies of the variation ".$Var_to_Add." in your collection however."."<br />";
							echo "Continue below if you want to add this release to your collection as well."."<br /><br />";
						}
					    }
					} ELSE {
					    echo "You do not have this release on your wishlist."."<br />";
					    $Wishlist_option=1;
	
					    if ($result5a != false) {
						echo "You have ".mysql_num_rows($result5a)." copy/copies of release ".$Rel_to_Add." in your collection."."<br />";
						echo "If you want to edit an existing record, select 'Update Models in Your Collection' from the menu bar on this page."."<br />";
						echo "Continue below if you want to add a new copy of this release to your collection."."<br /><br />";
					    } ELSE {
						echo "You do not have this release in your collection.";
						if ($result5b === false) {
							echo "Nor do you have this model variation in your collection."."<br />";
							echo "Continue below if you want to add a new copy of this release to your collection."."<br /><br />";
						} ELSE {
							echo "You do have ".mysql_num_rows($result5b)." copy/copies of the variation ".$Var_to_Add." in your collection however."."<br />";
							echo "Continue below if you want to add this release to your collection as well."."<br /><br />";
						}
					    }
					}
				?>
				<p>Add variation to wishlist, or to collection? (cancel to do neither)</>
				<br />
				<input type="radio" name="Coll_or_wishlist_Choice" value="Coll">Collection<br>
				<input type="radio" name="Coll_or_wishlist_Choice" value="Wishlist">Wishlist<br>	
				<input type="submit" value="<?php echo $row["RelID"]?>" id="submit" name="Rel_to_Add">Add<br/>
			
				<?php // cancel button
					$url= "Ver_Detail_and_Var_Listing.php?model=".$row["VerID"];
					echo "<a href=\"".$url."\">Cancel</a>";
				?>
			</form>
		</td>
	</tr>
</table>

<?php include("includes/footer.php"); ?>	
