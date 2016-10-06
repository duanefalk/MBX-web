<?php 
	require_once("includes/db_connection.php");
	require_once("includes/functions.php");
	$pageTitle = "Processing a new Value List Item";
	$pageDescription = "Processing the addition of a new Value List Item to the Matchbox University collector's database.";
	include("includes/header.php");
?>
<?php
    $Value_List=$_POST['ValueList'];
    $Entry=$_POST['ValueListEntry'];
    $ValueDispOrder=$_POST['ValueDispOrder'];

    $query="INSERT INTO Matchbox_Value_Lists (
            ValueList, ValueListEntry, ValueDispOrder
            ) VALUES (
            '$Value_List', '$Entry', '$ValueDispOrder'     
            )";
    //mysql_query($query);
    //turned output buffering on cause this was giving me errors- couldnt find the source in the includes 
    //header("Location: add-value-list-item-form.php");
    
    //for some reason this gives me error duplicate key primary, but also does the insert!
    $outcome=mysql_query($query);
    if ($outcome) {
        redirect_to("add-value-list-item-form.php");
        exit;
    } // success 
    else {
        echo "<p>Subject creation failed.</p>";
        echo "<p>".mysql_error()."</p>";
     }
    mysql_close($connection); ?>