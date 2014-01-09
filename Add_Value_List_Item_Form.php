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
						<h2>Add a Value List Item</h2>
						<br />
							<form action="Add_Value_List_Item_Process.php" method="post">
							
							<!--<p>Value List:     <input type="text" name="ValueList" value="" size="20" id="ValueList"</p>-->
							<p>Value Type: </p>
								<?php
									$query=("SELECT DISTINCT ValueList FROM Test_Matchbox_Value_Lists");								
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
								<select name="ValueList">
								<?php
									for ($i=1; $i<=$rows_count; $i++) {
										$row=mysql_fetch_array($result);
										echo '<option value="'.$row["ValueList"].'">'.$row["ValueList"].'</option'."<br />";
									}
									mysql_free_result($result);
								?>
								</select>	
							<br />
							
							<p>Entry:     <input type="text" name="ValueListEntry" value="" size="40" id="ValueListEntry"</p>
							<p>Display Order:  <input type="text" name="ValueDispOrder" value="" size="4" id="ValueDispOrder"</p>
												
							<input type="submit"  name="submit" value="Submit"/>
							</form>			
							<a href="Add_Value_List_Item_Form.php">Cancel</a>
					 						
					</td>
				</tr>
			</table>
<?php require("includes/footer.php"); ?>