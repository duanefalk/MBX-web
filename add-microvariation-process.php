<?php 
	require_once("includes/db_connection.php");
	require_once("includes/functions.php");
	$pageTitle = "Processing a new Microvariation";
	$pageDescription = "Processing the addition of a new Microvariation to the Matchbox University collector's database.";
	include("includes/header.php");
?>

    <!-- fields:
    UMID
    Microvariation
    Microvar_Updt_Dt
    -->	

<?php
    $UMID=$_POST['UMID'];
    $Text=$_POST['Microvariation'];
    $Updt_Dt=$_POST['Microvar_Updt_Dt'];
    
    echo $UMID."<br />";
    echo $Text."<br />";
    echo $Updt_Dt."<br />";  
    
    $query="INSERT INTO Matchbox_Microvariations (UMID, Microvariation, Microvar_Updt_Dt)
            VALUES ('$UMID','$Text','$Updt_Dt')";

    $outcome=mysql_query($query);
    if ($outcome) {
         redirect_to("add-microvariation-form.php");
         exit;
     } // success 
     else {
         echo "<p>Subject creation failed.</p>";
         echo "<p>".mysql_error()."</p>";
      }
    mysql_close($connection);
?>