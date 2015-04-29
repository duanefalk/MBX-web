<?php ob_start();
	// we must never forget to start the session
	session_start();
?>

<?php 
	require_once("includes/db_connection.php");
	
	$pageTitle = "Collections";
	include("includes/header.php"); 
	require_once("includes/functions.php");
?>

<?php 	
	$Username= $_SESSION['Username'];
	$SecLvl=$_SESSION['Sec_Lvl'];
	$check = WEB_IMAGE_URL . "iconCheck.png";
	$cross = WEB_IMAGE_URL . "iconCross.png";
?>

<div class="row">
	<div class="large-12 columns">
	
		<h2>Manage Your Collections</h2>
		<div class="row actionButtons">
			<div class="large-4 columns">
				<a href="Manage_Collections.php" class="button dark">Create/Configure Your Collections</a>
			</div>
			<div class="large-4 columns">
		        <a href="Manage_Models_in_Collection.php" class="button dark">Manage Models in Your Collection</a>
		    </div>
		    <div class="large-4 columns">   
		        <a href="Collection_Reports.php" class="button dark">Collection Reports</a>
		    </div>
		</div>		
		
		<h2>Get Started with Your Collection</h2>	
		<p>Steps to set up a collection using this web site and database:</p>
		
		<h3>Step 1: Set up an Account</h3>	
		<?php

			if ($SecLvl > 1) { ?>
				<p><img class='icon inline' src="<?php echo $check ?>">You already have an account, proceed to step 2.</p>
			<?php } else { ?>
				<p><img class='icon inline' src="<?php echo $cross ?>">Go to the Account option from the Main Menu and set up and account, then return here.</p>			
			<?php } ?>
	
		<h3>Step 2: Create a Collection</h3>
		<?php
			$result = 0;
			$rows_count = 0;
			$query = ("SELECT * FROM Matchbox_User_Collections WHERE Username='$Username'");													
			$result = mysql_query($query);	
			if ($result) {
				$rows_count= mysql_num_rows($result);
				if ($rows_count>0) {
					$row = mysql_fetch_array($result);
					if ($row['User_Coll_Inactiv_Flag']==0) { 
						?> <p><img class='icon inline' src="<?php echo $check ?>">You've already created a collection, proceed to step 3</p>
					<?php } else {
						?> <p><img class='icon inline' src="<?php echo $cross ?>">Go to <a href="Create_Collection.php">Create a Collection</a>
					<?php }
				} else {
					?> <p><img class='icon inline' src="<?php echo $cross ?>">Go to <a href="Create_Collection.php">Create a Collection</a>
				<?php }	
			} ?>
					


		<h3>Step 3 (optional): Set up lists of sellers and storage locations</h3>
		<?php
			
			$result=0;
			$rows_count=0;
			$query=("SELECT * FROM Matchbox_User_Coll_Value_Lists WHERE Username= '$Username'");													
			$result = mysql_query($query);

			if ($result) {
				$rows_count= mysql_num_rows($result);
				if ($rows_count>0) {
					$row = mysql_fetch_array($result);
					if ($row['Coll_List_Val_InactivFlg']==0) { 
						?> <p><img class='icon inline' src="<?php echo $check ?>">You've already entered some Collection Code List items. You can add to your lists at any time from the <a href="Collection_Code_Lists.php">Create Collection Code Lists</a> menu option.</p>
					<?php } else {
						?> <p><img class='icon inline' src="<?php echo $cross ?>">No sellers or storage locations added yet.</p>
					<?php }
				} else {
					?> <p><img class='icon inline' src="<?php echo $cross ?>">No sellers or storage locations added yet.</p>
				<?php }	
			} ?>

		<h3>Step 4: Add models to your collection</h3>
		<?php
			
			//$result_mdls=0;
			$rows_count=0;
			$query_mdls= ("SELECT * FROM Matchbox_Collection WHERE Username= '$Username'");
			$result_mdls= mysql_query($query_mdls);
			//$rows_count= mysql_num_rows($result);

			if ($result_mdls) {
				$rows_count= mysql_num_rows($result_mdls);
				if ($rows_count>0) {
					$row = mysql_fetch_array($result_mdls);
					if ($row['Coll_InactiveFlg']==0) { ?>
						<p><img class='icon inline' src="<?php echo $check ?>">You've already started adding models. Enjoy growing your collection!</p>
					<?php } else { ?>
						<p><img class='icon inline' src="<?php echo $cross ?>">No models yet added</p>
						<p>There are two ways to add a model to your collection:</p>
						<p><strong>Option 1:</strong></p>
						<ul>
							<li>Look up a model you using either the <a href="Search_Models_Menu.php">Search Models</a> or <a href="Search_Releases_Menu.php">Search Releases</a> menu options.</li>
							<li>Drill down to the variation record that matches your model.</li>
							<li>On the <em>Variations Detail</em> page, check the box marked <em>Add to Collection</em>.</li>
							<li>Fill in the collection information in the resulting form and submit it (the model is now added to your collection).</li>
							<li>Note: you can search by any criteria on the search pages to get to the variation you want.</li>
						</ul>
						<p><strong>Option 2:</strong></p>
						<ul>
							<li>Direct entry: If you know the database 'Variation ID' (also called 'VarID') of the model you have (for instance, 'SF0484-003-a') you can enter it directly from the <a href="Manage_Collections.php">Manage Your Collection</a> menu.</li>
							<li>Using this option, you MUST have this ID- you cannot use just the MAN#, Mack# or other ID for this method.</li>
							<li>You can print listings of models with the VarID's to use as reference if you prefer this method.</li>
						</ul>
					<?php }
				} else { ?>
					<p><img class='icon inline' src="<?php echo $cross ?>">No models yet added</p>
					<p>There are two ways to add a model to your collection:</p>
					<p><strong>Option 1:</strong></p>
					<ul>
						<li>Look up a model you using either the <a href="Search_Models_Menu.php">Search Models</a> or <a href="Search_Releases_Menu.php">Search Releases</a> menu options.</li>
						<li>Drill down to the variation record that matches your model.</li>
						<li>On the <em>Variations Detail</em> page, check the box marked <em>Add to Collection</em>.</li>
						<li>Fill in the collection information in the resulting form and submit it (the model is now added to your collection).</li>
						<li>Note: you can search by any criteria on the search pages to get to the variation you want.</li>
					</ul>
					<p><strong>Option 2:</strong></p>
					<ul>
						<li>Direct entry: If you know the database 'Variation ID' (also called 'VarID') of the model you have (for instance, 'SF0484-003-a') you can enter it directly from the <a href="Manage_Collections.php">Manage Your Collection</a> menu.</li>
						<li>Using this option, you MUST have this ID- you cannot use just the MAN#, Mack# or other ID for this method.</li>
						<li>You can print listings of models with the VarID's to use as reference if you prefer this method.</li>
					</ul>
				<?php }
			} ?>	
			
	</div>
</div>

<?php include("includes/footer.php"); ?>