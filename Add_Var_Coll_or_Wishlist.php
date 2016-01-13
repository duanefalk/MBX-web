<?php
	ob_start();
	session_start();
	require_once("includes/db_connection.php");
	$pageTitle = "Add Variation to Collection or Wishlist";
	$pageDescription = "Add this matchbox model variation to your collection.";
	include("includes/header.php");
	include("includes/functions.php");
?>
<?php
    $Var_to_add=$_POST["Var_to_Add"];	
    
    if ($_POST["Coll_or_wishlist_Choice"]=="Coll") {
		$location="Add_Var_to_Coll.php?model=".$Var_to_add;
    } else {
		$location="Add_Var_to_Wishlist.php?model=".$Var_to_add;
    }
    redirect_to($location);
?>
	
	