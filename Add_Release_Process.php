<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

<!--Fields:
        UMID
        VerID
        VarID
        RelID
        RelYr
        CountryofSale
        Theme
        Series
        SeriesID
        ShowSeriesID
        PkgName
        MdlNameOnPkg
        SubSeries
        SubSeriesID
        ShowSubseriesID
        UnitTyp
        PkgID
        PkgVarCd
        
        RelComm
        RelPkgPhotoName
        RelPkgPhotoRef
-->

<?php
    $UMID=$_POST['UMID'];
    $VERID1=$_POST['VERID1'];
    $VerID= $UMID.'-'.$VERID1;
    $VARID1=$_POST['VARID1'];
    $VarID=$VerID.'-'.$VARID1;
    $RELID1=$_POST['RELID1'];
    $RelID=$VarID.'-'.$RELID1;
    $RelYr=$_POST['RelYr'];
    $CountryOfSale=$_POST['CountryOfSale'];
    $Theme=$_POST['Theme'];
    $Series=$_POST['Series'];
    $SeriesID=$_POST['SeriesID'];
    $ShowSeriesID=$_POST['ShowSeriesID'];
    $PkgName=$_POST['PkgName'];
    $MdlNameOnPkg=$_POST['MdlNameOnPkg'];
    $SubSeries=$_POST['SubSeries'];
    if ($SubSeries=="") {
        $SubSeriesID="";
        $ShowSubSeriesID=""; 
    } else {
        $SubSeriesID=$_POST['SubSeriesID'];
        $ShowSubSeriesID=$_POST['ShowSubSeriesID'];
    }    
    $UnitTyp=$_POST['UnitTyp'];
    $PkgID=$_POST['PkgID'];
    $PkgVarCd=$_POST['PkgVarCd'];
    $RelComm=$_POST['RelComm'];
    $RelPkgPhotoName=$_POST['RelPkgPhotoName'];
    $RelPkgPhotoRef=$_POST['RelPkgPhotoRef'];
    

    echo $UMID."<br />";
    echo $VerID."<br />";
    echo $VarID."<br />";
    echo $RelID."<br />";
    echo $RelYr."<br />";
    echo $CountryOfSale."<br />";
    echo $Theme."<br />";
    echo $Series."<br />";
    echo $SeriesID."<br />";
    echo $ShowSeriesID."<br />";
    echo $PkgName."<br />";
    echo $MdlNameOnPkg."<br />";
    echo $SubSeries."<br />";
    echo $SubSeriesID."<br />";
    echo $ShowSubSeriesID."<br />";
    echo $UnitTyp."<br />";
    echo $PkgID."<br />";
    echo $PkgVarCd."<br />";
    echo $RelComm."<br />";
    echo $RelPkgPhotoName."<br />";
    echo $RelPkgPhotoRef."<br />";
    
   
    $query="INSERT INTO Test_Matchbox_Releases (UMID, VerID, VarID, RelID, RelYr, CountryOfSale, Theme, Series, SeriesID, ShowSeriesID,
            PkgName, MdlNameOnPkg, SubSeries, SubSeriesID, ShowSubSeriesID, UnitTyp, PkgID, PkgVarCd, RelComm, RelPkgPhotoName,
            RelPkgPhotoRef)
            VALUES ('$UMID','$VerID','$VarID','$RelID','$RelYr','$CountryOfSale','$Theme','$Series', '$SeriesID', '$ShowSeriesID',
            '$PkgName','$MdlNameOnPkg','$SubSeries','$SubSeriesID','$ShowSubSeriesID','$UnitTyp', '$PkgID', '$PkgVarCd', '$RelComm', '$RelPkgPhotoName',
            '$RelPkgPhotoRef')";
    // mysql_query($query);
    // "turned output buffering on cause this was giving me errors- couldnt find the source in the includes;
    // header("Location: Add_Release_Form.php");
    
    // for some reason this gives me error duplicate key primary- it executes the mysql_query rather than evaluating it, but also does the insert- from first one
    $outcome=mysql_query($query);
    if ($outcome) {
        redirect_to("Add_Release_Form.php");
         exit;
     } // success 
     else {
         echo "<p>Subject creation failed.</p>";
         echo "<p>".mysql_error()."</p>";
      }
    mysql_close($connection);
?>