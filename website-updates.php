<?php 	
	$pageTitle = "Website Updates";
	include("includes/header.php");
	require("includes/constants.php");
?>

<div class="row">
	<div class="large-12 columns">
	
		<h2>Latest Website Updates</h2>
			
		<div class="section">
			<p class="date">April 2, 2015</p>
			<ul>
				<li>ISSUE RESOLUTION: The problem with uploading files has been corrected. Uploaded files are now received by the site administrator, and the database record for the upload is created correctly.</li>	
				<li>Added Status Update function</li>
				<li>Fixed 'Create Account': on successful account creation it sends you directly to login page (fixes the 'Hello ___' problem in header)</li>
				<li>Fixed 'Edit Account' to show previous field entries</li>
				<li>New Model: <a href="<?php ROOTURL; ?>Models_Detail_and_Ver_Listing.php?model=SF0235">Ford Mini Pickup (SF0235)</a></li>
				<li>New Model: <a href="<?php ROOTURL; ?>Models_Detail_and_Ver_Listing.php?model=SF0236">Ford Mini Pickup (SF0236)</a></li>
				<li>New Model: <a href="<?php ROOTURL; ?>Models_Detail_and_Ver_Listing.php?model=SF0237">Pontiac Firebird SE (SF0237)</a></li>
				<li>New Model: <a href="<?php ROOTURL; ?>Models_Detail_and_Ver_Listing.php?model=SF0238">Ford Open Back Truck (SF0238)</a></li>
				<li>New Model: <a href="<?php ROOTURL; ?>Models_Detail_and_Ver_Listing.php?model=SF0239">Leyland Artic. Tanker (SF0239)</a></li>
				<li>New Model: <a href="<?php ROOTURL; ?>Models_Detail_and_Ver_Listing.php?model=SF0240">Leyland Titan London Bus (SF0240)</a></li>
				<li>New Model: <a href="<?php ROOTURL; ?>Models_Detail_and_Ver_Listing.php?model=SF0241">Peterbilt Cement Truck (SF0241)</a></li>
				<li>New Model: <a href="<?php ROOTURL; ?>Models_Detail_and_Ver_Listing.php?model=SF0242">Ford Mini Pickup (SF0242)</a></li>
				<li>New Model: <a href="<?php ROOTURL; ?>Models_Detail_and_Ver_Listing.php?model=SF0243">Audi Quattro (SF0243)</a></li>
				<li>New Model: <a href="<?php ROOTURL; ?>Models_Detail_and_Ver_Listing.php?model=SF0244">Volvo trucks (cable truck, zoo truck, container truck) (SF0244)</a></li>
			</ul>
		</div>
		
		<!--div class="section">
			<p class="date">April 2, 2015</p>
			<ul>
				<li>Added Status Update function</li>
				<li>Fixed 'Create Account': on successful account creation it sends you directly to login page (fixes the 'Hello ___' problem in header)</li>
				<li>Fixed 'Edit Account' to show previous field entries</li>
				<li>New Model: Ford Mini Pickup (SF0242)</li>
				<li>New Model: Audi Quattro (SF0243)</li>
				<li>New Model: Volvo trucks (cable truck, zoo truck, container truck) (SF0244)</li>
			</ul>
		</div-->
						
	</div>
</div>

<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="DB_explain.php">About the Database</a>
		<a href="MB_Code_System.php">The Code System</a>
		<a href="About_photos.php">Links & Photo References</a>
		<a href="Ref_files.php">Reference Files</a>
		<a href="Dedication.php">Dedication</a>
	</div>
</div>

<?php include("includes/footer.php"); ?>
