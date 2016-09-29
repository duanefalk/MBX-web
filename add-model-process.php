<?php 
	require_once("includes/db_connection.php");
	require_once("includes/functions.php");
	$pageTitle = "Processing a new Model";
	$pageDescription = "Processing the addition of a new Model to the Matchbox University collector's database.";
	include("includes/header.php");
?>

<?php

    // NOTE: CHECK OUT MYSQL_PREP FUNCTION TO CLEAN UP STRINGS
    // IT GOES IN HERE: $UMID=MYSQL_PREP($_POST['UMID']);
    
    $UMID=$_POST['UMID'];
    $Master_Model_Name=$_POST['MasterModelName'];
    $Model_Photo_Name=$_POST['ModelPhotoName'];
    $Model_Photo_Ref=$_POST['ModelPhotoRef'];
    $Yr_First_Prod=$_POST['YrFirstProduced'];
    $Vehicle_Type=$_POST['VehicleType'];
    $Vehicle_Type_2=$_POST['VehicleType2'];
    $Model_Scale=$_POST['ModelScale'];
    $Base_Cast_Yr=$_POST['BaseCastYr'];
    $Model_Comment=$_POST['ModelComment'];
    $Similar_Models=$_POST['SimilarModels'];
    $Make_of_Model=$_POST['MakeofModel'];
    $Country_of_Make=$_POST['CountryofMake'];

    echo $UMID."<br />";
    echo $Master_Model_Name."<br />";
    echo $Model_Photo_Name."<br />";
    echo $Model_Photo_Ref."<br />";
    echo $Yr_First_Prod."<br />";
    echo $Vehicle_Type."<br />";
    echo $Vehicle_Type_2."<br />";
    echo $Model_Scale."<br />";
    echo $Base_Cast_Yr."<br />";
    echo $Model_Comment."<br />";
    echo $Similar_Models."<br />";
    echo $Make_of_Model."<br />";
    echo $Country_of_Make."<br />";
 
    
    $query="INSERT INTO Matchbox_Models (UMID, MasterModelName, ModelPhotoName, ModelPhotoRef, YrFirstProduced, VehicleType, VehicleType2, ModelScale, BaseCastYr, ModelComment,
            SimilarModels, MakeofModel, CountryofMake
            ) VALUES ('$UMID','$Master_Model_Name','$Model_Photo_Name','$Model_Photo_Ref','$Yr_First_Prod','$Vehicle_Type','$Vehicle_Type_2',
            '$Model_Scale','$Base_Cast_Yr','$Model_Comment','$Similar_Models','$Make_of_Model','$Country_of_Make')";
    //mysql_query($query);
    // "turned output buffering on cause this was giving me errors- couldnt find the source in the includes;
    
    //header("Location: Add_Model_form.php");
    
    // for some reason this statement executes the mysql_query rather than  just evaluate it. so commente dout mysqlquery above to avoid dupl
    $outcome=mysql_query($query);
    if ($outcome) {
    //if ((mysql_query($query)) == true) {
         redirect_to("add-model-form.php");
         exit;
     } // success 
    
     else {
         echo "<p>Subject creation failed.</p>";
         echo "<p>".mysql_error()."</p>";
      }
    mysql_close($connection);
?>