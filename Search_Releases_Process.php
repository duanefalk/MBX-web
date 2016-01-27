<?php 
	$pageTitle = "Search Releases";
	$pageDescription = "Search the Matchbox University database, by releases, find any matchbox car you're looking for";
	require_once("includes/db_connection.php");
	require_once("includes/functions.php");
	include("includes/header.php");
?>

<div class="row">
	<div class="large-12 columns">

        <h2>Releases Search Results</h2>
        
		<?php
	        $QueryString="";
	        $PrevRelCriteria="";
	        
	        //set variables for post data
	
	        $RelTheme=$_SESSION['ReleaseTheme'];
	        
		$RelSeries=$_SESSION['RelSeries'];
			
		$OrigSeriesID=$_SESSION['SeriesID'];
	        $SeriesID=mysql_real_escape_string($_SESSION['SeriesID']);
	        
		$RelYr=$_SESSION['RelYr'];
	        
		$CountryOfSale=$_SESSION['CountryOfSale'];
	        
		$OrigPkgName= $_SESSION['PkgName'];
		$PkgName=mysql_real_escape_string($_SESSION['PkgName']);
	        
		$OrigMdlNameOnPkg=$_SESSION['MdlNameOnPkg'];
		$MdlNameOnPkg=mysql_real_escape_string($_SESSION['MdlNameOnPkg']);
	        
		$OrigPkgID=$_SESSION['PkgID'];
		$PkgID=mysql_real_escape_string($_SESSION['PkgID']);
	        
	        //check if search criteria selected
	            
	            if (($_SESSION['PkgName_Check']) OR ($_SESSION['MdlNameOnPkg_Check']) OR ($_SESSION['PkgID_Check'])) {
	                //WORKS
	                if ($_SESSION['PkgName_Check']) {
						echo "<p>Pkg name is: ".$OrigPkgName."</p>";
                        $PrevRelCriteria="1";
                        $QueryString= ("SELECT DISTINCT Matchbox_Variations.UMID, Matchbox_Variations.VarID, Matchbox_Variations.BaseName, Matchbox_Variations.VarPhoto1Ref,
	                                       Matchbox_Releases.RelID, Matchbox_Releases.Series, Matchbox_Releases.SeriesID, Matchbox_Releases.ShowSeriesID, Matchbox_Releases.RelYr, 
	                                       Matchbox_Releases.RelPkgPhotoRef, Matchbox_Releases.PkgName, Matchbox_Releases.MdlNameOnPkg, Matchbox_Releases.PkgID, Matchbox_Releases.CountryOfSale
	                        FROM Matchbox_Variations
	                        LEFT JOIN Matchbox_Releases ON Matchbox_Variations.VarID=Matchbox_Releases.VarID
	                        WHERE Matchbox_Releases.PkgName LIKE '%$PkgName%' OR Matchbox_Releases.Series LIKE '%$PkgName%' OR Matchbox_Releases.SubSeries LIKE '%$PkgName%'");
	                }                       
	                
	                if ($_SESSION['MdlNameOnPkg_Check']) {
						echo "<p>Model Name on Package is: ".$OrigMdlNameOnPkg."</p>";
	                    if ($PrevRelCriteria != "1") {
	                        $PrevRelCriteria="1";
	                        
	                        $QueryString= ("SELECT DISTINCT Matchbox_Variations.UMID, Matchbox_Variations.VarID, Matchbox_Variations.BaseName, Matchbox_Variations.VarPhoto1Ref,
	                                       Matchbox_Releases.RelID, Matchbox_Releases.Series, Matchbox_Releases.SeriesID, Matchbox_Releases.ShowSeriesID, Matchbox_Releases.RelYr, 
	                                       Matchbox_Releases.RelPkgPhotoRef, Matchbox_Releases.PkgName, Matchbox_Releases.MdlNameOnPkg, Matchbox_Releases.PkgID, Matchbox_Releases.CountryOfSale
	                        FROM Matchbox_Variations
	                        LEFT JOIN Matchbox_Releases ON Matchbox_Variations.VarID=Matchbox_Releases.VarID
	                        WHERE Matchbox_Releases.MdlNameOnPkg LIKE '%$MdlNameOnPkg%'");
	                        //echo $QueryString;
	                    } else {
	                        $PrevRelCriteria="1";
	                        $QueryString= chop($QueryString,")");
	                        $QueryString .= " AND Matchbox_Releases.MdlNameOnPkg LIKE '%".$MdlNameOnPkg."%'";
	                    }
	                }
	                
	                if ($_SESSION['PkgID_Check']) {
						echo "<p>Package ID is: ".$OrigPkgID."</p>";
	                    if ($PrevRelCriteria != "1") {
	                        $PrevRelCriteria="1";
	                        
	                        $QueryString= ("SELECT DISTINCT Matchbox_Variations.UMID, Matchbox_Variations.VarID, Matchbox_Variations.BaseName, Matchbox_Variations.VarPhoto1Ref,
	                                       Matchbox_Releases.RelID, Matchbox_Releases.Series, Matchbox_Releases.SeriesID, Matchbox_Releases.ShowSeriesID, Matchbox_Releases.RelYr, 
	                                       Matchbox_Releases.RelPkgPhotoRef, Matchbox_Releases.PkgName, Matchbox_Releases.MdlNameOnPkg, Matchbox_Releases.PkgID, Matchbox_Releases.CountryOfSale
	                        FROM Matchbox_Variations
	                        LEFT JOIN Matchbox_Releases ON Matchbox_Variations.VarID=Matchbox_Releases.VarID
	                        WHERE Matchbox_Releases.PkgID LIKE '%$PkgID%'");
	                        
	                    } else {
	                        $PrevRelCriteria="1";
	                        $QueryString= chop($QueryString,")");
	                        $QueryString .= " AND Matchbox_Releases.PkgID LIKE '%".$PkgID."%'";
	                        //echo $QueryString;
	                    }
	                }                    
	                
	            } else {
	                //Browse criteria selected
	                if (($_SESSION['ReleaseTheme_Check']) OR ($_SESSION['RelSeries_Check']) OR ($_SESSION['RelYr_Check']) OR ($_SESSION['SeriesID_Check']) OR ($_SESSION['CountryOfSale_Check'])) {
	
	                    if ($_SESSION['ReleaseTheme_Check']) {
	                        $PrevRelCriteria="1";
	                        //$QueryString= ("SELECT * FROM `Matchbox_Versions` WHERE `VerID` IN (SELECT `VerID` FROM `Matchbox_Releases` WHERE `Theme` LIKE '%$RelTheme%')");
	                        $QueryString= ("SELECT DISTINCT Matchbox_Variations.UMID, Matchbox_Variations.VarID, Matchbox_Variations.BaseName, Matchbox_Variations.VarPhoto1Ref,
	                                   Matchbox_Releases.RelID, Matchbox_Releases.Series, Matchbox_Releases.SeriesID, Matchbox_Releases.ShowSeriesID, Matchbox_Releases.RelYr,
	                                   Matchbox_Releases.RelPkgPhotoRef, Matchbox_Releases.PkgName, Matchbox_Releases.MdlNameOnPkg, Matchbox_Releases.PkgID, Matchbox_Releases.Theme, Matchbox_Releases.CountryOfSale
	                        FROM Matchbox_Variations
	                        LEFT JOIN Matchbox_Releases ON Matchbox_Variations.VarID=Matchbox_Releases.VarID
	                        WHERE Matchbox_Releases.Theme  LIKE '%$RelTheme%'");
	                    }                    
	
	                    if ($_SESSION['RelSeries_Check']) {
	                        if ($PrevRelCriteria != "1") {
	                            $PrevRelCriteria="1";
	                            //note diff in single quotes on table name between this and one that works below :
	                            //$QueryString= ("SELECT * FROM 'Matchbox_Versions' WHERE `VerID` IN (SELECT `VerID` FROM `Matchbox_Releases` WHERE `Series` LIKE '%$RelSeries%')");
	                            //$QueryString= ("SELECT * FROM `Matchbox_Versions` WHERE `VerID` IN (SELECT `VerID` FROM `Matchbox_Releases` WHERE `Series` LIKE '%$RelSeries%')");
	                            $QueryString= ("SELECT DISTINCT Matchbox_Variations.UMID, Matchbox_Variations.VarID, Matchbox_Variations.BaseName, Matchbox_Variations.VarPhoto1Ref,
	                                   Matchbox_Releases.RelID, Matchbox_Releases.Series, Matchbox_Releases.SeriesID, Matchbox_Releases.ShowSeriesID, Matchbox_Releases.RelYr,
	                                   Matchbox_Releases.RelPkgPhotoRef, Matchbox_Releases.PkgName, Matchbox_Releases.MdlNameOnPkg, Matchbox_Releases.PkgID, Matchbox_Releases.CountryOfSale
	                            FROM Matchbox_Variations
	                            LEFT JOIN Matchbox_Releases ON Matchbox_Variations.VarID=Matchbox_Releases.VarID
	                            WHERE Matchbox_Releases.Series  LIKE '%$RelSeries%'");
	                      
	                        } else {
	                            $PrevRelCriteria="1";
	                            $QueryString= chop($QueryString,")");
	                            $QueryString .= " AND Matchbox_Releases.Series LIKE '%".$RelSeries."%'";
	                        }
	                    }
	
	                    if ($_SESSION['SeriesID_Check']) {
							echo "<p>Series ID is: ".$OrigSeriesID."</p>";
	                        if ($PrevRelCriteria != "1") {
	                            $PrevRelCriteria="1";
	                            //$QueryString= ("SELECT * FROM `Matchbox_Versions` WHERE `VerID` IN (SELECT `VerID` FROM `Matchbox_Releases` WHERE `SeriesID`='$SeriesID' AND `ShowSeriesID`='1')");
	                            $QueryString= ("SELECT DISTINCT Matchbox_Variations.UMID, Matchbox_Variations.VarID, Matchbox_Variations.BaseName, Matchbox_Variations.VarPhoto1Ref,
	                                   Matchbox_Releases.RelID, Matchbox_Releases.Series, Matchbox_Releases.SeriesID, Matchbox_Releases.ShowSeriesID, Matchbox_Releases.RelYr,
	                                   Matchbox_Releases.RelPkgPhotoRef, Matchbox_Releases.PkgName, Matchbox_Releases.MdlNameOnPkg, Matchbox_Releases.PkgID, Matchbox_Releases.CountryOfSale
	                            FROM Matchbox_Variations
	                            LEFT JOIN Matchbox_Releases ON Matchbox_Variations.VarID=Matchbox_Releases.VarID
	                            WHERE Matchbox_Releases.SeriesID LIKE '%$SeriesID%' AND Matchbox_Releases.ShowSeriesID='1'");
	                            
	                        } else {
	                            $PrevRelCriteria="1";
	                            $QueryString= chop($QueryString,")");
	                            $QueryString .= " AND Matchbox_Releases.SeriesID='$SeriesID' AND Matchbox_Releases.ShowSeriesID='1'";
	                        }
	                    }
	
	                    if ($_SESSION['RelYr_Check']) {
		                    echo "<p>Release Year is: ".$RelYr."</p>";
		                    //$pageTitle .= ": Release Year: " . $RelYr;
	                        if ($PrevRelCriteria != "1") {
	                            $PrevRelCriteria="1";
	                            //$QueryString= ("SELECT * FROM `Matchbox_Versions` WHERE `VerID` IN (SELECT `VerID` FROM `Matchbox_Releases` WHERE `RelYr` LIKE '%$RelYr%')");
	                            $QueryString= ("SELECT DISTINCT Matchbox_Variations.UMID, Matchbox_Variations.VarID, Matchbox_Variations.BaseName, Matchbox_Variations.VarPhoto1Ref,
	                                   Matchbox_Releases.RelID, Matchbox_Releases.Series, Matchbox_Releases.SeriesID, Matchbox_Releases.ShowSeriesID, Matchbox_Releases.RelYr,
	                                   Matchbox_Releases.RelPkgPhotoRef, Matchbox_Releases.PkgName, Matchbox_Releases.MdlNameOnPkg, Matchbox_Releases.PkgID, Matchbox_Releases.CountryOfSale
	                            FROM Matchbox_Variations
	                            LEFT JOIN Matchbox_Releases ON Matchbox_Variations.VarID=Matchbox_Releases.VarID
	                            WHERE Matchbox_Releases.RelYr  LIKE '%$RelYr%'");
	                        
	                        } else {
	                            $PrevRelCriteria="1";
	                            $QueryString= chop($QueryString,")");
	                            $QueryString .= " AND Matchbox_Releases.RelYr LIKE '%".$RelYr."%'";
	                        }
	                    }
	
	                    if ($_SESSION['CountryOfSale_Check']) {
	                        //echo "outer if";
	                        if ($PrevRelCriteria != "1") {
	                            //echo "inner if";
	                            $PrevRelCriteria="1";
	                            //$QueryString= ("SELECT * FROM `Matchbox_Versions` WHERE `VerID` IN (SELECT `VerID` FROM `Matchbox_Releases` WHERE `CountryOfSale` LIKE '%$CountryOfSale%')");
	                            $QueryString= ("SELECT DISTINCT Matchbox_Variations.UMID, Matchbox_Variations.VarID, Matchbox_Variations.BaseName, Matchbox_Variations.VarPhoto1Ref,
	                                   Matchbox_Releases.RelID, Matchbox_Releases.Series, Matchbox_Releases.SeriesID, Matchbox_Releases.ShowSeriesID, Matchbox_Releases.RelYr,
	                                   Matchbox_Releases.RelPkgPhotoRef, Matchbox_Releases.PkgName, Matchbox_Releases.MdlNameOnPkg, Matchbox_Releases.PkgID, Matchbox_Releases.CountryOfSale
	                            FROM Matchbox_Variations
	                            LEFT JOIN Matchbox_Releases ON Matchbox_Variations.VarID=Matchbox_Releases.VarID
	                            WHERE Matchbox_Releases.CountryOfSale  LIKE '%$CountryOfSale%'");                           
	
	                        } else {
	                            $PrevRelCriteria="1";
	                            $QueryString= chop($QueryString,")");
	                            $QueryString .= " AND Matchbox_Releases.CountryOfSale LIKE '%".$CountryOfSale."%'";
	                            //echo $QueryString;
	                        }
	                    }
	
	                    $QueryString .= " ORDER BY Matchbox_Releases.Series, Matchbox_Releases.RelYr, Matchbox_Releases.CountryOfSale, LENGTH(Matchbox_Releases.SeriesID),Matchbox_Releases.SeriesID ASC";
	                    
	                
	                //else nothing was selected               
	                } else {              
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
	        if (!$result) {
	            echo "No matching results found"; //mysql_error();
	            exit;
	        } else {
	            $rows= mysql_num_rows($result);
	            echo "<p>Number of Matches: " . $rows . "</p>";
	            echo "<ul class='large-block-grid-3'>";
	        }  
	                
	
	        //If release data selected show versions
	        for ($i=1; $i<=$rows; $i++) {
	        
	            echo "<li class=\"carGrid\">";
	            
	            $row=mysql_fetch_array($result);
	            $VarPicture= IMAGE_URL . $row["VarID"]."_1.jpg";
				$VarPicture_loc=IMAGE_PATH. $row["VarID"]."_1.jpg";
	            $RelPicture= IMAGE_URL . $row["RelID"]."_1.jpg";
	            $RelPicture_loc= IMAGE_PATH . $row["RelID"]."_1.jpg";
	            //make image clickable and send proper umid to model_detail page
	            $Model_to_detail=$row["UMID"];
	            $Rel_to_detail=$row["RelID"];
	            $url= "Models_Detail_and_Ver_Listing.php?model=".$Model_to_detail;
	            $url2="Release_Detail.php?model=".$Rel_to_detail;
	
	            //break to new line on change of series, yr, country
	            //echo $i." ".$old_country." ".$row["CountryOfSale"];
	            
	            if (($i>1) AND (($row["Series"] != $old_ser) OR ($row["RelYr"] != $old_yr) OR ($row["CountryOfSale"] != $old_country))) {
	                //echo "<br></br><br></br>";
	                //NOTE: this doesnt display like I want, need Duncan to break the next model to a new line
	            }  
	                        
	            if (file_exists($VarPicture_loc)) {
	                    //echo "picture exists";
	                    echo "<a href=\"".$url."\">"."<img src=".$VarPicture." width=\"240\"></a>";
	                    if (file_exists($RelPicture_loc)) {
	                    //echo "picture exists";
	                        echo "<a href=\"".$url2."\">"."<img src=".$RelPicture." width=\"240\"></a>";
	                    } else {
	                            //echo "cant find picture";
	                            //echo DEFAULT_IMAGE;
	                            echo "<a href=\"".$url2."\">"."<img src=".DEFAULT_REL_IMAGE." width=\"240\"></a>";
	                    }
	            } else {
	                    //echo "cant find picture";
	                    //echo DEFAULT_IMAGE;
	                    echo "<a href=\"".$url."\">"."<img src=".DEFAULT_IMAGE." width=\"240\"></a>";
	            }
	
	            echo "<br />";
	            	$PhotoRefCd1 = $row["VarPhoto1Ref"];
					$PhotoRefCd2 = $row["RelPkgPhotoRef"];
	            if ($PhotoRefCd1) {
	                $query2a= ("SELECT * FROM Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd1%'");
	                $result2a= mysql_query($query2a);
	                $row2a =mysql_fetch_array($result2a);
	                
	                if ($PhotoRefCd2) {
	                    $query2b= ("SELECT * FROM Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd2%'");
	                    $result2b= mysql_query($query2b);
	                    $row2b =mysql_fetch_array($result2b);
	                    echo "<p>Photos by: ". $row2a["RefName"].", ".$row2b["RefName"]."</p>";
	                } else {
	                    echo "<p>Photo by: ". $row2a["RefName"]."</p>";
	                }
	            } else {
	                if ($PhotoRefCd2) {
	                    $query2b= ("SELECT * FROM Matchbox_References WHERE RefCode LIKE '%$PhotoRefCd2%'");
	                    $result2b= mysql_query($query2b);
	                    $row2b =mysql_fetch_array($result2b);
	                    echo "<p>Pkg Photo by: ". $row2b["RefName"]."</p>";
	                } else {
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
	            } else {
	                echo "<p>Name: ".$row["BaseName"]."</p>";
	            }               
	            echo "<p>Rel Yr: ".$row["RelYr"]."</p>";
	        echo "</li>";
	
	        $old_ser=$row["Series"];
	        $old_yr=$row["RelYr"];
	        $old_country=$row["CountryOfSale"];
	        } 
	
			
	        echo "</ul>";
	        
	        mysql_free_result($result);

		?>
        
	</div>
</div>

<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="Search_Releases_Menu.php">Search Releases</a>
	</div>
</div>

<?php include("includes/footer.php"); ?>