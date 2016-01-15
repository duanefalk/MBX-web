<?php 	
	$pageTitle = "Collection Reports";
	$pageDescription = "View reports about your own Matchbox University car collection.";
	include("includes/header.php");
?>

<section class="row">
	<div class="large-12 columns">
		<h2>Collection Reports</h2>
		<p>Select a report from the menu, fill in the specific data as required, and view or print.</p>
		
		<div class="row actionButtons">
			<div class="large-4 columns">
				<a href="Collection_Report_A.php" class="button dark">Collection Summary</a>
			</div>
			<div class="large-4 columns end">   
				<a href="Collection_Report_H.php" class="button dark">Summary for all Sellers</a>
			</div>
			<div class="large-4 columns end">   
				<a href="Collection_Report_M_Menu.php" class="button dark">Models in Collection</a>
			</div>					
			<div class="large-4 columns end">   
				<a href="Collection_Report_W.php" class="button dark">Wishlist Report</a>
			</div>			
		</div>
	</div>
</section>
		
<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="Collections_Menu.php">Manage Your Collections</a>
	</div>
</div>
		
<?php include("includes/footer.php"); ?>