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
			
	
		<h2>Variations Comparison Chart</h2>
		
		<?php
			$result=0;
			$rows=0;
			$model_for_detail=$_GET["model"];

			//find and display variations
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);

			//echo "No. of Variations: ".$rows2."<br /><br />";
			if(!$result) {
				echo "Database error"; //mysql_error();
				exit;
				}

			for ($i=1; $i<=$rows; $i++)
			{
				$row=mysql_fetch_array($result);
				echo "<h3>Var ID: ". $row["VarID"]."</h3>";
				$picture1= IMAGE_URL . $row["VarID"]."_1.jpg";
				$picture1_loc=IMAGE_PATH. $row["VarID"]."_1.jpg";
				//echo $picture1."<br />";
				$picture2= IMAGE_URL . $row["VarID"]."_2.jpg";
				$picture2_loc=IMAGE_PATH. $row["VarID"]."_2.jpg";
				
				//show photos
				$Variation_to_detail= $row["VarID"];
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
				//show photo refs								
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
								echo "<p id=\"photoref\">Photos by: ". $row2a["RefName"];
							} else {
							echo "<p id=\"photoref\">Photos by: ". $row2a["RefName"].", ".$row2b["RefName"]."</p>";
							}
						} else {
							echo "<p id=\"photoref\">Photo by: ". $row2a["RefName"];
						}
					} else {
						echo "<p id=\"photoref\">Photo by: no reference listed";
					}
				echo "<p></p>";
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
			}	
			
				$model_for_detail=$row["UMID"];
			        $url= "Models_Detail_and_Ver_Listing.php?model=".$model_for_detail;
				echo "<a href=\"".$url."\">Cancel</a>";
		?>
	</div>
</div>

<div class="row" id="varCompare">
	<div class="large-12 columns">
		
		<table>
			<tr>
				<td></td>
				<td>photo 1</td>
				<td>photo 2</td>
			</tr>
			<tr>
				<td>Variation ID</td>
				<td>a</td>
				<td>b</td>
			</tr>
			<tr>
				<td>Mack ID #</td>
				<td>1</td>
				<td>2</td>
			</tr>
		
		</table>
	
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