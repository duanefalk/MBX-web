<?php
	ob_start();
	session_start();
	$pageTitle = "Adding Releases, Variations, and Codes";
	$pageDescription = "Adding a new release, variation, or code to the matchbox university car database.";
	require_once("includes/db_connection.php");
	include("includes/header.php");
	include("includes/functions.php");
?>

<?php
$source_string= $_GET['message'];
$ID= $_GET['model'];

if ($source_string=="Rel_success") {
	 ?>
	<div class="row">
		<div class="large-12 columns">
		
			<h2>Release <?php echo $ID; ?> Successfully Added!</h2>
			<p><a class='button dark' href="search-models-menu.php">Return to Search Models</a></p>
		
		</div>
	</div>
	
<?php } elseif ($source_string=="Var_success") { ?>
	<div class="row">
		<div class="large-12 columns">
		
			<h2>Variation <?php echo $ID; ?> Successfully Added!</h2>
			<p><a class='button dark' href="search-models-menu.php">Return to Search Models</a></p>
		
		</div>
	</div>
	
<?php } elseif ($source_string=="Code_fail") { ?>
	<div class="row">
		<div class="large-12 columns">
		
			<h2>Code <?php echo $ID; ?> Failed!</h2>
			<p>Subject creation failed. Please review entries.</p>
			
			<p><a class='button dark' href="collection-code-lists.php">Manage Your Code Lists</a></p>
		
		</div>
	</div>	

<?php } elseif ($source_string=="Code_success") { ?>
	<div class="row">
		<div class="large-12 columns">
			<h2>Code <strong><?php echo $ID; ?></strong> Successfully Added!</h2>
			<div class="row">
				<div class="large-3 columns">
					<a class='button dark' href="add-user-collection-code.php">Add Another Code</a>
				</div>
				<div class="large-6 columns end">
					<a class='button dark' href="collection-code-lists.php">back to Collection Code Lists</a>
				</div>
			</div>		
		</div>
	</div>	
	
	
	
<?php } else {
	echo "Matched no source program";
} ?>

<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="Search_Models.php">Search Models</a>
		<a href="Search_Releases.php">Search Releases</a>
		<a href="update-collection-model.php">Update Models in Your Collection</a>
		<a href="index.php">Return to Main Page</a>		
	</div>
</div>
         
<?php include("includes/footer.php"); ?>