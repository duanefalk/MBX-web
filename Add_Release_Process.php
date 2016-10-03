<?php 
	require_once("includes/db_connection.php");
	require_once("includes/functions.php");
	$pageTitle = "Processing a new Release";
	$pageDescription = "Processing the addition of a new matchbox model release to the Matchbox University collector's database.";
	include("includes/header.php");
?>
<?php
    $UMID=$_POST['UMID'];
    $VerID=$_POST['VERID1'];
    //$VerID= $UMID.'-'.$VERID1;
    $VarID=$_POST['VARID1'];
    //$VarID=$VerID.'-'.$VARID1;
    $RelID=$_POST['RELID1'];
    //$RelID=$VarID.'-'.$RELID1;
    $RelYr=$_POST['RelYr'];
    $CountryOfSale=$_POST['CountryOfSale'];
    $Theme=$_POST['Theme'];
    $Line=$_POST['Line'];
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
    //$RelPkgPhotoName=$_POST['RelPkgPhotoName'];
    $RelPkgPhotoRef=$_POST['RelPkgPhotoRef'];
    
   
    $query="INSERT INTO Matchbox_Releases (UMID, VerID, VarID, RelID, RelYr, CountryOfSale, Theme, Line, Series, SeriesID, ShowSeriesID,
            PkgName, MdlNameOnPkg, SubSeries, SubSeriesID, ShowSubSeriesID, UnitTyp, PkgID, PkgVarCd, RelComm, 
            RelPkgPhotoRef)
            VALUES ('$UMID','$VerID','$VarID','$RelID','$RelYr','$CountryOfSale','$Theme', '$Line', '$Series', '$SeriesID', '$ShowSeriesID',
            '$PkgName','$MdlNameOnPkg','$SubSeries','$SubSeriesID','$ShowSubSeriesID','$UnitTyp', '$PkgID', '$PkgVarCd', '$RelComm',
            '$RelPkgPhotoRef')";
    // mysql_query($query);
    // "turned output buffering on cause this was giving me errors- couldnt find the source in the includes;
    // header("Location: add-release-form.php");
    
    // for some reason this gives me error duplicate key primary- it executes the mysql_query rather than evaluating it, but also does the insert- from first one
    $outcome=mysql_query($query);
    if ($outcome) {
        redirect_to("add-release-form.php");
         exit;
     } // success 
     else {
         echo "<p>Subject creation failed.</p>";
         echo "<p>".mysql_error()."</p>";
      }
    mysql_close($connection);
?>