<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<div class="row">
	<div class="large-12 columns">
		<h2>Add a Value List Item</h2>
		<form action="Add_Value_List_Item_Process.php" method="post">
			
			<label for="ValueList">Value Type:</label>
			<?php
				$query=("SELECT DISTINCT ValueList FROM Matchbox_Value_Lists");								
				$result=0;
				$rows_count=0;									
				$result = mysql_query($query);
				
				if (!result) {
					echo "Database query failed";
				} else {}
						
				$rows_count= mysql_num_rows($result);
			?>
			<select name="ValueList" id="ValueList">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueList"].'">'.$row["ValueList"].'</option'."<br />";
					}
					mysql_free_result($result);
				?>
			</select>	
			
			<label for="ValueListEntry">Entry:</label>
			<input type="text" name="ValueListEntry" value="" size="40" id="ValueListEntry">
			
			<label for="ValueDispOrder">Display Order:</label>
			<input type="text" name="ValueDispOrder" value="" size="4" id="ValueDispOrder">
			
			<div class="row">
				<div class="large-3 small-6 columns">
					<input type="submit" name="submit" value="Submit" class="button dark" />
				</div>
				<div class="large-4 small-6 columns end">
					<a href="Add_Menu.php" class="button dark cancel">Cancel</a>
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