<?php
	require_once("includes/db_connection.php");
	require_once("includes/functions.php");
	$pageTitle = "Add a Model";
	$pageDescription = "Add a new Model to the Matchbox University collector's database.";
	include("includes/header.php");
?>

<div class="row">
	<div class="large-12 columns">
		<h2>Add a Model</h2>
		<form action="Add_Model_Process.php" method="post">
			<label for="UMID">UMID:</label>
			<input type="text" name="UMID" value="" size="6" id="UMID">
			
			<label for="MasterModelName">Master Model Name: </label>
			<input type="text" name="MasterModelName" value="" size="60" id="MasterModelName">
			
			<label for="ModelPhotoName">Model Photo Name: </label>	
			<input type="text" name="ModelPhotoName" value="" size="20" id="ModelPhotoName">
			
			<label for="ModelPhotoRef">Model Photo Reference:</label>	
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
				// echo "Rows Count: ".$rows_count."<br />";
			?>
			<select name="ModelPhotoRef" id="ModelPhotoRef">
			<?php
					for ($i=1; $i<=$rows_count; $i++) {
					$row=mysql_fetch_array($result);
					echo '<option value="'.$row["RefCode"].'">'.$row["RefCode"].'</option>';
				}	
			?>
			</select>
			
			<label for="YrFirstProduced">Year First Released:</label>	
			<input type="text" name="YrFirstProduced" value="" size="4" id="YrFirstProduced">
			
			<label for="VehicleType">Vehicle Type:</label>	
			<?php
				$query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%VehicleType%'");								
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
				// echo "Rows Count: ".$rows_count."<br />";
			?>
			<select name="VehicleType" id="VehicleType">
			<?php
				for ($i=1; $i<=$rows_count; $i++) {
					$row=mysql_fetch_array($result);
					echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option>';
				}	
			?>
			</select>
			<label for="VehicleType2">Additional Vehicle Type:</label>
			<?php
				$query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%VehicleType%'");						
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
				// echo "Rows Count: ".$rows_count."<br />";
			?>
			<select name="VehicleType2" id="VehicleType2">
			<?php
				for ($i=1; $i<=$rows_count; $i++) {
					$row=mysql_fetch_array($result);
					echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option>';
				}	
			?>
			</select>
			
			<label for="ModelScale">Scale:</label>
			<input type="text" name="ModelScale" value="" size="10" id="ModelScale">
			
			<label for="BaseCastYr">Base Casting Date:</label>	
			<input type="text" name="BaseCastYr" value="" size="10" id="BaseCastYr">
			
			<label for="ModelComment">Model Comment:</label>
			<textarea name="ModelComment" id="ModelComment" cols="45" rows="4"></textarea>
			
			<label for="SimilarModels">Similar Models:</label>	
			<textarea name="SimilarModels" id="SimilarModels" cols="45" rows="4"></textarea>
			
			<label for="MakeofModel">Make of Model:</label>	
			<?php
				$query=("SELECT * FROM Matchbox_Value_lists WHERE ValueList LIKE '%VehMake%'");								
				$result=0;
				$rows_count=0;									
				$result = mysql_query($query);
				if (!$result) {
					echo "Database query failed";
				}
				else {
					//echo "made connection ".$result."<br />";		
				}
				$rows_count= mysql_num_rows($result);
				// echo "Rows Count: ".$rows_count."<br />";
			?>
			<select name="MakeofModel" id="MakeofModel">
			<?php
				for ($i=1; $i<=$rows_count; $i++) {
					$row=mysql_fetch_array($result);
					echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option>';
				}	
			?>
			</select>
			
			<label for="CountryofMake">Country of Make:</label>		
			<?php
				$query=("SELECT * FROM Matchbox_Value_lists WHERE ValueList LIKE '%MakeCountry%'");								
				$result=0;
				$rows_count=0;									
				$result = mysql_query($query);
				if (!$result) {
					echo "Database query failed";
				}
				else {
					//echo "made connection ".$result."<br />";		
				}
				$rows_count= mysql_num_rows($result);
				// echo "Rows Count: ".$rows_count."<br />";
			?>
			<select name="CountryofMake" id="CountryofMake">
			<?php
				for ($i=1; $i<=$rows_count; $i++) {
					$row=mysql_fetch_array($result);
					echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
				}	
			?>
			</select>
			
			<div class="row">
				<div class="large-3 small-6 columns">
					<input type="submit" class="button dark" value="Submit"/>
				</div>
				<div class="large-3 small-6 columns end">
					<a class="button dark cancel" href="Add_Menu.php">Cancel</a>
				</div>
			</div>	
		</form>						 						
	</div>
</div>

<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="Add_Menu.php">Return to Add New Record</a>
		<a href="index.php">Return to Main Page</a>		
	</div>
</div>
<?php require("includes/footer.php"); ?>