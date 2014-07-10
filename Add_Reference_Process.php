<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

    <!-- fields:
    RefType
    RefCode
    RefName
    RefDetails
    RefComment
    -->	

<?php
    $RefCode=$_POST['RefCode'];
    $RefType=$_POST['RefType'];
    $RefName=$_POST['RefName'];
    $RefDetails=$_POST['RefDetails'];
    $RefComment=$_POST['RefComment'];

 
    
    echo $RefCode."<br />";
    echo $RefType."<br />";
    echo $RefName."<br />";  
    echo $RefDetails."<br />";
    echo $RefComment."<br />";


    
    $query="INSERT INTO Matchbox_References (RefType, RefCode, RefName, RefDetails, RefComment)
            VALUES ('$RefType','$RefCode','$RefName','$RefDetails','$RefComment')";
    // mysql_query($query);
    // "turned output buffering on cause this was giving me errors- couldnt find the source in the includes;
    // header("Location: Add_Reference_Form.php");
    
    // for some reason this gives me error duplicate key primary, but also does the insert!
    $outcome=mysql_query($query);
    if ($outcome) {
         redirect_to("Add_Reference_Form.php");
         exit;
     } // success 
     else {
         echo "<p>Subject creation failed.</p>";
         echo "<p>".mysql_error()."</p>";
      }
    mysql_close($connection);
?>