<?php 
	require_once("includes/db_connection.php");
	require_once("includes/functions.php");
	$pageTitle = "Add a Microvariation";
	$pageDescription = "Add a new Microvariation to the Matchbox University collector's database.";
	include("includes/header.php"); 
?>

<div class="row">
	<div class="large-12 columns">
		<h2>Add a Microvariation</h2>				
		<form action="add-microvariation-process.php" method="post">			
			<label for="UMID">UMID:</label>
			<input type="text" name="UMID" value="" size="6" id="UMID">
			
			<label for="Microvariation">Microvariation:</label>
			<textarea name="Microvariation" cols="45" rows="4" id="Microvariation"></textarea>
			
			<label for="Microvar_Updt_Dt">Update Date:</label>
			<input type="date" name="Microvar_Updt_Dt" id="Microvar_Updt_Dt">

			<div class="row">
				<div class="large-2 small-6 columns">
					<input type="submit" class="button dark" name="submit" value="Submit"/>
				</div>
				<div class="large-2 small-6 columns end">
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
		<a href="add-menu.php">Return to Add New Record</a>
		<a href="index.php">Return to Main Page</a>		
	</div>
</div>

<!--script>
	$(function() {
		$( "#Microvar_Updt_Dt" ).datepicker();
	});
</script-->

<?php require("includes/footer.php"); ?>