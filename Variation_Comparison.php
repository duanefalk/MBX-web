<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>

<div class="row" id="varCompare">
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
			
			
			//BEGIN NEW COMPARISON CHART
			echo "<table><tr><td></td>";
			
			
			
			//Row 1, photos
			
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
			
				echo "<td>";
				
				$picture1= IMAGE_URL . $row["VarID"]."_1.jpg";
				$picture1_loc=IMAGE_PATH. $row["VarID"]."_1.jpg";
				
				$picture2= IMAGE_URL . $row["VarID"]."_2.jpg";
				$picture2_loc=IMAGE_PATH. $row["VarID"]."_2.jpg";
				
				//show photos
				$Variation_to_detail= $row["VarID"];
				$url= "Variation_Detail.php?model=".$Variation_to_detail;				
				
				if (file_exists($picture1_loc)) {
					//echo "picture exists";
					echo "<a href=\"".$url."\">"."<img src=".$picture1." width=\"120\"></a>";
				} else {
					//echo "cant find picture";
					//echo DEFAULT_IMAGE;
					echo "<a href=\"".$url."\">"."<img src=".DEFAULT_IMAGE." width=\"120\"></a>";
				}

				//show photo refs								
				$PhotoRefCd1= $row["VarPhoto1Ref"];
				
				if ($PhotoRefCd1) {
					$query2a= ("SELECT * FROM Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd1%'");
					$result2a= mysql_query($query2a);
					$row2a = mysql_fetch_array($result2a);
					
					echo "<p id=\"photoref\">Photo by: ". $row2a["RefName"] . "</p>";
				} else {
					echo "<p id=\"photoref\">Photo by: no reference listed" . "</p>";
				}
			
				echo "</td>";
			} // end row 1
			
			
			echo "<tr><td>Variation ID</td>";
			
			
			//Row 2, Var ID
			
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
			
				echo "<td>";
					echo $row["VarID"];
				echo "</td>";
			
			} //end row 2
			
			
			echo "<tr><td>Mack ID #</td>";
			
			
			//Row 3, Mack ID
			
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
			
				echo "<td>";
					echo $row["Mack_No"];
				echo "</td>";
			
			} //end row 3
			
			
			echo "<tr><td>Base Name</td>";
			
			
			//Row 4, Mack ID
			
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
			
				echo "<td>";
					echo $row["BaseName"];
				echo "</td>";
			
			} //end row 4
			
			
			
			echo "<tr><td>Manu. Location</td>";
			
			
			//Row 5, Manufactured In
			
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
			
				echo "<td>";
					echo $row["ManufLoc"];
				echo "</td>";
			
			} //end row 5
			
			
			echo "<tr><td>Variation Year</td>";
			
			
			//Row 6, Var Year
			
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
			
				echo "<td>";
					echo $row["VarYear"];
				echo "</td>";
			
			} //end row 6
			
			
			
			echo "<tr><td>Front Wheel Code</td>";
			
			
			//Row 7, Front Wheel Code
			
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
			
				echo "<td>";
					echo $row["FWhCd"];
				echo "</td>";
			
			} //end row 7
			
			
			echo "<tr><td>Rear Wheel Code</td>";
			
			
			//Row 8, Rear Wheel Code
			
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
			
				echo "<td>";
					echo $row["RWhCd"];
				echo "</td>";
			
			} //end row 8
			
			
			
			echo "<tr><td>Window Color</td>";
			
			
			//Row 9, Window Color
			
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
			
				echo "<td>";
					echo $row["WindowColor"];
				echo "</td>";
			
			} //end row 9
			
			
			echo "<tr><td>Interior Color</td>";
			
			
			//Row 10, Interior Color
			
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
			
				echo "<td>";
					echo $row["InteriorColor"];
				echo "</td>";
			
			} //end row 10
			
			
			
			echo "<tr><td>Base Material</td>";
			
			
			//Row 11, Base Material
			
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
			
				echo "<td>";
					echo $row["Base1Material"];
				echo "</td>";
			
			} //end row 11
			
			
			echo "<tr><td>Base Color</td>";
			
			
			//Row 12, Base Color
			
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
			
				echo "<td>";
					echo $row["Base1Color"];
				echo "</td>";
			
			} //end row 12
			
			
			echo "<tr><td>Finish</td>";
			
			
			//Row 13, Finish
			
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
			
				echo "<td>";
					echo $row["Finish"];
				echo "</td>";
			
			} //end row 13
			
			
			echo "<tr><td>Color Var</td>";
			
			
			//Row 14, Color Var
			
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
			
				echo "<td>";
					echo $row["ColorVar"];
				echo "</td>";
			
			} //end row 14
			
			
			echo "<tr><td>Tampo Var</td>";
			
			
			//Row 15, Tampo Var
			
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
			
				echo "<td>";
					echo $row["TempaVar"];
				echo "</td>";
			
			} //end row 15
			
			
			echo "</tr></table>";
			
			//END NEW COMPARISON CHART
			
		
			//Cancel button			
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