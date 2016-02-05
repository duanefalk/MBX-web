<?php 
	require_once("includes/db_connection.php");
	require_once("includes/functions.php");
	$pageTitle = "Add a Variation";
	$pageDescription = "Add a new Variation to the Matchbox University collector's database.";
	include("includes/header.php");
?>
<div class="row">
	<div class="large-12 columns">
		<h2>Add a Variation</h2>
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
				VarComment
				VarPhoto1Ref
				VarPhoto2Ref		
			-->		
				
		<form action="Add_Variation_Process.php" method="post">
			<label for="UMID">UMID:</label>
			<input type="text" name="UMID" value="" id="UMID">
			
			<label for="VERID1">Version ID:</label>
			<input type="text" name="VERID1" value="" size="10" id="VERID1">
			
			<label for="VARID1">Variation ID:</label>
			<input type="text" name="VARID1" value="" size="13" id="VARID1">
			
			<label for="Mack_No">Mack #:</label>
			<input type="text" name="Mack_No" value="" size="12" id="Mack_No">
			
			<label for="BaseName">Base Name:</label>
			<input type="text" name="BaseName" value="" size="60" id="BaseName">
			
			<label for="BaseCompany">Company on Base:</label>
			<?php
				$query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%BaseCompany%'");								
				$result=0;
				$rows_count=0;									
				$result = mysql_query($query);
				
				if (!result) {
					echo "Database query failed";
				} else {}
				
				$rows_count= mysql_num_rows($result);
			?>			
			<select name="BaseCompany" id="BaseCompany">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option>';
					}	
				?>
			</select>
			
			<label for="ManufLoc">Manufacturer Location:</label>
			<?php
				$query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%ManufactureOrigin%'");								
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
			<select name="ManufLoc" id="ManufLoc">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option>';
					}	
				?>
			</select>
			
			<label for="VarYear">Variation Year:</label>
			<input type="text" name="VarYear" value="" id="VarYear">
			
			<label for="FWhCd">Front Wheel Code:</label>
			<?php
				$query=("SELECT * FROM Matchbox_Wheels");								
				$result=0;
				$rows_count=0;									
				$result = mysql_query($query);
				if (!result) {
					echo "Database query failed";
				}
				else {}
				$rows_count= mysql_num_rows($result);
			?>
			<select name="FWhCd" id="FWhCd">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["WheelCod"].'">'.$row["WheelCod"].'</option>';
					}	
				?>
			</select>
			
			<label for="RWhCd">Rear Wheel Code:</label>
			<?php
				$query=("SELECT * FROM Matchbox_Wheels");								
				$result=0;
				$rows_count=0;									
				$result = mysql_query($query);
				if (!result) {
					echo "Database query failed";
				}
				else {}
				$rows_count= mysql_num_rows($result);
			?>
			<select name="RWhCd" id="RWhCd">
			<?php
				for ($i=1; $i<=$rows_count; $i++) {
					$row=mysql_fetch_array($result);
					echo '<option value="'.$row["WheelCod"].'">'.$row["WheelCod"].'</option>';
				}	
			?>
			</select>
			
			<label for="WindowColor">Window Color:</label>
			<?php
				$query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%WindowColor%' ORDER BY 'ValueDispOrder' ASC");								
				$result=0;
				$rows_count=0;									
				$result = mysql_query($query);
				if (!result) {
					echo "Database query failed";
				}
				else {}
				$rows_count= mysql_num_rows($result);
			?>
			<select name="WindowColor" id="WindowColor">
			<?php
				for ($i=1; $i<=$rows_count; $i++) {
					$row=mysql_fetch_array($result);
					echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option>';
				}	
			?>
			</select>
			
			<label for="InteriorColor">Interior Color:</label>
			<?php
				$query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%InteriorColor%' ORDER BY ValueDispOrder ASC");
				// $query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%InteriorColor%' ORDER BY 'ValueDispOrder' ASC");								
				$result=0;
				$rows_count=0;									
				$result = mysql_query($query);
				if (!result) {
					echo "Database query failed";
				}
				else {}
				$rows_count= mysql_num_rows($result);
			?>
			<select name="InteriorColor" id="InteriorColor">
			<?php
				for ($i=1; $i<=$rows_count; $i++) {
					$row=mysql_fetch_array($result);
					echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option>';
				}	
			?>
			</select>
				
			<label for="Base1Material">Base (1) Material:</label>
			<?php
				$query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%BaseType%' ORDER BY 'ValueDispOrder' ASC");								
				$result=0;
				$rows_count=0;									
				$result = mysql_query($query);
				if (!result) {
					echo "Database query failed";
				}
				else {}
				$rows_count= mysql_num_rows($result);
			?>
			<select name="Base1Material" id="Base1Material">
			<?php
				for ($i=1; $i<=$rows_count; $i++) {
					$row=mysql_fetch_array($result);
					echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option>';
				}	
			?>
			</select>
			
			<label for="Base1Color">Base (1) Color:</label>
			<?php
				$query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%BaseColor%' ORDER BY 'ValueDispOrder' ASC");								
				$result=0;
				$rows_count=0;									
				$result = mysql_query($query);
				if (!result) {
					echo "Database query failed";
				}
				else {}
				$rows_count= mysql_num_rows($result);
			?>
			<select name="Base1Color" id="Base1Color">
			<?php
				for ($i=1; $i<=$rows_count; $i++) {
					$row=mysql_fetch_array($result);
					echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option>';
				}	
			?>
			</select>
			
			
			<label for="Base2Type">Base (2) Type:</label>
			<?php
				$query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%Base2Type%' ORDER BY 'ValueDispOrder' ASC");								
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
			<select name="Base2Type" id="Base2Type">
			<?php
				for ($i=1; $i<=$rows_count; $i++) {
					$row=mysql_fetch_array($result);
					echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option>';
				}	
			?>
			</select>
				
			
			<label for="Base2Material">Base (2) Material:</label>
			<?php
				$query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%BaseType%' ORDER BY 'ValueDispOrder' ASC");								
				$result=0;
				$rows_count=0;									
				$result = mysql_query($query);
				if (!result) {
					echo "Database query failed";
				}
				else {}
				$rows_count= mysql_num_rows($result);
			?>
			<select name="Base2Material" id="Base2Material">
			<?php
				for ($i=1; $i<=$rows_count; $i++) {
					$row=mysql_fetch_array($result);
					echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option>';
				}	
			?>
			</select>
			
			
			<label for="Base2Color">Base (2) Color:</label>
			<?php
				$query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%BaseColor%' ORDER BY 'ValueDispOrder' ASC");								
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
			<select name="Base2Color" id="Base2Color">
			<?php
				for ($i=1; $i<=$rows_count; $i++) {
					$row=mysql_fetch_array($result);
					echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option>';
				}	
			?>
			</select>
			
			
			<label for="Finish">Finish:</label>
			<?php
				$query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%Finish%'");								
				$result=0;
				$rows_count=0;									
				$result = mysql_query($query);
				if (!result) {
					echo "Database query failed";
				}
				else {}
				$rows_count= mysql_num_rows($result);
			?>
			<select name="Finish" id="Finish">
			<?php
				for ($i=1; $i<=$rows_count; $i++) {
					$row=mysql_fetch_array($result);
					echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option>';
				}	
			?>
			</select>
			
			
			<label for="ColorVar">Color Variation:</label>
			<textarea name="ColorVar" id="ColorVar" cols="45" rows="4"></textarea>

			<label for="TempaVar">Tampo Variation:</label>
			<textarea name="TempaVar" id="TempaVar" cols="45" rows="4"></textarea>
			
			<label for="Det1Typ">Detail 1 Type:</label>
			<input type="text" name="Det1Typ" value="" size="20" id="Det1Typ">
			
			<label for="Det1Var">Detail 1 Variation:</label>
			<input type="text" name="Det1Var" value="" size="40" id="Det1Var">
			
			<label for="Det2Typ">Detail 2 Type:</label>
			<input type="text" name="Det2Typ" value="" size="20" id="Det2Typ">
			
			<label for="Det2Var">Detail 2 Variation:</label>
			<input type="text" name="Det2Var" value="" size="40" id="Det2Var">
			
			<label for="Det3Typ">Detail 3 Type:</label>
			<input type="text" name="Det3Typ" value="" size="20" id="Det3Typ">
			
			<label for="Det3Var">Detail 3 Variation:</label>
			<input type="text" name="Det3Var" value="" size="40" id="Det3Var">
			
			<label for="Det4Typ">Detail 4 Type:</label>
			<input type="text" name="Det4Typ" value="" size="20" id="Det4Typ">
			
			<label for="Det4Var">Detail 4 Variation:</label>
			<input type="text" name="Det4Var" value="" size="40" id="Det4Var">
			
			<label for="Det5Typ">Detail 5 Type:</label>
			<input type="text" name="Det5Typ" value="" size="20" id="Det5Typ">
			
			<label for="Det5Var">Detail 5 Variation:</label>
			<input type="text" name="Det5Var" value="" size="40" id="Det5Var">
			
			<label for="VarComment">Variation Comment:</label>
			<textarea name="VarComment" id="VarComment" cols="45" rows="4"></textarea>
			
			<label for="VarPhoto1Ref">Variation Photo 1 Reference:</label>
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
			<select name="VarPhoto1Ref" id="VarPhoto1Ref">
			<?php
				for ($i=1; $i<=$rows_count; $i++) {
					$row=mysql_fetch_array($result);
					echo '<option value="'.$row["RefCode"].'">'.$row["RefCode"].'</option>';
				}	
			?>
			</select>
			
			<label for="VarPhoto2Ref">Variation Photo 2 Reference:</label>
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
			<select name="VarPhoto2Ref" id="VarPhoto2Ref">
			<?php
				for ($i=1; $i<=$rows_count; $i++) {
					$row=mysql_fetch_array($result);
					echo '<option value="'.$row["RefCode"].'">'.$row["RefCode"].'</option>';
				}	
			?>
			</select>
			
			<div class="row">
				<div class="large-3 columns">
					<input class="button dark" type="submit" name="submit" value="Submit" />
				</div>
				<div class="large-3 columns end">
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