<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>
<table id="structure">

	<tr>
		<td id="navigation">
			<a href="Search_Models_Menu.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Search Models</p></a>
			<a href="Search_Releases_Menu.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Search Releases</p></a>
			<a href="Main_page.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Main Page</p></a>
		</td>
		<td id="page">
			<h2>Version Details Page</h2>
			<br></>
			<?php
			$result=0;
			$rows=0;
			$model_for_detail=$_GET["model"];
			//find and display version details
			//echo "The picture you clicked on was: ".$model_for_detail."<br />";
			$query= ("SELECT * FROM Test_Matchbox_Versions WHERE VerID LIKE '%$model_for_detail%'");
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
			} else {
				//echo "cant find picture";
				//echo DEFAULT_IMAGE;
				echo "<img src=".DEFAULT_IMAGE." width=\"240\">";
			}
			echo "<br></>Version Mack#: ".$row["Master_Mack_No"]."    MAN#: ".$row["FAB_No"]."<br></>";
			echo "Version Name: ". $row["VerName"]. "<br></>";
			echo "First Prod.: ". $row["VerYrFirstRel"]."    Ver Type: ".$row["VerTyp"]."<br></>";
			echo "Color: ".$row["BodyColor"]."   Design: ".$row["TempaDesign"]."<br></>";
			if ($row["TempaText"]) {
				echo "Text: ".$row["TempaText"]."<br></>";
			}
			if ($row["VerAttachments"]) {
				echo "Text: ".$row["VerAttachments"]."<br></>";
			}			
			if ($row["VerComm"]) {
				echo "Text: ".$row["VerComm"]."<br></>";
			}	
			echo "<br></>";

			echo "<h2>Variations</h2>";
			//find and display variations
			$query2= ("SELECT * FROM Test_Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result2 = mysql_query($query2);
			$rows2= mysql_num_rows($result2);

			//echo "No. of Variations: ".$rows2."<br /><br />";
			if(!$result2) {
				echo "No matching results found"; //mysql_error();
				exit;
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
					$query2a= ("SELECT * FROM Test_Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd1%'");
					$result2a= mysql_query($query2a);
					$row2a =mysql_fetch_array($result2a);
					echo "<p id=\"photoref\">Photo by: ". $row2a["RefName"]."</p>";
					if ($PhotoRefCd2) {
						$query2b= ("SELECT * FROM Test_Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd2%'");
						$result2b= mysql_query($query2b);
						$row2b =mysql_fetch_array($result2b);
						echo "<p id=\"photoref\">, ". $row2b["RefName"]."</p>";
					}
				} ELSE {
					echo "<p id=\"photoref\">Photo by: no reference listed</p>";
				}

				echo "Base Name: ". $row2["BaseName"]."<br />";
				echo "Var Year: ".$row2["VarYear"]." Origin: ".$row2["ManufLoc"]."<br />";
				//echo "Est. Value: ".$row2["StdValue"]."<br /><br />";
				
				//look up release info
				$result3=0;
				$rows3=0;
				$variation_for_detail=$row2["VarID"];
				echo "<br></>";
				$query3= ("SELECT * FROM Test_Matchbox_Releases WHERE VarID LIKE '%$variation_for_detail%' ORDER BY RelID ASC");
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
						echo "<a href=\"".$url2."\">"."<img src=".$rel_picture1." width=\"240\"></a>";
						} else {
							//echo "cant find picture";
							echo "<a href=\"".$url2."\">"."<img src=".DEFAULT_IMAGE." width=\"240\"></a>";
						}
						echo "<p>Release Yr: ". $row3["RelYr"]."   Country: ". $row3["CountryOfSale"]."</p>";
						echo "<p>Series: ".$row3["Series"]." Series#: ".$row3["SeriesID"]."</p>";
						echo "<p>Model Name: ".$row3["MdlNameOnPkg"]."</p>";
						echo "<p>Package Name: ".$row3["PkgName"]."</p>";
					echo "</div>";					
					}
					echo "<br></>";
				}
				$model_for_detail=$row["UMID"];
			        $url= "Models_Detail_and_Ver_Listing.php?model=".$model_for_detail;
				echo "<a href=\"".$url."\">Cancel</a>";
			?>
		</td>
	</tr>
</table>

<?php include("includes/footer.php"); ?>	
