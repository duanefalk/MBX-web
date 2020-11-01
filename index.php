<?php 
	//session_start();
	require_once("includes/functions.php");
	require_once("includes/db_connection.php");	
	$pageTitle = "Home";
	$pageDescription = "An online database for finding and collecting Matchbox cars.";
	include("includes/header.php");
?>

<div class="row">
	<div class="large-5 columns">
		<h4>The Matchbox Professor welcomes you to MBX University!!</h4>
		<p>This site is for Matchbox collectors and anyone interested in Matchbox models. Do a quick lookup of a model using the MAN# (box to the right), or check out the more extensive search abilities in 'Search Models' and 'Search Releases' above.</p>
	</div>
	
	<div class="large-7 columns">
		<div id="quick_search">
			<h3>Quick Search</h3>
			<form action="search-models-process.php" method="post" data-parsley-validate>
				<label for="Spec_MAN">MAN (FAB) # (i.e. '800'):</label>
				<div class="row">
					<div class="large-9 small-7 columns">
						<input type="text" name="Spec_MAN" value="" id="Spec_MAN" data-parsley-type="integer" required>
					</div>
					<div class="large-3 small-5 columns">
						<input type="submit" class="button" name="submit" value="Search"/>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<?php require("includes/footer.php"); ?>

<script>
	jQuery(document).ready(function() {
		jQuery("#announcement-popup").modal({
			fadeDuration: 500,
			fadeDelay: 0.50
		});
	});
</script>