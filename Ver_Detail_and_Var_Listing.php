<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>

<div class="row">
	<div class="large-12 columns">
	
		<?php
			$model_for_detail=$_GET["model"];
			$UMID=substr($model_for_detail,0,6);
			
			echo "<a href=\"Models_Detail_and_Ver_Listing.php?model=".$UMID."\"><p onmouseover=\"this.style.color='orange'\" onmouseout=\"this.style.color='white'\">Return to Versions Listing Page</a>";
		?>
			
	
		<h2>Version Details Page</h2>
		
		<?php
			$result=0;
			$rows=0;
			$model_for_detail=$_GET["model"];
			//find and display version details
			//echo "The picture you clicked on was: ".$model_for_detail."<br />";
			$query= ("SELECT * FROM Matchbox_Versions WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			if(!$result) {
				echo "Database error: No matching results found"; //mysql_error();
				exit;
				}
			$row=mysql_fetch_array($result);
			echo "<h3>Version ID: ". $row["VerID"]."</h3>";
			$picture1= IMAGE_URL . $row["VerID"]."_1.jpg";
			$picture1_loc=IMAGE_PATH. $row["VerID"]."_1.jpg";
			$Version_to_detail= $row["VerID"];			
			if (file_exists($picture1_loc)) {
				//echo "picture exists";
				echo "<img src=".$picture1." width=\"240\">";
				$picture2=IMAGE_URL . $row["VerID"]."_2.jpg";
				$picture2_loc=IMAGE_PATH. $row["VerID"]."_2.jpg";
				if (file_exists($picture2_loc)) {
					echo "<img src=".$picture2." width=\"240\">";
				}
			} else {
				//echo "cant find picture";
				//echo DEFAULT_IMAGE;
				echo "<img src=".DEFAULT_IMAGE." width=\"240\">";
			}
			echo "<br></>Version Name: ". $row["VerName"]. "<br></>";
			echo "<br></>Version Mack#: ".$row["Master_Mack_No"]."    MAN#: ".$row["FAB_No"]."<br></>";
			echo "First Prod.: ". $row["VerYrFirstRel"]."    Version Type: ".$row["VerTyp"]."<br></>";
			echo $row["BodyColor"]."<br></>";
			if (!empty($row["TempaDesign"])) {
				echo "Design: ".$row["TempaDesign"]."<br></>";
				}
			if (!empty($row["TempaText"])) {
				echo "Text: ".$row["TempaText"]."<br></>";
				}
			echo "Code level: ".$row["CodeLvl"]."<br></>";
			if ($row["CodeLvl"]=="2") {
				echo " C2 Manuf.: ".$row["SecManuf"]."<br></>";
			}
			if ($row["VerAttachments"]) {
				echo "Attachments: ".$row["VerAttachments"]."<br></>";
			}			
			if ($row["VerComm"]) {
				echo "Comment: ".$row["VerComm"]."<br></>";
			}	
			echo "<br></>";

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
			        $url= "Variation_Comparison.php?model=".$Version_to_detail;
				echo "<a class=\"button dark\" href=\"".$url."\">Var Comparison Chart</a><br></><br></>";
			}
			for ($i=1; $i<=$rows2; $i++)
				{
				$row2=mysql_fetch_array($result2);
				echo "<h3>Var ID: ". $row2["VarID"]."</h3>";
				$picture1= IMAGE_URL . $row2["VarID"]."_1.jpg";
				$picture1_loc=IMAGE_PATH. $row2["VarID"]."_1.jpg";
				//echo $picture1."<br />";
				$picture2= IMAGE_URL . $row2["VarID"]."_2.jpg";
				$picture2_loc=IMAGE_PATH. $row2["VarID"]."_2.jpg";	
				
				$Variation_to_detail= $row2["VarID"];
				$url= "Variation_Detail.php?model=".$Variation_to_detail;				
				if (file_exists($picture1_loc)) {
					//echo "picture exists";
					echo "<a href=\"".$url."\">"."<img src=".$picture1." width=\"240\"></a>";
				} else {
					//echo "cant find picture";
					//echo DEFAULT_IMAGE;
					echo "<a href=\"".$url."\">"."<img src=".DEFAULT_IMAGE." width=\"240\"></a>";
				}

				if (file_exists($picture2_loc)) {
					//echo "picture exists";
					echo "<a href=\"".$url."\">"."<img src=".$picture2." width=\"240\"></a>";
				} else {
					//ignore, dont put up a default for 2nd one	
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
								echo "<p id=\"photoref\">Photos by: ". $row2a["RefName"] . "</p>";
							} ELSE {
								echo "<p id=\"photoref\">Photos by: ". $row2a["RefName"].", ".$row2b["RefName"] . "</p>";
							}
						} else {
							echo "<p id=\"photoref\">Photo by: ". $row2a["RefName"] . "</p>";
						}
					} else {
						echo "<p id=\"photoref\">Photo by: no reference listed</p>";
					}
				
				//look up release info
				$result3=0;
				$rows3=0;
				$variation_for_detail=$row2["VarID"];
				echo "<br></>";
				$query3= ("SELECT * FROM Matchbox_Releases WHERE VarID LIKE '%$variation_for_detail%' ORDER BY RelID ASC");
				$result3 = mysql_query($query3);
				$rows3= mysql_num_rows($result3);
				if(!$result2) {
				echo "No matching results found"; //mysql_error();
				exit;
				}
				//list releases
				for ($i2=1; $i2<=$rows3; $i2++)
					{
					echo "<div class=\"car-block\">";
						$row3=mysql_fetch_array($result3);
						$rel_picture1= IMAGE_URL . $row3["RelID"]."_1.jpg";
						$rel_picture1_loc= IMAGE_PATH. $row3["RelID"]."_1.jpg";
						$Release_to_detail=$row3["RelID"];
						$url2= "Release_Detail.php?model=".$Release_to_detail;	
						if (file_exists($rel_picture1_loc)) {
						//echo "picture exists";
						echo "<a href=\"".$url2."\">"."<img src=".$rel_picture1." width=\"180\"></a>";
						} else {
							//echo "cant find picture";
							echo "<a href=\"".$url2."\">"."<img src=".DEFAULT_REL_IMAGE." width=\"180\"></a>";
						}
						echo "<p>Release Yr: ". $row3["RelYr"]."</p>";
						echo "<p>Country: ". $row3["CountryOfSale"]."</p>";
						echo "<p>Series: ".$row3["Series"]." Series#: ".$row3["SeriesID"]."</p>";
						echo "<p>Model Name: ".$row3["MdlNameOnPkg"]."</p>";
						echo "<p>Package Name: ".$row3["PkgName"]."</p>";
					echo "</div>";					
					}
					echo "<br />";
				}
				$model_for_detail=$row["UMID"];
			        $url= "Models_Detail_and_Ver_Listing.php?model=".$model_for_detail;
				echo "<a href=\"".$url."\">Cancel</a>";
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
