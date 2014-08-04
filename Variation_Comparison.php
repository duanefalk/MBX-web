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

			//Row 1, photos
			echo "<table><tr><td></td>";			
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
					echo "<a href=\"".$url."\">"."<img src=".$picture1." width=\"180\"></a>";
				} else {
					//echo "cant find picture";
					//echo DEFAULT_IMAGE;
					echo "<a href=\"".$url."\">"."<img src=".DEFAULT_IMAGE." width=\"180\"></a>";
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
						
			//Row 2, Var ID
			echo "<tr><td>Variation ID</td>";			
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
			
				echo "<td>";
					echo $row["VarID"];
				echo "</td>";			
			} //end row 2
			
			//Row 3, Mack ID
			echo "<tr><td>Mack ID #</td>";			
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
			
				echo "<td>";
					echo $row["Mack_No"];
				echo "</td>";
			} //end row 3
					
			//Row 4, Base name
			echo "<tr><td>Base Name</td>";			
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
			
				echo "<td>";
					echo $row["BaseName"];
				echo "</td>";
			} //end row 4
						
			//Row 5, Manufactured In
			echo "<tr><td>Manu. Location</td>";			
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
			
				echo "<td>";
					echo $row["ManufLoc"];
				echo "</td>";		
			} //end row 5
					
			//Row 6, Var Year
			echo "<tr><td>Variation Year</td>";			
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
			
				echo "<td>";
					echo $row["VarYear"];
				echo "</td>";		
			} //end row 6
			
			//Row 7, Front Wheel Photo
			echo "<tr><td>Front Wheel</td>";			
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);

				$fwheel= WHEEL_URL . $row["FWhCd"].".jpg";
				//$fwheel_loc=WHEEL_PATH. $row["FWhCd"]."_1.jpg";
				//echo "<img src=".$fwheel." width=\"120\"></a>";
				echo "<td>";
					echo "<img src=".$fwheel." width=\"100\"";
				echo "</td>";		
			} //end row 7
			
			//Row 8, Front Wheel Code
			echo "<tr><td></td>";			
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
				echo "<td>";
					echo $row["FWhCd"];
				echo "</td>";		
			} //end row 8			
		
			//Row 9, Rear Wheel Photo
			echo "<tr><td>Rear Wheel</td>";			
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);

				$rwheel= WHEEL_URL . $row["RWhCd"].".jpg";
				//$fwheel_loc=WHEEL_PATH. $row["FWhCd"]."_1.jpg";
				//echo "<img src=".$fwheel." width=\"120\"></a>";
				echo "<td>";
					echo "<img src=".$rwheel." width=\"100\"";
				echo "</td>";			
			} //end row 9
	
			//Row 10, Rear Wheel Code
			echo "<tr><td></td>";			
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
				echo "<td>";
					echo $row["RWhCd"];
				echo "</td>";		
			} //end row 10		

			//Row 11, Window Color
			echo "<tr><td>Window Color</td>";			
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
			
				echo "<td>";
					echo $row["WindowColor"];
				echo "</td>";			
			} //end row 11
			
			//Row 12, Interior Color
			echo "<tr><td>Interior Color</td>";
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
			
				echo "<td>";
					echo $row["InteriorColor"];
				echo "</td>";		
			} //end row 12
					
			//Row 13, Base Material
			echo "<tr><td>Base Material</td>";
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
			
				echo "<td>";
					echo $row["Base1Material"];
				echo "</td>";		
			} //end row 13
					
			//Row 14, Base Color
			echo "<tr><td>Base Color</td>";
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
			
				echo "<td>";
					echo $row["Base1Color"];
				echo "</td>";		
			} //end row 14		
					
			//Row 15, Finish
			echo "<tr><td>Finish</td>";
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
			
				echo "<td>";
					echo $row["Finish"];
				echo "</td>";
			} //end row 15
		
			//Row 16, Color Var
			$IsColorVar="0";
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
				if ($row["ColorVar"]) {
					$IsColorVar="1";
				}
			}
			if ($IsColorVar=="1") {
				echo "<tr><td>Color Var</td>";
				$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
				$result = mysql_query($query);
				$rows= mysql_num_rows($result);
				for ($i=1; $i<=$rows; $i++) {
					$row = mysql_fetch_array($result);
					echo "<td>";
						echo $row["ColorVar"];
					echo "</td>";
				} 
			}
			//end row 16
			
			//Row 17, Tampo Var	
			$IsTampoVar="0";
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
				if ($row["TempaVar"]) {
					$IsTampoVar="1";
				}
			}
			if ($IsTampoVar=="1") {
				echo "<tr><td>Tampo Var</td>";
				$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
				$result = mysql_query($query);
				$rows= mysql_num_rows($result);
				for ($i=1; $i<=$rows; $i++) {
					$row = mysql_fetch_array($result);
					echo "<td>";
						echo $row["TempaVar"];
					echo "</td>";
				} 
			}
			//end row 17	

			//Row 18, Det1	
			$IsDet1="0";
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
				if ($row["Det1Typ"]) {
					$IsDet1="1";
					$Det1Type=$row["Det1Typ"];
				}
			}
			if ($IsDet1=="1") {
				echo "<tr><td>$Det1Type</td>";
				$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
				$result = mysql_query($query);
				$rows= mysql_num_rows($result);
				for ($i=1; $i<=$rows; $i++) {
					$row = mysql_fetch_array($result);
					echo "<td>";
						echo $row["Det1Var"];
					echo "</td>";
				} 
			}
			//end row 18	

			//Row 19, Det2	
			$IsDet2="0";
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
				if ($row["Det2Typ"]) {
					$IsDet2="1";
					$Det2Type=$row["Det2Typ"];
				}
			}
			if ($IsDet2=="1") {
				echo "<tr><td>$Det2Type</td>";
				$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
				$result = mysql_query($query);
				$rows= mysql_num_rows($result);
				for ($i=1; $i<=$rows; $i++) {
					$row = mysql_fetch_array($result);
					echo "<td>";
						echo $row["Det2Var"];
					echo "</td>";
				} 
			}
			//end row 19	
	
			//Row 20, Det3	
			$IsDet3="0";
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
				if ($row["Det3Typ"]) {
					$IsDet3="1";
					$Det3Type=$row["Det3Typ"];
				}
			}
			if ($IsDet3=="1") {
				echo "<tr><td>$Det3Type</td>";
				$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
				$result = mysql_query($query);
				$rows= mysql_num_rows($result);
				for ($i=1; $i<=$rows; $i++) {
					$row = mysql_fetch_array($result);
					echo "<td>";
						echo $row["Det3Var"];
					echo "</td>";
				} 
			}
			//end row 20
			
			//Row 21, Det4	
			$IsDet4="0";
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
				if ($row["Det4Typ"]) {
					$IsDet4="1";
					$Det4Type=$row["Det4Typ"];
				}
			}
			if ($IsDet4=="1") {
				echo "<tr><td>$Det4Type</td>";
				$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
				$result = mysql_query($query);
				$rows= mysql_num_rows($result);
				for ($i=1; $i<=$rows; $i++) {
					$row = mysql_fetch_array($result);
					echo "<td>";
						echo $row["Det4Var"];
					echo "</td>";
				} 
			}
			//end row 21
			
			//Row 22, Det5	
			$IsDet5="0";
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
				if ($row["Det5Typ"]) {
					$IsDet5="1";
					$Det2Type=$row["Det5Typ"];
				}
			}
			if ($IsDet5=="1") {
				echo "<tr><td>$Det5Type</td>";
				$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
				$result = mysql_query($query);
				$rows= mysql_num_rows($result);
				for ($i=1; $i<=$rows; $i++) {
					$row = mysql_fetch_array($result);
					echo "<td>";
						echo $row["Det5Var"];
					echo "</td>";
				} 
			}
			//end row 22
			
			//Row 23, Var Comm	
			$IsComm="0";
			$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
				if ($row["VarComment"]) {
					$IsComm="1";
				}
			}
			if ($IsComm=="1") {
				echo "<tr><td>Comment</td>";
				$query= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
				$result = mysql_query($query);
				$rows= mysql_num_rows($result);
				for ($i=1; $i<=$rows; $i++) {
					$row = mysql_fetch_array($result);
					echo "<td>";
						echo $row["VarComment"];
					echo "</td>";
				} 
			}
			//end row 23	
			
			
			
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