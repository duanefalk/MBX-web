<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<div class="row">
	<div class="large-12 columns">
		
		<p>Select Record Type to Add:</p>
		<ul>
			<li><a href="Add_Model_Form.php">Model</a></li>
			<li><a href="Add_Version_Form.php">Version</a></li>
			<li><a href="Add_Variation_Form.php">Variation</a></li>
			<li><a href="Add_Release_Form.php">Release</a></li>
            <li><a href="Add_Package_Type_Form.php">Package Type</a></li>
            <li><a href="Add_Wheel_Form.php">Wheel Type</a></li>
			<li><a href="Add_Reference_Form.php">Reference</a></li>
            <li><a href="Add_Value_List_Item_Form.php">Value List Item</a></li>
			<li><a href="Add_Microvariation_Form.php">Microvariation</a></li>
		</ul>
		
	</div>
</div>

<div class="row">
	<div class="large-12 columns">
		<h2>Welcome to the Online Matchbox Database!!</h2>
		<p>This site is for Matchbox collectors and anyone interested in Matchbox models</p>
	</div>
</div>		
		
<?php require("includes/footer.php"); ?>