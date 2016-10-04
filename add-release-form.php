<?php 
	require_once("includes/db_connection.php");
	require_once("includes/functions.php");
	$pageTitle = "Add a Release";
	$pageDescription = "Add a new Release to the Matchbox University collector's database.";
	include("includes/header.php");
?>

<div class="row">
	<div class="large-12 columns">
		<h2>Add a Release</h2>
		<form action="add-release-process.php" method="post">
			<label for="UMID">UMID:</label>
			<input type="text" name="UMID" value="" size="6" id="UMID">
			
			<label for="VERID1">Version ID:</label>
			<input type="text" name="VERID1" value="" size="10" id="VERID1">
			
			<label for="VARID1">Variation ID:</label>
			<input type="text" name="VARID1" value="" size="13" id="VARID1">
			
			<label for="RELID1">Release ID:</label>
			<input type="text" name="RELID1" value="" size="16" id="RELID1">
			
			<label for="RelYr">Intended Release Year:</label>
			<input type="text" name="RelYr" value="" size="4" id="RelYr">
			
			<label for="CountryOfSale">Country of Sale:</label>
			<?php
				$query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%CountryOfSale%'");								
				$result=0;
				$rows_count=0;									
				$result = mysql_query($query);
				if (!result) {
					echo "Database query failed";
				}
				else {}
				$rows_count= mysql_num_rows($result);
				// echo "Rows COunt: ".$rows_count."<br />";
			?>
			<select name="CountryOfSale" id="CountryOfSale">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option>';
					}	
				?>
			</select>
			
			<label for="Theme">Release Theme:</label>
			<?php
				$query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%ReleaseTheme%' ORDER BY ValueDispOrder ASC");								
				$result=0;
				$rows_count=0;									
				$result = mysql_query($query);
				if (!result) {
					echo "Database query failed";
				}
				else {}
				$rows_count= mysql_num_rows($result);
				// echo "Rows COunt: ".$rows_count."<br />";
			?>
			<select name="Theme" id="Theme">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option>';
					}	
				?>
			</select>
			
			<label for="Line">Release Line:</label>
			<?php
				$query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%Line%' ORDER BY ValueDispOrder ASC");								
				$result=0;
				$rows_count=0;									
				$result = mysql_query($query);
				if (!result) {
					echo "Database query failed";
				}
				else {
					//echo "made connection ".$result."<br />";		
				}
				$rows_count= mysql_num_rows($result);
				// echo "Rows COunt: ".$rows_count."<br />";
			?>
			<select name="Line" id="Line">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option>';
					}	
				?>
			</select>
			
			<label for="Series">Release Series:</label>
			<?php
				$query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%RelSeries%'");								
				$result=0;
				$rows_count=0;									
				$result = mysql_query($query);
				if (!result) {
					echo "Database query failed";
				}
				else {
					//echo "made connection ".$result."<br />";		
				}
				$rows_count= mysql_num_rows($result);
				// echo "Rows COunt: ".$rows_count."<br />";
			?>
			<select name="Series" id="Series">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
					}	
				?>
			</select>
			
			<label for="SeriesID">ID in Series:</label>
			<input type="text" name="SeriesID" value="" size="20" id="SeriesID">
			
			<label for="ShowSeriesID">Show Series ID?:</label>
			<input type="text" name="ShowSeriesID" value="1" size="1" id="ShowSeriesID">
			
			<label for="SubSeries">Subgroup Under Series:</label>
			<input type="text" name="SubSeries" value="" size="40" id="SubSeries">
			
			<label for="SubSeriesID">ID in SubSeries:</label>
			<input type="text" name="SubSeriesID" value="" size="20" id="SubSeriesID">
			
			<label for="ShowSubSeriesID">Show SubSeries ID?:</label>
			<input type="text" name="ShowSubSeriesID" value="1" size="1" id="ShowSubSeriesID">
			
			<label for="MdlNameOnPkg">Model Name on the Package:</label>
			<input type="text" name="MdlNameOnPkg" value="" size="40" id="MdlNameOnPkg">
			
			<label for="PkgName">Name of the Package:</label>
			<input type="text" name="PkgName" value="" size="40" id="PkgName">
			
			<label for="UnitTyp">Unit Size:</label>
			<?php
				$query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%UnitSize%'");								
				$result=0;
				$rows_count=0;									
				$result = mysql_query($query);
				if (!result) {
					echo "Database query failed";
				}
				else {}
				$rows_count= mysql_num_rows($result);
				// echo "Rows COunt: ".$rows_count."<br />";
			?>
			<select name="UnitTyp" id="UnitTyp">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option>';
					}	
				?>
			</select>
			
			<label for="PkgID">Package ID#:</label>
			<input type="text" name="PkgID" value="" size="12" id="PkgID">
			
			<label for="PkgVarCd">Type of Package:</label>
			<?php
				$query=("SELECT PkgVarCode FROM Matchbox_Package_Varieties");								
				$result=0;
				$rows_count=0;									
				$result = mysql_query($query);
				if (!result) {
					echo "Database query failed";
				}
				else {
					//echo "made connection ".$result."<br />";		
				}
				$rows_count= mysql_num_rows($result);
				// echo "Rows COunt: ".$rows_count."<br />";
			?>
			<select name="PkgVarCd" id="PkgVarCd">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["PkgVarCode"].'">'.$row["PkgVarCode"].'</option>';
					}	
				?>
			</select>			
					
			<label for="RelComm">Release Comments:</label>
			<textarea name="RelComm" id="RelComm" cols="45" rows="4"></textarea>
			
			<label for="RelPkgPhotoRef">Package Photo Reference:</label>
			<?php
				$query=("SELECT * FROM Matchbox_References ORDER BY RefCode ASC");								
				$result=0;
				$rows_count=0;									
				$result = mysql_query($query);
				if (!result) {
					echo "Database query failed";
				}
				else {
					//echo "made connection ".$result."<br />";		
				}
				$rows_count= mysql_num_rows($result);
				// echo "Rows COunt: ".$rows_count."<br />";
			?>
			<select name="RelPkgPhotoRef" id="RelPkgPhotoRef">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["RefCode"].'">'.$row["RefCode"].'</option'."<br />";
					}	
				?>
			</select>
			
			<div class="row">
				<div class="large-3 small-6 columns">
					<input type="submit" name="submit" value="Submit" class="button dark" />
				</div>
				<div class="large-3 small-6 columns end">
					<a href="add-menu.php" class="button dark cancel">Cancel</a>
				</div>
			</div>
		</form>
	</div>
</div>
								 						

<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="add-menu.php">Add New Record</a>
	</div>
</div>
			</table>
<?php require("includes/footer.php"); ?>