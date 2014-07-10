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
						<h2>Add a Reference</h2>
						<p></p>

				<!-- fields:
				RefType
				RefCode
				RefName
				RefDetails
				RefComment
				-->		
				
		<form action="Add_Reference_Process.php" method="post">
			<p>Reference Code:     	  <input type="text" name="RefCode" value="" size="8" id="RefCode"</p>
			<p>Reference Type:     	</p>
				<?php
					$query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%ReferenceType%'");								
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
				<select name="RefType">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
					}	
				?>
				</select>
			<p>Name of Reference:          <input type="text" name="RefName" value="" size="30" id="RefName"</p>
			<p>Reference Details (i.e. url, book title):    <input type="text" name="RefDetails" value="" size="40" id="RefDetails"</p>
			<p>Reference Comment:     	</p>
				<textarea name="RefComment" cols="45" rows="4">			
				</textarea>

			<input type="submit" name="submit" value="Submit"/>
		</form>			
		<a href="Add_Reference_Form.php">Cancel</a>						 						
	</td>
</tr>
</table>
<?php require("includes/footer.php"); ?>						 						