<?php
// we must never forget to start the session
session_start();
$Sec_Lvl=$_SESSION['Sec_Lvl'];
$Code2_Pref=$_SESSION['Code2_Pref'];

?>

<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>
<table id="structure">

	<tr>
		<td id="navigation">
			<?php echo "<a href=\"javascript:history.go(-1)\">Return to Previous Page</a>"; ?>
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
						echo "<p>Code level: ".$row["CodeLvl"];
						if ($row["CodeLvl"]=="2") {
							echo " C2 Manuf.: ".$row["SecManuf"]."</p>";
						}
					echo "</div>";
					}	
			} else {
				//if logged in, start by showing code1
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
				//then check if to show code 2 also. if so sep srch for code 2
				if ($Code2_Pref == "1") {
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
							echo "<p>Code level: ".$row["CodeLvl"].";C2 Manuf.: ".$row["SecManuf"]."</p>";
						echo "</div>";
						}
				}		
			}
				//if chose no code2 just drop down without doing code 2 search

			?>			
		</td>
	</tr>
</table>

<?php include("includes/footer.php"); ?>	
