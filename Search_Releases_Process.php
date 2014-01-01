<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>
<table id="structure">
    <tr>
        <td id="navigation">
                <a href="Search_Releases.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Search Releases</p></a>
                <a href="Main_page.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Main Page</p></a>
        </td>
        <td id="page">


            <h2>Releases Search Results</h2>
            
            <?php
            $QueryString="";
            $PrevRelCriteria="";
            
            //set variables for post data

            $RelTheme=$_POST['ReleaseTheme'];
            $RelSeries=$_POST['RelSeries'];
            $SeriesID=$_POST['SeriesID'];
            $RelYr=$_POST['RelYr'];
            $CountryOfSale=$_POST['CountryOfSale'];
            $PkgName=$_POST['PkgName'];
            $MdlNameOnPkg=$_POST['MdlNameOnPkg'];
            $PkgID=$_POST['PkgID'];
            
            //check if search criteria selected
                
                if (($_POST['PkgName_Check']) OR ($_POST['MdlNameOnPkg_Check']) OR ($_POST['PkgID_Check'])) {
                    //WORKS
                    if ($_POST['PkgName_Check']) {
                            $PrevRelCriteria="1";
                            //$QueryString=("SELECT * FROM Test_Matchbox_Releases WHERE Test_Matchbox_Releases.PkgName LIKE '%$PkgName%'");
                            $QueryString= ("SELECT DISTINCT Test_Matchbox_Variations.UMID, Test_Matchbox_Variations.VarID, Test_Matchbox_Variations.BaseName, Test_Matchbox_Variations.VarPhoto1Ref,
                                           Test_Matchbox_Releases.RelID, Test_Matchbox_Releases.Series, Test_Matchbox_Releases.SeriesID, Test_Matchbox_Releases.ShowSeriesID, Test_Matchbox_Releases.RelYr,
                                           Test_Matchbox_Releases.RelPkgPhotoRef, Test_Matchbox_Releases.PkgName, Test_Matchbox_Releases.MdlNameOnPkg, Test_Matchbox_Releases.PkgID, Test_Matchbox_Releases.CountryOfSale
                             FROM Test_Matchbox_Variations
                             LEFT JOIN Test_Matchbox_Releases ON Test_Matchbox_Variations.VarID=Test_Matchbox_Releases.VarID
                             WHERE Test_Matchbox_Releases.PkgName LIKE '%$PkgName%' OR Test_Matchbox_Releases.Series LIKE '%$PkgName%' OR Test_Matchbox_Releases.SubSeries LIKE '%$PkgName%'");
                    }                       
                    
                    if ($_POST['MdlNameOnPkg_Check']) {
                        if ($PrevRelCriteria != "1") {
                            $PrevRelCriteria="1";
                            //$QueryString= ("SELECT * FROM `Test_Matchbox_Versions` WHERE `VerID` IN (SELECT `VerID` FROM `Test_Matchbox_Releases` WHERE `MdlNameOnPkg` LIKE '%$MdlNameOnPkg%')");
                            $QueryString= ("SELECT DISTINCT Test_Matchbox_Variations.UMID, Test_Matchbox_Variations.VarID, Test_Matchbox_Variations.BaseName, Test_Matchbox_Variations.VarPhoto1Ref,
                                           Test_Matchbox_Releases.RelID, Test_Matchbox_Releases.Series, Test_Matchbox_Releases.SeriesID, Test_Matchbox_Releases.ShowSeriesID, Test_Matchbox_Releases.RelYr, 
                                           Test_Matchbox_Releases.RelPkgPhotoRef, Test_Matchbox_Releases.PkgName, Test_Matchbox_Releases.MdlNameOnPkg, Test_Matchbox_Releases.PkgID, Test_Matchbox_Releases.CountryOfSale
                            FROM Test_Matchbox_Variations
                            LEFT JOIN Test_Matchbox_Releases ON Test_Matchbox_Variations.VarID=Test_Matchbox_Releases.VarID
                            WHERE Test_Matchbox_Releases.MdlNameOnPkg LIKE '%$MdlNameOnPkg%'");
                            //echo $QueryString;
                        } ELSE {
                            $PrevRelCriteria="1";
                            $QueryString= chop($QueryString,")");
                            $QueryString .= " AND Test_Matchbox_Releases.MdlNameOnPkg LIKE '%".$MdlNameOnPkg."%'";
                        }
                    }
                    
                    if ($_POST['PkgID_Check']) {
                        if ($PrevRelCriteria != "1") {
                            $PrevRelCriteria="1";
                            //$QueryString= ("SELECT * FROM `Test_Matchbox_Versions` WHERE `VerID` IN (SELECT `VerID` FROM `Test_Matchbox_Releases` WHERE `MdlNameOnPkg` LIKE '%$MdlNameOnPkg%')");
                            $QueryString= ("SELECT DISTINCT Test_Matchbox_Variations.UMID, Test_Matchbox_Variations.VarID, Test_Matchbox_Variations.BaseName, Test_Matchbox_Variations.VarPhoto1Ref,
                                       Test_Matchbox_Releases.RelID, Test_Matchbox_Releases.Series, Test_Matchbox_Releases.SeriesID, Test_Matchbox_Releases.ShowSeriesID, Test_Matchbox_Releases.RelYr, 
                                       Test_Matchbox_Releases.RelPkgPhotoRef, Test_Matchbox_Releases.PkgName, Test_Matchbox_Releases.MdlNameOnPkg, Test_Matchbox_Releases.PkgID, Test_Matchbox_Releases.CountryOfSale
                            FROM Test_Matchbox_Variations
                            LEFT JOIN Test_Matchbox_Releases ON Test_Matchbox_Variations.VarID=Test_Matchbox_Releases.VarID
                            WHERE Test_Matchbox_Releases.PkgID LIKE '%$PkgID%'");
                            
                        } ELSE {
                            $PrevRelCriteria="1";
                            $QueryString= chop($QueryString,")");
                            $QueryString .= " AND Test_Matchbox_Releases.PkgID LIKE '%".$PkgID."%'";
                            //echo $QueryString;
                        }
                    }                    
                    
                } ELSE {
                    //Browse criteria selected
                    if (($_POST['ReleaseTheme_Check']) OR ($_POST['RelSeries_Check']) OR ($_POST['RelYr_Check']) OR ($_POST['SeriesID_Check']) OR ($_POST['CountryOfSale_Check'])) {
    
                        if ($_POST['ReleaseTheme_Check']) {
                            $PrevRelCriteria="1";
                            //$QueryString= ("SELECT * FROM `Test_Matchbox_Versions` WHERE `VerID` IN (SELECT `VerID` FROM `Test_Matchbox_Releases` WHERE `Theme` LIKE '%$RelTheme%')");
                            $QueryString= ("SELECT DISTINCT Test_Matchbox_Variations.UMID, Test_Matchbox_Variations.VarID, Test_Matchbox_Variations.BaseName, Test_Matchbox_Variations.VarPhoto1Ref,
                                       Test_Matchbox_Releases.RelID, Test_Matchbox_Releases.Series, Test_Matchbox_Releases.SeriesID, Test_Matchbox_Releases.ShowSeriesID, Test_Matchbox_Releases.RelYr,
                                       Test_Matchbox_Releases.RelPkgPhotoRef, Test_Matchbox_Releases.PkgName, Test_Matchbox_Releases.MdlNameOnPkg, Test_Matchbox_Releases.PkgID, Test_Matchbox_Releases.Theme, Test_Matchbox_Releases.CountryOfSale
                            FROM Test_Matchbox_Variations
                            LEFT JOIN Test_Matchbox_Releases ON Test_Matchbox_Variations.VarID=Test_Matchbox_Releases.VarID
                            WHERE Test_Matchbox_Releases.Theme  LIKE '%$RelTheme%'");
                        }                    
    
                        if ($_POST['RelSeries_Check']) {
                            if ($PrevRelCriteria != "1") {
                                $PrevRelCriteria="1";
                                //note diff in single quotes on table name between this and one that works below :
                                //$QueryString= ("SELECT * FROM 'Test_Matchbox_Versions' WHERE `VerID` IN (SELECT `VerID` FROM `Test_Matchbox_Releases` WHERE `Series` LIKE '%$RelSeries%')");
                                //$QueryString= ("SELECT * FROM `Test_Matchbox_Versions` WHERE `VerID` IN (SELECT `VerID` FROM `Test_Matchbox_Releases` WHERE `Series` LIKE '%$RelSeries%')");
                                $QueryString= ("SELECT DISTINCT Test_Matchbox_Variations.UMID, Test_Matchbox_Variations.VarID, Test_Matchbox_Variations.BaseName, Test_Matchbox_Variations.VarPhoto1Ref,
                                       Test_Matchbox_Releases.RelID, Test_Matchbox_Releases.Series, Test_Matchbox_Releases.SeriesID, Test_Matchbox_Releases.ShowSeriesID, Test_Matchbox_Releases.RelYr,
                                       Test_Matchbox_Releases.RelPkgPhotoRef, Test_Matchbox_Releases.PkgName, Test_Matchbox_Releases.MdlNameOnPkg, Test_Matchbox_Releases.PkgID, Test_Matchbox_Releases.CountryOfSale
                                FROM Test_Matchbox_Variations
                                LEFT JOIN Test_Matchbox_Releases ON Test_Matchbox_Variations.VarID=Test_Matchbox_Releases.VarID
                                WHERE Test_Matchbox_Releases.Series  LIKE '%$RelSeries%'");
                          
                            } ELSE {
                                $PrevRelCriteria="1";
                                $QueryString= chop($QueryString,")");
                                $QueryString .= " AND Test_Matchbox_Releases.Series LIKE '%".$RelSeries."%'";
                            }
                        }
    
                        if ($_POST['SeriesID_Check']) {
                            if ($PrevRelCriteria != "1") {
                                $PrevRelCriteria="1";
                                //$QueryString= ("SELECT * FROM `Test_Matchbox_Versions` WHERE `VerID` IN (SELECT `VerID` FROM `Test_Matchbox_Releases` WHERE `SeriesID`='$SeriesID' AND `ShowSeriesID`='1')");
                                $QueryString= ("SELECT DISTINCT Test_Matchbox_Variations.UMID, Test_Matchbox_Variations.VarID, Test_Matchbox_Variations.BaseName, Test_Matchbox_Variations.VarPhoto1Ref,
                                       Test_Matchbox_Releases.RelID, Test_Matchbox_Releases.Series, Test_Matchbox_Releases.SeriesID, Test_Matchbox_Releases.ShowSeriesID, Test_Matchbox_Releases.RelYr,
                                       Test_Matchbox_Releases.RelPkgPhotoRef, Test_Matchbox_Releases.PkgName, Test_Matchbox_Releases.MdlNameOnPkg, Test_Matchbox_Releases.PkgID, Test_Matchbox_Releases.CountryOfSale
                                FROM Test_Matchbox_Variations
                                LEFT JOIN Test_Matchbox_Releases ON Test_Matchbox_Variations.VarID=Test_Matchbox_Releases.VarID
                                WHERE Test_Matchbox_Releases.SeriesID LIKE '%$SeriesID%' AND Test_Matchbox_Releases.ShowSeriesID='1'");
                                
                            } ELSE {
                                $PrevRelCriteria="1";
                                $QueryString= chop($QueryString,")");
                                $QueryString .= " AND Test_Matchbox_Releases.SeriesID='$SeriesID' AND Test_Matchbox_Releases.ShowSeriesID='1'";
                            }
                        }
    
                        if ($_POST['RelYr_Check']) {
                            if ($PrevRelCriteria != "1") {
                                $PrevRelCriteria="1";
                                //$QueryString= ("SELECT * FROM `Test_Matchbox_Versions` WHERE `VerID` IN (SELECT `VerID` FROM `Test_Matchbox_Releases` WHERE `RelYr` LIKE '%$RelYr%')");
                                $QueryString= ("SELECT DISTINCT Test_Matchbox_Variations.UMID, Test_Matchbox_Variations.VarID, Test_Matchbox_Variations.BaseName, Test_Matchbox_Variations.VarPhoto1Ref,
                                       Test_Matchbox_Releases.RelID, Test_Matchbox_Releases.Series, Test_Matchbox_Releases.SeriesID, Test_Matchbox_Releases.ShowSeriesID, Test_Matchbox_Releases.RelYr,
                                       Test_Matchbox_Releases.RelPkgPhotoRef, Test_Matchbox_Releases.PkgName, Test_Matchbox_Releases.MdlNameOnPkg, Test_Matchbox_Releases.PkgID, Test_Matchbox_Releases.CountryOfSale
                                FROM Test_Matchbox_Variations
                                LEFT JOIN Test_Matchbox_Releases ON Test_Matchbox_Variations.VarID=Test_Matchbox_Releases.VarID
                                WHERE Test_Matchbox_Releases.RelYr  LIKE '%$RelYr%'");
                            
                            } ELSE {
                                $PrevRelCriteria="1";
                                $QueryString= chop($QueryString,")");
                                $QueryString .= " AND Test_Matchbox_Releases.RelYr LIKE '%".$RelYr."%'";
                            }
                        }
    
                        if ($_POST['CountryOfSale_Check']) {
                            //echo "outer if";
                            if ($PrevRelCriteria != "1") {
                                //echo "inner if";
                                $PrevRelCriteria="1";
                                //$QueryString= ("SELECT * FROM `Test_Matchbox_Versions` WHERE `VerID` IN (SELECT `VerID` FROM `Test_Matchbox_Releases` WHERE `CountryOfSale` LIKE '%$CountryOfSale%')");
                                $QueryString= ("SELECT DISTINCT Test_Matchbox_Variations.UMID, Test_Matchbox_Variations.VarID, Test_Matchbox_Variations.BaseName, Test_Matchbox_Variations.VarPhoto1Ref,
                                       Test_Matchbox_Releases.RelID, Test_Matchbox_Releases.Series, Test_Matchbox_Releases.SeriesID, Test_Matchbox_Releases.ShowSeriesID, Test_Matchbox_Releases.RelYr,
                                       Test_Matchbox_Releases.RelPkgPhotoRef, Test_Matchbox_Releases.PkgName, Test_Matchbox_Releases.MdlNameOnPkg, Test_Matchbox_Releases.PkgID, Test_Matchbox_Releases.CountryOfSale
                                FROM Test_Matchbox_Variations
                                LEFT JOIN Test_Matchbox_Releases ON Test_Matchbox_Variations.VarID=Test_Matchbox_Releases.VarID
                                WHERE Test_Matchbox_Releases.CountryOfSale  LIKE '%$CountryOfSale%'");                           

                            } ELSE {
                                $PrevRelCriteria="1";
                                $QueryString= chop($QueryString,")");
                                $QueryString .= " AND Test_Matchbox_Releases.CountryOfSale LIKE '%".$CountryOfSale."%'";
                                //echo $QueryString;
                            }
                        }

                        $QueryString .= " ORDER BY Test_Matchbox_Releases.Series, Test_Matchbox_Releases.RelYr, Test_Matchbox_Releases.CountryOfSale, Test_Matchbox_Releases.SeriesID ASC";
                        
                    
                    //else nothing was selected               
                    } ELSE {              
                        echo "No Criteria Selected";
                        exit;
                            }
                    }
     	
            $result=0;
            $rows=0;
            // echo $result;
            $QueryString = "(".$QueryString.")";
            //echo $QueryString;
            
            $result = mysql_query($QueryString);
            $rows= mysql_num_rows($result);
            //print_r($result);
            echo "Number of Matches: ".$rows."<br /><br />";
            if(!$result) {
                    echo "No matching results found"; //mysql_error();
                    exit;
                    }
                    

            //If release data selected show versions
            for ($i=1; $i<=$rows; $i++)
            {
            echo "<div class=\"car-block\">";
                $row=mysql_fetch_array($result);
                $VarPicture= IMAGE_URL . $row["VarID"]."_1.jpg";
		$VarPicture_loc=IMAGE_PATH. $row["VarID"]."_1.jpg";
                $RelPicture= IMAGE_URL . $row["RelID"]."_1.jpg";
                $RelPicture_loc= IMAGE_PATH . $row["RelID"]."_1.jpg";
                //make image clickable and send proper umid to model_detail page
                $Model_to_detail=$row["UMID"];
                $url= "Models_Detail_and_Ver_Listing.php?model=".$Model_to_detail;
                
                if (file_exists($VarPicture_loc)) {
                        //echo "picture exists";
                        echo "<a href=\"".$url."\">"."<img src=".$VarPicture." width=\"240\"></a>";
                        if (file_exists($RelPicture_loc)) {
                        //echo "picture exists";
                            echo "<a href=\"".$url."\">"."<img src=".$RelPicture." width=\"240\"></a>";
                        } else {
                                //echo "cant find picture";
                                //echo DEFAULT_IMAGE;
                                echo "<a href=\"".$url."\">"."<img src=".DEFAULT_IMAGE." width=\"240\"></a>";
                        }
                } else {
                        //echo "cant find picture";
                        //echo DEFAULT_IMAGE;
                        echo "<a href=\"".$url."\">"."<img src=".DEFAULT_IMAGE." width=\"240\"></a>";
                }
 
                echo "<br />";
                $PhotoRefCd1= $row["VarPhoto1Ref"];
		$PhotoRefCd2= $row["RelPkgPhotoRef"];
                if ($PhotoRefCd1) {
                    $query2a= ("SELECT * FROM Test_Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd1%'");
                    $result2a= mysql_query($query2a);
                    $row2a =mysql_fetch_array($result2a);
                    
                    if ($PhotoRefCd2) {
                        $query2b= ("SELECT * FROM Test_Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd2%'");
                        $result2b= mysql_query($query2b);
                        $row2b =mysql_fetch_array($result2b);
                        echo "<p>Photos by: ". $row2a["RefName"].", ".$row2b["RefName"]."</p>";
                    } ELSE {
                        echo "<p>Photo by: ". $row2a["RefName"]."</p>";
                    }
                } ELSE {
                    if ($PhotoRefCd2) {
                        $query2b= ("SELECT * FROM Test_Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd2%'");
                        $result2b= mysql_query($query2b);
                        $row2b =mysql_fetch_array($result2b);
                        echo "<p>Pkg Photo by: ". $row2b["RefName"]."</p>";
                    } ELSE {
                        echo "<p>Photo by: no reference listed"."</p>";
                    }
                }    
                
                
                //echo "Photos by: ". $row["VarPhoto1Ref"]."    ".$row["RelPkgPhotoRef"].
                //echo "<br />";
                echo "<p>Var ID: ". $row["VarID"]."</p>";
                echo "<p>Rel ID: ". $row["RelID"]."</p>";
                echo "<p>Series: ".$row["Series"]."   ";
                if ($row["ShowSeriesID"]="1") {
                    echo "#".$row["SeriesID"]."   ";
                }
                echo "Country: ".$row["CountryOfSale"]."</p>";
                if ($row["PkgName"]) {
                     echo "<p>Pkg Name: ".$row["PkgName"]."</p>";
                }
                if ($row["MdlNameOnPkg"]) {
                    echo "<p>Name: ".$row["MdlNameOnPkg"]."</p>";
                } ELSE {
                    echo "<p>Name: ".$row["BaseName"]."</p>";
                }               
                echo "<p>Rel Yr: ".$row["RelYr"]."</p>";
            echo "</div>";
            } 

            echo "<br /> All done with query </br />";
            mysql_free_result($result);

            ?>
        
        </td>
    </tr>
</table>
<?php include("includes/footer.php"); ?>