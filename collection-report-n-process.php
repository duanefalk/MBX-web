qqqq<?php
	session_start();
	$pageTitle = "Processing Your Collection Search";
	$pageDescription = "Searching your own Matchbox University car collection.";
	require_once("includes/db_connection.php");
	include("includes/header.php");
	include("includes/functions.php");
?>


<div class="row">
	<div class="large-12 columns">
            <a href="collection-reports.php" class="button dark">Return to Collection Reports Menu</a>
            <a href="index.php" class="button dark">Return to Main Page</a>

                <h2>Models in Collection of <?php echo $_SESSION["Username"]; ?></h2>
            <?php
		$User=$_SESSION["Username"];

	
		//SELECT section
			//IF NOT Checked items
			if ((!$_POST['Seller_Check']) AND (!$_POST['Location_Check']) AND (!$_POST['Copies_Check']) AND (!$_POST['Sell_Check']) AND (!$_POST['Cond_Check'])) {	

				//UMID
				if ($_POST['UMID_1']) {
					$ID_String1= strval($_POST['UMID_1']);
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
					if (!$_POST['UMID_2']) {
						$query_select="SELECT Matchbox_Collection.Username, Matchbox_Collection.UMID, Matchbox_Collection.VerID, Matchbox_Collection.VarID, Matchbox_Collection.Copy, Matchbox_Collection.VehCond, Matchbox_Collection.ItemVal,
							Matchbox_Collection.StorLoc, Matchbox_Collection.StorLoc2, Matchbox_Collection.Seller, Matchbox_Collection.PurchDt, Matchbox_Collection.PurchPrice, Matchbox_Collection.SellFlag, 
							Matchbox_Versions.UMID, Matchbox_Versions.VerID, Matchbox_Versions.VerName, Matchbox_Versions.FAB_No, Matchbox_Versions.Master_Mack_No,
							Matchbox_Variations.UMID, Matchbox_Variations.VerID, Matchbox_Variations.VarID,  Matchbox_Variations.Mack_No, Matchbox_Variations.ManufLoc, Matchbox_Variations.FWhCd, Matchbox_Variations.RWhCd, Matchbox_Variations.WindowColor, Matchbox_Variations.InteriorColor,
							Matchbox_Variations.Finish, Matchbox_Variations.Base1Material, Matchbox_Variations.Base1Color, Matchbox_Variations.ColorVar, Matchbox_Variations.TempaVar, Matchbox_Variations.Det1Typ, Matchbox_Variations.Det1Var, Matchbox_Variations.Det2Typ,
							Matchbox_Variations.Det2Var, Matchbox_Variations.Det3Typ, Matchbox_Variations.Det3Var
							FROM Matchbox_Collection
							 JOIN Matchbox_Versions ON Matchbox_Collection.VerID=Matchbox_Versions.VerID
							 JOIN Matchbox_Variations on Matchbox_Collection.VarID=Matchbox_Variations.VarID
							WHERE Matchbox_Collection.Username = '$User' AND Matchbox_Collection.UMID='$ID_String1' AND Matchbox_Collection.Coll_InactiveFlg=0";
					} else {	
						$ID_String2= strval($_POST['UMID_2']);
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
						
							echo "Searching for UMIDs: ". $ID_String1 ." to ".$ID_String2 . "<br />";
							
							$query_select="SELECT Matchbox_Collection.Username, Matchbox_Collection.UMID, Matchbox_Collection.VerID, Matchbox_Collection.VarID, Matchbox_Collection.Copy, Matchbox_Collection.VehCond, Matchbox_Collection.ItemVal,
							Matchbox_Collection.StorLoc, Matchbox_Collection.StorLoc2, Matchbox_Collection.Seller, Matchbox_Collection.PurchDt, Matchbox_Collection.PurchPrice, Matchbox_Collection.SellFlag, 
							Matchbox_Versions.UMID, Matchbox_Versions.VerID, Matchbox_Versions.VerName, Matchbox_Versions.FAB_No, Matchbox_Versions.Master_Mack_No,
							Matchbox_Variations.UMID, Matchbox_Variations.VerID, Matchbox_Variations.VarID, Matchbox_Variations.Mack_No, Matchbox_Variations.ManufLoc, Matchbox_Variations.FWhCd, Matchbox_Variations.RWhCd, Matchbox_Variations.WindowColor, Matchbox_Variations.InteriorColor,
							Matchbox_Variations.Finish, Matchbox_Variations.Base1Material, Matchbox_Variations.Base1Color, Matchbox_Variations.ColorVar, Matchbox_Variations.TempaVar, Matchbox_Variations.Det1Typ, Matchbox_Variations.Det1Var, Matchbox_Variations.Det2Typ,
							Matchbox_Variations.Det2Var, Matchbox_Variations.Det3Typ, Matchbox_Variations.Det3Var
							FROM Matchbox_Collection
							 JOIN Matchbox_Versions ON Matchbox_Collection.VerID=Matchbox_Versions.VerID
							 JOIN Matchbox_Variations on Matchbox_Collection.VarID=Matchbox_Variations.VarID
							WHERE Matchbox_Collection.Username = '$User' AND Matchbox_Collection.UMID>='$ID_String1' AND Matchbox_Collection.UMID<='$ID_String2' AND Matchbox_Collection.Coll_InactiveFlg=0";
					}
				
				// MAN	
				} elseif ($_POST['MAN_No_1']) {
					$ID_Value1=$_POST['MAN_No_1'];
					if (!$_POST['MAN_No_2']) {
						echo "Searching for MAN#: ". $ID_Value1 ."<br />";
						
						$query_select="SELECT DISTINCT Matchbox_Collection.Username, Matchbox_Collection.UMID, Matchbox_Collection.VerID, Matchbox_Collection.VarID, Matchbox_Collection.Copy, Matchbox_Collection.VehCond, Matchbox_Collection.ItemVal,
							Matchbox_Collection.StorLoc, Matchbox_Collection.StorLoc2, Matchbox_Collection.Seller, Matchbox_Collection.PurchDt, Matchbox_Collection.PurchPrice, Matchbox_Collection.SellFlag, 
							Matchbox_Versions.UMID, Matchbox_Versions.VerID, Matchbox_Versions.VerName, Matchbox_Versions.FAB_No, Matchbox_Versions.Master_Mack_No,
							Matchbox_Variations.UMID, Matchbox_Variations.VerID, Matchbox_Variations.VarID,  Matchbox_Variations.Mack_No, Matchbox_Variations.ManufLoc, Matchbox_Variations.FWhCd, Matchbox_Variations.RWhCd, Matchbox_Variations.WindowColor, Matchbox_Variations.InteriorColor,
							Matchbox_Variations.Finish, Matchbox_Variations.Base1Material, Matchbox_Variations.Base1Color, Matchbox_Variations.ColorVar, Matchbox_Variations.TempaVar, Matchbox_Variations.Det1Typ, Matchbox_Variations.Det1Var, Matchbox_Variations.Det2Typ,
							Matchbox_Variations.Det2Var, Matchbox_Variations.Det3Typ, Matchbox_Variations.Det3Var
							FROM Matchbox_Versions
							 INNER JOIN Matchbox_Collection ON Matchbox_Versions.VerID=Matchbox_Collection.VerID
							 INNER JOIN Matchbox_Variations ON Matchbox_Collection.VarID=Matchbox_Variations.VarID
							WHERE Matchbox_Versions.FAB_No='$ID_Value1' AND Matchbox_Collection.Username = '$User' AND Matchbox_Collection.Coll_InactiveFlg=0";
					} else {
						$ID_Value2=$_POST['MAN_No_2'];
						echo "Searching for MAN#s: ". $ID_Value1 ." to ".$ID_Value2 . "<br />";

						$query_select="SELECT DISTINCT Matchbox_Collection.Username, Matchbox_Collection.UMID, Matchbox_Collection.VerID, Matchbox_Collection.VarID, Matchbox_Collection.Copy, Matchbox_Collection.VehCond, Matchbox_Collection.ItemVal,
							Matchbox_Collection.StorLoc, Matchbox_Collection.StorLoc2, Matchbox_Collection.Seller, Matchbox_Collection.PurchDt, Matchbox_Collection.PurchPrice, Matchbox_Collection.SellFlag, 
							Matchbox_Versions.UMID, Matchbox_Versions.VerID, Matchbox_Versions.VerName, Matchbox_Versions.FAB_No, Matchbox_Versions.Master_Mack_No,
							Matchbox_Variations.UMID, Matchbox_Variations.VerID, Matchbox_Variations.VarID,  Matchbox_Variations.Mack_No, Matchbox_Variations.ManufLoc, Matchbox_Variations.FWhCd, Matchbox_Variations.RWhCd, Matchbox_Variations.WindowColor, Matchbox_Variations.InteriorColor,
							Matchbox_Variations.Finish, Matchbox_Variations.Base1Material, Matchbox_Variations.Base1Color, Matchbox_Variations.ColorVar, Matchbox_Variations.TempaVar, Matchbox_Variations.Det1Typ, Matchbox_Variations.Det1Var, Matchbox_Variations.Det2Typ,
							Matchbox_Variations.Det2Var, Matchbox_Variations.Det3Typ, Matchbox_Variations.Det3Var
							FROM Matchbox_Versions
							 INNER JOIN Matchbox_Collection ON Matchbox_Versions.VerID=Matchbox_Collection.VerID
							 INNER JOIN Matchbox_Variations ON Matchbox_Collection.VarID=Matchbox_Variations.VarID
							WHERE Matchbox_Versions.FAB_No>='$ID_Value1' AND Matchbox_Versions.FAB_No<='$ID_Value2' AND Matchbox_Collection.Username = '$User' AND Matchbox_Collection.Coll_InactiveFlg=0";
						}
						
				// MACK		
				} elseif ($_POST['Mack_No']) {
					$Mack_No=$_POST['Mack_No'];
					echo "Searching for Mack #: ". $Mack_No ."<br />";
					
					$query_select="SELECT DISTINCT Matchbox_Collection.Username, Matchbox_Collection.UMID, Matchbox_Collection.VerID, Matchbox_Collection.VarID, Matchbox_Collection.Copy, Matchbox_Collection.VehCond, Matchbox_Collection.ItemVal,
							Matchbox_Collection.StorLoc, Matchbox_Collection.StorLoc2, Matchbox_Collection.Seller, Matchbox_Collection.PurchDt, Matchbox_Collection.PurchPrice, Matchbox_Collection.SellFlag, 
							Matchbox_Versions.UMID, Matchbox_Versions.VerID, Matchbox_Versions.VerName, Matchbox_Versions.FAB_No, Matchbox_Versions.Master_Mack_No,
							Matchbox_Variations.UMID, Matchbox_Variations.VerID, Matchbox_Variations.VarID,  Matchbox_Variations.Mack_No, Matchbox_Variations.ManufLoc, Matchbox_Variations.FWhCd, Matchbox_Variations.RWhCd, Matchbox_Variations.WindowColor, Matchbox_Variations.InteriorColor,
							Matchbox_Variations.Finish, Matchbox_Variations.Base1Material, Matchbox_Variations.Base1Color, Matchbox_Variations.ColorVar, Matchbox_Variations.TempaVar, Matchbox_Variations.Det1Typ, Matchbox_Variations.Det1Var, Matchbox_Variations.Det2Typ,
							Matchbox_Variations.Det2Var, Matchbox_Variations.Det3Typ, Matchbox_Variations.Det3Var
							FROM Matchbox_Versions
							 INNER JOIN Matchbox_Collection ON Matchbox_Versions.VerID=Matchbox_Collection.VerID
							 INNER JOIN Matchbox_Variations ON Matchbox_Collection.VarID=Matchbox_Variations.VarID
							WHERE Matchbox_Versions.Master_Mack_No='$Mack_No' AND Matchbox_Collection.Username = '$User' AND Matchbox_Collection.Coll_InactiveFlg=0";
				
				// THEME
				} elseif ($_POST['ReleaseTheme_Check']) {
					$Theme= $_POST['ReleaseTheme'];
					echo "Searching for Release Theme: ".$_POST['ReleaseTheme']."<br></br>";
					
					$query_select="SELECT DISTINCT Matchbox_Collection.Username, Matchbox_Collection.UMID, Matchbox_Collection.VerID, Matchbox_Collection.VarID, Matchbox_Collection.Copy, Matchbox_Collection.VehCond, Matchbox_Collection.ItemVal,
							Matchbox_Collection.StorLoc, Matchbox_Collection.StorLoc2, Matchbox_Collection.Seller, Matchbox_Collection.PurchDt, Matchbox_Collection.PurchPrice, Matchbox_Collection.SellFlag, 
							Matchbox_Versions.UMID, Matchbox_Versions.VerID, Matchbox_Versions.VerName, Matchbox_Versions.FAB_No, Matchbox_Versions.Master_Mack_No,
							Matchbox_Variations.UMID, Matchbox_Variations.VerID, Matchbox_Variations.VarID,  Matchbox_Variations.Mack_No, Matchbox_Variations.ManufLoc, Matchbox_Variations.FWhCd, Matchbox_Variations.RWhCd, Matchbox_Variations.WindowColor, Matchbox_Variations.InteriorColor,
							Matchbox_Variations.Finish, Matchbox_Variations.Base1Material, Matchbox_Variations.Base1Color, Matchbox_Variations.ColorVar, Matchbox_Variations.TempaVar, Matchbox_Variations.Det1Typ, Matchbox_Variations.Det1Var, Matchbox_Variations.Det2Typ,
							Matchbox_Variations.Det2Var, Matchbox_Variations.Det3Typ, Matchbox_Variations.Det3Var,
							Matchbox_Releases.Theme, Matchbox_Releases.Series, Matchbox_Releases.RelYr, Matchbox_Releases.VarID
							FROM Matchbox_Releases
							 INNER JOIN Matchbox_Collection ON Matchbox_Releases.VarID=Matchbox_Collection.VarID
							 INNER JOIN Matchbox_Variations ON Matchbox_Collection.VarID=Matchbox_Variations.VarID
							 INNER JOIN Matchbox_Versions ON Matchbox_Collection.VerID=Matchbox_Versions.VerID
							WHERE Matchbox_Releases.Theme='$Theme' AND Matchbox_Collection.Username = '$User' AND Matchbox_Collection.Coll_InactiveFlg=0";
				
					
				// SERIES	
				} elseif ($_POST['RelSeries_Check']) {
					echo "Searching for Release Series: ".$_POST['RelSeries']."<br></br>";
					$Series= $_POST['RelSeries'];
					
					$query_select="SELECT DISTINCT Matchbox_Releases.VarID, Matchbox_Collection.Username, Matchbox_Collection.UMID, Matchbox_Collection.VerID, Matchbox_Collection.VarID, Matchbox_Collection.Copy, Matchbox_Collection.VehCond, Matchbox_Collection.ItemVal,
							Matchbox_Collection.StorLoc, Matchbox_Collection.StorLoc2, Matchbox_Collection.Seller, Matchbox_Collection.PurchDt, Matchbox_Collection.PurchPrice, Matchbox_Collection.SellFlag, 
							Matchbox_Versions.UMID, Matchbox_Versions.VerID, Matchbox_Versions.VerName, Matchbox_Versions.FAB_No, Matchbox_Versions.Master_Mack_No,
							Matchbox_Variations.UMID, Matchbox_Variations.VerID, Matchbox_Variations.VarID,  Matchbox_Variations.Mack_No, Matchbox_Variations.ManufLoc, Matchbox_Variations.FWhCd, Matchbox_Variations.RWhCd, Matchbox_Variations.WindowColor, Matchbox_Variations.InteriorColor,
							Matchbox_Variations.Finish, Matchbox_Variations.Base1Material, Matchbox_Variations.Base1Color, Matchbox_Variations.ColorVar, Matchbox_Variations.TempaVar, Matchbox_Variations.Det1Typ, Matchbox_Variations.Det1Var, Matchbox_Variations.Det2Typ,
							Matchbox_Variations.Det2Var, Matchbox_Variations.Det3Typ, Matchbox_Variations.Det3Var
							FROM Matchbox_Releases
							 INNER JOIN Matchbox_Collection ON Matchbox_Releases.VarID=Matchbox_Collection.VarID
							 INNER JOIN Matchbox_Variations ON Matchbox_Collection.VarID=Matchbox_Variations.VarID
							 INNER JOIN Matchbox_Versions ON Matchbox_Collection.VerID=Matchbox_Versions.VerID
							WHERE Matchbox_Releases.Series='$Series' AND Matchbox_Collection.Username = '$User' AND Matchbox_Collection.Coll_InactiveFlg=0";
	
					
				// REL YRS	
				} elseif ($_POST['Rel_Yr_1']) {
					$Rel_Yr_1= $_POST['Rel_Yr_1'];
					if (!$_POST['Rel_Yr_2']) {
						echo "Searching for Release Year: ".$_POST['Rel_Yr_1']."<br></br>";
						$query_select="SELECT DISTINCT Matchbox_Releases.VarID, Matchbox_Collection.Username, Matchbox_Collection.UMID, Matchbox_Collection.VerID, Matchbox_Collection.VarID, Matchbox_Collection.Copy, Matchbox_Collection.VehCond, Matchbox_Collection.ItemVal,
							Matchbox_Collection.StorLoc, Matchbox_Collection.StorLoc2, Matchbox_Collection.Seller, Matchbox_Collection.PurchDt, Matchbox_Collection.PurchPrice, Matchbox_Collection.SellFlag, 
							Matchbox_Versions.UMID, Matchbox_Versions.VerID, Matchbox_Versions.VerName, Matchbox_Versions.FAB_No, Matchbox_Versions.Master_Mack_No,
							Matchbox_Variations.UMID, Matchbox_Variations.VerID, Matchbox_Variations.VarID,  Matchbox_Variations.Mack_No, Matchbox_Variations.ManufLoc, Matchbox_Variations.FWhCd, Matchbox_Variations.RWhCd, Matchbox_Variations.WindowColor, Matchbox_Variations.InteriorColor,
							Matchbox_Variations.Finish, Matchbox_Variations.Base1Material, Matchbox_Variations.Base1Color, Matchbox_Variations.ColorVar, Matchbox_Variations.TempaVar, Matchbox_Variations.Det1Typ, Matchbox_Variations.Det1Var, Matchbox_Variations.Det2Typ,
							Matchbox_Variations.Det2Var, Matchbox_Variations.Det3Typ, Matchbox_Variations.Det3Var
							FROM Matchbox_Releases
							 INNER JOIN Matchbox_Collection ON Matchbox_Releases.VarID=Matchbox_Collection.VarID
							 INNER JOIN Matchbox_Variations ON Matchbox_Collection.VarID=Matchbox_Variations.VarID
							 INNER JOIN Matchbox_Versions ON Matchbox_Collection.VerID=Matchbox_Versions.VerID
							WHERE Matchbox_Releases.RelYr='$Rel_Yr_1' AND Matchbox_Collection.Username = '$User' AND Matchbox_Collection.Coll_InactiveFlg=0";
						
					} else {
						echo "Searching for Release Years: ".$_POST['Rel_Yr_1']." to ".$_POST['Rel_Yr_2']."<br></br>";
						$Rel_Yr_2= $_POST['Rel_Yr_2'];
						$query_select="SELECT DISTINCT Matchbox_Releases.VarID, Matchbox_Collection.Username, Matchbox_Collection.UMID, Matchbox_Collection.VerID, Matchbox_Collection.VarID, Matchbox_Collection.Copy, Matchbox_Collection.VehCond, Matchbox_Collection.ItemVal,
							Matchbox_Collection.StorLoc, Matchbox_Collection.StorLoc2, Matchbox_Collection.Seller, Matchbox_Collection.PurchDt, Matchbox_Collection.PurchPrice, Matchbox_Collection.SellFlag, 
							Matchbox_Versions.UMID, Matchbox_Versions.VerID, Matchbox_Versions.VerName, Matchbox_Versions.FAB_No, Matchbox_Versions.Master_Mack_No,
							Matchbox_Variations.UMID, Matchbox_Variations.VerID, Matchbox_Variations.VarID,  Matchbox_Variations.Mack_No, Matchbox_Variations.ManufLoc, Matchbox_Variations.FWhCd, Matchbox_Variations.RWhCd, Matchbox_Variations.WindowColor, Matchbox_Variations.InteriorColor,
							Matchbox_Variations.Finish, Matchbox_Variations.Base1Material, Matchbox_Variations.Base1Color, Matchbox_Variations.ColorVar, Matchbox_Variations.TempaVar, Matchbox_Variations.Det1Typ, Matchbox_Variations.Det1Var, Matchbox_Variations.Det2Typ,
							Matchbox_Variations.Det2Var, Matchbox_Variations.Det3Typ, Matchbox_Variations.Det3Var
							FROM Matchbox_Releases
							 INNER JOIN Matchbox_Collection ON Matchbox_Releases.VarID=Matchbox_Collection.VarID
							 INNER JOIN Matchbox_Variations ON Matchbox_Collection.VarID=Matchbox_Variations.VarID
							 INNER JOIN Matchbox_Versions ON Matchbox_Collection.VerID=Matchbox_Versions.VerID
							WHERE Matchbox_Releases.RelYr>='$Rel_Yr_1' AND Matchbox_Releases.RelYr<='$Rel_Yr_2' AND Matchbox_Collection.Username = '$User' AND Matchbox_Collection.Coll_InactiveFlg=0";
						
					}
					
				} else {
					//show all models in collection
					$query_select= "SELECT Matchbox_Collection.Username, Matchbox_Collection.UMID, Matchbox_Collection.VerID, Matchbox_Collection.VarID, Matchbox_Collection.Copy, Matchbox_Collection.VehCond, Matchbox_Collection.ItemVal,
						Matchbox_Collection.StorLoc, Matchbox_Collection.StorLoc2, Matchbox_Collection.Seller, Matchbox_Collection.PurchDt, Matchbox_Collection.PurchPrice, Matchbox_Collection.SellFlag, 
						Matchbox_Versions.UMID, Matchbox_Versions.VerID, Matchbox_Versions.VerName, Matchbox_Versions.FAB_No, Matchbox_Versions.Master_Mack_No,
						Matchbox_Variations.UMID, Matchbox_Variations.VerID, Matchbox_Variations.VarID,  Matchbox_Variations.Mack_No, Matchbox_Variations.ManufLoc, Matchbox_Variations.FWhCd, Matchbox_Variations.RWhCd, Matchbox_Variations.WindowColor, Matchbox_Variations.InteriorColor,
						Matchbox_Variations.Finish, Matchbox_Variations.Base1Material, Matchbox_Variations.Base1Color, Matchbox_Variations.ColorVar, Matchbox_Variations.TempaVar, Matchbox_Variations.Det1Typ, Matchbox_Variations.Det1Var, Matchbox_Variations.Det2Typ,
						Matchbox_Variations.Det2Var, Matchbox_Variations.Det3Typ, Matchbox_Variations.Det3Var
						 FROM Matchbox_Collection
						 JOIN Matchbox_Versions ON Matchbox_Collection.VerID=Matchbox_Versions.VerID
						 JOIN Matchbox_Variations on Matchbox_Collection.VarID=Matchbox_Variations.VarID
						WHERE Matchbox_Collection.Username = '$User' AND Matchbox_Collection.Coll_InactiveFlg=0";
				}
				
			
			//ELSE IF Checked items
			} else {
						
				// Search by Seller
				$PrevModelCriteria="";
				if ($_POST['Seller_Check']) {
					$Seller=$_POST['Seller'];
					echo "<p>Searching for:</p>";
					echo "<p>Seller= " . $Seller . "</p>";
					$PrevModelCriteria="1";
					$query_select= "SELECT Matchbox_Collection.Username, Matchbox_Collection.UMID, Matchbox_Collection.VerID, Matchbox_Collection.VarID, Matchbox_Collection.Copy, Matchbox_Collection.VehCond, Matchbox_Collection.ItemVal,
							Matchbox_Collection.StorLoc, Matchbox_Collection.StorLoc2, Matchbox_Collection.Seller, Matchbox_Collection.PurchDt, Matchbox_Collection.PurchPrice, Matchbox_Collection.SellFlag, 
							Matchbox_Versions.UMID, Matchbox_Versions.VerID, Matchbox_Versions.VerName, Matchbox_Versions.FAB_No, Matchbox_Versions.Master_Mack_No,
							Matchbox_Variations.UMID, Matchbox_Variations.VerID, Matchbox_Variations.VarID,  Matchbox_Variations.Mack_No, Matchbox_Variations.ManufLoc, Matchbox_Variations.FWhCd, Matchbox_Variations.RWhCd, Matchbox_Variations.WindowColor, Matchbox_Variations.InteriorColor,
							Matchbox_Variations.Finish, Matchbox_Variations.Base1Material, Matchbox_Variations.Base1Color, Matchbox_Variations.ColorVar, Matchbox_Variations.TempaVar, Matchbox_Variations.Det1Typ, Matchbox_Variations.Det1Var, Matchbox_Variations.Det2Typ,
							Matchbox_Variations.Det2Var, Matchbox_Variations.Det3Typ, Matchbox_Variations.Det3Var
							 FROM Matchbox_Collection
							 JOIN Matchbox_Versions ON Matchbox_Collection.VerID=Matchbox_Versions.VerID
							 JOIN Matchbox_Variations on Matchbox_Collection.VarID=Matchbox_Variations.VarID
							WHERE Matchbox_Collection.Username = '$User' AND Matchbox_Collection.Seller LIKE '%$Seller%' AND Matchbox_Collection.Coll_InactiveFlg=0";
					//echo $query_select;
				}
				if ($_POST['Location_Check']) {
					$Location=$_POST['Location'];
					echo "  Location= ".$Location."<br></>";
					if ($PrevModelCriteria != 1) {
						//echo "only location";
						$PrevModelCriteria="1";    
						$query_select= "SELECT Matchbox_Collection.Username, Matchbox_Collection.UMID, Matchbox_Collection.VerID, Matchbox_Collection.VarID, Matchbox_Collection.Copy, Matchbox_Collection.VehCond, Matchbox_Collection.ItemVal,
							Matchbox_Collection.StorLoc, Matchbox_Collection.StorLoc2, Matchbox_Collection.Seller, Matchbox_Collection.PurchDt, Matchbox_Collection.PurchPrice, Matchbox_Collection.SellFlag, 
							Matchbox_Versions.UMID, Matchbox_Versions.VerID, Matchbox_Versions.VerName, Matchbox_Versions.FAB_No, Matchbox_Versions.Master_Mack_No,
							Matchbox_Variations.UMID, Matchbox_Variations.VerID, Matchbox_Variations.VarID,  Matchbox_Variations.Mack_No, Matchbox_Variations.ManufLoc, Matchbox_Variations.FWhCd, Matchbox_Variations.RWhCd, Matchbox_Variations.WindowColor, Matchbox_Variations.InteriorColor,
							Matchbox_Variations.Base1Material, Matchbox_Variations.Base1Color, Matchbox_Variations.ColorVar, Matchbox_Variations.TempaVar, Matchbox_Variations.Det1Typ, Matchbox_Variations.Det1Var, Matchbox_Variations.Det2Typ,
							Matchbox_Variations.Det2Var, Matchbox_Variations.Det3Typ, Matchbox_Variations.Det3Var
							 FROM Matchbox_Collection
							 JOIN Matchbox_Versions ON Matchbox_Collection.VerID=Matchbox_Versions.VerID
							 JOIN Matchbox_Variations on Matchbox_Collection.VarID=Matchbox_Variations.VarID
							WHERE Matchbox_Collection.Username = '$User' AND Matchbox_Collection.StorLoc LIKE '%$Location%' AND Matchbox_Collection.Coll_InactiveFlg=0";
					} else {
						//echo "seller and location";
						$PrevModelCriteria="1";
						$query_select .= " AND Matchbox_Collection.StorLoc LIKE '%$Location%'";
						//echo $query;
						//exit;
					}
				}
				if ($_POST['Copies_Check']) {		
					echo "  Copies>1 <br></>";
					if ($PrevModelCriteria != "1") {
						//echo "only copies";
						$PrevModelCriteria="1";
						$query_select= "SELECT Matchbox_Collection.Username, Matchbox_Collection.UMID, Matchbox_Collection.VerID, Matchbox_Collection.VarID, Matchbox_Collection.Copy, Matchbox_Collection.VehCond, Matchbox_Collection.ItemVal,
							Matchbox_Collection.StorLoc, Matchbox_Collection.StorLoc2, Matchbox_Collection.Seller, Matchbox_Collection.PurchDt, Matchbox_Collection.PurchPrice, Matchbox_Collection.SellFlag, 
							Matchbox_Versions.UMID, Matchbox_Versions.VerID, Matchbox_Versions.VerName, Matchbox_Versions.FAB_No, Matchbox_Versions.Master_Mack_No,
							Matchbox_Variations.UMID, Matchbox_Variations.VerID, Matchbox_Variations.VarID, Matchbox_Variations.Mack_No, Matchbox_Variations.ManufLoc, Matchbox_Variations.FWhCd, Matchbox_Variations.RWhCd, Matchbox_Variations.WindowColor, Matchbox_Variations.InteriorColor,
							Matchbox_Variations.Base1Material, Matchbox_Variations.Base1Color, Matchbox_Variations.ColorVar, Matchbox_Variations.TempaVar, Matchbox_Variations.Det1Typ, Matchbox_Variations.Det1Var, Matchbox_Variations.Det2Typ,
							Matchbox_Variations.Det2Var, Matchbox_Variations.Det3Typ, Matchbox_Variations.Det3Var
							 FROM Matchbox_Collection
							 JOIN Matchbox_Versions ON Matchbox_Collection.VerID=Matchbox_Versions.VerID
							 JOIN Matchbox_Variations on Matchbox_Collection.VarID=Matchbox_Variations.VarID
							WHERE Username = '$User' AND (Matchbox_Collection.Copy>1) AND Matchbox_Collection.Coll_InactiveFlg=0";			
					} else {
					    //echo "copies plus others";
					    $PrevModelCriteria="1";
					    $query_select .= " AND Matchbox_Collection.Copy>1";
					    //echo $query;
					    //exit;
					}
				}
				if ($_POST['Sell_Check']) {
					echo "To Sell  <br></>";
					if ($PrevModelCriteria != "1") {
					    //echo "only to sell";
					    $PrevModelCriteria="1";
						$query_select= "SELECT Matchbox_Collection.Username, Matchbox_Collection.UMID, Matchbox_Collection.VerID, Matchbox_Collection.VarID, Matchbox_Collection.Copy, Matchbox_Collection.VehCond, Matchbox_Collection.ItemVal,
							Matchbox_Collection.StorLoc, Matchbox_Collection.StorLoc2, Matchbox_Collection.Seller, Matchbox_Collection.PurchDt, Matchbox_Collection.PurchPrice, Matchbox_Collection.SellFlag, 
							Matchbox_Versions.UMID, Matchbox_Versions.VerID, Matchbox_Versions.VerName, Matchbox_Versions.FAB_No, Matchbox_Versions.Master_Mack_No,
							Matchbox_Variations.UMID, Matchbox_Variations.VerID, Matchbox_Variations.VarID,  Matchbox_Variations.Mack_No, Matchbox_Variations.ManufLoc, Matchbox_Variations.FWhCd, Matchbox_Variations.RWhCd, Matchbox_Variations.WindowColor, Matchbox_Variations.InteriorColor,
							Matchbox_Variations.Base1Material, Matchbox_Variations.Base1Color, Matchbox_Variations.ColorVar, Matchbox_Variations.TempaVar, Matchbox_Variations.Det1Typ, Matchbox_Variations.Det1Var, Matchbox_Variations.Det2Typ,
							Matchbox_Variations.Det2Var, Matchbox_Variations.Det3Typ, Matchbox_Variations.Det3Var
							 FROM Matchbox_Collection
							 JOIN Matchbox_Versions ON Matchbox_Collection.VerID=Matchbox_Versions.VerID
							 JOIN Matchbox_Variations on Matchbox_Collection.VarID=Matchbox_Variations.VarID
							WHERE Username = '$User' AND (Matchbox_Collection.SellFlag =\"1\") AND Matchbox_Collection.Coll_InactiveFlg=0";				
					} else {
					    
					    $PrevModelCriteria="1";
					    $query_select.= " AND Matchbox_Collection.SellFlag =\"1\"";
					
					}				
				}
				if ($_POST['Cond_Check']) {
					$VehCond=$_POST['VehCond'];
					echo "  Condition: <".$VehCond." <br></>";

					if (is_numeric($VehCond)) {
						//FInd any model w cond numerically less than that chosen
						echo "seen as numeric";
						if ($PrevModelCriteria != "1") {
							$PrevModelCriteria="1";
							$query_select= "SELECT Matchbox_Collection.Username, Matchbox_Collection.UMID, Matchbox_Collection.VerID, Matchbox_Collection.VarID, Matchbox_Collection.Copy,  Matchbox_Collection.VehCond, Matchbox_Collection.ItemVal,
							Matchbox_Collection.StorLoc, Matchbox_Collection.StorLoc2, Matchbox_Collection.Seller, Matchbox_Collection.PurchDt, Matchbox_Collection.PurchPrice, Matchbox_Collection.SellFlag, 
							Matchbox_Versions.UMID, Matchbox_Versions.VerID, Matchbox_Versions.VerName, Matchbox_Versions.FAB_No, Matchbox_Versions.Master_Mack_No,
							Matchbox_Variations.UMID, Matchbox_Variations.VerID, Matchbox_Variations.VarID,  Matchbox_Variations.Mack_No, Matchbox_Variations.ManufLoc, Matchbox_Variations.FWhCd, Matchbox_Variations.RWhCd, Matchbox_Variations.WindowColor, Matchbox_Variations.InteriorColor,
							Matchbox_Variations.Base1Material, Matchbox_Variations.Base1Color, Matchbox_Variations.ColorVar, Matchbox_Variations.TempaVar, Matchbox_Variations.Det1Typ, Matchbox_Variations.Det1Var, Matchbox_Variations.Det2Typ,
							Matchbox_Variations.Det2Var, Matchbox_Variations.Det3Typ, Matchbox_Variations.Det3Var
							 FROM Matchbox_Collection
							 JOIN Matchbox_Versions ON Matchbox_Collection.VerID=Matchbox_Versions.VerID
							 JOIN Matchbox_Variations on Matchbox_Collection.VarID=Matchbox_Variations.VarID
							WHERE Username = '$User' AND ABS(Matchbox_Collection.VehCond) <= '$VehCond' AND Matchbox_Collection.VehCond !=\"N/A\" AND Matchbox_Collection.Coll_InactiveFlg=0";	
						} else {
							$PrevModelCriteria="1";
	   					        $query_select.= " AND ABS(Matchbox_Collection.VehCond) <= '$VehCond' AND Matchbox_Collection.VehCond !=\"N/A\"";
						}						
					} else {
						echo "alpha";
	
						if ($PrevModelCriteria != "1") {
							//first part of select wo the cond req
							$query_select= "SELECT Matchbox_Collection.Username, Matchbox_Collection.UMID, Matchbox_Collection.VerID, Matchbox_Collection.VarID, Matchbox_Collection.Copy,  Matchbox_Collection.VehCond, Matchbox_Collection.ItemVal,
								Matchbox_Collection.StorLoc, Matchbox_Collection.StorLoc2, Matchbox_Collection.Seller, Matchbox_Collection.PurchDt, Matchbox_Collection.PurchPrice, Matchbox_Collection.SellFlag, 
								Matchbox_Versions.UMID, Matchbox_Versions.VerID, Matchbox_Versions.VerName, Matchbox_Versions.FAB_No, Matchbox_Versions.Master_Mack_No,
								Matchbox_Variations.UMID, Matchbox_Variations.VerID, Matchbox_Variations.VarID,  Matchbox_Variations.Mack_No, Matchbox_Variations.ManufLoc, Matchbox_Variations.FWhCd, Matchbox_Variations.RWhCd, Matchbox_Variations.WindowColor, Matchbox_Variations.InteriorColor,
								Matchbox_Variations.Base1Material, Matchbox_Variations.Base1Color, Matchbox_Variations.ColorVar, Matchbox_Variations.TempaVar, Matchbox_Variations.Det1Typ, Matchbox_Variations.Det1Var, Matchbox_Variations.Det2Typ,
								Matchbox_Variations.Det2Var, Matchbox_Variations.Det3Typ, Matchbox_Variations.Det3Var
								 FROM Matchbox_Collection
								 JOIN Matchbox_Versions ON Matchbox_Collection.VerID=Matchbox_Versions.VerID
								 JOIN Matchbox_Variations on Matchbox_Collection.VarID=Matchbox_Variations.VarID";
							if ($VehCond=="MIB" or $VehCond=="Mint") {
								$query_select.=" WHERE Username = '$User' AND Matchbox_Collection.VehCond !=\"N/A\" AND Matchbox_Collection.Coll_InactiveFlg=0";
							} elseif ($VehCond=="NM") {
								$query_select.=" WHERE Username = '$User' AND (Matchbox_Collection.VehCond IN (\"NM\",\"Excellent\",\"Very Good\",\"Good\",\"Fair\",\"Poor\",\"Junk\"))
								AND Matchbox_Collection.Coll_InactiveFlg=0";
							} elseif ($VehCond=="Excellent") {
								$query_select.=" WHERE Username = '$User' AND (Matchbox_Collection.VehCond IN (\"Excellent\",\"Very Good\",\"Good\",\"Fair\",\"Poor\",\"Junk\"))
								AND Matchbox_Collection.Coll_InactiveFlg=0";
							} elseif ($VehCond=="Very Good") {
								$query_select.=" WHERE Username = '$User' AND (Matchbox_Collection.VehCond IN (\"Very Good\",\"Good\",\"Fair\",\"Poor\",\"Junk\"))
								AND Matchbox_Collection.Coll_InactiveFlg=0";
							} elseif ($VehCond=="Good") {
								$query_select.=" WHERE Username = '$User' AND (Matchbox_Collection.VehCond IN (\"Good\",\"Fair\",\"Poor\",\"Junk\"))
								AND Matchbox_Collection.Coll_InactiveFlg=0";
							} elseif ($VehCond=="Fair") {
								$query_select.=" WHERE Username = '$User' AND (Matchbox_Collection.VehCond IN (\"Fair\",\"Poor\",\"Junk\"))
								AND Matchbox_Collection.Coll_InactiveFlg=0";
							} elseif ($VehCond=="Poor") {
								$query_select.=" WHERE Username = '$User' AND (Matchbox_Collection.VehCond IN (\"Poor\",\"Junk\"))
								AND Matchbox_Collection.Coll_InactiveFlg=0";
							} elseif ($VehCond=="Junk") {	
								$query_select.=" WHERE Username = '$User' AND (Matchbox_Collection.VehCond IN (\"Junk\"))
								AND Matchbox_Collection.Coll_InactiveFlg=0";					
							} elseif ($VehCond=="N/A") {
								$query_select.=" WHERE Username = '$User' AND (Matchbox_Collection.VehCond IN (\"N/A\"))
								AND Matchbox_Collection.Coll_InactiveFlg=0";
							}	
						} else {
							if ($VehCond=="MIB" or $VehCond=="Mint") {
								$query_select.=" AND Matchbox_Collection.VehCond !=\"N/A\"";								
							} elseif ($VehCond=="NM") {
								$query_select.=" AND (Matchbox_Collection.VehCond IN (\"NM\",\"Excellent\",\"Very Good\",\"Good\",\"Fair\",\"Poor\",\"Junk\"))";
							} elseif ($VehCond=="Excellent") {
								$query_select.=" AND (Matchbox_Collection.VehCond IN (\"Excellent\",\"Very Good\",\"Good\",\"Fair\",\"Poor\",\"Junk\"))";								
							} elseif ($VehCond=="Very Good") {
								$query_select.=" AND (Matchbox_Collection.VehCond IN (\"Very Good\",\"Good\",\"Fair\",\"Poor\",\"Junk\"))";								
							} elseif ($VehCond=="Good") {
								$query_select.=" AND (Matchbox_Collection.VehCond IN (\"Good\",\"Fair\",\"Poor\",\"Junk\"))";								
							} elseif ($VehCond=="Fair") {
								$query_select.=" AND (Matchbox_Collection.VehCond IN (\"Fair\",\"Poor\",\"Junk\"))";								
							} elseif ($VehCond=="Poor") {
								$query_select.=" AND (Matchbox_Collection.VehCond IN (\"Poor\",\"Junk\"))";								
							} elseif ($VehCond=="Junk") {	
								$query_select.=" AND (Matchbox_Collection.VehCond IN (\"Junk\"))";													
							} elseif ($VehCond=="N/A") {
								$query_select.=" WHERE Username = '$User' AND (Matchbox_Collection.VehCond IN (\"N/A\"))
								AND Matchbox_Collection.Coll_InactiveFlg=0";
							}	
							
						}
					}
				}
			}
		//SORT section
			//SORT 1
			$Sort1= $_POST['Sort1'];
			if ($Sort1=="UMID") {
				$query_sort=" ORDER BY Matchbox_Collection.VarID ASC";					
			} elseif ($Sort1=="MAN") {
				$query_sort=" ORDER BY Matchbox_Versions.FAB_No ASC";
			} elseif ($Sort1=="Mack") {
				$query_sort=" ORDER BY Matchbox_Versions.Master_Mack_No ASC";
			} elseif ($Sort1=="Location") {
				$query_sort=" ORDER BY Matchbox_Collection.StorLoc ASC, Matchbox_Collection.StorLoc2 ASC";
			} elseif ($Sort1=="Seller") {
				$query_sort=" ORDER BY Matchbox_Collection.Seller ASC";
			} elseif ($Sort1=="MdlValue") {
				$query_sort=" ORDER BY Matchbox_Collection.ItemVal ASC";
			} elseif ($Sort1=="PurchPrice") {
				$query_sort=" ORDER BY Matchbox_Collection.PurchPrice ASC";	
			} elseif ($Sort1=="PurchDt") {	
				$query_sort=" ORDER BY Matchbox_Collection.PurchDt ASC";
			}	
			
			//SORT 2
			$Sort2= $_POST['Sort2'];
			if ($Sort2 =="UMID") {
				$query_sort.=", Matchbox_Collection.VarID ASC";
			} elseif ($Sort2=="MAN") {
				$query_sort.=", Matchbox_Versions.FAB_No ASC";					
			} elseif ($Sort2=="Mack") {
				$query_sort.=", Matchbox_Versions.Master_Mack_No ASC";				
			} elseif ($Sort2=="Location") {
				$query_sort.=", Matchbox_Collection.StorLoc ASC, Matchbox_Collection.StorLoc2 ASC";					
			} elseif ($Sort2=="Seller") {
				$query_sort.=", Matchbox_Collection.Seller ASC";					
			} elseif ($Sort2=="MdlValue") {
				$query_sort.=", Matchbox_Collection.ItemVal ASC";					
			} elseif ($Sort2=="PurchPrice") {
				$query_sort.=", Matchbox_Collection.PurchPric ASC";						
			} elseif ($Sort2=="PurchDt") {
				$query_sort.=", Matchbox_Collection.PurchDt ASC";					
			}	
			
			
		//COMBINE SEARCH PIECES
		$query_full=$query_select.$query_sort;
		//echo $query_full;
		
		$result=0;
		$rows=0;
		
		$result= mysql_query($query_full);
		
		
		if (!$result) {
			echo "<h5>You have no models in your collection that match these criteria.</h5>";
			//exit;
		} else {
			
				//DISPLAY COLUMN HEADERS
			?>
			<div id="overflow">
        
				<table>
					<thead>
					<tr>
						<td>Photo</td>
						<td>Variation</td>
						<td>MAN</td>
						<td>Mack</td>
						<td>Name</td>
						<td>Copy</td>
						<td>Condition</td>
						<td>Seller</td>
						<td>Loc1</td>
						<td>Loc2</td>
						<td>Value</td>
						<td>Price</td>
						<td>Purch Dt</td>
					</tr>
					</thead>            
				
					<?php
					//DISPLAY RESULTS
					$rows = mysql_num_rows($result);
					echo "No. of matches: ".$rows."<br></br>";
					if ($Sort2==$Sort1){
						echo "Sort by: ".$Sort1."<br></br>";	
					} else {	
						echo "Sort by: ".$Sort1.", ".$Sort2."<br></br>";
					}	
					for ($i=1; $i<=$rows; $i++) {
						$row = mysql_fetch_array($result);
							
						echo "<tr>";  
							 
							$picture= IMAGE_URL . $row["VarID"]."_1.jpg";
							$picture_loc=IMAGE_PATH. $row["VarID"]."_1.jpg";
								
							if (file_exists($picture_loc)) {
								//echo "picture exists";
								echo "<td><img src=" . $picture . " /></td>";
							} else {
								echo "<td><img src=" . DEFAULT_IMAGE . " /></td>";	
							}
							
							echo "<td>" . $row['VarID'] . "</td>"; 
							echo "<td>" . $row['FAB_No'] . "</td>";
							echo "<td>" . $row['Mack_No'] . "</td>";
							echo "<td>" . $row['VerName'] . "</td>";
							echo "<td>" . $row['Copy'] . "</td>";
							echo "<td>" . $row['VehCond'] . "</td>";
							echo "<td>" . $row['Seller'] . "</td>";
							echo "<td>" . $row['StorLoc'] . "</td>";
							echo "<td>" . $row['StorLoc2'] . "</td>";
							echo "<td>" . $row['ItemVal'] . "</td>";
							echo "<td>" . $row['PurchPrice'] . "</td>";
							echo "<td>" . $row['PurchDt'] . "</td>";
							
						echo "</tr>";
					}
				?>	
				</table>
			
			</div>
		
			<a id="printThis" class="button dark" href="javascript:window.print()">Print this Report</a>
			
		<?php	
		}
		?>
            
	</div>
 </div>       
