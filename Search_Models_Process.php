<?php ob_start(); ?>
<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>

<div class="row">
	<div class="large-12 column">
		<h2>Matching Models</h2>
	 
		<?php
			$VehicleType=$_POST['TypeofVehicle'];
			$VehicleMake=$_POST['VehicleMake'];
			$MakeCountry=$_POST['MakeCountry'];
			$TempaText=$_POST['TempaText'];

			if ((!$_POST['VehicleType_Check']) AND (!$_POST['VehicleMake_Check']) AND (!$_POST['MakeCountry_Check']) AND (!$_POST['TempaText'])) {	
			
				if ($_POST[MAN_No_1]) {
					$ID_Value1=$_POST[MAN_No_1];
					if (!$_POST[MAN_No_2]) {
						echo "Searching for MAN#: ". $ID_Value1 ."<br />";
						//SELECT *
						//FROM categories
						//LEFT JOIN user_category_subscriptions ON 
						//user_category_subscriptions.category_id = categories.category_id
						//and user_category_subscriptions.user_id =1
						//$query= ("SELECT * FROM Matchbox_Models WHERE `UMID` IN (SELECT `UMID` FROM Matchbox_Versions WHERE `FAB_No`='$ID_Value1')");
						$query= ("SELECT DISTINCT Matchbox_Models.UMID, Matchbox_Models.MasterModelName, Matchbox_Models.YrFirstProduced, Matchbox_Versions.FAB_No, Matchbox_Models.ModelPhotoRef, Matchbox_Versions.Master_Mack_No
							 FROM Matchbox_Models
							 INNER JOIN Matchbox_Versions ON Matchbox_Models.UMID=Matchbox_Versions.UMID
							 WHERE Matchbox_Versions.FAB_No='$ID_Value1'");
						} else {
						$ID_Value2=$_POST[MAN_No_2];
						echo "Searching for MAN#s: ". $ID_Value1 ." to ".$ID_Value2 . "<br />";
						//$query= ("SELECT * FROM Matchbox_Models WHERE `UMID` IN (SELECT `UMID` FROM Matchbox_Versions WHERE `FAB_No`>='$ID_Value1' AND `FAB_No`<='$ID_Value2')");
						$query= ("SELECT DISTINCT Matchbox_Models.UMID, Matchbox_Models.MasterModelName, Matchbox_Models.YrFirstProduced, Matchbox_Versions.FAB_No, Matchbox_Models.ModelPhotoRef, Matchbox_Versions.Master_Mack_No
							 FROM Matchbox_Models
							 INNER JOIN Matchbox_Versions ON Matchbox_Models.UMID=Matchbox_Versions.UMID
							 WHERE Matchbox_Versions.FAB_No>='$ID_Value1' AND Matchbox_Versions.FAB_No<='$ID_Value2'");
					}
				}
				elseif ($_POST[Mack_No]) {
					$ID_Value1=$_POST[Mack_No];
					echo "Searching for Mack #: ". $ID_Value1 ."<br />";
					//$query= ("SELECT * FROM Matchbox_Models WHERE `UMID` IN (SELECT `UMID` FROM Matchbox_Versions WHERE `Master_Mack_No`='$ID_Value1')");
					$query= ("SELECT DISTINCT Matchbox_Models.UMID, Matchbox_Models.MasterModelName, Matchbox_Models.YrFirstProduced, Matchbox_Versions.FAB_No, Matchbox_Models.ModelPhotoRef, Matchbox_Versions.Master_Mack_No
							 FROM Matchbox_Models
							 INNER JOIN Matchbox_Versions ON Matchbox_Models.UMID=Matchbox_Versions.UMID
							 WHERE Matchbox_Versions.Master_Mack_No='$ID_Value1'");
				}
				elseif ($_POST[QuickName]) {
					$ID_Value1=$_POST[QuickName];
					echo "Searching for Version Name: ".$ID_Value1 ."<br />";
					//$query= ("SELECT * FROM Matchbox_Models WHERE `MasterModelName` LIKE '%$ID_Value1%' OR `UMID` IN (SELECT `UMID` FROM `TMatchbox_Versions` WHERE `VerName` LIKE '%$ID_Value1%' OR `VERID` IN (SELECT `VERID` FROM `Matchbox_Variations` WHERE `BaseName` LIKE '%$ID_Value1%'))");		
					$query= ("SELECT DISTINCT Matchbox_Models.UMID, Matchbox_Models.MasterModelName, Matchbox_Models.YrFirstProduced, Matchbox_Versions.FAB_No, Matchbox_Models.ModelPhotoRef, Matchbox_Versions.Master_Mack_No
							 FROM Matchbox_Models
							 LEFT JOIN Matchbox_Versions ON Matchbox_Models.UMID=Matchbox_Versions.UMID
							 WHERE Matchbox_Versions.VerName LIKE '%$ID_Value1%'");	
				}
				elseif ($_POST[Name]) {
					$ID_Value1=$_POST[Name];
					echo "Searching for Any Name: ".$ID_Value1 ."<br />";
					//$query= ("SELECT * FROM Matchbox_Models WHERE `MasterModelName` LIKE '%$ID_Value1%' OR `UMID` IN (SELECT `UMID` FROM `Matchbox_Versions` WHERE `VerName` LIKE '%$ID_Value1%' OR `VERID` IN (SELECT `VERID` FROM `Matchbox_Variations` WHERE `BaseName` LIKE '%$ID_Value1%'))");		
					$query= ("SELECT DISTINCT Matchbox_Models.UMID, Matchbox_Models.MasterModelName, Matchbox_Models.YrFirstProduced, Matchbox_Versions.FAB_No, Matchbox_Models.ModelPhotoRef, Matchbox_Versions.Master_Mack_No
							 FROM Matchbox_Models
							 LEFT JOIN Matchbox_Versions ON Matchbox_Models.UMID=Matchbox_Versions.UMID
							 LEFT JOIN Matchbox_Variations ON Matchbox_Models.UMID=Matchbox_Variations.UMID
							 WHERE Matchbox_Models.MasterModelName LIKE '%$ID_Value1%' OR Matchbox_Versions.VerName LIKE '%$ID_Value1%' OR Matchbox_Variations.BaseName LIKE '%$ID_Value1%'");	
				}
				elseif ($_POST[UMID_1]) {
					$ID_String1= strval($_POST[UMID_1]);
					$ID_Len=strlen($ID_String1);
					//check if LR number
					if (substr($ID_String1,0,2)=="LR") {
						//make sure no other letters
						if (!is_numeric(substr($ID_String1,2))) {
							echo "<h3>Invalid UMID, please re-enter</h3>"; //mysql_error();
							exit;
						//	$ID_String1="Invalid UMID, please retry";
						//make sure not too long
						} ELSEIF (strlen(substr($ID_String1,2))>3) {
							echo "<h3>Invalid UMID, please re-enter</h3>"; //mysql_error();
							exit;
						//pad if too short						
						} ELSEIF ($ID_Len<5) {
							$ID_String_LRno= substr($ID_String1,2);
							$ID_String_LRno=str_pad($ID_String_LRno, 3, "0", STR_PAD_LEFT);
							$ID_String1=str_pad($ID_String_LRno, 5, "LR", STR_PAD_LEFT);
						}
						//otherwise just right
					//if SF
					} ELSEIF (substr($ID_String1,0,2)=="SF") {
						//make sure no other letters
						if (!is_numeric(substr($ID_String1,2))) {
							echo "<h3>Invalid UMID, please re-enter</h3>"; //mysql_error();
							exit;
						//make sure not too long
						} ELSEIF (strlen(substr($ID_String1,2))>4) {
							echo "<h3>Invalid UMID, please re-enter</h3>"; //mysql_error();
							exit;;
						//pad if too short otherwise good						
						} ELSEIF ($ID_Len<6) {						
							$ID_String_SFno= substr($ID_String1,2);
							$ID_String1=str_pad($ID_String_SFno, 4, "0", STR_PAD_LEFT);
							$ID_String1=str_pad($ID_String1, 6,"SF", STR_PAD_LEFT);	
						}
					//should be just up to 4 numbers
					} else {
						//make sure no other letters
						if (!is_numeric($ID_String1)) {
							echo "<h3>Invalid UMID, please re-enter</h3>"; //mysql_error();
							exit;
						//make sure not too long
						} ELSEIF ($ID_Len>4) {
							echo "<h3>Invalid UMID, please re-enter</h3>"; //mysql_error();
							exit;
						//pad if too short otherwise jsut right						
						} else {						
							$ID_String1=str_pad($ID_String1, 4, "0", STR_PAD_LEFT);
							$ID_String1=str_pad($ID_String1, 6,"SF", STR_PAD_LEFT);
						}
					}	
					if (!$_POST[UMID_2]) {
						//if searching by 1 umid, skip the search results and go right to model detail page
						$string_to_redirect="Models_Detail_and_Ver_Listing.php?model=".$ID_String1;	
						redirect_to($string_to_redirect);
					} else {	
						$ID_String2= strval($_POST[UMID_2]);
						$ID_Len=strlen($ID_String2);

						if (substr($ID_String2,0,2)=="LR") {
							//make sure no other letters
							if (!is_numeric(substr($ID_String2,2))) {
								echo "<h3>Invalid UMID, please re-enter</h3>"; //mysql_error();
								exit;
							//make sure not too long
							} ELSEIF (strlen(substr($ID_String2,2))>3) {
								echo "<h3>Invalid UMID, please re-enter</h3>"; //mysql_error();
								exit;
							//pad if too short						
							} ELSEIF ($ID_Len<5) {
								$ID_String_LRno= substr($ID_String2,2);
								$ID_String_LRno=str_pad($ID_String_LRno, 3, "0", STR_PAD_LEFT);
								$ID_String2=str_pad($ID_String_LRno, 5, "LR", STR_PAD_LEFT);
							}
							//otherwise just right
						//if SF
						} ELSEIF (substr($ID_String2,0,2)=="SF") {
							//make sure no other letters
							if (!is_numeric(substr($ID_String2,2))) {
								echo "<h3>Invalid UMID, please re-enter</h3>"; //mysql_error();
								exit;
							//make sure not too long
							} ELSEIF (strlen(substr($ID_String2,2))>4) {
								echo "<h3>Invalid UMID, please re-enter</h3>"; //mysql_error();
								exit;
							//pad if too short otherwise good						
							} ELSEIF ($ID_Len<6) {						
								$ID_String_SFno= substr($ID_String2,2);
								$ID_String2=str_pad($ID_String_SFno, 4, "0", STR_PAD_LEFT);
								$ID_String2=str_pad($ID_String2, 6,"SF", STR_PAD_LEFT);	
							}
						//should be just up to 4 numbers
						} else {
							//make sure no other letters
							if (!is_numeric($ID_String2)) {
								echo "<h3>Invalid UMID, please re-enter</h3>"; //mysql_error();
								exit;
							//make sure not too long
							} ELSEIF ($ID_Len>4) {
								echo "<h3>Invalid UMID, please re-enter</h3>"; //mysql_error();
								exit;
							//pad if too short otherwise jsut right						
							} else {						
								$ID_String2=str_pad($ID_String2, 4, "0", STR_PAD_LEFT);
								$ID_String2=str_pad($ID_String2, 6,"SF", STR_PAD_LEFT);
							}
						}	
					
						echo "Searching for UMIDs: ". $ID_String1 ." to ".$ID_String2 . "<br />";
						//$query= ("SELECT * FROM Matchbox_Models WHERE UMID >='$ID_String1' AND UMID <='$ID_String2' ORDER BY UMID ASC");
						$query= ("SELECT DISTINCT Matchbox_Models.UMID, Matchbox_Models.MasterModelName, Matchbox_Models.YrFirstProduced, Matchbox_Versions.FAB_No, Matchbox_Models.ModelPhotoRef, Matchbox_Versions.Master_Mack_No
							 FROM Matchbox_Models
							 LEFT JOIN Matchbox_Versions ON Matchbox_Models.UMID=Matchbox_Versions.UMID
							 WHERE Matchbox_Models.UMID>='$ID_String1' AND Matchbox_Models.UMID<='$ID_String2'");
					}
				} else {
					echo "ERROR no type selected";
					exit;
				}
			} ELSEIF (!$_POST['TempaText']) {
				

				 //if model criteria checked
				//echo "Made it to model info";
				$PrevModelCriteria="";
				if ($_POST['VehicleType_Check']) {
					echo "Searching for:<br></>";
					echo "Vehicle Type= ".$VehicleType."<br />";
					$VehicleType=$_POST['TypeofVehicle'];
					$PrevModelCriteria="1";
					//$query= "SELECT * FROM Matchbox_Models WHERE `VehicleType` LIKE '%$VehicleType%'  OR `VehicleType2` LIKE '%$VehicleType%'";
					$query= "SELECT DISTINCT Matchbox_Models.UMID, Matchbox_Models.MasterModelName, Matchbox_Models.YrFirstProduced, Matchbox_Versions.FAB_No, Matchbox_Models.ModelPhotoRef, Matchbox_Versions.Master_Mack_No
							 FROM Matchbox_Models
							 LEFT JOIN Matchbox_Versions ON Matchbox_Models.UMID=Matchbox_Versions.UMID
							 WHERE (Matchbox_Models.VehicleType LIKE '%$VehicleType%' OR Matchbox_Models.VehicleType2 LIKE '%$VehicleType%')";
				
				}
				if ($_POST['VehicleMake_Check']) {
					
					echo "  Make= ".$VehicleMake."<br></>";
					$VehicleMake=$_POST['VehicleMake'];
					if ($PrevModelCriteria != "1") {
					    //echo "only vehicle make";
					    $PrevModelCriteria="1";
					    //$query= "SELECT * FROM Matchbox_Models WHERE `MakeofModel` LIKE '%$VehicleMake%'";
					    $query= "SELECT DISTINCT Matchbox_Models.UMID, Matchbox_Models.MasterModelName, Matchbox_Models.YrFirstProduced, Matchbox_Versions.FAB_No, Matchbox_Models.ModelPhotoRef, Matchbox_Versions.Master_Mack_No
							 FROM Matchbox_Models
							 INNER JOIN Matchbox_Versions ON Matchbox_Models.UMID=Matchbox_Versions.UMID
							 WHERE Matchbox_Models.MakeofModel LIKE '%$VehicleMake%'";
					} else {
					    //echo "type and make";
					    $PrevModelCriteria="1";
					    $query .= " AND Matchbox_Models.MakeofModel LIKE '%$VehicleMake%'";
					    //echo $query;
					    //exit;
					}
				}
				if ($_POST['MakeCountry_Check']) {
					
					echo "  Country of Make= ".$$MakeCountry."<br></>";
					$MakeCountry=$_POST['MakeCountry'];
					if (!$PrevModelCriteria) {
						$PrevModelCriteria="1";
						//$query= "SELECT * FROM Matchbox_Models WHERE `CountryofMake` LIKE '%$MakeCountry%'";
						$query= "SELECT DISTINCT Matchbox_Models.UMID, Matchbox_Models.MasterModelName, Matchbox_Models.YrFirstProduced, Matchbox_Versions.FAB_No, Matchbox_Models.ModelPhotoRef, Matchbox_Versions.Master_Mack_No
							 FROM Matchbox_Models
							 INNER JOIN Matchbox_Versions ON Matchbox_Models.UMID=Matchbox_Versions.UMID
							 WHERE Matchbox_Models.CountryofMake LIKE '%$MakeCountry%'";
				       } else {
					   $PrevModelCriteria="1";
					   $query=$query . " AND Matchbox_Models.CountryofMake LIKE '%$MakeCountry%'";
				       }                   
				}
				$query = "(".$query.")";
				
			} else {
				//go to separate page to search and display model details of multiple umids at ver level
				$TempaText=$_POST['TempaText'];
				$string_to_redirect="Models_Found_List.php?tempatext=".$TempaText;
				redirect_to($string_to_redirect);
			}                   

			//echo $query."<br />";
			$result=0;
			$rows=0;
			// echo $result;
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			//print_r($result);
			//exit;
			echo "No. Found: ".$rows."<br /><br />";
			if(!$result) {
				echo "No matching results found"; //mysql_error();
				exit;
			} ?>
			
	</div>
</div>

<div class="row">
	<div class="large-12 columns">
			<?php
			for ($i=1; $i<=$rows; $i++) {
			
				echo "<div class=\"car-block\">";
				
				$row = mysql_fetch_array($result);
				//$picture= IMAGE_PATH . $row["UMID"].".jpg";
				//make image clickable and send proper umid to model_detail page
				$Model_to_detail=$row["UMID"];
				$url= "Models_Detail_and_Ver_Listing.php?model=".$Model_to_detail;
				$picture= IMAGE_URL . $row["UMID"].".jpg";
				
				$picture_loc= IMAGE_PATH . $row["UMID"].".jpg";
				
				if ( file_exists($picture_loc) ) {
						//echo "picture exists";
						echo "<a href=\"" . $url . "\">"."<img src=" . $picture . " width=\"240\"></a>";
					} else {
						//echo "cant find picture";
						//echo DEFAULT_IMAGE;
						echo "<a href=\"" . $url . "\">"."<img src=" . DEFAULT_IMAGE . " width=\"240\"></a>";
					}	

				echo "<br />";
				//echo $picture."<br />";
				$PhotoRefCd= $row["ModelPhotoRef"];
				if ($PhotoRefCd) {
					$query2= ("SELECT * FROM Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd%'");
					$result2= mysql_query($query2);
					$row2 =mysql_fetch_array($result2);
					echo "<p>Photo by: ". $row2["RefName"]."</p>";
				} else {
					echo "<p>Photo by: no reference listed"."</p>";
				}
	
				echo "<p>Model UMID: ". $row["UMID"]."</p>";
				echo "<p>MAN#: ".$row["FAB_No"]. "  Mack No.: ".$row["Master_Mack_No"]."</p>";
				echo "<p>Master Name: ".$row["MasterModelName"]."</p>";
				echo "<p>First Rel Dt: ".$row["YrFirstProduced"]."</p>";
			echo "</div>";
			} ?>
	</div>
</div>

<div class="row">
	<div class="large-12 columns">

		<?php 
			echo "<br /> Query Completed </br /><br />";
			//echo "* see 'References' page for full source info"."<br /><br />";
			mysql_free_result($result);
			// echo $result;
			
			?>
			<a href="Search_Models_Menu.php">Cancel</a>
	</div>
</div>	

<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="Search_Models_Menu.php">Search Models</a>
		<a href="similar_models_compare.php">Differences Among Similar Models</a>
		<a href="model_search_help.php">Tips on Searching for Models</a>
	</div>
</div>

<?php include("includes/footer.php"); ?>