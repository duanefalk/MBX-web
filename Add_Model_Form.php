<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>
<table id="structure">
<tr>
	<td id="navigation">
		<a href="Add_Menu.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Add New Record</p></a>
		<a href="Main_page.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Main Page</p></a>			
	</td>
	<td id="page">
		<h2>Add a Model</h2>
		<form action="Add_Model_Process.php" method="post">
			<p>UMID:     	  <input type="text" name="UMID" value="" size="6" id="UMID"</p>
			<p>Master Model Name:     	  <input type="text" name="MasterModelName" value="" size="60" id="MasterModelName"</p>
			<p>Model Photo Name:     	  <input type="text" name="ModelPhotoName" value="" size="20" id="ModelPhotoName"</p>
			<p>Model Photo Reference: </p>
				<?php
					$query=("SELECT * FROM Test_Matchbox_References ORDER BY RefCode ASC");								
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
				<select name="ModelPhotoRef">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["RefCode"].'">'.$row["RefCode"].'</option'."<br />";
					}	
				?>
				</select>
			<p>Year First Released:      <input type="text" name="YrFirstProduced" value="" size="4" id="YrFirstProduced"</p>
			<p>Vehicle Type: </p>
				<?php
					$query=("SELECT * FROM Test_Matchbox_Value_Lists WHERE ValueList LIKE '%VehicleType%'");								
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
				<select name="VehicleType">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
					}	
				?>
				</select>
			<p>Additional Vehicle Type: </p>
				<?php
					$query=("SELECT * FROM Test_Matchbox_Value_Lists WHERE ValueList LIKE '%VehicleType%'");						
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
				<select name="VehicleType2">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
					}	
				?>
				</select>
			<p>Scale:     	  <input type="text" name="ModelScale" value="" size="10" id="ModelScale"</p>
			<p>Base Casting Date:     <input type="text" name="BaseCastYr" value="" size="10" id="BaseCastYr"</p>
			<p>Model Comment: </p>
				<!--check the syntax of textarea...
				<textarea id="ModelComment" cols="45" rows="4">			
				</textarea> -->
				<textarea name="ModelComment" cols="45" rows="4">	
				</textarea>
			<p>Similar Models:     </p>
				<textarea name="SimilarModels" cols="45" rows="4">			
				</textarea>
			<p>Make of Model: </p>
				<?php
					$query=("SELECT * FROM Test_Matchbox_Value_lists WHERE ValueList LIKE '%VehMake%'");								
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
					// echo "Rows COunt: ".$rows_count."<br />";
				?>
				<select name="MakeofModel">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
					}	
				?>
				</select>
			<p>Country of Make: </p>
				<?php
					$query=("SELECT * FROM Test_Matchbox_Value_lists WHERE ValueList LIKE '%MakeCountry%'");								
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
					// echo "Rows COunt: ".$rows_count."<br />";
				?>
				<select name="CountryofMake">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
					}	
				?>
				</select>	
			<input type="submit" name="submit" value="Submit"/>
		</form>			
		<a href="Add_Model_Form.php">Cancel</a>						 						
	</td>
</tr>
			</table>
<?php require("includes/footer.php"); ?>