<?php 
	require_once("includes/db_connection.php");
	require_once("includes/functions.php");
	$pageTitle = "Add a Reference";
	$pageDescription = "Add a new Reference to the Matchbox University collector's database.";
	include("includes/header.php");
?>

<div class="row">
	<div class="large-12 columns">
		<h2>Add a Reference</h2>
		
		<!-- fields:
			RefType
			RefCode
			RefName
			RefDetails
			RefComment
		-->		
				
		<form action="add-reference-process.php" method="post">
			
			<label for="RefCode">Reference Code:</label>
			<input type="text" name="RefCode" value="" size="8" id="RefCode">
			
			<label for="RefType">Reference Type:</label>
			<?php
				$query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%ReferenceType%'");								
				$result=0;
				$rows_count=0;									
				$result = mysql_query($query);
				if (!result) {
					echo "Database query failed";
				} else {}
				
				$rows_count= mysql_num_rows($result);
			?>
			<select name="RefType" id="RefType">
			<?php
				for ($i=1; $i<=$rows_count; $i++) {
					$row=mysql_fetch_array($result);
					echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option>';
				}	
			?>
			</select>
			
			<label for="RefName">Name of Reference:</label>
			<input type="text" name="RefName" value="" size="30" id="RefName">
			
			<label for="RefDetails">Reference Details (i.e. url, book title):</label>
			<input type="text" name="RefDetails" value="" size="40" id="RefDetails">
			
			<label for="RefComment">Reference Comment:</label>
			<textarea name="RefComment" id="RefComment" cols="45" rows="4"></textarea>

			<div class="row">
				<div class="large-3 medium-6 small-6 columns">
					<input class="button dark" type="submit" name="submit" value="Submit"/>
				</div>
				<div class="large-3 medium-6 small-6 columns end">
					<a class="button dark cancel" href="add-menu.php">Cancel</a>
				</div>
			</div>
		</form>
	</div>
</div>

<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="add-menu.php">Add New Record</a>
	</div>
</div>

<?php require("includes/footer.php"); ?>						 						