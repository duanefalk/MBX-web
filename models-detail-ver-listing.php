<?php
	session_start();
	$Sec_Lvl=$_SESSION['Sec_Lvl'];
	$Code2_Pref=$_SESSION['Code2_Pref'];
	$Username=$_SESSION['Username'];
	$model_for_detail=$_GET["model"]; //get model number up here so we can use in Page's <title> (line 7)
	$pageTitle = $model_for_detail . " Model Details";
	$pageDescription = "Matchbox car model details for the " . $model_for_detail . " model.";
	require_once("includes/db_connection.php");
	include("includes/header.php");
	include("includes/functions.php");
?>

<div class="row">
	<div class="large-12 columns">
		<!-- ADDED COMMENT -->
		<h2>Models Detail Page</h2>
			
		<?php
			//show model header info
			
			
			$query2= ("SELECT * FROM Matchbox_Models WHERE UMID LIKE '%$model_for_detail%'");
			$result2 = mysql_query($query2);
			if (mysql_num_rows($result2)==0) {			
				echo "<h3>Error - No matching results found</h3>"; //mysql_error();
				exit;
			}
			$row2 = mysql_fetch_array($result2);
			
			echo "<ul class='large-block-grid-3'>";
			echo "<li class='carGrid'>";
			
			$picture= IMAGE_URL . $row2["UMID"].".jpg";
			$picture_loc=IMAGE_PATH. $row2["UMID"].".jpg";
			if (file_exists($picture_loc)) {
				//echo "picture exists";
				echo "<img src=" . $picture . " />";
			} else {
				//echo "cant find picture";
				//echo DEFAULT_IMAGE;
				echo "<img src=" . DEFAULT_IMAGE . " />";
			}	
			
			$PhotoRefCd= $row2["ModelPhotoRef"];
			
			if ($PhotoRefCd) {
				$query3= ("SELECT * FROM Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd%'");
				$result3= mysql_query($query3);
				$row3 =mysql_fetch_array($result3);
				echo "<p class=\"photoref\">Photo by: ". $row3["RefName"]."</p>";
			} else {
				echo "<p class=\"photoref\">Photo by: no reference listed"."</p>";
			}

			echo "<h6>".$model_for_detail."  ".$row2['MasterModelName']."</h6>";
			echo "<p><strong>First release in:</strong> ".$row2['YrFirstProduced']."</p>";
			if ($row2["VehicleType2"]) {	
				echo "<p><strong>Vehicles type(s):</strong> ".$row2["VehicleType"].",  ".$row2["VehicleType2"]."</p>";
			} else {
				echo "<p><strong>Vehicles type(s):</strong> ".$row2["VehicleType"]."</p>";				
			}
			if ($row2["ModelScale"]) {	
				echo "<p><strong>Scale:</strong> ".$row2['ModelScale']."   Base Casting Dt: ".$row2['BaseCastYr']."</p>";
			} else {
				echo "<p><strong>Scale: None shown</strong> ".$row2['ModelScale']."   Base Casting Dt: ".$row2['BaseCastYr']."</p>";				
			}			
			echo "<p><strong>Vehicle Make:</strong> ".$row2['MakeofModel']."   Country of Make: ".$row2['CountryofMake']."</p>";
			if ($row2["ModelComment"]) {	
				echo "<p><strong>Comments:</strong> ".$row2["ModelComment"]."</p>";
			}
			
			//check if any microvar listings
			$query4=("SELECT * FROM Matchbox_Model_Microvariations WHERE Matchbox_Model_Microvariations.UMID='$model_for_detail'");
			$result4 = mysql_query($query4);
			$rowcount4=mysql_num_rows($result4);
			
			echo "</li>";
			echo "</ul>";
			
		?>
	
		<div class="row actionButtons">			
			<?php if ($rowcount4 != 0) { ?>
				<div class="large-6 columns">	
					<a href="all-variations.php?model=<?php echo $model_for_detail; ?>" class="button dark">See All Variations</a>
				</div>
				<div class="large-6 columns">
					<a href="display-microvariations.php?model=<?php echo $model_for_detail; ?>" class="button dark">See Microvariations</a>
				</div>
			<?php } else { ?>
				<div class="large-6 columns end">
					<a href="all-variations.php?model=<?php echo $model_for_detail; ?>" class="button dark">See All Variations</a>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="large-12 columns">
		<?php
			$row2 = mysql_fetch_array($result2);

			//check user code2 display preference
			//if logged as guest, or chose to mix then do code2 with code1
			if (($Sec_Lvl < "2") OR ($Code2_Pref=="0")) {
				//get version data to display
				
				$query= ("SELECT * FROM Matchbox_Versions WHERE UMID LIKE '%$model_for_detail%' ORDER BY VerYrFirstRel,VerID ASC");
				$result=0;
				$rows=0;
				// echo $result;
				$result = mysql_query($query);
				$rows= mysql_num_rows($result); //print_r($result);
				echo "<h3>CODE 1 & 2/3</h3>";
				echo "<h6>" . $rows . " versions found</h6>";
				
				if(!$result) {
					echo "No matching results found"; //mysql_error();
					exit;
				}			
				echo "<ul class='large-block-grid-3'>";		
				for ($i=1; $i<=$rows; $i++) {
					echo "<li class='carGrid'>";
						//make image clickable and send proper umid to model_detail pa
						$row=mysql_fetch_array($result);
						$picture= IMAGE_URL . $row["VerID"]."_1.jpg";
						$picture_loc=IMAGE_PATH. $row["VerID"]."_1.jpg";
						$Version_to_detail=$row["VerID"];
						$url= "ver-detail-var-listing.php?model=".$Version_to_detail;

						//determine what to show for version pics
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
										echo "<a href=\"".$url."\">"."<img class='own' src=".$picture." /></a>";
									} else {
										echo "<a href=\"".$url."\">"."<img class='own-not' src=".$picture." /></a>";
									}	
								} else {
									if ($rows_own !="0") {
										echo "<a href=\"".$url."\">"."<img class='own' src=".DEFAULT_IMAGE." /></a>";
									} else {
										echo "<a href=\"".$url."\">"."<img class='own-not' src=".DEFAULT_IMAGE." /></a>";
									}
								}	
							} else {
								if (file_exists($picture_loc)) {									
									echo "<a href=\"".$url."\">"."<img src=".$picture." /></a>";
										
								} else {
									echo "<a href=\"".$url."\">"."<img src=".DEFAULT_IMAGE." /></a>";
								}	
							}	
						} else {
							if (file_exists($picture_loc)) {									
								echo "<a href=\"".$url."\">"."<img src=".$picture." /></a>";
							} else {
								echo "<a href=\"".$url."\">"."<img src=".DEFAULT_IMAGE." /></a>";
							}
						}			
				
						$PhotoRefCd= $row["VerPhoto1Ref"];
						if ($PhotoRefCd) {
							$query2= ("SELECT * FROM Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd%'");
							$result2= mysql_query($query2);
							$row2 =mysql_fetch_array($result2);
							echo "<p class=\"photoref\">Photo by: ". $row2["RefName"]."</p>";
						} else {
							echo "<p class=\"photoref\">Photo by: no reference listed"."</p>";
						}
						
						echo "<h6>" . $row["VerName"] . "</h6>";
						echo "<p><strong>Version ID:</strong> " . $row["VerID"] . "</p>";
						echo "<p><strong>MAN #:</strong> " . $row["FAB_No"] . "</p>";
						echo "<p>First Rel Dt: ".$row["VerYrFirstRel"]."</p>";
						echo "<p>Code level: ".$row["CodeLvl"];
						echo "<p>";
						if ($row["CodeLvl"]=="2/3") {
							echo " C2 Manuf.: ".$row["SecManuf"]."</p>";
						}
						
						echo "<div class='carDetails'>";
							echo "<p><strong>Body Color:</strong> " . $row["BodyColor"] . "</p>";
							echo "<p><strong>Design &amp; Text</strong>: ";
							if (!empty($row["TempaDesign"])) {
								echo $row["TempaDesign"].", ";
							}
							//echo "<p>".$row["VerName"]."</p>";
							//echo "<p>Ver ID: ". $row["VerID"]." MAN#: ". $row["FAB_No"]."</p>";
							//echo "<p>".$row["BodyColor"]."</p>";
							//echo "<p>";
							//if (!empty($row["TempaDesign"])) {
							//	echo $row["TempaDesign"].", ";
							//}
							echo $row["TempaText"]."</p>";
							echo "<p>";

						echo "</div>";
						
							
			
						
					echo "</li>";
					}
				echo "</ul>";
			} else {
				//start by showing code1
				$query = ("SELECT * FROM Matchbox_Versions WHERE UMID LIKE '%$model_for_detail%' AND CodeLvl='1' ORDER BY VerYrFirstRel,VerID ASC");
				$result=0;
				$rows=0;
				// echo $result;
				$result = mysql_query($query);
				$rows= mysql_num_rows($result); //print_r($result);
				echo "<h3>CODE 1</h3>";
				echo "<h6>" . $rows . " versions found</h6>";
				if (!$result) {
					echo "No matching results found"; //mysql_error();
					exit;
				}
				echo "<ul class='large-block-grid-3'>";
				for ($i=1; $i<=$rows; $i++) {
					echo "<li class='carGrid'>";
					
					$row=mysql_fetch_array($result);
					$picture= IMAGE_URL . $row["VerID"]."_1.jpg";
					$picture_loc=IMAGE_PATH. $row["VerID"]."_1.jpg";
		
					//make image clickable and send proper umid to model_detail page
					$Version_to_detail = $row["VerID"];
					$url = "ver-detail-var-listing.php?model=".$Version_to_detail;
					
					if ($Sec_Lvl >= "2") {	
						//if have account, have collection?
						$query_coll=("SELECT * FROM Matchbox_Collection WHERE Username='$Username'");
						$result_coll = mysql_query($query_coll);
						
						if ($result_coll) {								
							//if so, check if have in collection
							$query_own=("SELECT * FROM Matchbox_Collection WHERE Username='$Username' AND VerID='$Version_to_detail'");
							$result_own = mysql_query($query_own);
							$rows_own= mysql_num_rows($result_own);
							
							//check if pic exists and apply colors
							if (file_exists($picture_loc)) {									
								if ($rows_own !="0") {									
									echo "<a href=\"".$url."\">"."<img class='own' src=".$picture." /></a>";
								} else {
									echo "<a href=\"".$url."\">"."<img class='own-not' src=".$picture." /></a>";
								}	
							} else {
								if ($rows_own !="0") {
									echo "<a href=\"".$url."\">"."<img class='own' src=".DEFAULT_IMAGE." /></a>";
								} else {
									echo "<a href=\"".$url."\">"."<img class='own-not' src=".DEFAULT_IMAGE." /></a>";
								}
							}	
						} else {								
							if (file_exists($picture_loc)) {									
								echo "<a href=\"".$url."\">"."<img src=".$picture." /></a>";
							} else {
								echo "<a href=\"".$url."\">"."<img src=".DEFAULT_IMAGE." /></a>";
							}	
						}	
					} else {
						if (file_exists($picture_loc)) {									
							echo "<a href=\"".$url."\">"."<img src=".$picture." /></a>";
						} else {
							echo "<a href=\"".$url."\">"."<img src=".DEFAULT_IMAGE." /></a>";
						}
					}	
					
					$PhotoRefCd = $row["VerPhoto1Ref"];
					if ($PhotoRefCd) {
						$query2= ("SELECT * FROM Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd%'");
						$result2= mysql_query($query2);
						$row2 =mysql_fetch_array($result2);
						echo "<p class=\"photoref\">Photo by: ". $row2["RefName"]."</p>";
					} else {
						echo "<p class=\"photoref\">Photo by: no reference listed"."</p>";
					}
					echo "<h6>" . $row["VerName"] . "</h6>";
					echo "<p><strong>Version ID:</strong> ". $row["VerID"] . "</p>";
					echo "<p><strong>MAN#:</strong> ". $row["FAB_No"]."</p>";
					echo "<p><strong>First Release Date:</strong> ".$row["VerYrFirstRel"]."</p>";

					
					//getting body color; then turning body color into a lowercase string (for uniformity)
					$bodyColorLowercase = $row["BodyColor"];
					$bodyColorLowercase = strtolower($bodyColorLowercase);
					
					echo "<div class='carDetails'>";
						echo "<p class='tag " . $bodyColorLowercase . "'><strong>Body Color:</strong> " . $bodyColorLowercase . "</p>";
						echo "<p><strong>Design &amp; Text</strong>: ";
						if (!empty($row["TempaDesign"])) {
							echo $row["TempaDesign"].", ";
						}
						echo $row["TempaText"];
						echo "</p>";	
						
					echo "</div>";
					echo "</li>";
				}
				echo "</ul>";
				
				//then check if to show code 2 also. if so sep srch for code 2
				if (($Sec_Lvl >= "2") AND ($Code2_Pref == "1")) {
					$query = ("SELECT * FROM Matchbox_Versions WHERE UMID LIKE '%$model_for_detail%' AND CodeLvl='2/3' ORDER BY VerYrFirstRel,VerID ASC");
					$result = 0;
					$rows = 0;
					// echo $result;
					$result = mysql_query($query);
					$rows = mysql_num_rows($result); //print_r($result);
					echo "<h3>CODE 2/3</h3>";
					echo "<h6>" . $rows . " versions found</h6>";
					if(!$result) {
						echo "No matching results found"; //mysql_error();
						exit;
					}
					echo "<ul class='large-block-grid-3'>";		
					for ($i=1; $i<=$rows; $i++) {
						echo "<li class='carGrid'>";
						
						$row = mysql_fetch_array($result);
						$picture = IMAGE_URL . $row["VerID"] . "_1.jpg";
						$picture_loc = IMAGE_PATH . $row["VerID"] . "_1.jpg";
			
						//make image clickable and send proper umid to model_detail page
						$Version_to_detail = $row["VerID"];
						$url = "ver-detail-var-listing.php?model=".$Version_to_detail;
							
						//have collection?
						$query_coll = ("SELECT * FROM Matchbox_Collection WHERE Username='$Username'");
						$result_coll = mysql_query($query_coll);
						
						if ($result_coll) {
							//if so, check if have in collection
							$query_own = ("SELECT * FROM Matchbox_Collection WHERE Username='$Username' AND VerID='$Version_to_detail'");
							$result_own = mysql_query($query_own);
							$rows_own = mysql_num_rows($result_own);
							//$rows_own= mysql_num_rows($result_own);
							//check if pic exists and apply colors
							
							if (file_exists($picture_loc)) {									
								if ($rows_own !="0") {
									echo "<a href=\"".$url."\">"."<img class='own' src=".$picture." /></a>";
								} else {
									echo "<a href=\"".$url."\">"."<img class='own-not' src=".$picture." /></a>";
								}	
							} else {
								if ($rows_own !="0") {
									echo "<a href=\"".$url."\">"."<img class='own' src=".DEFAULT_IMAGE." /></a>";
								} else {
									echo "<a href=\"".$url."\">"."<img class='own-not' src=".DEFAULT_IMAGE." /></a>";
								}
							}	
						}				
							
						$PhotoRefCd = $row["VerPhoto1Ref"];
						if ($PhotoRefCd) {
							$query2 = ("SELECT * FROM Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd%'");
							$result2 = mysql_query($query2);
							$row2 = mysql_fetch_array($result2);
							echo "<p class=\"photoref\">Photo by: ". $row2["RefName"]."</p>";
						} else {
							echo "<p class=\"photoref\">Photo by: no reference listed"."</p>";
						}
						
						echo "<h6>".$row["VerName"]."</h6>";
						echo "<p><strong>Version ID:</strong> " . $row["VerID"] . "</p>";
						echo "<p><strong>MAN#:</strong> " . $row["FAB_No"] . "</p>";
						echo "<p><strong>First Release Date:</strong> ".$row["VerYrFirstRel"]."</p>";
						echo "<p><strong>Code level:</strong> " . $row["CodeLvl"] . "</p>";
						echo "<p><strong>C2 Manufacturer:</strong> " . $row["SecManuf"] . "</p>";						
							
							//getting body color; then turning body color into a lowercase string (for uniformity)
							$bodyColorLowercase = $row["BodyColor"];
							$bodyColorLowercase = strtolower($bodyColorLowercase);
							
						echo "<div class='carDetails'>";
							echo "<p class='tag " . $bodyColorLowercase . "'><strong>Body Color</strong>: " . $bodyColorLowercase . "</p>";
							echo "<p>";
							if (!empty($row["TempaDesign"])) {
								echo $row["TempaDesign"].", ";
								}
							echo $row["TempaText"]."</p>";	

						echo "</div>";
							
						echo "</li>";		
					}
					echo "</ul>";
				}	
			}
			
			//if chose no code2 just drop down without doing code 2 search
			// display releases for this umid
			$rel_result=0;
			$rel_rows=0;
			
			//Search for 1-75
			$rel_query=("SELECT * FROM Matchbox_Releases WHERE UMID LIKE '%$model_for_detail%' AND Series='1-75' ORDER BY RelYr, CountryofSale, SeriesID, RelID");
			$rel_result = mysql_query($rel_query);
			$rel_rows= mysql_num_rows($rel_result);
			if ($rel_rows!=0) {
				echo "<h2>1-75 series</h2>";
				echo "<ul class='large-block-grid-5'>";
				
				for ($i=1; $i<=$rel_rows; $i++) {
					
					echo "<li class='carGrid'>";
					
						$rel_row = mysql_fetch_array($rel_result);
						$curr_yr = $rel_row["RelYr"];
						
						/*
						if ($i==1) {
							$last_yr = $curr_yr;
							echo "<h6 class='" . $rel_row["RelYr"] . "'>".$rel_row["RelYr"]."</h6>";
						}
						if ($curr_yr != $last_yr) {
							echo "<h6 class='" . $rel_row["RelYr"] . "'>".$rel_row["RelYr"]."</h6>";
						}	
						*/
						
						//print info
						$RelPhotoRefCd=$rel_row["RelPkgPhotoRef"];
						$picture = IMAGE_URL . $rel_row["RelID"] . "_1.jpg";
						$picture_loc = IMAGE_PATH . $rel_row["RelID"] . "_1.jpg";
						$url = "release-detail.php?model=" . $rel_row["RelID"];
						
						if (file_exists($picture_loc)) {
							echo "<a class='thumb' href='" . $url . "'><img src=" . $picture . " /><h6 class='year " . $rel_row["RelYr"] . "'>".$rel_row["RelYr"]."</h6></a>";
						} else {	
							echo "<a class='thumb' href='" . $url . "'><img src=" . DEFAULT_IMAGE . " /><h6 class='year " . $rel_row["RelYr"] . "'>".$rel_row["RelYr"]."</h6></a>";
						}
						if ($rel_row["RelPkgPhotoRef"]) {
							$query2 = ("SELECT * FROM Matchbox_References WHERE RefCode LIKE '%$RelPhotoRefCd%'");
							$result2 = mysql_query($query2);
							$row2 = mysql_fetch_array($result2);
							echo "<p class=\"photoref\">Photo by: ". $row2["RefName"]."</p>";
						} else {
							echo "<p class=\"photoref\">Photo by: no reference listed"."</p>";
						}
						echo "<p><strong>Country:</strong> ".$rel_row["CountryOfSale"]."</p>";
						echo "<p><strong>Rel ID:</strong> ". $rel_row["RelID"]."</p>";
						echo "<p><strong>Series ID:</strong> ".$rel_row["SeriesID"]."</p>";
						echo "<p><strong>Name on Pakage:</strong> ".$rel_row["MdlNameOnPkg"]."</p>";	
						$last_yr = $curr_yr;
					
					echo "</li>";
				}
			}
			echo "</ul>";
			
			//Search for Superfast
			$rel_query=("SELECT * FROM Matchbox_Releases WHERE UMID LIKE '%$model_for_detail%' AND Series='Superfast' ORDER BY RelYr, CountryofSale, SeriesID, RelID");
			$rel_result = mysql_query($rel_query);
			$rel_rows= mysql_num_rows($rel_result);
			if ($rel_rows!=0) {	
				echo "<h2>SUPERFAST</h2>";
				echo "<ul class='large-block-grid-5'>";
				
				for ($i=1; $i<=$rel_rows; $i++) {
					echo "<li class='carGrid'>";
					
					$rel_row=mysql_fetch_array($rel_result);
					$curr_yr=$rel_row["RelYr"];
	
					/*
					if ($i==1) {
						$last_yr = $curr_yr;
						echo "<div class='row'><div class='large-12 columns'><h3>" . $rel_row["RelYr"] . "</h3></div></div>";
					}
					//echo $curr_yr."...".$last_yr;
					if ($curr_yr != $last_yr) {
						echo "<div class='row'><div class='large-12 columns'><h3>".$rel_row["RelYr"]."</h3></div></div>";
					}
					*/
					
					//print info
					$RelPhotoRefCd=$rel_row["RelPkgPhotoRef"];
					$picture= IMAGE_URL . $rel_row["RelID"]."_1.jpg";
					$picture_loc=IMAGE_PATH. $rel_row["RelID"]."_1.jpg";
					$url= "release-detail.php?model=".$rel_row["RelID"];
					if (file_exists($picture_loc)) {
						echo "<a class='thumb' href=\"".$url."\">"."<img src=".$picture." /><h6 class='year " . $rel_row["RelYr"] . "'>".$rel_row["RelYr"]."</h6></a>";
					} else {	
						echo "<a class='thumb' href=\"".$url."\">"."<img src=".DEFAULT_IMAGE." /><h6 class='year " . $rel_row["RelYr"] . "'>".$rel_row["RelYr"]."</h6></a>";
					}
					if ($rel_row["RelPkgPhotoRef"]) {
						$query2= ("SELECT * FROM Matchbox_References WHERE RefCode LIKE '%$RelPhotoRefCd%'");
						$result2= mysql_query($query2);
						$row2 =mysql_fetch_array($result2);
						echo "<p class=\"photoref\">Photo by: ". $row2["RefName"]."</p>";
					} else {
						echo "<p class=\"photoref\">Photo by: no reference listed"."</p>";
					}
					echo "<p><strong>Country:</strong> ".$rel_row["CountryOfSale"]."</p>";
					echo "<p><strong>Rel ID:</strong> ". $rel_row["RelID"]."</p>";
					echo "<p><strong>Series ID:</strong> ".$rel_row["SeriesID"]."</p>";
					echo "<p><strong>Name on Package:</strong> ".$rel_row["MdlNameOnPkg"]."</p>";	
					$last_yr=$curr_yr;
					
					echo "</li>";
				}
				echo "</ul>";
			}

			//Search for Multipacks
			$rel_query=("SELECT * FROM Matchbox_Releases WHERE UMID LIKE '%$model_for_detail%' AND Series='Multi-Packs' ORDER BY RelYr, CountryofSale, SeriesID, RelID");
			$rel_result = mysql_query($rel_query);
			$rel_rows= mysql_num_rows($rel_result);
			if ($rel_rows!=0) {
				echo "<h2>MULTI-PACKS</h2>";
				echo "<ul class='large-block-grid-5'>";
				
				for ($i=1; $i<=$rel_rows; $i++) {
					echo "<li class='carGrid'>";
					$rel_row=mysql_fetch_array($rel_result);
					$curr_yr=$rel_row["RelYr"];
					
					/*
					if ($i==1) {
						$last_yr = $curr_yr;
						echo "<div class='row'><div class='large-12 columns'><h3>" . $rel_row["RelYr"] . "</h3></div></div>";
					}
					//echo $curr_yr."...".$last_yr;
					if ($curr_yr != $last_yr) {
						echo "<div class='row'><div class='large-12 columns'><h3>" . $rel_row["RelYr"] . "</h3></div></div>";						
					}
					*/
					
					//print info
					$RelPhotoRefCd=$rel_row["RelPkgPhotoRef"];
					$picture = IMAGE_URL . $rel_row["RelID"] . "_1.jpg";
					$picture_loc = IMAGE_PATH . $rel_row["RelID"] . "_1.jpg";
					$url= "release-detail.php?model=".$rel_row["RelID"];
					if (file_exists($picture_loc)) {
						echo "<a class='thumb' href=\"".$url."\">"."<img src=".$picture." /><h6 class='year " . $rel_row["RelYr"] . "'>".$rel_row["RelYr"]."</h6></a>";
					} else {	
						echo "<a class='thumb' href=\"".$url."\">"."<img src=".DEFAULT_IMAGE." /><h6 class='year " . $rel_row["RelYr"] . "'>".$rel_row["RelYr"]."</h6></a>";
					}
					if ($rel_row["RelPkgPhotoRef"]) {
						$query2= ("SELECT * FROM Matchbox_References WHERE RefCode LIKE '%$RelPhotoRefCd%'");
						$result2= mysql_query($query2);
						$row2 =mysql_fetch_array($result2);
						echo "<p class=\"photoref\">Photo by: ". $row2["RefName"]."</p>";
					} else {
						echo "<p class=\"photoref\">Photo by: no reference listed"."</p>";
					}
					echo "<p><strong>Country:</strong> ".$rel_row["CountryOfSale"]."</p>";
					echo "<p><strong>Rel ID:</strong> ". $rel_row["RelID"]."</p>";
					if ($rel_row["SeriesID"]) {
						echo "<p><strong>Series ID:</strong> ".$rel_row["SeriesID"]."</p>";
					}
					if ($rel_row["MdlNameOnPkg"]) {
						echo "<p><strong>Name on Package:</strong> " . $rel_row["MdlNameOnPkg"] . "</p>";	
					}
					$last_yr = $curr_yr;
					echo "</li>";
				}
				echo "</ul>";
			}
			
			//Search for Other Releases
			$rel_query=("SELECT * FROM Matchbox_Releases WHERE UMID LIKE '%$model_for_detail%' AND (Series!='Multi-Packs' AND Series!='Superfast' AND Series!='1-75' AND Series!='Code 2') ORDER BY Series, RelYr, CountryofSale, SeriesID, RelID");
			$rel_result = mysql_query($rel_query);
			$rel_rows= mysql_num_rows($rel_result);
			if ($rel_rows!=0) {	
				echo "<h2>OTHER RELEASES</h2>";
				echo "<ul class='large-block-grid-5'>";
				
				for ($i=1; $i<=$rel_rows; $i++) {
					
					echo "<li class='carGrid'>";
					
						$rel_row = mysql_fetch_array($rel_result);
						$curr_yr = $rel_row["RelYr"];
		
						/*
						if ($i==1) {
							$last_yr = $curr_yr;
							echo "<div class='row'><div class='large-12 columns'><h3>".$rel_row["RelYr"]."</h3></div></div>";
						}
						if ($curr_yr != $last_yr) {
							echo "<div class='row'><div class='large-12 columns'><h3>".$rel_row["RelYr"]."</h3></div></div>";
						}
						*/
					
						//print info
						$RelPhotoRefCd=$rel_row["RelPkgPhotoRef"];
						$picture = IMAGE_URL . $rel_row["RelID"] . "_1.jpg";
						$picture_loc = IMAGE_PATH . $rel_row["RelID"] . "_1.jpg";
						$url = "release-detail.php?model=" . $rel_row["RelID"];
						if (file_exists($picture_loc)) {
							echo "<a class='thumb' href=\"".$url."\">"."<img src=".$picture." /><h6 class='year " . $rel_row["RelYr"] . "'>".$rel_row["RelYr"]."</h6></a>";
						} else {	
							echo "<a class='thumb' href=\"".$url."\">"."<img src=".DEFAULT_IMAGE." /><h6 class='year " . $rel_row["RelYr"] . "'>".$rel_row["RelYr"]."</h6></a>";
						}
						if ($rel_row["RelPkgPhotoRef"]) {
							$query2= ("SELECT * FROM Matchbox_References WHERE RefCode LIKE '%$RelPhotoRefCd%'");
							$result2= mysql_query($query2);
							$row2 =mysql_fetch_array($result2);
							echo "<p class=\"photoref\">Photo by: " . $row2["RefName"]."</p>";
						} else {
							echo "<p class=\"photoref\">Photo by: no reference listed"."</p>";
						}
						echo "<p><strong>Country:</strong> ".$rel_row["CountryOfSale"]."</p>";
						echo "<p><strong>Rel ID:</strong> ". $rel_row["RelID"]."</p>";
						if ($rel_row["SeriesID"]) {
							echo "<p><strong>Series ID:</strong> ".$rel_row["SeriesID"]."</p>";
						}
						if ($rel_row["MdlNameOnPkg"]) {
							echo "<p><strong>Name on Package:</strong> " . $rel_row["MdlNameOnPkg"] . "</p>";	
						}
						$last_yr = $curr_yr;
					
					echo "</li>";
				}
				
				echo "</ul>";
			}
			
		?>			
	</div>
</div>

<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="search-models-menu.php">Search Models</a>
		<a href="search-releases-menu.php">Search Releases</a>
		<a href="model-search-help.php">Tips on Searching for Models</a>
	</div>
</div>


<?php include("includes/footer.php"); ?>	
