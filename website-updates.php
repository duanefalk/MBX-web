<?php 	
	$pageTitle = "Website Updates";
	include("includes/header.php");
	require("includes/constants.php");
?>

<div class="row">
	<div class="large-12 columns">
	
		<h2>Latest Website Updates</h2>
			
		<div class="section">
			<p class="date">May 08, 2015</p>
			<ul>
				<li>FIXES: Collection Summary report now works correctly. Working on Summary for All Sellers.</li>
				<li>New Model: <a href="<?php ROOTURL; ?>Models_Detail_and_Ver_Listing.php?model=SF0220">Flat Car Side Tipper (SF0220)</a></li>
				<li>New Model: <a href="<?php ROOTURL; ?>Models_Detail_and_Ver_Listing.php?model=SF0221">Motor-cycle Trailer (SF0221)</a></li>
				<li>Note- SF0222 not used at present</li>
				<li>New Model: <a href="<?php ROOTURL; ?>Models_Detail_and_Ver_Listing.php?model=SF0223">S 2 Buccaneer Jet (SF0223)</a></li>
				<li>New Model: <a href="<?php ROOTURL; ?>Models_Detail_and_Ver_Listing.php?model=SF0224">Rover 3500 (SF0224)</a></li>
				<li>New Model: <a href="<?php ROOTURL; ?>Models_Detail_and_Ver_Listing.php?model=SF0225">Swing Wing Tomcat Jet (SF0225)</a></li>
				<li>New Model: <a href="<?php ROOTURL; ?>Models_Detail_and_Ver_Listing.php?model=SF0226">Leyland Articulated Truck (SF0226)</a></li>
				<li>New Model: <a href="<?php ROOTURL; ?>Models_Detail_and_Ver_Listing.php?model=SF0227">Atlas Excavator (SF0227)</a></li>
				<li>New Model: <a href="<?php ROOTURL; ?>Models_Detail_and_Ver_Listing.php?model=SF0228">Chevy Pro Stocker (SF0228)</a></li>
			</ul>
		</div>	
			
		<div class="section">
			<p class="date">May 02, 2015</p>
			<ul>
				<li>FIXES: Lots of work! Thanks to all 'beta testers' who found bugs for me.</li>
				<li>Fixed issues with creating collection. Can now create collection without system error. Coll name limited to 12 chars</li>
				<li>Variation and Release detail screens: fixed bug that allowed you to add models to collection or wishlist even if you had not created a collection, or didn't have appropriate security (ie not logged in). Now fixed: will not see collection options on these screens unless you are logged in and have created a collection first.</li>
				<li>Added validation to many user input fields (ie collection code display order now requires a number)</li>
				<li>Fixed issues on Manage Collections screen- now shows appropriate check or x for steps you've completed or not</li>
				<li>Open Items: Collection Summary Reports are not retuning corect results. Will work on those over next coupel of days. Models in Collection reports does work.</li>
				<li>New Model: <a href="<?php ROOTURL; ?>Models_Detail_and_Ver_Listing.php?model=SF0229">BMW M1 (SF0229)</a></li>
				<li>New Model: <a href="<?php ROOTURL; ?>Models_Detail_and_Ver_Listing.php?model=SF0230">Snorkel Fire Engine (SF0230)</a></li>
				<li>New Model: <a href="<?php ROOTURL; ?>Models_Detail_and_Ver_Listing.php?model=SF0231">Ferrari 308 GTB (SF0231)</a></li>
				<li>New Model: <a href="<?php ROOTURL; ?>Models_Detail_and_Ver_Listing.php?model=SF0232">Leyland Articulated Truck Cab (SF0232)</a></li>
				<li>New Model: <a href="<?php ROOTURL; ?>Models_Detail_and_Ver_Listing.php?model=SF0233">Dodge Challenger (SF0233)</a></li>
				<li>New Model: <a href="<?php ROOTURL; ?>Models_Detail_and_Ver_Listing.php?model=SF0234">4x4 Jeep (SF0234)</a></li>
			</ul>
		</div>
		
		<div class="section">
			<p class="date">April 22, 2015</p>
			<ul>
				<li>ISSUE RESOLUTION: The problem with uploading files has been corrected. Uploaded files are now received by the site administrator, and the database record for the upload is created correctly.</li>	
				<li>Added Status Update function</li>
				<li>Fixed 'Create Account': on successful account creation it sends you directly to login page (fixes the 'Hello ___' problem in header)</li>
				<li>Fixed 'Edit Account' to show previous field entries</li>
				<li>New Model: <a href="<?php ROOTURL; ?>Models_Detail_and_Ver_Listing.php?model=SF0235">VW Rompin Rabbit (SF0235)</a></li>
				<li>New Model: <a href="<?php ROOTURL; ?>Models_Detail_and_Ver_Listing.php?model=SF0236">Ford Mini Pickup (SF0236)</a></li>
				<li>New Model: <a href="<?php ROOTURL; ?>Models_Detail_and_Ver_Listing.php?model=SF0237">Pontiac Firebird SE (SF0237)</a></li>
				<li>New Model: <a href="<?php ROOTURL; ?>Models_Detail_and_Ver_Listing.php?model=SF0238">Ford Open Back Truck (SF0238)</a></li>
				<li>New Model: <a href="<?php ROOTURL; ?>Models_Detail_and_Ver_Listing.php?model=SF0239">Leyland Artic. Tanker (SF0239)</a></li>
				<li>New Model: <a href="<?php ROOTURL; ?>Models_Detail_and_Ver_Listing.php?model=SF0240">Leyland Titan London Bus (SF0240)</a></li>
			</ul>
		</div>
		
		<div class="section">
			<p class="date">April 2, 2015</p>
			<ul>
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
