<?php 
	require_once("includes/db_connection.php");
	include("includes/header.php");
	$pageTitle = "Add Release to Wishlist or Collection";
	$pageDescription = "Add this matchbox model release to your collection.";
	include("includes/functions.php");
?>

<?php
    $Rel_to_add=$_POST["Rel_to_Add"];	
    
    if ($_POST["Coll_or_wishlist_Choice"]=="Coll") {
		$location = "add-release-to-collection.php?model=" . $Rel_to_add;
    } else {
		$location = "add-release-to-wishlist.php?model=" . $Rel_to_add;
    }
    redirect_to($location);
?>