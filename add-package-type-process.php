<?php
	require_once("includes/db_connection.php");
	require_once("includes/functions.php");
	$pageTitle = "Processing a new Package Type";
	$pageDescription = "Processing the addition of a new Package Type to the Matchbox University collector's database.";
	include("includes/header.php");
?>

<!-- fields:
PkgVarCode
PkgType
PkgTypeYrs
PkgTypeDescr
PkgTypePhotoName
PkgTypePhotoPath
PkgTypePhotoRef

-->	

<?php
    $PkgVarCode=$_POST['PkgVarCode'];
    $PkgType=$_POST['PkgType'];
    $PkgTypeYrs=$_POST['PkgTypeYrs'];
    $PkgTypeDescr=$_POST['PkgTypeDescr'];
    $PkgTypePhotoName=$_POST['PkgTypePhotoName'];
    $PkgTypePhotoPath=$_POST['PkgTypePhotoPath'];
    $PkgTypePhotoRef=$_POST['PkgTypePhotoRef'];
 
    
    echo $PkgVarCode."<br />";
    echo $PkgType."<br />";
    echo $PkgTypeYrs."<br />";  
    echo $PkgTypeDescr."<br />";
    echo $PkgTypePhotoName."<br />";
    echo $PkgTypePhotoPath."<br />";
    echo $PkgTypePhotoRef."<br />";

    
    $query="INSERT INTO Matchbox_package_Varieties (PkgVarCode, PkgType, PkgTypeYrs, PkgTypeDescr, PkgTypePhotoName, PkgTypePhotoPath, PkgTypePhotoRef)
            VALUES ('$PkgVarCode','$PkgType','$PkgTypeYrs','$PkgTypeDescr','$PkgTypePhotoName','$PkgTypePhotoPath','$PkgTypePhotoRef')";
    // mysql_query($query);
    // "turned output buffering on cause this was giving me errors- couldnt find the source in the includes;
    // header("Location: add-package-type-form.php");
    
    // for some reason this gives me error duplicate key primary, but also does the insert!
    $outcome=mysql_query($query);
    if ($outcome) {
         redirect_to("add-package-type-form.php");
         exit;
     } // success 
     else {
         echo "<p>Subject creation failed.</p>";
         echo "<p>".mysql_error()."</p>";
      }
    mysql_close($connection);
?>