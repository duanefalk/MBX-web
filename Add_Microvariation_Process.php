<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

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
         redirect_to("Add_Microvariation_Form.php");
         exit;
     } // success 
     else {
         echo "<p>Subject creation failed.</p>";
         echo "<p>".mysql_error()."</p>";
      }
    mysql_close($connection);
?>