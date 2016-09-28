<?php 
	ob_start();
	session_start();
	require_once("includes/db_connection.php");
	
	//SEARCH LOGIC
	if ($_POST['Spec_MAN']) {
		$_SESSION['Spec_MAN']=$_POST['Spec_MAN'];
	}
	$VehicleType=$_SESSION['TypeofVehicle'];
	$VehicleMake=$_SESSION['VehicleMake'];
	$MakeCountry=$_SESSION['MakeCountry'];
	$TempaText=$_SESSION['TempaText'];
	$Search_by_MAN="0";
	
	//PAGE TITLE LOGIC
	//all of this logic was copied from below, using it here allows us to supply a UNIQUE and SPECIFIC page title (good for search engines)
	if ((!$_SESSION['VehicleType_Check']) AND (!$_SESSION['VehicleMake_Check']) AND (!$_SESSION['MakeCountry_Check']) AND (!$_SESSION['TempaText'])) {	
		if ($_SESSION['MAN_No_1']) {
			$ID_Value1 = $_SESSION['MAN_No_1'];
			if (!$_SESSION['MAN_No_2']) {
				$pageTitle = "Search for MAN# " . $ID_Value1;
			} else {
				$ID_Value2 = $_SESSION['MAN_No_2'];
				$pageTitle = "Search MAN# " . $ID_Value1 . " to " . $ID_Value2;
			}
		} elseif ($_SESSION['Spec_MAN']) {
			$ID_Value1 = $_SESSION['Spec_MAN'];
			$pageTitle = "Search for " . $ID_Value1;
		} elseif ($_SESSION['Mack_No']) {
			$ID_Value1 = mysql_real_escape_string($_SESSION['Mack_No']);
			$pageTitle = "Search for Mack # " . $ID_Value1;
		} elseif ($_SESSION['QuickName']) {
			$ID_Value1 = mysql_real_escape_string($_SESSION['QuickName']);
			$pageTitle = "Search for " . $ID_Value1;
		} elseif ($_SESSION['Name']) {
			$ID_Value1 = mysql_real_escape_string($_SESSION['Name']);
			$pageTitle = "Search for " . $ID_Value1;
		} elseif ($_SESSION['UMID_1']) {
			$ID_String1 = strval($_SESSION['UMID_1']);
			$ID_Len = strlen($ID_String1);
			if (substr($ID_String1,0,2)=="LR") {
				if (!is_numeric(substr($ID_String1,2))) {					
				} elseif (strlen(substr($ID_String1,2))>3) {					
				} elseif ($ID_Len<5) {
					$ID_String_LRno = substr($ID_String1,2);
					$ID_String_LRno =str_pad($ID_String_LRno, 3, "0", STR_PAD_LEFT);
					$ID_String1 = str_pad($ID_String_LRno, 5, "LR", STR_PAD_LEFT);
				}
			} elseif (substr($ID_String1,0,2)=="SF") {
				if (!is_numeric(substr($ID_String1,2))) {					
				} elseif (strlen(substr($ID_String1,2))>4) {									
				} elseif ($ID_Len<6) {						
					$ID_String_SFno = substr($ID_String1,2);
					$ID_String1 = str_pad($ID_String_SFno, 4, "0", STR_PAD_LEFT);
					$ID_String1 = str_pad($ID_String1, 6,"SF", STR_PAD_LEFT);	
				}
			} else {
				if (!is_numeric($ID_String1)) {					
				} elseif ($ID_Len>4) {										
				} else {						
					$ID_String1 = str_pad($ID_String1, 4, "0", STR_PAD_LEFT);
					$ID_String1 = str_pad($ID_String1, 6,"SF", STR_PAD_LEFT);
				}
			}	
			if (!$_SESSION['UMID_2']) {					
				$pageTitle = "Search for UMID # " . $ID_String1;
			} else {	
				$ID_String2 = strval($_SESSION['UMID_2']);
				$ID_Len = strlen($ID_String2);

				if (substr($ID_String2,0,2)=="LR") {					
					if (!is_numeric(substr($ID_String2,2))) {						
					} elseif (strlen(substr($ID_String2,2))>3) {							
					} elseif ($ID_Len<5) {
						$ID_String_LRno = substr($ID_String2,2);
						$ID_String_LRno = str_pad($ID_String_LRno, 3, "0", STR_PAD_LEFT);
						$ID_String2 = str_pad($ID_String_LRno, 5, "LR", STR_PAD_LEFT);
					}
				} elseif (substr($ID_String2,0,2)=="SF") {					
					if (!is_numeric(substr($ID_String2,2))) {					
					} elseif (strlen(substr($ID_String2,2))>4) {											
					} elseif ($ID_Len<6) {						
						$ID_String_SFno = substr($ID_String2,2);
						$ID_String2 = str_pad($ID_String_SFno, 4, "0", STR_PAD_LEFT);
						$ID_String2 = str_pad($ID_String2, 6,"SF", STR_PAD_LEFT);	
					}
				} else {
					if (!is_numeric($ID_String2)) {						
					} elseif ($ID_Len>4) {											
					} else {						
						$ID_String2 = str_pad($ID_String2, 4, "0", STR_PAD_LEFT);
						$ID_String2 = str_pad($ID_String2, 6,"SF", STR_PAD_LEFT);
					}
				}	
				$pageTitle = "Search UMID # " . $ID_String1 . " to " . $ID_String2;
			}
		} else {}
	} elseif (!$_SESSION['TempaText']) {
		$PrevModelCriteria="";
		if ($_SESSION['VehicleType_Check']) {
			$VehicleType = $_SESSION['TypeofVehicle'];
			$pageTitle = "Search for " . $VehicleType;
		}
		if ($_SESSION['VehicleMake_Check']) {			
			$VehicleMake = $_SESSION['VehicleMake'];
			$pageTitle = "Search for " . $VehicleMake;
		}
		if ($_SESSION['MakeCountry_Check']) {
			$MakeCountry = $_SESSION['MakeCountry'];
			$pageTitle = "Search for " . $MakeCountry;               
		}		
	} else {
		$pageTitle = "Search Models";
	}
	$pageDescription = "Search the Matchbox University database to find any matchbox car you're looking for";
	
	include("includes/header.php");	
	include("includes/functions.php");
?>
<div class="row">
	<div class="large-12 column">
		<h2>Matching Models</h2>
	 
		<?php
			if ((!$_SESSION['VehicleType_Check']) AND (!$_SESSION['VehicleMake_Check']) AND (!$_SESSION['MakeCountry_Check']) AND (!$_SESSION['TempaText'])) {	
				
				// Search by ID
				if ($_SESSION['MAN_No_1']) {
					$ID_Value1 = $_SESSION['MAN_No_1'];
					if (!$_SESSION['MAN_No_2']) {
						echo "<h4>Searching for MAN#: ". $ID_Value1 ."</h4>";
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
						$ID_Value2 = $_SESSION['MAN_No_2'];
						echo "<h4>Searching for MAN#s: ". $ID_Value1 ." to ".$ID_Value2 . "</h4>";
						//$query= ("SELECT * FROM Matchbox_Models WHERE `UMID` IN (SELECT `UMID` FROM Matchbox_Versions WHERE `FAB_No`>='$ID_Value1' AND `FAB_No`<='$ID_Value2')");
						$query= ("SELECT DISTINCT Matchbox_Models.UMID, Matchbox_Models.MasterModelName, Matchbox_Models.YrFirstProduced, Matchbox_Versions.FAB_No, Matchbox_Models.ModelPhotoRef, Matchbox_Versions.Master_Mack_No
							 FROM Matchbox_Models
							 INNER JOIN Matchbox_Versions ON Matchbox_Models.UMID=Matchbox_Versions.UMID
							 WHERE Matchbox_Versions.FAB_No>='$ID_Value1' AND Matchbox_Versions.FAB_No<='$ID_Value2'");
					}
				}
				elseif ($_SESSION['Spec_MAN']) {
					$ID_Value1=$_SESSION['Spec_MAN'];
					$Search_by_MAN="1";
					echo "<h4>Searching for specific MAN#: ". $ID_Value1 ."</h4>";
					//$query= ("SELECT * FROM Matchbox_Models WHERE `UMID` IN (SELECT `UMID` FROM Matchbox_Versions WHERE `Master_Mack_No`='$ID_Value1')");
					$query= ("SELECT DISTINCT Matchbox_Models.UMID, Matchbox_Models.MasterModelName, Matchbox_Models.YrFirstProduced, Matchbox_Versions.FAB_No, Matchbox_Models.ModelPhotoRef, Matchbox_Versions.Master_Mack_No
							 FROM Matchbox_Models
							 INNER JOIN Matchbox_Versions ON Matchbox_Models.UMID=Matchbox_Versions.UMID
							 WHERE Matchbox_Versions.FAB_No='$ID_Value1'");
				}
				elseif ($_SESSION['Mack_No']) {
					$ID_Value1=mysql_real_escape_string($_SESSION['Mack_No']);
					echo "<h4>Searching for Mack #: ". $ID_Value1 ."</h4>";
					//$query= ("SELECT * FROM Matchbox_Models WHERE `UMID` IN (SELECT `UMID` FROM Matchbox_Versions WHERE `Master_Mack_No`='$ID_Value1')");
					$query= ("SELECT DISTINCT Matchbox_Models.UMID, Matchbox_Models.MasterModelName, Matchbox_Models.YrFirstProduced, Matchbox_Versions.FAB_No, Matchbox_Models.ModelPhotoRef, Matchbox_Versions.Master_Mack_No
							 FROM Matchbox_Models
							 INNER JOIN Matchbox_Versions ON Matchbox_Models.UMID=Matchbox_Versions.UMID
							 WHERE Matchbox_Versions.Master_Mack_No='$ID_Value1'");
				}
				elseif ($_SESSION['QuickName']) {
					$ID_Value1=mysql_real_escape_string($_SESSION['QuickName']);
					echo "<h4>Searching for Version Name: ".$ID_Value1 ."</h4>";
					//$query= ("SELECT * FROM Matchbox_Models WHERE `MasterModelName` LIKE '%$ID_Value1%' OR `UMID` IN (SELECT `UMID` FROM `TMatchbox_Versions` WHERE `VerName` LIKE '%$ID_Value1%' OR `VERID` IN (SELECT `VERID` FROM `Matchbox_Variations` WHERE `BaseName` LIKE '%$ID_Value1%'))");		
					$query= ("SELECT DISTINCT Matchbox_Models.UMID, Matchbox_Models.MasterModelName, Matchbox_Models.YrFirstProduced, Matchbox_Versions.FAB_No, Matchbox_Models.ModelPhotoRef, Matchbox_Versions.Master_Mack_No
							 FROM Matchbox_Models
							 LEFT JOIN Matchbox_Versions ON Matchbox_Models.UMID=Matchbox_Versions.UMID
							 WHERE Matchbox_Versions.VerName LIKE '%$ID_Value1%'");	
				}
				elseif ($_SESSION['Name']) {
					$ID_Value1=mysql_real_escape_string($_SESSION['Name']);
					echo "<h4>Searching for Any Name: ".$ID_Value1 ."</h4>";
					//$query= ("SELECT * FROM Matchbox_Models WHERE `MasterModelName` LIKE '%$ID_Value1%' OR `UMID` IN (SELECT `UMID` FROM `Matchbox_Versions` WHERE `VerName` LIKE '%$ID_Value1%' OR `VERID` IN (SELECT `VERID` FROM `Matchbox_Variations` WHERE `BaseName` LIKE '%$ID_Value1%'))");		
					$query= ("SELECT DISTINCT Matchbox_Models.UMID, Matchbox_Models.MasterModelName, Matchbox_Models.YrFirstProduced, Matchbox_Versions.FAB_No, Matchbox_Models.ModelPhotoRef, Matchbox_Versions.Master_Mack_No
							 FROM Matchbox_Models
							 LEFT JOIN Matchbox_Versions ON Matchbox_Models.UMID=Matchbox_Versions.UMID
							 LEFT JOIN Matchbox_Variations ON Matchbox_Models.UMID=Matchbox_Variations.UMID
							 WHERE Matchbox_Models.MasterModelName LIKE '%$ID_Value1%' OR Matchbox_Versions.VerName LIKE '%$ID_Value1%' OR Matchbox_Variations.BaseName LIKE '%$ID_Value1%'");	
				}
				elseif ($_SESSION['UMID_1']) {
					$ID_String1= strval($_SESSION['UMID_1']);
					$ID_Len=strlen($ID_String1);
					//check if LR number
					if (substr($ID_String1,0,2)=="LR") {
						//make sure no other letters
						if (!is_numeric(substr($ID_String1,2))) {
							echo "<h3>Invalid UMID, please re-enter</h3>"; //mysql_error();
							exit;
						//	$ID_String1="Invalid UMID, please retry";
						//make sure not too long
						} elseif (strlen(substr($ID_String1,2))>3) {
							echo "<h3>Invalid UMID, please re-enter</h3>"; //mysql_error();
							exit;
						//pad if too short						
						} elseif ($ID_Len<5) {
							$ID_String_LRno= substr($ID_String1,2);
							$ID_String_LRno=str_pad($ID_String_LRno, 3, "0", STR_PAD_LEFT);
							$ID_String1=str_pad($ID_String_LRno, 5, "LR", STR_PAD_LEFT);
						}
						//otherwise just right
					//if SF
					} elseif (substr($ID_String1,0,2)=="SF") {
						//make sure no other letters
						if (!is_numeric(substr($ID_String1,2))) {
							echo "<h3>Invalid UMID, please re-enter</h3>"; //mysql_error();
							exit;
						//make sure not too long
						} elseif (strlen(substr($ID_String1,2))>4) {
							echo "<h3>Invalid UMID, please re-enter</h3>"; //mysql_error();
							exit;;
						//pad if too short otherwise good						
						} elseif ($ID_Len<6) {						
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
						} elseif ($ID_Len>4) {
							echo "<h3>Invalid UMID, please re-enter</h3>"; //mysql_error();
							exit;
						//pad if too short otherwise jsut right						
						} else {						
							$ID_String1=str_pad($ID_String1, 4, "0", STR_PAD_LEFT);
							$ID_String1=str_pad($ID_String1, 6,"SF", STR_PAD_LEFT);
						}
					}	
					if (!$_SESSION['UMID_2']) {
						//if searching by 1 umid, skip the search results and go right to model detail page
						$string_to_redirect="models-detail-ver-listing.php?model=".$ID_String1;	
						redirect_to($string_to_redirect);
					} else {	
						$ID_String2= strval($_SESSION['UMID_2']);
						$ID_Len=strlen($ID_String2);

						if (substr($ID_String2,0,2)=="LR") {
							//make sure no other letters
							if (!is_numeric(substr($ID_String2,2))) {
								echo "<h3>Invalid UMID, please re-enter</h3>"; //mysql_error();
								exit;
							//make sure not too long
							} elseif (strlen(substr($ID_String2,2))>3) {
								echo "<h3>Invalid UMID, please re-enter</h3>"; //mysql_error();
								exit;
							//pad if too short						
							} elseif ($ID_Len<5) {
								$ID_String_LRno= substr($ID_String2,2);
								$ID_String_LRno=str_pad($ID_String_LRno, 3, "0", STR_PAD_LEFT);
								$ID_String2=str_pad($ID_String_LRno, 5, "LR", STR_PAD_LEFT);
							}
							//otherwise just right
						//if SF
						} elseif (substr($ID_String2,0,2)=="SF") {
							//make sure no other letters
							if (!is_numeric(substr($ID_String2,2))) {
								echo "<h3>Invalid UMID, please re-enter</h3>"; //mysql_error();
								exit;
							//make sure not too long
							} elseif (strlen(substr($ID_String2,2))>4) {
								echo "<h3>Invalid UMID, please re-enter</h3>"; //mysql_error();
								exit;
							//pad if too short otherwise good						
							} elseif ($ID_Len<6) {						
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
							} elseif ($ID_Len>4) {
								echo "<h3>Invalid UMID, please re-enter</h3>"; //mysql_error();
								exit;
							//pad if too short otherwise jsut right						
							} else {						
								$ID_String2=str_pad($ID_String2, 4, "0", STR_PAD_LEFT);
								$ID_String2=str_pad($ID_String2, 6,"SF", STR_PAD_LEFT);
							}
						}	
					
						echo "<h4>Searching for UMIDs: ". $ID_String1 ." to ".$ID_String2 . "</h4>";
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
			} elseif (!$_SESSION['TempaText']) {
				
				// Search by Type criteria
				$PrevModelCriteria="";
				if ($_SESSION['VehicleType_Check']) {
					echo "<h4>Searching for Vehicle Type = " . $VehicleType . "</h4>";
					$pageTitle .= ": Vehicle Type: " . $VehicleType;
					$VehicleType=$_SESSION['TypeofVehicle'];
					$PrevModelCriteria="1";
					//$query= "SELECT * FROM Matchbox_Models WHERE `VehicleType` LIKE '%$VehicleType%'  OR `VehicleType2` LIKE '%$VehicleType%'";
					$query= "SELECT DISTINCT Matchbox_Models.UMID, Matchbox_Models.MasterModelName, Matchbox_Models.YrFirstProduced, Matchbox_Versions.FAB_No, Matchbox_Models.ModelPhotoRef, Matchbox_Versions.Master_Mack_No
							 FROM Matchbox_Models
							 LEFT JOIN Matchbox_Versions ON Matchbox_Models.UMID=Matchbox_Versions.UMID
							 WHERE (Matchbox_Models.VehicleType LIKE '%$VehicleType%' OR Matchbox_Models.VehicleType2 LIKE '%$VehicleType%')";
				
				}
				if ($_SESSION['VehicleMake_Check']) {
					
					echo "<h4>Make = " . $VehicleMake . "</h4>";
					$VehicleMake=$_SESSION['VehicleMake'];
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
				if ($_SESSION['MakeCountry_Check']) {
					
					echo "<h4>Country of Make = " . $MakeCountry . "</h4>";
					$MakeCountry=$_SESSION['MakeCountry'];
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
				// if search by text on model		
				//go to separate page to search and display model details of multiple umids at ver level
				$TempaText=$_SESSION['TempaText'];
				$string_to_redirect="models-found-list.php?tempatext=".$TempaText;
				redirect_to($string_to_redirect);
			}                   

			//echo $query."<br />";
			$result=0;
			$rows=0;
			
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			
			
			echo "<p>Number Found: " . $rows . "</p>";
			?>
			<?php if ($rows==0) { ?>
				<h3>Why Were No Matches Found?</h3>
				<ul>
				<li>The Database is still being built! Check <a href="website-updates.php">Website Updates</a> to see current status.</li>
				<li>Your query may have been too specific- try searching a portion of the name. The name you are looking at may be just the model name used on the package, which can be searched also under <a href="Search_Releases_Menu.php">Search Releases</a></li>
				<li>Check for misspellings or incorrect format, i.e. MAN#s are up to 3 digits, with no '#'</li>
				<li>There may be a database error! If you are certain the outcome is incorrect, please send details to me at info@mbx-u.com (or using the <a href="user-upload.php">Upload</a> feature available if you have an account)</li>
				</ul>
				<p>Additional tips for searching are contained on the 'Tips' related page listed below</p>
			<?php } ?>			
	</div>
</div>

<div class="row">
	<div class="large-12 columns">
		<ul class="large-block-grid-3 small-block-grid-3">
		
		<?php
			for ($i=1; $i<=$rows; $i++) {
			
				echo "<li class='carGrid'>";
				
				$row = mysql_fetch_array($result);

				
				//$picture= IMAGE_PATH . $row["UMID"].".jpg";
				//make image clickable and send proper id to model_detail page
				if ($Search_by_MAN=="1") {
					$Model_to_detail=$row["FAB_No"];
					$url= "man-details-and-ver-listing.php?model=".$Model_to_detail;
				} else {
					$Model_to_detail=$row["UMID"];
					$url= "models-detail-ver-listing.php?model=".$Model_to_detail;
				}	

				$picture = IMAGE_URL . $row["UMID"].".jpg";
				
				$picture_loc = IMAGE_PATH . $row["UMID"].".jpg";
				
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
					echo "<p id=\"photoref\">Photo by: ". $row2["RefName"]."</p>";
				} else {
					echo "<p id=\"photoref\">Photo by: no reference listed"."</p>";
				}
				echo "<p><strong>Model UMID:</strong> ". $row["UMID"]."</p>";
				echo "<p><strong>MAN#:</strong> ".$row["FAB_No"]. "</p>";
				echo "<p><strong>Mack No.:</strong> ".$row["Master_Mack_No"]."</p>";
				echo "<p><strong>Master Name:</strong> ".$row["MasterModelName"]."</p>";
				echo "<p><strong>First Rel Dt:</strong> ".$row["YrFirstProduced"]."</p>";
				echo "</li>";
			} ?>
		
		</ul>
		
		
		<?php mysql_free_result($result); ?>
	</div>
</div>

<!-- Duplicate Image message -->
<div id="duplicateImages">
	<div class="row">
		<div class="large-12 columns">
			<p>You might see duplicate images here if there are multiple MAN#'s or Mack #'s covered by the same MBX-U model.</p>
			<p>Click on any of the matches to see the versions and variations for that MBX-U model.</p>
		</div>
	</div>
</div>

<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="Search_Models_Menu.php">Search Models</a>
		<a href="similar_models_compare.php">Differences Among Similar Models</a>
		<a href="model-search-help.php">Tips on Searching for Models</a>
	</div>
</div>

<?php include("includes/footer.php"); ?>