<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>
<table id="structure">
<tr>
	<td id="navigation">
		<a href="Add_Menu.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Add New Record</p></a>
		<a href="index.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Main Page</p></a>			
	</td>
	<td id="page">
		<h2>Add a Wheel Variation</h2>
		<br />
			<form action="Add_Wheel_Process.php" method="post">
			<p>Wheel Type: </p>
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
				<select name="WheelTyp">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
					}
					mysql_free_result($result);
				?>
				</select>	
			<br />
			<p>Wheel Code:     	  <input type="text" name="WheelCod" value="" size="20" id="WheelCod"</p>
			<p>Wheel Description:     <input type="text" name="WheelDescr" value="" size="60" id="WheelDescr"</p>
			<p>Wheel Photo Path:      <input type="text" name="WheelPhotoPath" value="" size="60" id="WheelPhotoPath"</p>
			<p>Wheel Photo Name:      <input type="text" name="WheelPhotoName" value="" size="60" id="WheelPhotoName"</p>
			<p>Wheel Photo Reference: </p>
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
				<select name="WheelPhotoRef">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["RefCode"].'">'.$row["RefCode"].'</option'."<br />";
					}	
				?>
				</select>						
			
			<input type="submit"  name="submit" value="Submit"/>
			</form>			
			<a href="Add_Wheel_Form.php">Cancel</a>
		<p></p>	
	</td>
</tr>
</table>
<?php require("includes/footer.php"); ?>