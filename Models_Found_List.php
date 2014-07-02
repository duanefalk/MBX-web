<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>
<table id="structure">

	<tr>
		<td id="navigation">		
			<a href="Search_Releases_Menu.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Search Releases</p></a>
			<a href="index.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Main Page</p></a>
		</td>
		<td id="page">
			<h2>Matching Models</h2>
			<br />
			<!--<a href="http://localhost/~Falk/MBX_Web_Site_Test/IMAGES/TEST.doc"><p>CLICK TO DOWNLOAD FILE</p</a><br /> -->
			<?php
			$TexttoSearch=$_GET["tempatext"];
			echo "You selected models with the text: ".$TexttoSearch."<br />";
			$query= ("SELECT DISTINCT Test_Matchbox_Versions.UMID, Test_Matchbox_Versions.VerID, Test_Matchbox_Versions.VerName, Test_Matchbox_Versions.VerYrFirstRel, Test_Matchbox_Versions.FAB_No, Test_Matchbox_Versions.VerPhoto1Ref, Test_Matchbox_Versions.Master_Mack_No
							 FROM Test_Matchbox_Versions
							 LEFT JOIN Test_Matchbox_Variations ON Test_Matchbox_Versions.VerID=Test_Matchbox_Variations.VerID
							 WHERE Test_Matchbox_Versions.TempaText LIKE '%$TexttoSearch%' OR Test_Matchbox_Variations.TempaVar LIKE '%$TexttoSearch%'
							 ORDER BY Test_Matchbox_Versions.VerID ASC");	
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
					$url= "Ver_detail_and_Var_Listing.php?model=".$Version_to_detail;
					if (file_exists($picture_loc)) {
						//echo "picture exists";
						echo "<a href=\"".$url."\">"."<img src=".$picture." width=\"240\"></a>";
					} else {
						//echo "cant find picture";
						//echo DEFAULT_IMAGE;
						echo "<a href=\"".$url."\">"."<img src=".DEFAULT_IMAGE." width=\"240\"></a>";
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
					echo "<p>Ver ID: ". $row["VerID"]."   MAN#: ". $row["FAB_No"]."</p>";
					echo "<p>Ver Name: ".$row["VerName"]."</p>";
					echo "<p>First Rel Dt: ".$row["VerYrFirstRel"]."</p>";
				echo "</div>";
				}
			?>
			
		</td>
	</tr>
</table>

<?php include("includes/footer.php"); ?>	
