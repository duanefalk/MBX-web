<?php 
	$pageTitle = "Matching Models";
	$pageDescription = "Matchbox cars matching your search query.";
	require_once("includes/db_connection.php");
	include("includes/header.php");
	include("includes/functions.php");
?>

<div class="row">
	<div class="large-12 columns">

		<h2>Matching Models</h2>
		
		<?php
			
			$OrigText=$_GET["tempatext"];
			$TexttoSearch = mysql_real_escape_string($_GET["tempatext"]);
			echo "<p>You searched models with the text: <strong>" . $OrigText . "</strong></p>";
			
			$query= ("SELECT DISTINCT Matchbox_Versions.UMID, Matchbox_Versions.VerID, Matchbox_Versions.VerName, Matchbox_Versions.VerYrFirstRel, Matchbox_Versions.FAB_No, Matchbox_Versions.VerPhoto1Ref, Matchbox_Versions.Master_Mack_No
						 FROM Matchbox_Versions
						 LEFT JOIN Matchbox_Variations ON Matchbox_Versions.VerID=Matchbox_Variations.VerID
						 WHERE Matchbox_Versions.TempaText LIKE '%$TexttoSearch%' OR Matchbox_Variations.TempaVar LIKE '%$TexttoSearch%'
						 ORDER BY Matchbox_Versions.VerID ASC");	
			$result=0;
			$rows=0;
			
			$result = mysql_query($query);
			$rows= mysql_num_rows($result); //print_r($result);
			
			echo "<p>Versions found: <strong>" . $rows . "</strong></p>";
			
			if (!$result) {
				echo "No matching results found"; //mysql_error();
				exit;
			}					
			?>
			
			<ul class="large-block-grid-3">
			
			<?php
			
			for ($i=1; $i<=$rows; $i++) {
				echo "<li class=\"carGrid\">";
					$row=mysql_fetch_array($result);
					$picture= IMAGE_URL . $row["VerID"]."_1.jpg";
					$picture_loc=IMAGE_PATH. $row["VerID"]."_1.jpg";
					
					
					//make image clickable and send proper umid to model_detail page
					$Version_to_detail=$row["VerID"];
					$url= "ver-detail-var-listing.php?model=".$Version_to_detail;
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
						$query2= ("SELECT * FROM Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd%'");
						$result2= mysql_query($query2);
						$row2 =mysql_fetch_array($result2);
						echo "<p id=\"photoref\">Photo by: ". $row2["RefName"]."</p>";
					} else {
						echo "<p id=\"photoref\">Photo by: no reference listed"."</p>";
					}
					echo "<p>Ver ID: ". $row["VerID"]."   MAN#: ". $row["FAB_No"]."</p>";
					echo "<p>Ver Name: ".$row["VerName"]."</p>";
					echo "<p>First Rel Dt: ".$row["VerYrFirstRel"]."</p>";
				echo "</li>";
				}
			?>
			
			</ul>

	</div>
</div>


<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="Search_Models_Menu.php">Search Models</a>
		<a href="Search_Releases_Menu.php">Search Releases</a>
	</div>
</div>	

<?php include("includes/footer.php"); ?>	
