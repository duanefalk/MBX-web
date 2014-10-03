<?php
	// we must never forget to start the session
	session_start();
?>

<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php require_once("includes/functions.php"); ?>

<?php 	$Username= $_SESSION['Username'];
	$SecLvl=$_SESSION['Sec_Lvl'];
	$check = WEB_IMAGE_URL . "iconCheck.png";
	$X_out = WEB_IMAGE_URL . "iconCross.png";
?>

<div class="row">
	<div class="large-12 columns">
	
		<h2>Your Collections</h2>
		<p>Steps to set up a collection using this web site and database:</p>
		
		<h3>Step 1: Set up an Account</h3>	
		<?php

			if ($SecLvl > 1) {
				echo "<p><img class='icon inline' src=".$check." width=\"40\"> You are all set with an account, proceed to step 2.</p>";
			} else {
				echo "<p><img class='icon inline' src=".$X_out." width=\"40\"> Go to the Account option from the Main Menu and set up and account, then return here.</p>";					
			}
		?>
	
		<h3>Step 2: Create a Collection under your account</h3>
		<?php
			$result = 0;
			$rows_count = 0;
			$query = ("SELECT * FROM Matchbox_User_Collections WHERE Username='$Username'");													
			$result = mysql_query($query);
			$rows_count = mysql_num_rows($result);
	                if ($rows_count == 0) {
				echo "<p><img class='icon inline' src=".$X_out." width=\"40\"> Go to 'Create a Collection' (from 'Manage Collections', on this page) and set up a new collection.</p>";
			}
			else {				
				echo "<p><img class='icon inline' src=".$check." width=\"40\"> You've already created a collection, proceed to step 3</p>";		
			}
		?>

		<h3>Step 3 (optional): Set up lists of sellers and storage locations</h3>
		<?php
			//fake until set up
			$result=0;
			$rows_count=0;
			$query=("SELECT * FROM Matchbox_User_Coll_Value_Lists WHERE Username= '$Username'");													
			$result = mysql_query($query);
			$rows_count= mysql_num_rows($result);
	        
	        if ($rows_count == 0) {
				echo "<p><img class='icon inline' src=".$X_out." width=\"40\"> No sellers or storage locations added yet."."</p>";
				echo "<p>If you want to have your own sellers and storage locations for your collection (and don't want to type them in each time), Go to 'Set Up Collection Value Lists' (from 'Manage Collections', on this page) and enter the values you desire. These will show up in drop-down lists that you can select from, for the appropriate fields when you are adding models rather than you needing to type them in.</p>";	
			}
			else {
				echo "<p><img class='icon inline' src=".$check." width=\"40\"> You've already entered some collection value list items. You can add to your lists at any time from the 'Create Collection Value Lists menu option.</p>";
			}
		?>

		<h3>Step 4: Add models to your collection</h3>
		<?php
			$result_mdls=0;
			$rows_count=0;
			$query_mdls= ("SELECT * FROM Matchbox_Collection WHERE Username= '$Username'");
			$result_mdls= mysql_query($query_mdls);
			$rows_count= mysql_num_rows($result);
	                if ($rows_count == 0) {
			//$Collection_not_null=0;
			//if ($Collection_not_null) {
				//echo "<img src=/" . $check . " width=\"40\">";
				echo "<p><img class='icon inline' src=" . $check . " width=\"40\"> You've already started adding models. Enjoy growing your collection!</p>";
			} else {
				echo "<p><img class='icon inline' src=" . $X_out . " width=\"40\"> No models yet added</p>";
				echo "<p>There are two ways to add a model to your collection:</p>";
				echo "<p><strong>Option 1:</strong> Do a model/release search, then add from the search result.</p>";
				echo "<p>First look up the model you have from the 'Search Models' or 'Search Releases' menu options ('Main' page).</p>";
				echo "<p>Then drill down to the variation record that matches your model. On the 'Variations Detail' page, check the box marked 'Add to Collection' next to the photo of the correct variation. Fill in the collection information in the resulting form, and submit it.</p>";
				echo "<p>The model is now added to your collection.</p>";
				echo "<p>Note: you can search by any criteria on the search pages to get to the variation you want.</p>";
				echo "<br></br>";
				echo "<p><strong>Option 2:</strong> Direct entry.</p>";
				echo "<p>If you know the database 'Variation ID' (also called 'VarID') of the model you have (for instance, 'SF0484-003-a') you can enter it directly from the 'Manage Your Collection' menu. Using this option, you MUST have this ID- you cannot use just the MAN#, Mack# or other ID for this method. You can print listings of models with the VarID's to use as reference if you prefer this method.</p>";						
			}
		?>	
		
	</div>
</div>

	
<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="Manage_Collections.php">Create/Configure Your Collections</a>
		<a href="Manage_Models_in_Collection.php">Manage Models in Your Collection</a>
		<a href="Collection_Reports.php">Collection Reports</a>
	</div>
</div>	


<?php include("includes/footer.php"); ?>