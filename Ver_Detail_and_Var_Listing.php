<?php 
	require_once("includes/db_connection.php");
	
	$model_for_detail = $_GET["model"];
	$UMID = substr($model_for_detail,0,6);
	
	$result=0;
	$rows=0;
	$model_for_detail=$_GET["model"];
	
	$query= ("SELECT * FROM Matchbox_Versions WHERE VerID LIKE '%$model_for_detail%'");
	$result = mysql_query($query);
	if(!$result) {
		echo "Database error: No matching results found"; //mysql_error();
		exit;
	}
	$row = mysql_fetch_array($result);
	$versionID = $row["VerID"];
	
	if($versionID) {
		$pageTitle = $versionID . " Version Details Page";
		$pageDescription = "Matchbox model version and variation details about " . $versionID . ".";
	} else {
		$pageTitle = "Version Details Page";
		$pageDescription = "Matchbox model version and variation details.";	
	}	
	include("includes/header.php");
	include("includes/functions.php");
?>

<div class="row">
	<div class="large-12 columns">
		<p><a href="Models_Detail_and_Ver_Listing.php?model=<?php echo $UMID; ?>">Return to Versions Listing Page</a></p>	
		<h2>Version Details Page</h2>		
		<?php
			echo "<h3>Version ID: " . $row["VerID"] . "</h3>";
			echo "<ul class='large-block-grid-3'>";
			echo "<li class='carGrid'>";
			
			$picture1 = IMAGE_URL . $row["VerID"] . "_1.jpg";
			$picture1_loc = IMAGE_PATH . $row["VerID"] . "_1.jpg";
			
			$Version_to_detail = $row["VerID"];
			
			if ( file_exists($picture1_loc) ) {
			
				$PhotoRefCd1 = $row["VerPhoto1Ref"];
				$query2a = ("SELECT * FROM Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd1%'");
				$result2a = mysql_query($query2a);
				$row2a = mysql_fetch_array($result2a);
				
			?>
				<a class="imagePopup" title="<?php echo $row2a["RefName"]; ?>" href="<?php echo $picture1; ?>"><img src="<?php echo $picture1; ?>" /></a>
				<?php
					$picture2 = IMAGE_URL . $row["VerID"] . "_2.jpg";
					$picture2_loc = IMAGE_PATH . $row["VerID"] . "_2.jpg";
					
					if (file_exists($picture2_loc)) { 
						$PhotoRefCd2 = $row["VerPhoto2Ref"];
						$query2b = ("SELECT * FROM Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd2%'");
						$result2b = mysql_query($query2b);
						$row2b = mysql_fetch_array($result2b);
					?>
					
						<a class="imagePopup" title="<?php echo $row2b["RefName"]; ?>" href="<?php echo $picture2; ?>"><img src="<?php echo $picture2; ?>" /></a>
					<?php }
			} else {
				echo "<img src=" . DEFAULT_IMAGE . " />";
			}
			
			$PhotoRefCd1 = $row["VerPhoto1Ref"];
			$PhotoRefCd2 = $row["VerPhoto2Ref"];
			
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
				
			echo "<p><strong>Version Name:</strong> " . $row["VerName"] . "</p>";
			echo "<p><strong>Version Mack #:</strong> " . $row["Master_Mack_No"] . "</p>";
			echo "<p><strong>MAN #:</strong> " . $row["FAB_No"] . "</p>";
			echo "<p><strong>First Prod.:</strong> " . $row["VerYrFirstRel"] . "</p>";
			echo "<p><strong>Version Type:</strong> " . $row["VerTyp"] . "</p>";
			echo "<p><strong>Code level:</strong> " . $row["CodeLvl"] . "</p>";
			if ($row["CodeLvl"]=="2") {
				echo "<p><strong>C2 Manufacturer:</strong> ".$row["SecManuf"] . "</p>";
			}
			echo "<div class='carDetails'>";
				echo "<p><strong>Body Color:</strong> " . $row["BodyColor"] . "</p>";
				if (!empty($row["TempaDesign"])) {
					echo "<p><strong>Design:</strong> " . $row["TempaDesign"] . "</p>";
				}
				if (!empty($row["TempaText"])) {
					echo "<p><strong>Text:</strong> " . $row["TempaText"] . "</p>";
				}

				if ($row["VerAttachments"]) {
					echo "<p><strong>Attachments:</strong> " . $row["VerAttachments"] . "</p>";
				}			
				if ($row["VerComm"]) {
					echo "<p><strong>Comment:</strong> " . $row["VerComm"] . "</p>";
				}	
			echo "</li></ul>";

			echo "<h2>Variations</h2>";
			//find and display variations
			$query2= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%' ORDER BY VarID ASC");
			$result2 = mysql_query($query2);
			$rows2= mysql_num_rows($result2);

			//echo "No. of Variations: ".$rows2."<br /><br />";
			if(!$result2) {
				echo "No matching results found"; //mysql_error();
				exit;
				}
			if ($rows2>1) {
			        $url= "variation-comparison.php?model=".$Version_to_detail;
				echo "<a class=\"button dark\" href=\"".$url."\">Var Comparison Chart</a>";
			}
			for ($i=1; $i<=$rows2; $i++) {
				$row2 = mysql_fetch_array($result2);
				echo "<h3>Var ID: " . $row2["VarID"] . "</h3>";
				$picture1 = IMAGE_URL . $row2["VarID"] . "_1.jpg";
				$picture1_loc = IMAGE_PATH . $row2["VarID"] . "_1.jpg";
				$picture2 = IMAGE_URL . $row2["VarID"] . "_2.jpg";
				$picture2_loc = IMAGE_PATH . $row2["VarID"] . "_2.jpg";	
				
				$Variation_to_detail = $row2["VarID"];
				$url = "variation-detail.php?model=".$Variation_to_detail;
				
				echo "<ul class='large-block-grid-3'>";
					echo "<li class='carGrid'>";
						
						if (file_exists($picture1_loc)) {
							//echo "picture exists";
							echo "<a href=\"".$url."\"><img src=".$picture1." /></a>";
						} else {
							//echo "cant find picture";
							//echo DEFAULT_IMAGE;
							echo "<a href=\"".$url."\"><img src=".DEFAULT_IMAGE." /></a>";
						}
		
						if (file_exists($picture2_loc)) {
							//echo "picture exists";
							echo "<a href=\"".$url."\"><img src=".$picture2." /></a>";
						}
							
						$PhotoRefCd1= $row2["VarPhoto1Ref"];
						$PhotoRefCd2= $row2["VarPhoto2Ref"];

						if ($PhotoRefCd1) {
							$query2a= ("SELECT * FROM Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd1%'");
							$result2a= mysql_query($query2a);
							$row2a =mysql_fetch_array($result2a);
							if ($PhotoRefCd2) {
								$query2b= ("SELECT * FROM Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd2%'");
								$result2b= mysql_query($query2b);
								$row2b =mysql_fetch_array($result2b);
								if ($row2b==$row2a) {
									echo "<p class=\"photoref\">Photos by: ". $row2a["RefName"] . "</p>";
								} else {
									echo "<p class=\"photoref\">Photos by: ". $row2a["RefName"].", ".$row2b["RefName"] . "</p>";
								}
							} else {
								echo "<p class=\"photoref\">Photo by: ". $row2a["RefName"] . "</p>";
							}
						} else {
							echo "<p class=\"photoref\">Photo by: no reference listed</p>";
						}
						
					echo "</li>";
				echo "</ul>";
				
				//look up release info
				$result3=0;
				$rows3=0;
				$variation_for_detail=$row2["VarID"];
				
				$query3 = ("SELECT * FROM Matchbox_Releases WHERE VarID LIKE '%$variation_for_detail%' ORDER BY RelID ASC");
				$result3 = mysql_query($query3);
				$rows3= mysql_num_rows($result3);
				if (!$result2) {
					echo "No matching results found"; //mysql_error();
					exit;
				}
				//list releases
				echo "<ul class='large-block-grid-3'>";
				
				for ($i2=1; $i2<=$rows3; $i2++) {
					echo "<li class='carGrid'>";
						$row3 = mysql_fetch_array($result3);
						$rel_picture1 = IMAGE_URL . $row3["RelID"] . "_1.jpg";
						$rel_picture1_loc = IMAGE_PATH . $row3["RelID"] . "_1.jpg";
						$Release_to_detail = $row3["RelID"];
						$url2 = "Release_Detail.php?model=" . $Release_to_detail;	
						
						if (file_exists($rel_picture1_loc)) {
							//echo "picture exists";
							echo "<a href=\"" . $url2 . "\">" . "<img src=" . $rel_picture1 . " /></a>";
						} else {
							//echo "cant find picture";
							echo "<a href=\"" . $url2 . "\">" . "<img src=" . DEFAULT_REL_IMAGE . " /></a>";
						}
						echo "<p><strong>Release Year:</strong> ". $row3["RelYr"]."</p>";
						echo "<p><strong>Country:</strong> ". $row3["CountryOfSale"]."</p>";
						echo "<p><strong>Series:</strong> ".$row3["Series"]." Series#: ".$row3["SeriesID"]."</p>";
						if ($row3["MdlNameOnPkg"]) {
							echo "<p><strong>Model Name:</strong> ".$row3["MdlNameOnPkg"]."</p>";
						}
						if ($row3["PkgName"]) {
							echo "<p><strong>Package Name:</strong> ".$row3["PkgName"]."</p>";
						}						
					echo "</li>";					
				}
				
				echo "</ul>";
			}
				
			$model_for_detail = $row["UMID"];
			$url = "Models_Detail_and_Ver_Listing.php?model=" . $model_for_detail;
			
		?>
		<a class="button cancel" href="<?php echo $url; ?>">Cancel</a>
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
