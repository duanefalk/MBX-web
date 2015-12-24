<?php
	session_start();
	require_once("includes/db_connection.php");
	$pageTitle = "Collection Wishlist";
	include("includes/header.php");
	include("includes/functions.php");
?>

<div class="row">
	<div class="large-12 columns">
        <a href="Collection_Reports.php" class="button dark">Return to Collection Reports Menu</a>
	<a href="index.php" class="button dark">Return to Main Page</a>

        <h2>Wishlist for <?php echo $_SESSION["Username"]; ?></h2>

        <?php
			$User=$_SESSION["Username"];
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
						<td>Origin</td>
						<td>F Wh</td>
						<td>R Wh</td>
						<td>Window</td>
						<td>Interior</td>
						<td>Finish</td>
						<td>Color Var</td>
						<td>Tampo Var</td>
						<td>Base Mat</td>
						<td>Base Color</td>
						<td>Detail Vars</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
		            </tr>
				</thead>
	            
	            <?php
				
	            	$result = mysql_query("SELECT Matchbox_User_Wishlist.VarID, Matchbox_User_Wishlist.VerID, Matchbox_Versions.VerID, Matchbox_Versions.Master_Mack_No, Matchbox_Versions.FAB_No, Matchbox_Versions.Vername, 
					      Matchbox_Variations.ManufLoc, Matchbox_Variations.FWhCd, Matchbox_Variations.RWhCd, Matchbox_Variations.WindowColor, Matchbox_Variations.InteriorColor, Matchbox_Variations.Finish, Matchbox_Variations.ColorVar, Matchbox_Variations.TempaVar,
					      Matchbox_Variations.Base1Material, Matchbox_Variations.Base1Color, Matchbox_Variations.Det1Typ, Matchbox_Variations.Det1Var, Matchbox_Variations.Det2Typ, Matchbox_Variations.Det2Var,
					      Matchbox_Variations.Det3Typ, Matchbox_Variations.Det3Var, Matchbox_Variations.Det4Typ, Matchbox_Variations.Det4Var, Matchbox_Variations.Det5Typ, Matchbox_Variations.Det5Var
					      FROM Matchbox_User_Wishlist
					      JOIN Matchbox_Versions ON Matchbox_User_Wishlist.VerID=Matchbox_Versions.VerID
					      JOIN Matchbox_Variations ON Matchbox_User_Wishlist.VarID=Matchbox_Variations.VarID
					      WHERE Matchbox_User_Wishlist.Username='$User' ORDER BY Matchbox_User_Wishlist.VarID ASC");
					      
					      
			     
				if ($result) {
					$rows = mysql_num_rows($result);
					//echo "rows: " . $rows;
					
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
							echo "<td>" . $row['Master_Mack_No'] . "</td>";
							echo "<td>" . $row['Vername'] . "</td>";
							echo "<td>" . $row['ManufLoc'] . "</td>";
							echo "<td>" . $row['FWhCd'] . "</td>";
							echo "<td>" . $row['RWhCd'] . "</td>";
							echo "<td>" . $row['WindowColor'] . "</td>";
							echo "<td>" . $row['InteriorColor'] . "</td>";
							echo "<td>" . $row['Finish'] . "</td>";
							echo "<td>" . $row['ColorVar'] . "</td>";
							echo "<td>" . $row['TempaVar'] . "</td>";
							echo "<td>" . $row['Base1Material'] . "</td>";
							echo "<td>" . $row['Base1Color'] . "</td>";
							echo "<td>" . $row['Det1Typ'] . "</td>";
							echo "<td>" . $row['Det1Var'] . "</td>";
							echo "<td>" . $row['Det2Typ'] . "</td>";
							echo "<td>" . $row['Det2Var'] . "</td>";
							echo "<td>" . $row['Det3Typ'] . "</td>";
							echo "<td>" . $row['Det3Var'] . "</td>";
							echo "<td>" . $row['Det4Typ'] . "</td>";
							echo "<td>" . $row['Det4Var'] . "</td>";
							echo "<td>" . $row['Det5Typ'] . "</td>";
							echo "<td>" . $row['Det5Var'] . "</td>";
							echo "<td>" . $row['Series'] . "</td>";
							echo "<td>" . $row['RelYr'] . "</td>";
							echo "<td>" . $row['SeriesID'] . "</td>";
						
						echo "</tr>";
					} ?>
			</table>
			
			<?php } else { ?>
				</table>
				<p>No items in your wishlist</p>
			<?php } ?>
	
		</div>
		
		<a id="printThis" class="button dark" href="javascript:window.print()">Print this Report</a>
	</div>
</div>


<?php include("includes/footer.php"); ?>
