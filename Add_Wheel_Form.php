<?php 
	require_once("includes/db_connection.php");
	require_once("includes/functions.php");
	$pageTitle = "Add a Wheel Variation";
	$pageDescription = "Add a new Wheel Variation to the Matchbox University collector's database.";
	include("includes/header.php");
?>

<div class="row">
	<div class="large-12 columns">
		
		<h2>Add a Wheel Variation</h2>
	
		<form action="Add_Wheel_Process.php" method="post">
			<label for="WheelTyp">Wheel Type:</label>
			<?php
				$query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%WheelType%'");								
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
			<select id="WheelTyp" name="WheelTyp">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
					}
					mysql_free_result($result);
				?>
			</select>
			
			<label for="WheelCod">Wheel Code:</label>
			<input type="text" name="WheelCod" value="" size="20" id="WheelCod">
			
			<label for="WheelDescr">Wheel Description:</label>
			<input type="text" name="WheelDescr" value="" size="60" id="WheelDescr">
			
			<label for="WheelPhotoPath">Wheel Photo Path:</label>
			<input type="text" name="WheelPhotoPath" value="" size="60" id="WheelPhotoPath">
			
			<label for="WheelPhotoName">Wheel Photo Name:</label>
			<input type="text" name="WheelPhotoName" value="" size="60" id="WheelPhotoName">
			
			<label for="WheelPhotoRef">Wheel Photo Reference:</label>
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
			<select name="WheelPhotoRef" id="WheelPhotoRef">
			<?php
				for ($i=1; $i<=$rows_count; $i++) {
					$row=mysql_fetch_array($result);
					echo '<option value="'.$row["RefCode"].'">'.$row["RefCode"].'</option'."<br />";
				}	
			?>
			</select>						
			
			<div class="row">
				<div class="large-3 small-6 columns">
					<input type="submit" class="button dark" name="submit" value="Submit"/>
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
		<a href="Add_Menu.php">Add New Record</a>
	</div>
</div>
		
<?php require("includes/footer.php"); ?>