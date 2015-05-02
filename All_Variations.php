<?php
// we must never forget to start the session
session_start();
$Sec_Lvl=$_SESSION['Sec_Lvl'];
$Code2_Pref=$_SESSION['Code2_Pref'];
$Username=$_SESSION['Username'];
?>

<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>

<div class="row">
	<div class="large-12 columns">
		<?php
			$model_for_detail=$_GET["model"];
			echo "<h3>All Variations of ".$model_for_detail."</h3>";
			echo "<p>If you have a collection, the colored bar under photo indicates whether that variation is in your collection. If the bar is yellow, then you have the variation, but it's condition is either unspecified or less than Very Good or 8.0</p>";

			$query= ("SELECT * FROM Matchbox_Variations WHERE UMID LIKE '%$model_for_detail%' ORDER BY VarYear, VarID ASC");
			$result = mysql_query($query);
			if (mysql_num_rows($result)==0) {			
				echo "<h3>Error - No matching results found</h3>"; //mysql_error();
				exit;
			}
			$rows= mysql_num_rows($result);
			echo "<h3>"."CODE 1 & 2/3 Versions found: ".$rows."</h3>";
			echo "<ul class='large-block-grid-6'>";
			
			for ($i=1; $i<=$rows; $i++) {
				echo "<li class='carGrid'>";
				//make image clickable and send proper umid to variation_detail page
				$row = mysql_fetch_array($result);
				$picture = IMAGE_URL . $row["VarID"] . "_1.jpg";
				$picture_loc = IMAGE_PATH . $row["VarID"] . "_1.jpg";
				$Variation_to_detail = $row["VarID"];
				$url = "Variation_Detail.php?model=" . $Variation_to_detail;

				//determine what to show for version pics
				//check if have account
				if ($Sec_Lvl >= "2") {	
					//if have account, have collection?
					$query_coll=("SELECT * FROM Matchbox_Collection WHERE Username='$Username'");
					$result_coll = mysql_query($query_coll);
					if ($result_coll) {
						//if so check what VehCond scheme used
						$query_cond=("SELECT * FROM MBXU_User_Accounts WHERE Username='$Username'");
						$result_cond = mysql_query($query_cond);
						$row_cond=mysql_fetch_array($result_cond);
						$cond_scheme=$row_cond['Veh_Cond_Scheme'];
						//check if have in collection and its condition
						$query_own=("SELECT * FROM Matchbox_Collection WHERE Username='$Username' AND VarID='$Variation_to_detail'");
						$result_own = mysql_query($query_own);
						$rows_own= mysql_num_rows($result_own);
						$row_own=mysql_fetch_array($result_own);
						$row_own_cond=$row_own['VehCond'];
						

						//check if pic exists and apply colors
						if (file_exists($picture_loc)) {									
							if ($rows_own !="0") {
								if ($cond_scheme=="0") {
									if ($row_own_cond=="MIB" or $row_own_cond=="Mint" or $row_own_cond=="NM" or $row_own_cond=="Excellent" or $row_own_cond=="Very Good") {
										echo "<a href=\"".$url."\">"."<img class='own' src=".$picture." /></a>";
									} else {
										echo "<a href=\"".$url."\">"."<img class='own-poor' src=".$picture." /></a>";
									}
								} else {
									if ($row_own_cond=="10" or $row_own_cond=="9.5" or $row_own_cond=="9.0" or $row_own_cond=="8.5" or $row_own_cond=="8.0") {
										echo "<a href=\"".$url."\">"."<img class='own' src=".$picture." /></a>";
									} else {
										echo "<a href=\"".$url."\">"."<img class='own-poor' src=".$picture." /></a>";
									}
								}
							} else {
								echo "<a href=\"".$url."\">"."<img class='own-not' src=".$picture." /></a>";
							}	
						} else {
							if ($rows_own !="0") {
								if ($cond_scheme=="0") {
									if ($row_own_cond=="MIB" or $row_own_cond=="Mint" or $row_own_cond=="NM" or $row_own_cond=="Excellent" or $row_own_cond=="Very Good")	
									{
										echo "<a href=\"".$url."\">"."<img class='own' src=".DEFAULT_IMAGE." /></a>";
									} else {
										echo "<a href=\"".$url."\">"."<img class='own-poor' src=".DEFAULT_IMAGE." /></a>";
									}
								} else {
									if ($row_own_cond=="10" or $row_own_cond=="9.5" or $row_own_cond=="9.0" or $row_own_cond=="8.5" or $row_own_cond=="8.0") {
										echo "<a href=\"".$url."\">"."<img class='own' src=".DEFAULT_IMAGE." /></a>";
									} else {
										echo "<a href=\"".$url."\">"."<img class='own-poor' src=".DEFAULT_IMAGE." /></a>";
									}
								}
								echo "<a href=\"".$url."\">"."<img class='own' src=".DEFAULT_IMAGE." /></a>";
							} else {
								echo "<a href=\"".$url."\">"."<img class='own-not' src=".DEFAULT_IMAGE." /></a>";
							}
						}	
					} else {
						if (file_exists($picture_loc)) {									
							echo "<a href=\"".$url."\">"."<img src=".$picture." /></a>";			
						} else {
							echo "<a href=\"".$url."\">"."<img src=".DEFAULT_IMAGE." /></a>";
						}	
					}	
				} else {
					if (file_exists($picture_loc)) {									
						echo "<a href=\"".$url."\">"."<img src=".$picture." /></a>";
					} else {
						echo "<a href=\"".$url."\">"."<img src=".DEFAULT_IMAGE." /></a>";
					}
				}			
				
				$PhotoRefCd= $row["VerPhoto1Ref"];
				if ($PhotoRefCd) {
					$query2= ("SELECT * FROM Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd%'");
					$result2= mysql_query($query2);
					$row2 =mysql_fetch_array($result2);
					echo "<p class=\"photoref\">Photo by: ". $row2["RefName"]."</p>";
				} else {
					echo "<p class=\"photoref\">Photo by: no reference listed"."</p>";
				}
				echo "<p><strong>Variation Year:</strong> " . $row["VarYear"] . "</p>";
				echo "<p><strong>Var ID:</strong> " . $row["VarID"] . "</p>";
				echo "<p><strong>Mack #:</strong> " . $row["Mack_No"] . "</p>";
				
				echo "</li>";
			}	
			echo "</ul>";	
		?>
        </div>
</div>

<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="Search_Models_Menu.php">Search Models</a>
		<a href="Search_Releases_Menu.php">Search Releases</a>
		<a href="index.php">Main Page</a>
	</div>
</div>


<?php include("includes/footer.php"); ?>