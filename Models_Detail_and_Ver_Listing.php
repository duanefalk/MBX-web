<?php
// we must never forget to start the session
session_start();
$Sec_Lvl=$_SESSION['Sec_Lvl'];
$Code2_Pref=$_SESSION['Code2_Pref'];
$Username=$_SESSION['Username'];
?>

<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>
<table id="structure">

	<tr>
		<td id="navigation">
			<?php echo "<a href=\"javascript:history.go(-1)\">Return to Matching Models</a>"; ?>
			<a href="Search_Models_Menu.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Search Models</p></a>
			<a href="Search_Releases_Menu.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Search Releases</p></a>
			<a href="Index.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Main Page</p></a>
		</td>
		<td id="page">
			<h2>Models Detail Page</h2>
			<br />
			<!--<a href="http://localhost/~Falk/MBX_Web_Site_Test/IMAGES/TEST.doc"><p>CLICK TO DOWNLOAD FILE</p</a><br /> -->
			<?php
			//show model header info
			$model_for_detail=$_GET["model"];
			$query2= ("SELECT * FROM Test_Matchbox_Models WHERE UMID LIKE '%$model_for_detail%'");
			$result2 = mysql_query($query2);
			if (mysql_num_rows($result2)==0) {			
				echo "<h3>Error - No matching results found</h3>"; //mysql_error();
				exit;
			}
			$row2=mysql_fetch_array($result2);
			echo "<h3>".$model_for_detail."  ".$row2['MasterModelName']."</h3>";
			$picture= IMAGE_URL . $row2["UMID"].".jpg";
			$picture_loc=IMAGE_PATH. $row2["UMID"].".jpg";
			if (file_exists($picture_loc)) {
				//echo "picture exists";
				echo "<img class='own' src=".$picture." width=\"240\">";
			} else {
				//echo "cant find picture";
				//echo DEFAULT_IMAGE;
				echo "<img class='own-poor' src=".DEFAULT_IMAGE." width=\"240\">";
			}	
			echo "<br />";
			$PhotoRefCd= $row2["ModelPhotoRef"];
			if ($PhotoRefCd) {
				$query3= ("SELECT * FROM Test_Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd%'");
				$result3= mysql_query($query3);
				$row3 =mysql_fetch_array($result3);
				echo "<p id=\"photoref\">Photo by: ". $row3["RefName"]."</p>";
			} ELSE {
				echo "<p id=\"photoref\">Photo by: no reference listed"."</p>";
			}

			echo "First rel in ".$row2['YrFirstProduced']."<br></>";
			if ($row2["VehicleType2"]) {	
				echo "Vehicles type(s): ".$row2["VehicleType"].",  ".$row2["VehicleType2"]."<br></>";
			} ELSE {
				echo "Vehicles type(s): ".$row2["VehicleType"]."<br></>";				
			}
			if ($row2["Scale"]) {	
				echo "Scale:  ".$row2['ModelScale']."   Base Casting Dt: ".$row2['BaseCastYr']."<br></>";
			} ELSE {
				echo "Scale: None shown ".$row2['ModelScale']."   Base Casting Dt: ".$row2['BaseCastYr']."<br></>";				
			}			
			echo "Vehicle Make: ".$row2['MakeofModel']."   Country of Make: ".$row2['CountryofMake']."<br></>";
			if ($row2["ModelComment"]) {	
				echo "Comments: ".$row2["ModelComment"]."<br></>";
			}

			//check if any microvar listings
			$query4=("SELECT * FROM Test_Matchbox_Model_Microvariations WHERE Test_Matchbox_Model_Microvariations.UMID='$model_for_detail'");
			$result4 = mysql_query($query4);
			$rowcount4=mysql_num_rows($result4);
			if ($rowcount4!=0) {
			//if ($result4) {
				echo "<a href=\"Display_Microvariations.php?model=$model_for_detail\">See Microvariations</a>";
				echo "<br></>";
			}

			$row2=mysql_fetch_array($result2);

			//check user code2 display preference
			//if logged as guest, or chose to mix then do code2 with code1
			if (($Sec_Lvl < "2") OR ($Code2_Pref=="0")) {
				//get version data to display
				$query= ("SELECT * FROM Test_Matchbox_Versions WHERE UMID LIKE '%$model_for_detail%'");
				$result=0;
				$rows=0;
				// echo $result;
				$result = mysql_query($query);
				$rows= mysql_num_rows($result); //print_r($result);
				echo "<h3>"."CODE 1 & 2 Versions found: ".$rows."</h3>"."<br /><br />";
				if(!$result) {
					echo "No matching results found"; //mysql_error();
					exit;
					}					
				for ($i=1; $i<=$rows; $i++)
					{
					echo "<div class=\"car-block\">";
						//make image clickable and send proper umid to model_detail pa
						$row=mysql_fetch_array($result);
						$picture= IMAGE_URL . $row["VerID"]."_1.jpg";
						$picture_loc=IMAGE_PATH. $row["VerID"]."_1.jpg";
						$Version_to_detail=$row["VerID"];
						$url= "Ver_Detail_and_Var_Listing.php?model=".$Version_to_detail;

						//determine what to show fro version pics
						//check if have account
						if ($Sec_Lvl >= "2") {	
							//if have account, have collection?
							$query_coll=("SELECT * FROM Matchbox_Collection WHERE Username='$Username'");
							$result_coll = mysql_query($query_coll);
							if ($result_coll) {
								//if so, check if have in collection
								$query_own=("SELECT * FROM Matchbox_Collection WHERE Username='$Username' AND VerID='$Version_to_detail'");
								$result_own = mysql_query($query_own);
								$rows_own= mysql_num_rows($result_own);
								//$rows_own= mysql_num_rows($result_own);
								//check if pic exists and apply colors
								if (file_exists($picture_loc)) {									
									if ($rows_own !="0") {
										echo "<a href=\"".$url."\">"."<img class='own' src=".$picture." width=\"240\"></a>";
									} ELSE {
										echo "<a href=\"".$url."\">"."<img class='own.not' src=".$picture." width=\"240\"></a>";
									}	
								} ELSE {
									if ($rows_own !="0") {
										echo "<a href=\"".$url."\">"."<img class='own' src=".DEFAULT_IMAGE." width=\"240\"></a>";
									} ELSE {
										echo "<a href=\"".$url."\">"."<img class='own-not' src=".DEFAULT_IMAGE." width=\"240\"></a>";
									}
								}	
							}			
						} else {
							if (file_exists($picture_loc)) {									
								echo "<a href=\"".$url."\">"."<img src=".$picture." width=\"240\"></a>";
							} ELSE {
								echo "<a href=\"".$url."\">"."<img src=".DEFAULT_IMAGE." width=\"240\"></a>";
							}
						}			
				
						echo "<br />";
						$PhotoRefCd= $row["VerPhoto1Ref"];
						if ($PhotoRefCd) {
							$query2= ("SELECT * FROM Test_Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd%'");
							$result2= mysql_query($query2);
							$row2 =mysql_fetch_array($result2);
							echo "<p id=\"photoref\">Photo by: ". $row2["RefName"]."</p>";
						} ELSE {
							echo "<p id=\"photoref\">Photo by: no reference listed"."</p>";
						}
						echo "<p>Ver ID: ". $row["VerID"]." MAN#: ". $row["FAB_No"]."</p>";
						echo "<p>Ver Name: ".$row["VerName"]."</p>";
						echo "<p>First Rel Dt: ".$row["VerYrFirstRel"]."</p>";
						echo "<p>Code level: ".$row["CodeLvl"];
						if ($row["CodeLvl"]=="2") {
							echo " C2 Manuf.: ".$row["SecManuf"]."</p>";
						}
					echo "</div>";
					}	
			} else {
				//start by showing code1
				$query= ("SELECT * FROM Test_Matchbox_Versions WHERE UMID LIKE '%$model_for_detail%' AND CodeLvl='1'");
				$result=0;
				$rows=0;
				// echo $result;
				$result = mysql_query($query);
				$rows= mysql_num_rows($result); //print_r($result);
				echo "<h3>"."CODE 1 Versions found: ".$rows."</h3>"."<br /><br />";
				if(!$result) {
					echo "No matching results found"; //mysql_error();
					exit;
					}					
				for ($i=1; $i<=$rows; $i++) {
					echo "<div class=\"car-block\">";
					$row=mysql_fetch_array($result);
					$picture= IMAGE_URL . $row["VerID"]."_1.jpg";
					$picture_loc=IMAGE_PATH. $row["VerID"]."_1.jpg";
		
					//make image clickable and send proper umid to model_detail page
					$Version_to_detail=$row["VerID"];
					$url= "Ver_Detail_and_Var_Listing.php?model=".$Version_to_detail;
					
					if ($Sec_Lvl >= "2") {	
						//if have account, have collection?
						$query_coll=("SELECT * FROM Test_Matchbox_Collection WHERE Username='$Username'");
						$result_coll = mysql_query($query_coll);
						if ($result_coll) {
								
							//if so, check if have in collection
							$query_own=("SELECT * FROM Test_Matchbox_Collection WHERE Username='$Username' AND VerID='$Version_to_detail'");
							$result_own = mysql_query($query_own);
							$rows_own= mysql_num_rows($result_own);
							//$rows_own= mysql_num_rows($result_own);
							//check if pic exists and apply colors
							if (file_exists($picture_loc)) {									
								if ($rows_own !="0") {
									
									echo "<a href=\"".$url."\">"."<img class='own' src=".$picture." width=\"240\"></a>";
								} ELSE {
									echo "<a href=\"".$url."\">"."<img class='own-not' src=".$picture." width=\"240\"></a>";
								}	
							} ELSE {
								if ($rows_own !="0") {
									echo "<a href=\"".$url."\">"."<img class='own' src=".DEFAULT_IMAGE." width=\"240\"></a>";
								} ELSE {
									echo "<a href=\"".$url."\">"."<img class='own-not' src=".DEFAULT_IMAGE." width=\"240\"></a>";
								}
							}	
						} ELSE {
								
							if (file_exists($picture_loc)) {									
								echo "<a href=\"".$url."\">"."<img src=".$picture." width=\"240\"></a>";
							} ELSE {
								echo "<a href=\"".$url."\">"."<img src=".DEFAULT_IMAGE." width=\"240\"></a>";
							}	
						}	
					} else {
						if (file_exists($picture_loc)) {									
							echo "<a href=\"".$url."\">"."<img src=".$picture." width=\"240\"></a>";
						} ELSE {
							echo "<a href=\"".$url."\">"."<img src=".DEFAULT_IMAGE." width=\"240\"></a>";
						}
					}	
					echo "<br />";
					$PhotoRefCd= $row["VerPhoto1Ref"];
					if ($PhotoRefCd) {
						$query2= ("SELECT * FROM Test_Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd%'");
						$result2= mysql_query($query2);
						$row2 =mysql_fetch_array($result2);
						echo "<p id=\"photoref\">Photo by: ". $row2["RefName"]."</p>";
					} ELSE {
						echo "<p id=\"photoref\">Photo by: no reference listed"."</p>";
					}
					echo "<p>Ver ID: ". $row["VerID"]." MAN#: ". $row["FAB_No"]."</p>";
					echo "<p>Ver Name: ".$row["VerName"]."</p>";
					echo "<p>First Rel Dt: ".$row["VerYrFirstRel"]."</p>";
					echo "</div>";
				}
				//then check if to show code 2 also. if so sep srch for code 2
				if (($Sec_Lvl >= "2") AND ($Code2_Pref == "1")) {
					$query= ("SELECT * FROM Test_Matchbox_Versions WHERE UMID LIKE '%$model_for_detail%' AND CodeLvl='2'");
					$result=0;
					$rows=0;
					// echo $result;
					$result = mysql_query($query);
					$rows= mysql_num_rows($result); //print_r($result);
					echo "<br></>";						
					echo "<br></>"."<h3>"."CODE 2 Versions found: ".$rows."</h3>"."<br /><br />";
					if(!$result) {
						echo "No matching results found"; //mysql_error();
						exit;
						}					
					for ($i=1; $i<=$rows; $i++)
						{
						echo "<div class=\"car-block\">";
						$row=mysql_fetch_array($result);
						$picture= IMAGE_URL . $row["VerID"]."_1.jpg";
						$picture_loc=IMAGE_PATH. $row["VerID"]."_1.jpg";
			
						//make image clickable and send proper umid to model_detail page
						$Version_to_detail=$row["VerID"];
						$url= "Ver_Detail_and_Var_Listing.php?model=".$Version_to_detail;
							
						//have collection?
						$query_coll=("SELECT * FROM Test_Matchbox_Collection WHERE Username='$Username'");
						$result_coll = mysql_query($query_coll);
						if ($result_coll) {
							//if so, check if have in collection
							$query_own=("SELECT * FROM Test_Matchbox_Collection WHERE Username='$Username' AND VerID='$Version_to_detail'");
							$result_own = mysql_query($query_own);
							$rows_own=mysql_num_rows($result_own);
							//$rows_own= mysql_num_rows($result_own);
							//check if pic exists and apply colors
							
							if (file_exists($picture_loc)) {									
								if ($rows_own !="0") {
									echo "<a href=\"".$url."\">"."<img class='own' src=".$picture." width=\"240\"></a>";
								} ELSE {
									echo "<a href=\"".$url."\">"."<img class='own-not' src=".$picture." width=\"240\"></a>";
								}	
							} ELSE {
								if ($rows_own !="0") {
									echo "<a href=\"".$url."\">"."<img class='own' src=".DEFAULT_IMAGE." width=\"240\"></a>";
								} ELSE {
									echo "<a href=\"".$url."\">"."<img class='own-not' src=".DEFAULT_IMAGE." width=\"240\"></a>";
								}
							}	
						}				
							echo "<br />";
							$PhotoRefCd= $row["VerPhoto1Ref"];
							if ($PhotoRefCd) {
								$query2= ("SELECT * FROM Test_Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd%'");
								$result2= mysql_query($query2);
								$row2 =mysql_fetch_array($result2);
								echo "<p id=\"photoref\">Photo by: ". $row2["RefName"]."</p>";
							} ELSE {
								echo "<p id=\"photoref\">Photo by: no reference listed"."</p>";
							}
							echo "<p>Ver ID: ". $row["VerID"]." MAN#: ". $row["FAB_No"]."</p>";
							echo "<p>Ver Name: ".$row["VerName"]."</p>";
							echo "<p>First Rel Dt: ".$row["VerYrFirstRel"]."</p>";
							echo "<p>Code level: ".$row["CodeLvl"].";C2 Manuf.: ".$row["SecManuf"]."</p>";
						echo "</div>";
						}
				}		
			}
				//if chose no code2 just drop down without doing code 2 search
			// display releases for this umid
			$rel_result=0;
			$rel_rows=0;
			//Search for 1-75
			$rel_query=("SELECT * FROM Test_Matchbox_Releases WHERE UMID LIKE '%$model_for_detail%' AND Series='1-75' ORDER BY RelYr, CountryofSale, SeriesID, RelID");
			$rel_result = mysql_query($rel_query);
			$rel_rows= mysql_num_rows($rel_result);
			if ($rel_rows!=0) {
				echo "<br></><h2>1-75 series</h2>";
				for ($i=1; $i<=$rel_rows; $i++) {
					echo "<div class=\"car-block\">";
					$rel_row=mysql_fetch_array($rel_result);
					$curr_yr=$rel_row["RelYr"];
	
					if ($i==1) {
						$last_yr=$curr_yr;
						echo "<h3>".$rel_row["RelYr"]."</h3>";
					}
					//echo $curr_yr."...".$last_yr;
					if ($curr_yr!=$last_yr) {
						echo "<h3>".$rel_row["RelYr"]."</h3>";
					}
					//print info
					$picture= IMAGE_URL . $rel_row["RelID"]."_1.jpg";
					$picture_loc=IMAGE_PATH. $rel_row["RelID"]."_1.jpg";
					$url= "Release_Detail.php?model=".$rel_row["RelID"];
					if (file_exists($picture_loc)) {
						echo "<a href=\"".$url."\">"."<img src=".$picture." height=\"400\"></a>";
					} ELSE {	
						echo "<a href=\"".$url."\">"."<img src=".DEFAULT_IMAGE." height=\"400\"></a>";
					}
					if ($rel_row["RelPkgPhotoRef"]) {
						$query2= ("SELECT * FROM Test_Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd%'");
						$result2= mysql_query($query2);
						$row2 =mysql_fetch_array($result2);
						echo "<p id=\"photoref\">Photo by: ". $row2["RefName"]."</p>";
					} ELSE {
						echo "<p id=\"photoref\">Photo by: no reference listed"."</p>";
					}
					echo "<p>Country:  ".$rel_row["CountryOfSale"]."</p>";
					echo "<p>Rel ID: ". $rel_row["RelID"]."</p>";
					echo "<p>Series ID: ".$rel_row["SeriesID"]."</p>";
					echo "<p>Name on Pkg: ".$rel_row["MdlNameOnPkg"]."</p>";	
					$last_yr=$curr_yr;
					echo "</div>";
				}
			}
			//Search for Superfast
			$rel_query=("SELECT * FROM Test_Matchbox_Releases WHERE UMID LIKE '%$model_for_detail%' AND Series='Superfast' ORDER BY RelYr, CountryofSale, SeriesID, RelID");
			$rel_result = mysql_query($rel_query);
			$rel_rows= mysql_num_rows($rel_result);
			if ($rel_rows!=0) {
			
				echo "<br></><h2>SUPERFAST</h2>";
			}
			//Search for Multipacks
			$rel_query=("SELECT * FROM Test_Matchbox_Releases WHERE UMID LIKE '%$model_for_detail%' AND Series='Multi-Packs' ORDER BY RelYr, CountryofSale, SeriesID, RelID");
			$rel_result = mysql_query($rel_query);
			$rel_rows= mysql_num_rows($rel_result);
			if ($rel_rows!=0) {
			
				echo "<br></><h2>MULTI-PACKS</h2>";
			}
			//Search for Other
			//Search for Multipacks
			$rel_query=("SELECT * FROM Test_Matchbox_Releases WHERE UMID LIKE '%$model_for_detail%' AND (Series!='Multi-Packs' AND Series!='Superfast' AND Series!='1-75') ORDER BY RelYr, CountryofSale, SeriesID, RelID");
			$rel_result = mysql_query($rel_query);
			$rel_rows= mysql_num_rows($rel_result);
			if ($rel_rows!=0) {
			
				echo "<br></><h2>OTHER RELEASES</h2>";
			}
			?>			
		</td>
	</tr>
</table>

<?php include("includes/footer.php"); ?>	
