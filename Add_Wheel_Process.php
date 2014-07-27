<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<?php
    $Wheel_Type=$_POST['WheelTyp'];
    $Wheel_Code=$_POST['WheelCod'];
    $Wheel_Description=$_POST['WheelDescr'];
    $Wheel_Photo_Path=$_POST['WheelPhotoPath'];
    $Wheel_Photo_Name=$_POST['WheelPhotoName'];
    $Wheel_Photo_Ref=$_POST['WheelPhotoRef'];
    $query="INSERT INTO Matchbox_Wheels (
            WheelTyp, WheelCod, WheelDescr, WheelPhotoPath, WheelPhotoName, WheelPhotoRef
            ) VALUES (
            '$Wheel_Type', '$Wheel_Code', '$Wheel_Description', '$Wheel_Photo_Path', '$Wheel_Photo_Name', '$Wheel_Photo_Ref'     
            )";
    // mysql_query($query);
    //turned output buffering on cause this was giving me errors- couldnt find the source in the includes 
    //header("Location: Add_Wheel_Form.php");
    
    //for some reason this gives me error duplicate key primary, but also does the insert!
    $outcome=mysql_query($query);
    if ($outcome) {
        redirect_to("Add_Wheel_Form.php");
        exit;
    } // success 
     else {
        echo "<p>Subject creation failed.</p>";
        echo "<p>".mysql_error()."</p>";
        exit;
     }
    mysql_close($connection);
?>