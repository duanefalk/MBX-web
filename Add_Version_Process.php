<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<!-- fields:
    UMID
    VERID
    FAB_No
    Master_Mack_No
    VerName
    VerYrFirstRel
    VerTyp
    CodeLvl
    SecManuf
    BodyColor
    TempaDesign
    TempaText
    VerAttachments
    VerPhoto1Name
    VerPhoto1Path
    VerPhoto1Ref
    VerPhoto2Name
    VerPhoto2Path
    VerPhoto2Ref
    VerComm
-->		

<?php
    $UMID=$_POST['UMID'];
    $VERID1=$_POST['VERID1'];
    $VERID= $UMID.'-'.$VERID1;
    $FAB_No=$_POST['FAB_No'];
    $Master_Mack_No=$_POST['Master_Mack_No'];
    $VerName=$_POST['VerName'];
    $VerYrFirstRel=$_POST['VerYrFirstRel'];
    $VerTyp=$_POST['VerTyp'];
    $CodeLvl=$_POST['CodeLvl'];
    $SecManuf=$_POST['SecManuf'];
    $BodyColor=$_POST['BodyColor'];
    $TempaDesign=$_POST['TempaDesign'];
    $TempaText=$_POST['TempaText'];
    $VerAttachments=$_POST['VerAttachments'];
    $VerPhoto1Name=$_POST['VerPhoto1Name'];
    $VerPhoto1Ref=$_POST['VerPhoto1Ref'];
    $VerPhoto2Name=$_POST['VerPhoto2Name'];
    if (!ISSET($_POST['VerPhoto2Name'])) {
        $VerPhoto2Ref=""; 
    } else {
    $VerPhoto2Ref=$_POST['VerPhoto2Ref'];
    }
    $VerComm=$_POST['VerComm'];
    
    
    //echo $UMID."<br />";
    //echo $VERID."<br />";
    //echo $FAB_No."<br />";
    //echo $Master_Mack_No."<br />";
    //echo $VerName."<br />";
    //echo $VerYrFirstRel."<br />";
    //echo $VerTyp."<br />";
    //echo $CodeLvl."<br />";
    //echo $SecManuf."<br />";
    //echo $BodyColor."<br />";
    //echo $TempaDesign."<br />";
    //echo $TempaText."<br />";
    //echo $VerAttachments."<br />";
    //echo $VerPhoto1Name."<br />";
    //echo $VerPhoto1Ref."<br />";
    //echo $VerPhoto2Name."<br />";
    //echo $VerPhoto2Ref."<br />";
    //echo $VerComm."<br />";
 
    
    $query="INSERT INTO Matchbox_Versions (UMID, VERID, FAB_No, Master_Mack_No, VerName, VerYrFirstRel, VerTyp, CodeLvl, SecManuf, BodyColor, TempaDesign, TempaText,
            VerAttachments, VerPhoto1Name, VerPhoto1Ref, VerPhoto2Name, VerPhoto2Ref, VerComm
            ) VALUES ('$UMID','$VERID','$FAB_No','$Master_Mack_No','$VerName','$VerYrFirstRel','$VerTyp', '$CodeLvl', '$SecManuf', '$BodyColor','$TempaDesign', '$TempaText',
            '$VerAttachments','$VerPhoto1Name','$VerPhoto1Ref','$VerPhoto2Name','$VerPhoto2Ref', '$VerComm')";
    // mysql_query($query);
    // "turned output buffering on cause this was giving me errors- couldnt find the source in the includes;
    // header("Location: Add_Version_Form.php");
    
    // for some reason this gives me error duplicate key primary, but also does the insert!
    $outcome=mysql_query($query);
    if ($outcome) {
         redirect_to("Add_Version_Form.php");
         exit;
     } // success 
     else {
         echo "<p>Subject creation failed.</p>";
         echo "<p>".mysql_error()."</p>";
      }
    mysql_close($connection);
?>