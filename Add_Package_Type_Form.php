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
						<h2>Add a Package Type</h2>
						<p></p>

				<!-- fields:
				PkgVarCode
				PkgType
				PkgTypeYrs
				PkgTypeDescr
				PkgTypePhotoName
				PkgTypePhotoPath
				PkgTypePhotoRef
		
				-->		
				
		<form action="Add_Package_Type_Process.php" method="post">
			<p>Package Code:     	  <input type="text" name="PkgVarCode" value="" size="20" id="PkgVarCode"</p>
			<p>Package Type:     	</p>
				<?php
					$query=("SELECT * FROM Test_Matchbox_Value_Lists WHERE ValueList LIKE '%PkgType%'");								
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
				<select name="PkgType">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
					}	
				?>
				</select>
			<p>Years of Use:          <input type="text" name="PkgTypeYrs" value="" size="9" id="PkgTypeYrs"</p>
			<p>Description:     	  <input type="text" name="PkgTypeDescr" value="" size="40" id="PkgTypeDescr"</p>
			<p>Photo Path:     	  <input type="text" name="PkgTypePhotoPath" value="" size="40" id="PkgTypePhotoPath"</p>
			<p>Photo Name:     	  <input type="text" name="PkgTypePhotoName" value="" size="20" id="PkgTypePhotoName"</p>
			<p>Photo Reference:     </p>
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
				<select name="PkgTypePhotoRef">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["RefCode"].'">'.$row["RefCode"].'</option'."<br />";
					}	
				?>
				</select>		

			<input type="submit"  name="submit" value="Submit"/>
		</form>			
		<a href="Add_Package_Type_Menu.php">Cancel</a>						 						
	</td>
</tr>
</table>
<?php require("includes/footer.php"); ?>						 						