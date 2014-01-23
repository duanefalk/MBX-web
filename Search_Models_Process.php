<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>
<table id="structure">

	<tr>
		<td id="navigation">
			<a href="Search_Models_Menu.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Search Models</p></a>
			<a href="index.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Main Page</p></a>
		</td>
		<td id="page">
			
			<h2>Matching Models</h2> 
			<?php
			$VehicleType=$_POST['TypeofVehicle'];
			$VehicleMake=$_POST['VehicleMake'];
			$MakeCountry=$_POST['MakeCountry'];
			$TempaText=$_POST['TempaText'];

			if ((!$_POST['VehicleType_Check']) AND (!$_POST['VehicleMake_Check']) AND (!$_POST['MakeCountry_Check']) AND (!$_POST['TempaText_Check'])) {	
			
				if ($_POST[MAN_No_1]) {
					$ID_Value1=$_POST[MAN_No_1];
					if (!$_POST[MAN_No_2]) {
						echo "Searching for MAN#: ". $ID_Value1 ."<br />";
						//SELECT *
						//FROM categories
						//LEFT JOIN user_category_subscriptions ON 
						//user_category_subscriptions.category_id = categories.category_id
						//and user_category_subscriptions.user_id =1
						//$query= ("SELECT * FROM Test_Matchbox_Models WHERE `UMID` IN (SELECT `UMID` FROM Test_Matchbox_Versions WHERE `FAB_No`='$ID_Value1')");
						$query= ("SELECT DISTINCT Test_Matchbox_Models.UMID, Test_Matchbox_Models.MasterModelName, Test_Matchbox_Models.YrFirstProduced, Test_Matchbox_Versions.FAB_No, Test_Matchbox_Models.ModelPhotoRef, Test_Matchbox_Versions.Master_Mack_No
							 FROM Test_Matchbox_Models
							 INNER JOIN Test_Matchbox_Versions ON Test_Matchbox_Models.UMID=Test_Matchbox_Versions.UMID
							 WHERE Test_Matchbox_Versions.FAB_No='$ID_Value1'");
						} else {
						$ID_Value2=$_POST[MAN_No_2];
						echo "Searching for MAN#s: ". $ID_Value1 ." to ".$ID_Value2 . "<br />";
						//$query= ("SELECT * FROM Test_Matchbox_Models WHERE `UMID` IN (SELECT `UMID` FROM Test_Matchbox_Versions WHERE `FAB_No`>='$ID_Value1' AND `FAB_No`<='$ID_Value2')");
						$query= ("SELECT DISTINCT Test_Matchbox_Models.UMID, Test_Matchbox_Models.MasterModelName, Test_Matchbox_Models.YrFirstProduced, Test_Matchbox_Versions.FAB_No, Test_Matchbox_Models.ModelPhotoRef, Test_Matchbox_Versions.Master_Mack_No
							 FROM Test_Matchbox_Models
							 INNER JOIN Test_Matchbox_Versions ON Test_Matchbox_Models.UMID=Test_Matchbox_Versions.UMID
							 WHERE Test_Matchbox_Versions.FAB_No>='$ID_Value1' AND Test_Matchbox_Versions.FAB_No<='$ID_Value2'");
					}
				}
				elseif ($_POST[Mack_No]) {
					$ID_Value1=$_POST[Mack_No];
					echo "Searching for Mack #: ". $ID_Value1 ."<br />";
					//$query= ("SELECT * FROM Test_Matchbox_Models WHERE `UMID` IN (SELECT `UMID` FROM Test_Matchbox_Versions WHERE `Master_Mack_No`='$ID_Value1')");
					$query= ("SELECT DISTINCT Test_Matchbox_Models.UMID, Test_Matchbox_Models.MasterModelName, Test_Matchbox_Models.YrFirstProduced, Test_Matchbox_Versions.FAB_No, Test_Matchbox_Models.ModelPhotoRef, Test_Matchbox_Versions.Master_Mack_No
							 FROM Test_Matchbox_Models
							 INNER JOIN Test_Matchbox_Versions ON Test_Matchbox_Models.UMID=Test_Matchbox_Versions.UMID
							 WHERE Test_Matchbox_Versions.Master_Mack_No='$ID_Value1'");
				}
				elseif ($_POST[QuickName]) {
					$ID_Value1=$_POST[QuickName];
					echo "Searching for Version Name: ".$ID_Value1 ."<br />";
					//$query= ("SELECT * FROM Test_Matchbox_Models WHERE `MasterModelName` LIKE '%$ID_Value1%' OR `UMID` IN (SELECT `UMID` FROM `Test_Matchbox_Versions` WHERE `VerName` LIKE '%$ID_Value1%' OR `VERID` IN (SELECT `VERID` FROM `Test_Matchbox_Variations` WHERE `BaseName` LIKE '%$ID_Value1%'))");		
					$query= ("SELECT DISTINCT Test_Matchbox_Models.UMID, Test_Matchbox_Models.MasterModelName, Test_Matchbox_Models.YrFirstProduced, Test_Matchbox_Versions.FAB_No, Test_Matchbox_Models.ModelPhotoRef, Test_Matchbox_Versions.Master_Mack_No
							 FROM Test_Matchbox_Models
							 JOIN Test_Matchbox_Versions ON Test_Matchbox_Models.UMID=Test_Matchbox_Versions.UMID
							 WHERE Test_Matchbox_Versions.VerName LIKE '%$ID_Value1%'");	
				}
				elseif ($_POST[Name]) {
					$ID_Value1=$_POST[Name];
					echo "Searching for Any Name: ".$ID_Value1 ."<br />";
					//$query= ("SELECT * FROM Test_Matchbox_Models WHERE `MasterModelName` LIKE '%$ID_Value1%' OR `UMID` IN (SELECT `UMID` FROM `Test_Matchbox_Versions` WHERE `VerName` LIKE '%$ID_Value1%' OR `VERID` IN (SELECT `VERID` FROM `Test_Matchbox_Variations` WHERE `BaseName` LIKE '%$ID_Value1%'))");		
					$query= ("SELECT DISTINCT Test_Matchbox_Models.UMID, Test_Matchbox_Models.MasterModelName, Test_Matchbox_Models.YrFirstProduced, Test_Matchbox_Versions.FAB_No, Test_Matchbox_Models.ModelPhotoRef, Test_Matchbox_Versions.Master_Mack_No
							 FROM Test_Matchbox_Models
							 LEFT JOIN Test_Matchbox_Versions ON Test_Matchbox_Models.UMID=Test_Matchbox_Versions.UMID
							 LEFT JOIN Test_Matchbox_Variations ON Test_Matchbox_Models.UMID=Test_Matchbox_Variations.UMID
							 WHERE Test_Matchbox_Models.MasterModelName LIKE '%$ID_Value1%' OR Test_Matchbox_Versions.VerName LIKE '%$ID_Value1%' OR Test_Matchbox_Variations.BaseName LIKE '%$ID_Value1%'");	
				}
				elseif ($_POST[UMID_1]) {
					$ID_Value1=$_POST[UMID_1];
					$ID_String1= strval($ID_Value1);
					$ID_Len=strlen($ID_String1);
					$ID_String1=str_pad($ID_String1, 4, "0", STR_PAD_LEFT);
					$ID_String1=str_pad($ID_String1, 6,"SF", STR_PAD_LEFT);	
					
					if (!$_POST[UMID_2]) {
					//if searching by 1 umid, skip the search results and go right to model detail page
					$string_to_redirect="Models_Detail_and_Ver_Listing.php?model=".$ID_String1;
					redirect_to($string_to_redirect);
					} else {	
						$ID_Value2=$_POST[UMID_2];
						$ID_String2= strval($ID_Value2);
						$ID_Len=strlen($ID_String2);
						$ID_String2=str_pad($ID_String2, 4, "0", STR_PAD_LEFT);
						$ID_String2=str_pad($ID_String2, 6,"SF", STR_PAD_LEFT);
					
						echo "Searching for UMIDs: ". $ID_String1 ." to ".$ID_String2 . "<br />";
						//$query= ("SELECT * FROM Test_Matchbox_Models WHERE UMID >='$ID_String1' AND UMID <='$ID_String2' ORDER BY UMID ASC");
						$query= ("SELECT DISTINCT Test_Matchbox_Models.UMID, Test_Matchbox_Models.MasterModelName, Test_Matchbox_Models.YrFirstProduced, Test_Matchbox_Versions.FAB_No, Test_Matchbox_Models.ModelPhotoRef, Test_Matchbox_Versions.Master_Mack_No
							 FROM Test_Matchbox_Models
							 LEFT JOIN Test_Matchbox_Versions ON Test_Matchbox_Models.UMID=Test_Matchbox_Versions.UMID
							 WHERE Test_Matchbox_Models.UMID>='$ID_String1' AND Test_Matchbox_Models.UMID<='$ID_String2'");
					}
				} else {
					echo "ERROR no type selected";
					exit;
				}
			} ELSEIF (!$_POST['TempaText_Check']) {
				

				 //if model criteria checked
				//echo "Made it to model info";
				$PrevModelCriteria="";
				if ($_POST['VehicleType_Check']) {
					echo "Searching for:<br></>";
					echo "Vehicle Type= ".$VehicleType."<br />";
					$VehicleType=$_POST['TypeofVehicle'];
					$PrevModelCriteria="1";
					//$query= "SELECT * FROM Test_Matchbox_Models WHERE `VehicleType` LIKE '%$VehicleType%'  OR `VehicleType2` LIKE '%$VehicleType%'";
					$query= "SELECT DISTINCT Test_Matchbox_Models.UMID, Test_Matchbox_Models.MasterModelName, Test_Matchbox_Models.YrFirstProduced, Test_Matchbox_Versions.FAB_No, Test_Matchbox_Models.ModelPhotoRef, Test_Matchbox_Versions.Master_Mack_No
							 FROM Test_Matchbox_Models
							 LEFT JOIN Test_Matchbox_Versions ON Test_Matchbox_Models.UMID=Test_Matchbox_Versions.UMID
							 WHERE (Test_Matchbox_Models.VehicleType LIKE '%$VehicleType%' OR Test_Matchbox_Models.VehicleType2 LIKE '%$VehicleType%')";
				
				}
				if ($_POST['VehicleMake_Check']) {
					
					echo "  Make= ".$VehicleMake."<br></>";
					$VehicleMake=$_POST['VehicleMake'];
					if ($PrevModelCriteria != "1") {
					    //echo "only vehicle make";
					    $PrevModelCriteria="1";
					    //$query= "SELECT * FROM Test_Matchbox_Models WHERE `MakeofModel` LIKE '%$VehicleMake%'";
					    $query= "SELECT DISTINCT Test_Matchbox_Models.UMID, Test_Matchbox_Models.MasterModelName, Test_Matchbox_Models.YrFirstProduced, Test_Matchbox_Versions.FAB_No, Test_Matchbox_Models.ModelPhotoRef, Test_Matchbox_Versions.Master_Mack_No
							 FROM Test_Matchbox_Models
							 INNER JOIN Test_Matchbox_Versions ON Test_Matchbox_Models.UMID=Test_Matchbox_Versions.UMID
							 WHERE Test_Matchbox_Models.MakeofModel LIKE '%$VehicleMake%'";
					} ELSE {
					    //echo "type and make";
					    $PrevModelCriteria="1";
					    $query .= " AND Test_Matchbox_Models.MakeofModel LIKE '%$VehicleMake%'";
					    //echo $query;
					    //exit;
					}
				}
				if ($_POST['MakeCountry_Check']) {
					
					echo "  Country of Make= ".$$MakeCountry."<br></>";
					$MakeCountry=$_POST['MakeCountry'];
					if (!$PrevModelCriteria) {
						$PrevModelCriteria="1";
						//$query= "SELECT * FROM Test_Matchbox_Models WHERE `CountryofMake` LIKE '%$MakeCountry%'";
						$query= "SELECT DISTINCT Test_Matchbox_Models.UMID, Test_Matchbox_Models.MasterModelName, Test_Matchbox_Models.YrFirstProduced, Test_Matchbox_Versions.FAB_No, Test_Matchbox_Models.ModelPhotoRef, Test_Matchbox_Versions.Master_Mack_No
							 FROM Test_Matchbox_Models
							 INNER JOIN Test_Matchbox_Versions ON Test_Matchbox_Models.UMID=Test_Matchbox_Versions.UMID
							 WHERE Test_Matchbox_Models.CountryofMake LIKE '%$MakeCountry%'";
				       } ELSE {
					   $PrevModelCriteria="1";
					   $query=$query . " AND Test_Matchbox_Models.CountryofMake LIKE '%$MakeCountry%'";
				       }                   
				}
				$query = "(".$query.")";
				
			} ELSE {
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
				}
	
			for ($i=1; $i<=$rows; $i++)
			{
			echo "<div class=\"car-block\">";
				$row=mysql_fetch_array($result);
				//$picture= IMAGE_PATH . $row["UMID"].".jpg";
				//make image clickable and send proper umid to model_detail page
				$Model_to_detail=$row["UMID"];
				$url= "Models_Detail_and_Ver_Listing.php?model=".$Model_to_detail;
				$picture= IMAGE_URL . $row["UMID"].".jpg";
				
				$picture_loc= IMAGE_PATH . $row["UMID"].".jpg";
				
				if (file_exists($picture_loc)) {
						//echo "picture exists";
						echo "<a href=\"".$url."\">"."<img src=".$picture." width=\"240\"></a>";
					} else {
						//echo "cant find picture";
						//echo DEFAULT_IMAGE;
						echo "<a href=\"".$url."\">"."<img src=".DEFAULT_IMAGE." width=\"240\"></a>";
					}	

				echo "<br />";
				//echo $picture."<br />";
				$PhotoRefCd= $row["ModelPhotoRef"];
				if ($PhotoRefCd) {
					$query2= ("SELECT * FROM Test_Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd%'");
					$result2= mysql_query($query2);
					$row2 =mysql_fetch_array($result2);
					echo "<p>Photo by: ". $row2["RefName"]."</p>";
				} ELSE {
					echo "<p>Photo by: no reference listed"."</p>";
				}
	
				echo "<p>Model UMID: ". $row["UMID"]."</p>";
				echo "<p>MAN#: ".$row["FAB_No"]. "  Mack No.: ".$row["Master_Mack_No"]."</p>";
				echo "<p>Master Name: ".$row["MasterModelName"]."</p>";
				echo "<p>First Rel Dt: ".$row["YrFirstProduced"]."</p>";
			echo "</div>";
			}

			echo "<br /> Query Completed </br /><br />";
			//echo "* see 'References' page for full source info"."<br /><br />";
			mysql_free_result($result);
			// echo $result;
			
			?>
			<a href="Search_Models_Menu.php">Cancel</a>
		</td>
	</tr>
</table>

<?php include("includes/footer.php"); ?>