<?php
// we must never forget to start the session
session_start();
?>
<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>


<div class="row">
	<div class="large-12 columns">
            <a href="Collection_Reports.php" class="button dark">Return to Collection Reports Menu</a>
            <a href="index.php" class="button dark">Return to Main Page</a>

                <h2>Wishlist for <?php echo $_SESSION["Username"]; ?></h2>
            <?php
		$User=$_SESSION["Username"];
                echo "<table border='1' style='border-collapse: collapse;border-color: silver;'>";  
                echo "<tr style='font-weight: bold;'>";  
		echo "<td width='400' align='center'>Photo</td>";
                echo "<td width='200' align='center'>Variations</td>";
                echo "<td width='200' align='center'>MAN</td>";
		echo "<td width='200' align='center'>Mack</td>";
		echo "<td width='200' align='center'>Name</td>";
		echo "<td width='200' align='center'>Origin</td>";
		echo "<td width='200' align='center'>F Wh</td>";
		echo "<td width='200' align='center'>R Wh</td>";
		echo "<td width='200' align='center'>Window</td>";
		echo "<td width='200' align='center'>Interior</td>";
		echo "<td width='200' align='center'>Finish</td>";
		echo "<td width='200' align='center'>Color Var</td>";
		echo "<td width='200' align='center'>Tampo Var</td>";
		echo "<td width='200' align='center'>Base Mat</td>";
		echo "<td width='200' align='center'>Base Color</td>";
		echo "<td width='200' align='center'>Detail Vars</td>";
		echo "<td width='200' align='center'></td>";
		echo "<td width='200' align='center'></td>";
		echo "<td width='200' align='center'></td>";
		echo "<td width='200' align='center'></td>";
		echo "<td width='200' align='center'></td>";
		echo "<td width='200' align='center'></td>";
		echo "<td width='200' align='center'></td>";
		echo "<td width='200' align='center'></td>";
		echo "<td width='200' align='center'></td>";

                echo "</tr>";
			
                $result = mysql_query("SELECT Matchbox_User_Wishlist.VarID, Matchbox_User_Wishlist.VerID, Matchbox_Versions.VerID, Matchbox_Versions.Master_Mack_No, Matchbox_Versions.FAB_No, Matchbox_Versions.Vername,
				      Matchbox_Variations.ManufLoc, Matchbox_Variations.FWhCd, Matchbox_Variations.RWhCd, Matchbox_Variations.WindowColor, Matchbox_Variations.InteriorColor, Matchbox_Variations.Finish, Matchbox_Variations.ColorVar, Matchbox_Variations.TempaVar,
				      Matchbox_Variations.Base1Material, Matchbox_Variations.Base1Color, Matchbox_Variations.Det1Typ, Matchbox_Variations.Det1Var, Matchbox_Variations.Det2Typ, Matchbox_Variations.Det2Var,
				      Matchbox_Variations.Det3Typ, Matchbox_Variations.Det3Var, Matchbox_Variations.Det4Typ, Matchbox_Variations.Det4Var, Matchbox_Variations.Det5Typ, Matchbox_Variations.Det5Var
				      FROM Matchbox_User_Wishlist
				      JOIN Matchbox_Versions ON Matchbox_User_Wishlist.VerID=Matchbox_Versions.VerID
				      JOIN Matchbox_Variations ON Matchbox_User_Wishlist.VarID=Matchbox_Variations.VarID
				      WHERE Matchbox_User_Wishlist.Username='$User' ORDER BY Matchbox_User_Wishlist.VarID ASC");
		     
		if ($result) {
			$rows= mysql_num_rows($result);
			echo "rows: ".$rows;
			for ($i=1; $i<=$rows; $i++) {
				$row = mysql_fetch_array($result);
				echo "<tr>";  
				 
				$picture= IMAGE_URL . $row["VarID"]."_1.jpg";
				$picture_loc=IMAGE_PATH. $row["VarID"]."_1.jpg";
				if (file_exists($picture_loc)) {
				//echo "picture exists";
					echo "<td align='center' width='400'><img src=" . $picture . " /></td>";
					//echo "<td align='center' width='200'>".$picture."</td>";
				} else {
					echo "<td align='center' width='200'></td>";

				}
				echo "<td align='center' width='200'>" . $row['VarID'] . "</td>"; 
				echo "<td align='center' width='200'>" . $row['FAB_No'] . "</td>";
				echo "<td align='center' width='200'>" . $row['Master_Mack_No'] . "</td>";
				echo "<td align='center' width='200'>" . $row['Vername'] . "</td>";
				echo "<td align='center' width='200'>" . $row['ManufLoc'] . "</td>";
				echo "<td align='center' width='200'>" . $row['FWhCd'] . "</td>";
				echo "<td align='center' width='200'>" . $row['RWhCd'] . "</td>";
				echo "<td align='center' width='200'>" . $row['WindowColor'] . "</td>";
				echo "<td align='center' width='200'>" . $row['InteriorColor'] . "</td>";
				echo "<td align='center' width='200'>" . $row['Finish'] . "</td>";
				echo "<td align='center' width='200'>" . $row['ColorVar'] . "</td>";
				echo "<td align='center' width='200'>" . $row['TempaVar'] . "</td>";
				echo "<td align='center' width='200'>" . $row['Base1Material'] . "</td>";
				echo "<td align='center' width='200'>" . $row['Base1Color'] . "</td>";
				echo "<td align='center' width='200'>" . $row['Det1Typ'] . "</td>";
				echo "<td align='center' width='200'>" . $row['Det1Var'] . "</td>";
				echo "<td align='center' width='200'>" . $row['Det2Typ'] . "</td>";
				echo "<td align='center' width='200'>" . $row['Det2Var'] . "</td>";
				echo "<td align='center' width='200'>" . $row['Det3Typ'] . "</td>";
				echo "<td align='center' width='200'>" . $row['Det3Var'] . "</td>";
				echo "<td align='center' width='200'>" . $row['Det4Typ'] . "</td>";
				echo "<td align='center' width='200'>" . $row['Det4Var'] . "</td>";
				echo "<td align='center' width='200'>" . $row['Det5Typ'] . "</td>";
				echo "<td align='center' width='200'>" . $row['Det5Var'] . "</td>";
				echo "<td align='center' width='200'>" . $row['Series'] . "</td>";
				echo "<td align='center' width='200'>" . $row['RelYr'] . "</td>";
				echo "<td align='center' width='200'>" . $row['SeriesID'] . "</td>";
				echo "</tr>";
			}
			echo "</table>";
		} else {
			echo "</table>"; 
			echo "No items in your wishlist";
		}
		
            ?>
	</div>
 </div>       



<?php include("includes/footer.php"); ?>
