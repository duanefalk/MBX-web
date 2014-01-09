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
				
	<!--Fields:
		UMID
		VerID
		VarID
		RelID
		RelYr
		CountryOfSale
		Theme
		Series
		SeriesID
		ShowSeriesID
		PkgName
		MdlNameOnPkg
		SubSeries
		SubSeriesID
		ShowSubSeriesID
		UnitTyp
		PkgID
		PkgVarCd
		RelDt
		RelComm
		RelPkgPhotoName
		RelPkgPhotoRef
	-->
		<h2>Add a Release</h2>
		<form action="Add_Release_Process.php" method="post">
			<p>UMID:     	  <input type="text" name="UMID" value="" size="6" id="UMID"</p>
			<p>Version ID:     	  <input type="text" name="VERID1" value="" size="4" id="VERID1"</p>
			<p>Variation ID:          <input type="text" name="VARID1" value="" size="4" id="VARID1"</p>
			<p>Release ID:     <input type="text" name="RELID1" value="" size="2" id="RELID1"</p>

			<p>Intended Release Year:     	  <input type="text" name="RelYr" value="" size="4" id="RelYr"</p>
			<p>Country of Sale: </p>
				<?php
					$query=("SELECT * FROM Test_Matchbox_Value_Lists WHERE ValueList LIKE '%CountryOfSale%'");								
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
				<select name="CountryOfSale">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
					}	
				?>
				</select>
				
			<p>Release Theme: </p>
				<?php
					$query=("SELECT * FROM Test_Matchbox_Value_Lists WHERE ValueList LIKE '%ReleaseTheme%' ORDER BY ValueDispOrder ASC");								
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
				<select name="Theme">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
					}	
				?>
				</select>
			<p>Release Series: </p>
				<?php
					$query=("SELECT * FROM Test_Matchbox_Value_Lists WHERE ValueList LIKE '%RelSeries%'");								
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
				<select name="Series">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
					}	
				?>
				</select>
			<p>ID in Series:     	  <input type="text" name="SeriesID" value="" size="20" id="SeriesID"</p>
			<p>Show Series ID?:     	  <input type="text" name="ShowSeriesID" value="1" size="1" id="ShowSeriesID"</p>
			<p>Subgroup Under Series:   <input type="text" name="SubSeries" value="" size="40" id="SubSeries"</p>  	
			<p>ID in SubSeries:     	  <input type="text" name="SubSeriesID" value="" size="20" id="SubSeriesID"</p>
			<p>Show SubSeries ID?:     	  <input type="text" name="ShowSubSeriesID" value="1" size="1" id="ShowSubSeriesID"</p>
			
			<p>Model Name on the Package:     	  <input type="text" name="MdlNameOnPkg" value="" size="40" id="MdlNameOnPkg"</p>
			<p>Name of the Package:     	  <input type="text" name="PkgName" value="" size="40" id="PkgName"</p>
			<p>Unit Size: </p>
				<?php
					$query=("SELECT * FROM Test_Matchbox_Value_Lists WHERE ValueList LIKE '%UnitSize%'");								
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
				<select name="UnitTyp">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
					}	
				?>
				</select>
			<p>Package ID#:     	  <input type="text" name="PkgID" value="" size="12" id="PkgID"</p>
			<p>Type of Package: </p>
				<?php
					$query=("SELECT PkgVarCode FROM Test_Matchbox_Package_Varieties");								
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
				<select name="PkgVarCd">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["PkgVarCode"].'">'.$row["PkgVarCode"].'</option'."<br />";
					}	
				?>
				</select>			
			
			<p>Release Date:      <input type="text" name="RelDt" value="" size="10" id="RelDt"</p>			
			<p>Release Comments:     </p>
				<textarea name="RelComm" cols="45" rows="4">			
				</textarea>
			<p>Package Photo Name:     	  <input type="text" name="RelPkgPhotoName" value="" size="40" id="RelPkgPhotoName"</p>	
			<p>Package Photo Reference: </p>
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
				<select name="RelPkgPhotoRef">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["RefCode"].'">'.$row["RefCode"].'</option'."<br />";
					}	
				?>
				</select>
	
			<input type="submit"  name="submit" value="Submit"/>
		</form>			
		<a href="Add_Release_Form.php">Cancel</a>						 						
	</td>
</tr>
			</table>
<?php require("includes/footer.php"); ?>