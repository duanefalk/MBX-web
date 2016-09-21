<?php 
	require_once("includes/db_connection.php");
	require_once("includes/functions.php");
	$pageTitle = "Add a Version";
	$pageDescription = "Add a new Version to the Matchbox University collector's database.";
	include("includes/header.php");
?>

<div class="row">
	<div class="large-12 columns">
		<h2>Add a Version</h2>
		<form action="Add_Version_Process.php" method="post">
			
			<label for="UMID">UMID:</label>
			<input type="text" name="UMID" value="" size="6" id="UMID">
			
			<label for="VERID1">Version ID:</label>
			<input type="text" name="VERID1" value="" size="10" id="VERID1">
			
			<label for="FAB_No">MAN/FAB #:</label>
			<input type="text" name="FAB_No" value="" size="10" id="FAB_No">
			
			<label for="Master_Mack_No">Master Mack #:</label>
			<input type="text" name="Master_Mack_No" value="" size="12" id="Master_Mack_No">			
			
			<label for="VerName">Version Name:</label>
			<input type="text" name="VerName" value="" size="60" id="VerName">			
			
			<label for="VerYrFirstRel">Version Release Year:</label>
			<input type="text" name="VerYrFirstRel" value="" size="4" id="VerYrFirstRel">			
			
			<label for="VerType">Version Type:</label>
			<?php
				$query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%VersionType%'");								
				$result=0;
				$rows_count=0;									
				$result = mysql_query($query);
				if (!result) {
					echo "Database query failed";
				}
				else {}
				$rows_count= mysql_num_rows($result);
			?>
			<select name="VerType" id="VerType">
			<?php
				for ($i=1; $i<=$rows_count; $i++) {
					$row=mysql_fetch_array($result);
					echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option>';
				}	
			?>
			</select>
			
			
			<label for="CodeLvl">Code Level:</label>
			<?php
				$query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%CodeLevel%'");								
				$result=0;
				$rows_count=0;									
				$result = mysql_query($query);
				if (!result) {
					echo "Database query failed";
				}
				else {}
				$rows_count= mysql_num_rows($result);
			?>
			<select name="CodeLvl" id="CodeLvl">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option>';
					}	
				?>
			</select>
			
			<label for="SecManuf">Secondary Manufacturer:</label>
			<?php
				$query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%SecondManufacturer%'");								
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
			<select name="SecManuf" id="SecManuf">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option>';
					}	
				?>
			</select>		

			<label for="BodyColor">Body Color(s):</label>
			<input type="text" name="BodyColor" value="" size="40" id="BodyColor">
			
			<label for="TempaDesign">Tampo Design:</label>
			<textarea name="TempaDesign" id="TempaDesign" cols="45" rows="4"></textarea>	
			
			<label for="TempaText">Tampo Text:</label>
			<textarea name="TempaText" id="TempaText" cols="45" rows="4"></textarea>
			
			<label for="VerAttachments">Version Attachments:</label>
			<input type="text" name="VerAttachments" value="" size="60" id="VerAttachments">
			
			<label for="VerPhoto1Ref">Version Photo 1 Reference:</label>
			<?php
				$query=("SELECT * FROM Matchbox_References ORDER BY RefCode ASC");								
				$result=0;
				$rows_count=0;									
				$result = mysql_query($query);
				if (!result) {
					echo "Database query failed";
				}
				else {}
				$rows_count= mysql_num_rows($result);
			?>
			<select name="VerPhoto1Ref" id="VerPhoto1Ref">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["RefCode"].'">'.$row["RefCode"].'</option>';
					}	
				?>
			</select>
				
			<label for="VerPhoto2Ref">Version Photo 2 Reference:</label>
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
			<select name="VerPhoto2Ref" id="VerPhoto2Ref">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["RefCode"].'">'.$row["RefCode"].'</option>';
					}	
				?>
			</select>	
			
			<label for="VerComm">Version Comment:</label>
			<textarea name="VerComm" id="VerComm" cols="45" rows="4"></textarea>
	
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
	
<?php require("includes/footer.php"); ?>