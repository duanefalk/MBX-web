<?php 
	require_once("includes/db_connection.php");
	require_once("includes/functions.php");
	$pageTitle = "Processing a new Variation";
	$pageDescription = "Processing the addition of a new Variation to the Matchbox University collector's database.";
	include("includes/header.php");
?>

<!-- fields:
 UMID
    VERID
    VARID
    Mack_No
    BaseName
    BaseCompany
    ManufLoc
    VarYear
    FWhCd
    RWhCd
    WindowColor
    InteriorColor
    Base1Material
    Base1Color
    Base2Typ
    Base2Material
    Base2Color
    Finish
    ColorVar
    TempaVar
    Det1Type
    Det1Var
    Det2Type
    Det2Var
    Det3Type
    Det3Var
    Det4Type
    Det4Var
    Det5Type
    Det5Var
    CodeLvl
    SecManuf
    VarComment
    
    VarPhoto1Ref
    
    VarPhoto2Ref
-->		

<?php
    $UMID=$_POST['UMID'];
    $VERID=$_POST['VERID1'];
    //$VERID= $UMID.'-'.$VERID1;
    $VARID=$_POST['VARID1'];
    //$VARID=$UMID.'-'.$VERID1.'-'.$VARID1;
    $Mack_No=$_POST['Mack_No'];
    $BaseName=$_POST['BaseName'];
    $BaseCompany=$_POST['BaseCompany'];
    $ManufLoc=$_POST['ManufLoc'];
    $VarYear=$_POST['VarYear'];
    $FWhCd=$_POST['FWhCd'];
    $RWhCd=$_POST['RWhCd'];
    $WindowColor=$_POST['WindowColor'];
    $InteriorColor=$_POST['InteriorColor'];
    $Base1Material=$_POST['Base1Material'];
    $Base1Color=$_POST['Base1Color'];
    $Base2Type=$_POST['Base2Material'];
    if ($Base2Type=="No Base") {
        $Base2Type="";
        $Base2Material="";
        $Base2Color="";
    } else {
        $Base2Material=$_POST['Base2Material'];
        $Base2Color=$_POST['Base2Color'];
    }    
    $Finish=$_POST['Finish'];
    $ColorVar=$_POST['ColorVar'];
    $TempaVar=$_POST['TempaVar'];
    $Det1Typ=$_POST['Det1Typ'];
    $Det1Var=$_POST['Det1Var'];
    $Det2Typ=$_POST['Det2Typ'];
    $Det2Var=$_POST['Det2Var'];
    $Det3Typ=$_POST['Det3Typ'];
    $Det3Var=$_POST['Det3Var'];
    $Det4Typ=$_POST['Det4Typ'];
    $Det4Var=$_POST['Det4Var'];
    $Det5Typ=$_POST['Det5Typ'];
    $Det5Var=$_POST['Det5Var'];
    $CodeLvl=$_POST['CodeLvl'];
    $SecManuf=$_POST['SecManuf'];
    $VarComment=$_POST['VarComment'];
    //$VarPhoto1Name=$_POST['VarPhoto1Name'];
    $VarPhoto1Ref=$_POST['VarPhoto1Ref'];
    //$VarPhoto2Name=$_POST['VarPhoto2Name'];
    if (!ISSET($_POST['VarPhoto2Ref'])) {
        $VarPhoto2Ref=""; 
    } else {
        $VarPhoto2Ref=$_POST['VarPhoto2Ref'];
    }
    
    //echo $UMID."<br />";
    //echo $VERID."<br />";
    //echo $VARID."<br />";  
    //echo $Mack_No."<br />";
    //echo $BaseName."<br />";
    //echo $ManufLoc."<br />";
    //echo $VarYear."<br />";
    //echo $FWhCd."<br />";
    //echo $RWhCd."<br />";
    //echo $WindowColor."<br />";
    //echo $InteriorColor."<br />";
    //echo $Base1Typ."<br />";
    //echo $Base1Color."<br />";
    //echo $Base2Typ."<br />";
    //echo $Base2Color."<br />";
    //echo $Finish."<br />"; 
    //echo $ColorVar."<br />";
    //echo $TempaVar."<br />";
    //echo $Det1Typ."<br />";
    //echo $Det1Var."<br />";
    //echo $Det2Typ."<br />";
    //echo $Det2Var."<br />";
    //echo $Det3Typ."<br />";
    //echo $Det3Var."<br />";
    //echo $Det4Typ."<br />";
    //echo $Det4Var."<br />";
    //echo $Det5Typ."<br />";
    //echo $Det5Var."<br />";
    //echo $StdValue."<br />";
    //echo $VarComment."<br />";
   
    //echo $VarPhoto1Ref."<br />";
    
    //echo $VarPhoto2Ref."<br />";
    
    $query="INSERT INTO Matchbox_Variations (UMID, VERID, VARID, Mack_No, BaseName, BaseCompany, ManufLoc, VarYear, FWhCd, RWhCd, WindowColor, InteriorColor,
            Base1Material, Base1Color, Base2Type, Base2Material, Base2Color, Finish, ColorVar, TempaVar, Det1Typ, Det1Var, Det2Typ, Det2Var, Det3Typ, Det3Var, Det4Typ, Det4Var,
            Det5Typ, Det5Var, VarComment, VarPhoto1Ref, VarPhoto2Ref
            ) VALUES ('$UMID','$VERID','$VARID','$Mack_No','$BaseName', '$BaseCompany', '$ManufLoc','$VarYear','$FWhCd', '$RWhCd','$WindowColor', '$InteriorColor',
            '$Base1Material','$Base1Color','$Base2Type','$Base2Material','$Base2Color','$Finish','$ColorVar', '$TempaVar', '$Det1Typ', '$Det1Var', '$Det2Typ', '$Det2Var', '$Det3Typ', '$Det3Var', '$Det4Typ', '$Det4Var',
            '$Det5Typ', '$Det5Var', '$VarComment', '$VarPhoto1Ref', '$VarPhoto2Ref')";
    // mysql_query($query);
    // "turned output buffering on cause this was giving me errors- couldnt find the source in the includes;
    // header("Location: add-variation-form.php");
    
    // for some reason this gives me error duplicate key primary, but also does the insert!
    $outcome=mysql_query($query);
    if ($outcome) {
         redirect_to("add-variation-form.php");
         exit;
     } // success 
     else {
         echo "<p>Subject creation failed.</p>";
         echo "<p>".mysql_error()."</p>";
      }
    mysql_close($connection);
?>