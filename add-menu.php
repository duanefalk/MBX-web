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
				<a class="button dark" href="Add_Model_Form.php">Model</a>
				<a class="button dark" href="Add_Version_Form.php">Version</a>
				<a class="button dark" href="Add_Variation_Form.php">Variation</a>
			</div>
			<div class="large-4 columns">
				<a class="button dark" href="Add_Release_Form.php">Release</a>
		        <a class="button dark" href="Add_Package_Type_Form.php">Package Type</a>
		        <a class="button dark" href="Add_Wheel_Form.php">Wheel Type</a>
			</div>
			<div class="large-4 columns">
				<a class="button dark" href="Add_Reference_Form.php">Reference</a>
		        <a class="button dark" href="Add_Value_List_Item_Form.php">Value List Item</a>
				<a class="button dark" href="Add_Microvariation_Form.php">Microvariation</a>
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