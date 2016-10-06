<?php 
	require_once("includes/db_connection.php");
	require_once("includes/functions.php");
	$pageTitle = "Administrative Menu";
	$pageDescription = "Add new records to the Matchbox University collector's database.";
	include("includes/header.php");
?>

<div class="row" id="addMenu">
	<div class="large-12 columns">
	
		<h1>Add a Menu</h1>
		
		<p>Select Record Type to Add:</p>
		
		<div class="row">
			<div class="large-4 columns">
				<a class="button dark" href="add-model-form.php">Model</a>
				<a class="button dark" href="add-version-form.php">Version</a>
				<a class="button dark" href="add-variation-form.php">Variation</a>
			</div>
			<div class="large-4 columns">
				<a class="button dark" href="add-release-form.php">Release</a>
		        <a class="button dark" href="add-package-type-form.php">Package Type</a>
		        <a class="button dark" href="add-wheel-form.php">Wheel Type</a>
			</div>
			<div class="large-4 columns">
				<a class="button dark" href="Add_Reference_Form.php">Reference</a>
		        <a class="button dark" href="add-value-list-item-form.php">Value List Item</a>
				<a class="button dark" href="add-microvariation-form.php">Microvariation</a>
			</div>
		</div>
		
	</div>
</div>

<!--div class="row">
	<div class="large-12 columns">
		<h2>Welcome to the Online Matchbox Database!!</h2>
		<p>This site is for Matchbox collectors and anyone interested in Matchbox models</p>
	</div>
</div-->		
		
<?php require("includes/footer.php"); ?>