<?php 
	require_once("includes/db_connection.php");
	require_once("includes/functions.php");
	$pageTitle = "Add a Package Type";
	$pageDescription = "Add a new Package Type to the Matchbox University collector's database.";
	include("includes/header.php");
?>

<div class="row">
	<div class="large-12 columns">
		<h2>Add a Package Type</h2>
		<form action="Add_Package_Type_Process.php" method="post">
			<label for="PkgVarCode">Package Code:</label>
			<input type="text" name="PkgVarCode" value="" size="20" id="PkgVarCode">
			
			<label for="PkgType">Package Type:</label>
			<?php
				$query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%PkgType%'");								
				$result=0;
				$rows_count=0;									
				$result = mysql_query($query);
				if (!result) {
					echo "Database query failed";
				}
				else {}
				$rows_count= mysql_num_rows($result);
			?>
			<select name="PkgType" id="PkgType">
			<?php
				for ($i=1; $i<=$rows_count; $i++) {
					$row=mysql_fetch_array($result);
					echo '<option value="' . $row["ValueListEntry"] . '">' . $row["ValueListEntry"] . '</option>';
				}	
			?>
			</select>
			
			<label for="PkgTypeYrs">Years of Use:</label>
			<input type="text" name="PkgTypeYrs" value="" size="9" id="PkgTypeYrs">
			
			<label for="PkgTypeDescr">Description:</label>
			<input type="text" name="PkgTypeDescr" value="" size="40" id="PkgTypeDescr">
			
			<label for="PkgTypePhotoPath">Photo Path:</label>
			<input type="text" name="PkgTypePhotoPath" value="" size="40" id="PkgTypePhotoPath">
			
			<label for="PkgTypePhotoName">Photo Name:</label>
			<input type="text" name="PkgTypePhotoName" value="" size="20" id="PkgTypePhotoName">
			
			<label for="PkgTypePhotoRef">Photo Reference:</label>
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
			<select name="PkgTypePhotoRef" id="PkgTypePhotoRef">
			<?php
				for ($i=1; $i<=$rows_count; $i++) {
					$row=mysql_fetch_array($result);
					echo '<option value="' . $row["RefCode"].'">' . $row["RefCode"] . '</option>';
				}	
			?>
			</select>
			
			<div class="row">
				<div class="large-3 small-6 columns">
					<input type="submit" name="submit" value="Submit" class="button dark" />
				</div>
				<div class="large-3 small-6 columns end">
					<a href="add-menu.php"class="button dark cancel">Cancel</a>
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

<?php require("includes/footer.php"); ?>						 						