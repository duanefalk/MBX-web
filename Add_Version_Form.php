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
		<h2>Add a Version</h2>
		<!-- fields:
				UMID
				VERID
				FAB_No
				Master_Mack_No
				VerName
				VerYrFirstRel
				VerTyp
				CodeLvl
				SecManuf
				BaseCompany
				BodyColor
				TempaDesign
				TempaText
				VerAttachments
				VerPhoto1Name
				VerPhoto1Ref
				VerPhoto2Name
				VerPhoto2Ref
				VerComm
		-->		
				
		<form action="Add_Version_Process.php" method="post">
			<p>UMID:     	  <input type="text" name="UMID" value="" size="6" id="UMID"</p>
			<p>Version ID:     	  <input type="text" name="VERID1" value="" size="4" id="VERID1"</p>				
			<p>MAN/FAB#:     	  <input type="text" name="FAB_No" value="" size="6" id="FAB_No"</p>
			<p>Master Mack#:     	  <input type="text" name="Master_Mack_No" value="" size="8" id="Master_Mack_No"</p>
			<p>Version Name:     	  <input type="text" name="VerName" value="" size="60" id="VerName"</p>
			<p>Version Release Year:     	  <input type="text" name="VerYrFirstRel" value="" size="4" id="VerYrFirstRel"</p>
			<p>Version Type: </p>
				<?php
					$query=("SELECT * FROM Test_Matchbox_Value_Lists WHERE ValueList LIKE '%VersionType%'");								
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
				<select name="VerType">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
					}	
				?>
				</select>				
			<p>Code Level:    </p>
				<?php
					$query=("SELECT * FROM Test_Matchbox_Value_Lists WHERE ValueList LIKE '%CodeLevel%'");								
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
				<select name="CodeLvl">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
					}	
				?>
				</select>
			<p>Secondary Manufacturer:    </p>
				<?php
					$query=("SELECT * FROM Test_Matchbox_Value_Lists WHERE ValueList LIKE '%SecondManufacturer%'");								
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
				<select name="SecManuf">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
					}	
				?>
				</select>		
			<p>Body Color(s):     	  <input type="text" name="BodyColor" value="" size="40" id="BodyColor"</p>
			<p>Tempa Design:     </p>
				<textarea name="TempaDesign" cols="45" rows="4">			
				</textarea>	
			<p>Tempa Text:     </p>
				<textarea name="TempaText" cols="45" rows="4">			
				</textarea>
			<p>Version Attachments:     	  <input type="text" name="VerAttachments" value="" size="60" id="VerAttachments"</p>	
			<p>Version Photo 1 Name:     	  <input type="text" name="VerPhoto1Name" value="" size="40" id="VerPhoto1Name"</p>
			<p>Version Photo 1 Reference: </p>
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
				<select name="VerPhoto1Ref">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["RefCode"].'">'.$row["RefCode"].'</option'."<br />";
					}	
				?>
				</select>
			<p>Version Photo 2 Name:     	  <input type="text" name="VerPhoto2Name" value="" size="40" id="VerPhoto2Name"</p>
			<p>Version Photo 2 Reference: </p>
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
				<select name="VerPhoto2Ref">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["RefCode"].'">'.$row["RefCode"].'</option'."<br />";
					}	
				?>
				</select>	
			<p>Version Comment: </p>
				<textarea name="VerComm" cols="45" rows="4">	
				</textarea>
	
			<input type="submit"  name="submit" value="Submit"/>
		</form>			
		<a href="Add_Version_Form.php">Cancel</a>						 						
	</td>
</tr>
			</table>
<?php require("includes/footer.php"); ?>