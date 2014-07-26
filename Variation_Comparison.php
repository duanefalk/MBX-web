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
			$query2= ("SELECT * FROM Matchbox_Variations WHERE VerID LIKE '%$model_for_detail%'");
			$result2 = mysql_query($query2);
			$rows2= mysql_num_rows($result2);

			//echo "No. of Variations: ".$rows2."<br /><br />";
			if(!$result2) {
				echo "Database error"; //mysql_error();
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
						$query2a= ("SELECT * FROM Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd1%'");
						$result2a= mysql_query($query2a);
						$row2a =mysql_fetch_array($result2a);
						if ($PhotoRefCd2) {
							$query2b= ("SELECT * FROM Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd2%'");
							$result2b= mysql_query($query2b);
							$row2b =mysql_fetch_array($result2b);
							echo "<p id=\"photoref\">Photos by: ". $row2a["RefName"].", ".$row2b["RefName"]."</p>";
						} else {
							echo "<p id=\"photoref\">Photo by: ". $row2a["RefName"];
						}
					} else {
						echo "<p id=\"photoref\">Photo by: no reference listed";
					}
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