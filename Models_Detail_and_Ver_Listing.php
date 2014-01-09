<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>
<table id="structure">

	<tr>
		<td id="navigation">
			<a href="Search_Models_Menu.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Search Models</p></a>
			<a href="Search_Releases_Menu.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Search Releases</p></a>
			<a href="index.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Main Page</p></a>
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
			if(!$result2) {
				echo "Error in database- No matching results found"; //mysql_error();
				exit;
			}
			$row2=mysql_fetch_array($result2);
			echo "<h3>".$model_for_detail."  ".$row2['MasterModelName']."</h3>";
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
				
			//get version data to display
			$query= ("SELECT * FROM Test_Matchbox_Versions WHERE UMID LIKE '%$model_for_detail%'");
			$result=0;
			$rows=0;
			// echo $result;
			$result = mysql_query($query);
			$rows= mysql_num_rows($result); //print_r($result);
			echo "Versions found: ".$rows."<br /><br />";
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
					if (file_exists($picture_loc)) {
						//echo "picture exists";
						echo "<a href=\"".$url."\">"."<img class='own' src=".$picture." width=\"240\"></a>";
					} else {
						//echo "cant find picture";
						//echo DEFAULT_IMAGE;
						echo "<a href=\"".$url."\">"."<img class='own-poor' src=".DEFAULT_IMAGE." width=\"240\"></a>";
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
			?>			
		</td>
	</tr>
</table>

<?php include("includes/footer.php"); ?>	
