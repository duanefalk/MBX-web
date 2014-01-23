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
						<h2>Add a Variation</h2>
						<p></p>

				<!-- fields:
				UMID
				VERID
				VARID
				Mack_No
				BaseName
				ManufLoc
				VarYear
				FWhCd
				RWhCd
				WindowColor
				InteriorColor
				Base1Material
				Base1Color
				Base2Type
				Base2Material
				Base2Color
				Finish
				ColorVar
				TempaVar
				Det1Type
				Det1Var
				Det2Type
				Det2Var
				Det3Type
				Det3Var
				Det4Type
				Det4Var
				Det5Type
				Det5Var
				CodeLvl
				SecManuf
				StdValue
				VarComment
				VarPhoto1Name
				VarPhoto1Ref
				VarPhoto2Name
				VarPhoto2Ref		
				-->		
				
		<form action="Add_Variation_Process.php" method="post">
			<p>UMID:     	  <input type="text" name="UMID" value="" size="6" id="UMID"</p>
			<p>Version ID:     	  <input type="text" name="VERID1" value="" size="4" id="VERID1"</p>
			<p>Variation ID:          <input type="text" name="VARID1" value="" size="4" id="VARID1"</p>
			<p>Mack#:     	  <input type="text" name="Mack_No" value="" size="8" id="Mack_No"</p>
			<p>Base Name:     	  <input type="text" name="BaseName" value="" size="60" id="BaseName"</p>
						<p>Company on Base: </p>
				<?php
					$query=("SELECT * FROM Test_Matchbox_Value_Lists WHERE ValueList LIKE '%BaseCompany%'");								
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
				<select name="BaseCompany">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
					}	
				?>
				</select>
			<p>Manufacture Location:    </p>
				<?php
					$query=("SELECT * FROM Test_Matchbox_Value_Lists WHERE ValueList LIKE '%ManufactureOrigin%'");								
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
				<select name="ManufLoc">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
					}	
				?>
				</select>
			<p>Variation Year:     	  <input type="text" name="VarYear" value="" size="9" id="VarYear"</p>	
			<p>Front Wheel Code: </p>
				<?php
					$query=("SELECT * FROM Test_Matchbox_Wheels");								
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
				<select name="FWhCd">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["WheelCod"].'">'.$row["WheelCod"].'</option'."<br />";
					}	
				?>
				</select>				
			<p>Rear Wheel Code: </p>
				<?php
					$query=("SELECT * FROM Test_Matchbox_Wheels");								
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
				<select name="RWhCd">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["WheelCod"].'">'.$row["WheelCod"].'</option'."<br />";
					}	
				?>
				</select>
			<p>Window Color: </p>	
				<?php
					$query=("SELECT * FROM Test_Matchbox_Value_Lists WHERE ValueList LIKE '%WindowColor%' ORDER BY 'ValueDispOrder' ASC");								
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
				<select name="WindowColor">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
					}	
				?>
				</select>
			<p>Interior Color: </p>	
				<?php
					$query=("SELECT * FROM Test_Matchbox_Value_Lists WHERE ValueList LIKE '%InteriorColor%' ORDER BY ValueDispOrder ASC");
					// $query=("SELECT * FROM Test_Matchbox_Value_Lists WHERE ValueList LIKE '%InteriorColor%' ORDER BY 'ValueDispOrder' ASC");								
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
				<select name="InteriorColor">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
					}	
				?>
				</select>	
			<p>Base (1) Material: </p>	
				<?php
					$query=("SELECT * FROM Test_Matchbox_Value_Lists WHERE ValueList LIKE '%BaseType%' ORDER BY 'ValueDispOrder' ASC");								
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
				<select name="Base1Material">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
					}	
				?>
				</select>
			<p>Base (1) Color: </p>	
				<?php
					$query=("SELECT * FROM Test_Matchbox_Value_Lists WHERE ValueList LIKE '%BaseColor%' ORDER BY 'ValueDispOrder' ASC");								
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
				<select name="Base1Color">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
					}	
				?>
				</select>
			<p>Base (2) Type: </p>	
				<?php
					$query=("SELECT * FROM Test_Matchbox_Value_Lists WHERE ValueList LIKE '%Base2Type%' ORDER BY 'ValueDispOrder' ASC");								
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
				<select name="Base2Type">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
					}	
				?>
				</select>
			<p>Base (2) Material: </p>	
				<?php
					$query=("SELECT * FROM Test_Matchbox_Value_Lists WHERE ValueList LIKE '%BaseType%' ORDER BY 'ValueDispOrder' ASC");								
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
				<select name="Base2Material">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
					}	
				?>
				</select>	
			<p>Base (2) Color: </p>	
				<?php
					$query=("SELECT * FROM Test_Matchbox_Value_Lists WHERE ValueList LIKE '%BaseColor%' ORDER BY 'ValueDispOrder' ASC");								
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
				<select name="Base2Color">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
					}	
				?>
				</select>	
			<p>Finish: </p>	
				<?php
					$query=("SELECT * FROM Test_Matchbox_Value_Lists WHERE ValueList LIKE '%Finish%'");								
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
				<select name="Finish">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
					}	
				?>
				</select>
			<p>Color Variation:     </p>
				<textarea name="ColorVar" cols="45" rows="4">			
				</textarea>	
			<p>Tempa Variation:     </p>
				<textarea name="TempaVar" cols="45" rows="4">			
				</textarea>		
			<p>Detail 1 Type:     	  <input type="text" name="Det1Typ" value="" size="20" id="Det1Typ"</p>
			<p>Detail 1 Variation:     	  <input type="text" name="Det1Var" value="" size="40" id="Det1Var"</p>
			<p>Detail 2 Type:     	  <input type="text" name="Det2Typ" value="" size="20" id="Det2Typ"</p>
			<p>Detail 2 Variation:     	  <input type="text" name="Det2Var" value="" size="40" id="Det2Var"</p>
			<p>Detail 3 Type:     	  <input type="text" name="Det3Typ" value="" size="20" id="Det3Typ"</p>
			<p>Detail 3 Variation:     	  <input type="text" name="Det3Var" value="" size="40" id="Det3Var"</p>
			<p>Detail 4 Type:     	  <input type="text" name="Det4Typ" value="" size="20" id="Det4Typ"</p>
			<p>Detail 4 Variation:     	  <input type="text" name="Det4Var" value="" size="40" id="Det4Var"</p>
			<p>Detail 5 Type:     	  <input type="text" name="Det5Typ" value="" size="20" id="Det5Typ"</p>
			<p>Detail 5 Variation:     	  <input type="text" name="Det5Var" value="" size="40" id="Det5Var"</p>
			
			<p>Standard Value:     	  <input type="number" name="StdValue" value="0.00" size="10" id="StdValue"</p>	
			<p>Variation Comment: </p>
				<textarea name="VarComment" cols="45" rows="4">	
				</textarea>
			<p>Variation Photo 1 Name:     	  <input type="text" name="VarPhoto1Name" value="" size="40" id="VarPhoto1Name"</p>
			<p>Variation Photo 1 Reference: </p>
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
				<select name="VarPhoto1Ref">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["RefCode"].'">'.$row["RefCode"].'</option'."<br />";
					}	
				?>
				</select>
			<p>Variation Photo 2 Name:     	  <input type="text" name="VarPhoto2Name" value="" size="40" id="VarPhoto2Name"</p>
			<p>Variation Photo 2 Reference: </p>
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
				<select name="VarPhoto2Ref">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["RefCode"].'">'.$row["RefCode"].'</option'."<br />";
					}	
				?>
				</select>	
			<input type="submit"  name="submit" value="Submit"/>
		</form>			
		<a href="Add_Variation_Form.php">Cancel</a>						 						
	</td>
</tr>
</table>
<?php require("includes/footer.php"); ?>						 						