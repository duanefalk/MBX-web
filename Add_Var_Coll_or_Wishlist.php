<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>

<?php
    $Var_to_add=$_POST["Var_to_Add"];	
    if ($_POST["Coll_or_wishlist_Choice"]=="Coll") {
	$location="Add_Var_to_Coll.php?model=".$Var_to_add;
    } ELSE {
	$location="Add_Var_to_Wishlist.php?model=".$Var_to_add;
    }
    redirect_to($location);
?>
	
	