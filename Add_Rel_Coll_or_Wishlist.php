<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>

<?php
    $Rel_to_add=$_POST["Rel_to_Add"];	
    if ($_POST["Coll_or_wishlist_Choice"]=="Coll") {
	$location="Add_Rel_to_Coll.php?model=".$Rel_to_add;
    } ELSE {
	$location="Add_Rel_to_Wishlist.php?model=".$Rel_to_add;
    }
    redirect_to($location);
?>