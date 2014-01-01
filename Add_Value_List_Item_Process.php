<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
    $Value_List=$_POST['ValueList'];
    $Entry=$_POST['ValueListEntry'];
    $ValueDispOrder=$_POST['ValueDispOrder'];

    $query="INSERT INTO Test_Matchbox_Value_Lists (
            ValueList, ValueListEntry, ValueDispOrder
            ) VALUES (
            '$Value_List', '$Entry', '$ValueDispOrder'     
            )";
    //mysql_query($query);
    //turned output buffering on cause this was giving me errors- couldnt find the source in the includes 
    //header("Location: Add_Value_List_Item_Form.php");
    
    //for some reason this gives me error duplicate key primary, but also does the insert!
    $outcome=mysql_query($query);
    if ($outcome) {
        redirect_to("Add_Value_List_Item_Form.php");
        exit;
    } // success 
    else {
        echo "<p>Subject creation failed.</p>";
        echo "<p>".mysql_error()."</p>";
     }
    mysql_close($connection); ?>