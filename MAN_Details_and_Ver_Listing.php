<?php
	session_start();
	$Sec_Lvl=$_SESSION['Sec_Lvl'];
	$Code2_Pref=$_SESSION['Code2_Pref'];
	$Username=$_SESSION['Username'];
	$pageTitle = "MAN# Versions Listing";
	$pageDescription = "Matching matchbox cars based on your MAN# search.";
	require_once("includes/db_connection.php");
	include("includes/header.php");
	include("includes/functions.php");
?>

<div class="row">
	<div class="large-12 columns">
	
		<h2>MAN# Versions Listing</h2>
		<p>Drill down on a version to see details, variations and releases</p>
			
		<!--<a href="http://localhost/~Falk/MBX_Web_Site_Test/IMAGES/TEST.doc"><p>CLICK TO DOWNLOAD FILE</p</a><br /> -->
			
		<?php
			//show model header info
			$model_for_detail=$_GET["model"];

			//check user code2 display preference
			//if logged as guest, or chose to mix then do code2 with code1

			if (($Sec_Lvl < "2") OR ($Code2_Pref=="0")) {
				//get version data to display
				
				$query= ("SELECT * FROM Matchbox_Versions WHERE FAB_No LIKE '%$model_for_detail%' ORDER BY VerYrFirstRel,VerID ASC");
				$result=0;
				$rows=0;
				// echo $result;
				$result = mysql_query($query);
				$rows= mysql_num_rows($result); //print_r($result);
				echo "<h3>"."CODE 1 & 2/3 Versions found: ".$rows."</h3>";
				if(!$result) {}	
			?>
			
				<ul class="large-block-grid-3 small-block-grid-2">
				
			<?php
				for ($i=1; $i<=$rows; $i++) {
					echo "<li class='carGrid'>";
						//make image clickable and send proper umid to model_detail pa
						$row=mysql_fetch_array($result);
						$picture= IMAGE_URL . $row["VerID"]."_1.jpg";
						$picture_loc=IMAGE_PATH. $row["VerID"]."_1.jpg";
						$Version_to_detail=$row["VerID"];
						$url= "Ver_Detail_and_Var_Listing.php?model=".$Version_to_detail;

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
								echo $picture_loc;
								if (file_exists($picture_loc)) {									
									if ($rows_own !="0") {
										echo "<a href=\"".$url."\">"."<img class='own' src=".$picture." width=\"240\"></a>";
									} else {
										echo "<a href=\"".$url."\">"."<img class='own not' src=".$picture." width=\"240\"></a>";
									}	
								} else {
									if ($rows_own !="0") {
										echo "<a href=\"".$url."\">"."<img class='own' src=".DEFAULT_IMAGE." width=\"240\"></a>";
									} else {
										echo "<a href=\"".$url."\">"."<img class='own not' src=".DEFAULT_IMAGE." width=\"240\"></a>";
									}
								}	
							} else {
								if (file_exists($picture_loc)) {									
									echo "<a href=\"".$url."\">"."<img src=".$picture." width=\"240\"></a>";
										
								} else {
									echo "<a href=\"".$url."\">"."<img src=".DEFAULT_IMAGE." width=\"240\"></a>";
								}	
							}	
						} else {
							if (file_exists($picture_loc)) {									
								echo "<a href=\"".$url."\">"."<img src=".$picture." width=\"240\"></a>";
							} else {
								echo "<a href=\"".$url."\">"."<img src=".DEFAULT_IMAGE." width=\"240\"></a>";
							}
						}			
				
						echo "<br />";
						$PhotoRefCd= $row["VerPhoto1Ref"];
						if ($PhotoRefCd) {
							$query2= ("SELECT * FROM Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd%'");
							$result2= mysql_query($query2);
							$row2 =mysql_fetch_array($result2);
							echo "<p id=\"photoref\">Photo by: ". $row2["RefName"]."</p>";
						} else {
							echo "<p id=\"photoref\">Photo by: no reference listed"."</p>";
						}
						echo "<p>".$row["VerName"]."</p>";
						echo "<p>Ver ID: " . $row["VerID"] . "</p>";
						echo "<p>MAN #: " . $row["FAB_No"] . "</p>";
						echo "<p>".$row["BodyColor"]."</p>";
						echo "<p>";
						if (!empty($row["TempaDesign"])) {
							echo $row["TempaDesign"].", ";
						}
						echo $row["TempaText"]."</p>";	
						echo "<p>".$row["BodyColor"]."</p>";
						echo "<p>";
						if (!empty($row["TempaDesign"])) {
							echo $row["TempaDesign"].", ";
							}
						echo $row["TempaText"]."</p>";	
						echo "<p>First Rel Dt: ".$row["VerYrFirstRel"]."</p>";
						echo "<p>Code level: ".$row["CodeLvl"];
						if ($row["CodeLvl"]=="2") {
							echo " C2 Manuf.: ".$row["SecManuf"]."</p>";
						}
					echo "</li>";
					}
					echo "</ul>";	
			} else {
				//start by showing code1
				$query= ("SELECT * FROM Matchbox_Versions WHERE FAB_No LIKE '%$model_for_detail%' AND CodeLvl='1' ORDER BY VerYrFirstRel,VerID ASC");
				$result=0;
				$rows=0;
				// echo $result;
				$result = mysql_query($query);
				$rows= mysql_num_rows($result); //print_r($result);
				echo "<h3>"."CODE 1 Versions found: ".$rows."</h3>";
				if(!$result) {
					echo "No matching results found"; //mysql_error();
					exit;
				}
				?>
				
				<ul class="large-block-grid-3 small-block-grid-2">
				
				<?php									
				for ($i=1; $i<=$rows; $i++) {
					echo "<li class='carGrid'>";
					$row=mysql_fetch_array($result);
					$picture= IMAGE_URL . $row["VerID"]."_1.jpg";
					$picture_loc=IMAGE_PATH. $row["VerID"]."_1.jpg";
		
					//make image clickable and send proper umid to model_detail page
					$Version_to_detail=$row["VerID"];
					$url= "Ver_Detail_and_Var_Listing.php?model=".$Version_to_detail;
					
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
								} else {
									echo "<a href=\"".$url."\">"."<img class='own-not' src=".$picture." width=\"240\"></a>";
								}	
							} else {
								if ($rows_own !="0") {
									echo "<a href=\"".$url."\">"."<img class='own' src=".DEFAULT_IMAGE." width=\"240\"></a>";
								} else {
									echo "<a href=\"".$url."\">"."<img class='own-not' src=".DEFAULT_IMAGE." width=\"240\"></a>";
								}
							}	
						} else {
								
							if (file_exists($picture_loc)) {									
								echo "<a href=\"".$url."\">"."<img src=".$picture." width=\"240\"></a>";
							} else {
								echo "<a href=\"".$url."\">"."<img src=".DEFAULT_IMAGE." width=\"240\"></a>";
							}	
						}	
					} else {
						if (file_exists($picture_loc)) {									
							echo "<a href=\"".$url."\">"."<img src=".$picture." width=\"240\"></a>";
						} else {
							echo "<a href=\"".$url."\">"."<img src=".DEFAULT_IMAGE." width=\"240\"></a>";
						}
					}	
					echo "<br />";
					$PhotoRefCd= $row["VerPhoto1Ref"];
					if ($PhotoRefCd) {
						$query2= ("SELECT * FROM Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd%'");
						$result2= mysql_query($query2);
						$row2 =mysql_fetch_array($result2);
						echo "<p id=\"photoref\">Photo by: ". $row2["RefName"]."</p>";
					} else {
						echo "<p id=\"photoref\">Photo by: no reference listed"."</p>";
					}
					echo "<p>".$row["VerName"]."</p>";
					echo "<p>Ver ID: ". $row["VerID"] . "</p>";
					echo "<p>MAN #: ". $row["FAB_No"]."</p>";
					echo "<p>".$row["BodyColor"]."</p>";
					echo "<p>";
					if (!empty($row["TempaDesign"])) {
						echo $row["TempaDesign"].", ";
						}
					echo $row["TempaText"]."</p>";	
					echo "<p>First Rel Dt: ".$row["VerYrFirstRel"]."</p>";
					echo "</li>";
				}
				
				echo "</ul>";
				
				//then check if to show code 2 also. if so sep srch for code 2
				if (($Sec_Lvl >= "2") AND ($Code2_Pref == "1")) {
					$query= ("SELECT * FROM Matchbox_Versions WHERE FAB_No LIKE '%$model_for_detail%' AND CodeLvl='2/3' ORDER BY VerYrFirstRel,VerID ASC");
					$result=0;
					$rows=0;
					// echo $result;
					$result = mysql_query($query);
					$rows= mysql_num_rows($result); //print_r($result);
					
					echo "<h3>"."CODE 2/3 Versions found: ".$rows."</h3>";
					
					if(!$result) {
						echo "No matching results found"; //mysql_error();
						exit;
					} else {} 
					
					if ($rows > 0) { ?>
					
						<ul class="large-block-grid-3 small-block-grid-2">
						
					<?php } 		
					for ($i=1; $i<=$rows; $i++) {
						echo "<li class=\"car-block\">";
						$row=mysql_fetch_array($result);
						$picture= IMAGE_URL . $row["VerID"]."_1.jpg";
						$picture_loc=IMAGE_PATH. $row["VerID"]."_1.jpg";
			
						//make image clickable and send proper umid to model_detail page
						$Version_to_detail=$row["VerID"];
						$url= "Ver_Detail_and_Var_Listing.php?model=".$Version_to_detail;
							
						//have collection?
						$query_coll=("SELECT * FROM Matchbox_Collection WHERE Username='$Username'");
						$result_coll = mysql_query($query_coll);
						if ($result_coll) {
							//if so, check if have in collection
							$query_own=("SELECT * FROM Matchbox_Collection WHERE Username='$Username' AND VerID='$Version_to_detail'");
							$result_own = mysql_query($query_own);
							$rows_own=mysql_num_rows($result_own);
							//$rows_own= mysql_num_rows($result_own);
							//check if pic exists and apply colors
							
							if (file_exists($picture_loc)) {									
								if ($rows_own !="0") {
									echo "<a href=\"".$url."\">"."<img class='own' src=".$picture." width=\"240\"></a>";
								} else {
									echo "<a href=\"".$url."\">"."<img class='own-not' src=".$picture." width=\"240\"></a>";
								}	
							} else {
								if ($rows_own !="0") {
									echo "<a href=\"".$url."\">"."<img class='own' src=".DEFAULT_IMAGE." width=\"240\"></a>";
								} else {
									echo "<a href=\"".$url."\">"."<img class='own-not' src=".DEFAULT_IMAGE." width=\"240\"></a>";
								}
							}	
						}				
							echo "<br />";
							$PhotoRefCd= $row["VerPhoto1Ref"];
							
							if ($PhotoRefCd) {
								$query2= ("SELECT * FROM Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd%'");
								$result2= mysql_query($query2);
								$row2 =mysql_fetch_array($result2);
								echo "<p id=\"photoref\">Photo by: ". $row2["RefName"]."</p>";
							} else {
								echo "<p id=\"photoref\">Photo by: no reference listed"."</p>";
							}
							
							echo "<p>".$row["VerName"]."</p>";
							echo "<p>Ver ID: ". $row["VerID"]." MAN#: ". $row["FAB_No"]."</p>";
							echo "<p>".$row["BodyColor"]."</p>";
							echo "<p>";
								if (!empty($row["TempaDesign"])) {
									echo $row["TempaDesign"].", ";
								}							
							echo $row["TempaText"]."</p>";	

							echo "<p>First Rel Dt: ".$row["VerYrFirstRel"]."</p>";
							echo "<p>Code level: ".$row["CodeLvl"].", C2 Manuf.: ".$row["SecManuf"]."</p>";
						echo "</li>";
						}
					}				
			}
				//if chose no code2 just drop down without doing code 2 search
			// does not show releases for this FAB_No, need to drill down for those

			?>			
	</div>
</div>

<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="Search_Models_Menu.php">Search Models</a>
		<a href="Search_Releases_Menu.php">Search Releases</a>
		<a href="model_search_help.php">Tips on Searching for Models</a>
	</div>
</div>


<?php include("includes/footer.php"); ?>	
