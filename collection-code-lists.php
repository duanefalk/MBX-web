<?php 
	$pageTitle = "Manage Code Lists";
	$pageDescription = "Manage your Matchbox University car collection Seller and Location codes.";
	require_once("includes/db_connection.php");
	include("includes/header.php");
	require_once("includes/functions.php");
?>

<div class="row">	
	<div class="large-12 columns">
        <h2>Manage Your Code Lists</h2>
        
        <div class="row actionButtons">
			<div class="large-4 columns">
				<a href="add-user-collection-code.php" class="button dark">Add a New Seller or Location Code</a>
			</div>
			<div class="large-4 columns end">
		    	<a href="update-user-collection-code.php" class="button dark">Update/Delete Codes</a>
		    </div>
		</div>
        
        
        <p>Collection code lists can speed up adding models to your collection by letting you select from a drop-down list of sellers and storage locations, rather than having to type those in with each model. In the add/update/delete functions you will first be asked whether you want to work with <strong>'Sellers'</strong> or <strong>'Locations'</strong></p>

		<h4>Sellers</h4>
        <p><strong>Sellers</strong> are, of course, the people or companies from whom you buy your models. Typically there will be a core group of sellers you use repeatedly, so selecting them from a list will be quicker than typing out their names. There are two fields to enter for sellers:</p>
        <ul>
            <li><strong>Seller Name:</strong> The name of the person or company</li>
            <li><strong>Display Order:</strong> It is more convenient to have the most commonly used sellers at the front of the list. You can enter a number here to set the order they display in the list. I would recommend leaving gaps in the numbers between each seller for future additions.</li>
        </ul>
        <h4>Locations</h4>
        <p><strong>'Locations'</strong> refers to storage locations for your models. In the collection table you are given two fields for these, which allows you to enter a main location and a sub-location (e.g. storage unit1, shelf 3). As with sellers, there are two fields to enter:</p>
        <ul>
            <li><strong>Location Name:</strong> What you call your storage locations. You need to include both main locations and sub-locations in the list, if you have them.</li>
            <li><strong>Display Order:</strong> As above, the order the locations display in the drop-down. You may want to group your main locations first, then you sub-locations.</li>
        </ul>
	</div>
</div>

<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="manage-collections.php">Manage Collections</a>
	</div>
</div>


<?php include("includes/footer.php"); ?>