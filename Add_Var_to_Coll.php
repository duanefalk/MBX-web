<?php ob_start(); ?>
<?php
// we must never forget to start the session
session_start();
?>

<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>
<?php
if (isset($_POST['var_coll_submit'])) {
        //echo "sees as post set";

        //Do collection table updates
        //Fields:
        $Coll_Username=$_POST['Coll_Username'];
        $User_CollID=$_POST['User_CollID'];
        $UMID=$_POST['Coll_UMID'];
        $VerID=$_POST['Coll_VerID'];
        $VarID=$_POST['Coll_VarID'];
	$RelID=$_POST['Coll_RelID'];
        $User_SpecID=$_POST['User_SpecID'];
        $Copy=$_POST['Coll_Copy'];
        $VehCond=$_POST['VehCond'];
        $PkgCond=$_POST['PkgCond'];
        $ItemVal=$_POST['Coll_Value'];
        $StorLoc=$_POST['Coll_Loc1'];
        $StorLoc2=$_POST['Coll_Loc2'];
        $PurchDt=$_POST['Coll_Purch_Dt'];
        $Seller=$_POST['Coll_Seller'];
        $PurchPrice=$_POST['Coll_Purch_Price'];
        $SellFlg=$_POST['CollSellFlg'];
        $MinSellPrice=$_POST['Coll_MinSell_Price'];
        $CollComm=$_POST['Coll_Comm'];
        $Coll_InactiveFlg="0";
        
        //echo $Coll_Username;
        //echo $UMID;
        //echo $VerID;
        //echo $VarID;
        //echo $RelID;
        //echo $UserCollID;
        //echo $CollWishFlg;
        //echo $Copy;
        //echo $VehCond;
        //echo $PkgCond;
        //echo $ItemVal;
        //echo $StorLoc;
        //echo $StorLoc2;
        //echo $PurchDt;
        //echo $Seller;
        //echo $PurchPrice;
        //echo $SellFlg;
        //echo $MinSellPrice;
        //echo $CollComm;
        //echo $Coll_InactiveFlg;
       
        $query="INSERT INTO Matchbox_Collection (Username, User_Coll_ID, UMID, VerID, VarID, RelID, User_SpecID, Copy, VehCond, PkgCond, ItemVal, StorLoc,
            StorLoc2, PurchDt, Seller, PurchPrice, SellFlag, MinSellPrice, CollComm, Coll_InactiveFlg) 
            VALUES ('$Coll_Username','$User_CollID','$UMID', '$VerID', '$VarID', '$RelID', '$User_SpecID', '$Copy', '$VehCond', '$PkgCond', '$ItemVal', '$StorLoc',
            '$StorLoc2', '$PurchDt', '$Seller', '$PurchPrice', '$SellFlg', '$MinSellPric', '$CollComm', '$Coll_InactiveFlg')";
 
	//Check if success, if so go out to success message and button to search again 
        $outcome=mysql_query($query);
        if ($outcome) {
	    redirect_to("Add_Var_to_Coll_Outcome.php");
        
	    //if ((mysql_query($query)) == true)
            //echo "<p>Done and returning</p>";
            //require_once("includes/close_db_connection.php");
            //Return;
            //$url= "Ver_Detail_and_Var_Listing.php?model=".$VerID;
	    //echo "<a href=\"".$url."\">Return to Listing</a>";
            //exit;
        } else {
            echo "<p>Subject creation failed. Please review entries.</p>";
            echo "<p>".mysql_error()."</p>";
            //drop down to form again
        }   
    }
?>


<div class="row">
	<div class="large-12 columns">
		
	    <h2>Add Variation to Collection</h2>
		
	    <?php
		$Var_to_Add=$_GET["model"];
		$Username=$_SESSION['Username'];
			$query=("SELECT * FROM Matchbox_User_Collections WHERE Username='$Username'");
			$result=mysql_query($query);
    
			if (!$result) {
				    echo "<p>You have no collection. Please go to Manage Collections and follow the steps described there to create a collection.</p>";
				    exit;
			} 
			    
			$row=mysql_fetch_array($result);
		$User_CollID=$row['User_Coll_ID'];
		echo "<p>Variation Selected: ".$Var_to_Add."</p>";
		       
		$picture1 = IMAGE_URL . $Var_to_Add."_1.jpg";
			$picture1_loc = IMAGE_PATH. $Var_to_Add."_1.jpg";
    
		if (file_exists($picture1_loc)) {
		    echo "<img src=".$picture1." />";
		} else {
		    //no photo, echo DEFAULT_IMAGE;
		    echo "<img src=".DEFAULT_IMAGE." />";
		}
	    ?>
              
	    <form name="Add_Var_to_Coll" action="Add_Var_to_Coll.php" method="post">	
                 
            <?php               
	        $Coll_VarID=$Var_to_Add;
                $Coll_VerID=substr($Coll_VarID,0,10);
                $Coll_UMID=substr($Coll_VerID,0,6);

                        
                //determine what copy to default in field
                $query=("SELECT * FROM Matchbox_Collection WHERE Username='$Username' AND User_Coll_ID='$User_CollID' AND VarID='$Var_to_Add'");								
				$result=0;
				$result=mysql_query($query);
        
                if ($result) {
                    $copy_to_show= (mysql_num_rows($result)+1);
                } else {
                    $copy_to_show= "1";
                }          
            ?>

            <p>Username: <input type="text" name="Coll_Username" value="<?php echo $Username;?>" size="20" id="Coll_Username"></p>
            <p>Collection ID:  <input type="text" name="User_CollID" value="<?php echo $User_CollID;?>" size="12" id="User_CollID"></p>
            <p>UMID:          <input type="text" name="Coll_UMID" value="<?php echo $Coll_UMID;?>" size="6" id="Coll_UMID"></p>
            <p>Version ID:    <input type="text" name="Coll_VerID" value="<?php echo $Coll_VerID;?>" size="10" id="Coll_VerID"></p>
            <p>Variation ID:  <input type="text" name="Coll_VarID" value="<?php echo $Coll_VarID;?>" size="13" id="Coll_VarID"></p>
            <p>Release ID (use the variation ID, above, plus '-99' where 99 is the release no.):    <input type="text" name="Coll_RelID" value="" size="16" id="Coll_RelID"></p>
            <p>User-specific ID:   <input type="text" name="User_SpecID" value="" size="20" id="User_SpecID"></p>
            <p>Copy No.:      <input type="text" name="Coll_Copy" value="<?php echo $copy_to_show; ?>" size="2" id="Coll_Copy"></p>
            
            <p>Vehicle Condition: 
	    <?php
                //determine from account what scheme for vehicle condition
                $query_cond=("SELECT * FROM MBXU_User_Accounts WHERE Username='$Username'");
		$result_cond = mysql_query($query_cond);

		if ($result_cond) {
                    $rows_count= mysql_num_rows($result_cond);
                    for ($i=1; $i<=$rows_count; $i++) {
                        $row=mysql_fetch_array($result_cond);
                        $Cond_scheme= $row['Veh_Cond_Scheme'];
                    }
                } else {
                    echo "Your account is corrupted, contact admin";
                }
			    
		//show condition in approp scheme    
		if ($Cond_scheme == 1) {
		    $Veh_Cond_Scheme = "Alpha_cond";
		} else {
		    $Veh_Cond_Scheme = "Num_cond";			
		}
			    
                $query=("SELECT * FROM Matchbox_Value_lists WHERE ValueList LIKE '%$Veh_Cond_Scheme%' ORDER BY ValueDispOrder ASC");								
                $result=0;
                $rows_count=0;									
                $result = mysql_query($query);

                if ((mysql_num_rows($result) == 0)) {
                    echo "Error condition query failed";
                    exit;
                } 

                $rows_count= mysql_num_rows($result);
            ?>
           
            <select name="VehCond" id="VehCond">
                <?php
	                for ($i=1; $i<=$rows_count; $i++) {
                        $row=mysql_fetch_array($result);
                        echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
                    }	
                ?>
            </select>
			
			
            <p>Package Condition: 
            <?php
                //determine from account what scheme for pkg cond
		$query_cond2=("SELECT * FROM MBXU_User_Accounts WHERE Username='$Username'");
	        $result_cond2 = mysql_query($query_cond2);

		if ($result_cond2) {
                    $rows_count2= mysql_num_rows($result_cond2);                 
                    for ($i=1; $i<=$rows_count2; $i++) {
                        $row=mysql_fetch_array($result_cond2);
                        $Cond_scheme2= $row['Pkg_Cond_Scheme'];
                    }
                } else {
	                echo "Your account is corrupted, contact admin";
                }
			    
		//show conditions in approp scheme  
		if ($Cond_scheme2 == 1) {
		    $Pkg_Cond_Scheme="Alpha_cond";
		} else {
		    $Pkg_Cond_Scheme="Num_cond";			
		}
			    
		$query=("SELECT * FROM Matchbox_Value_lists WHERE ValueList LIKE '%$Pkg_Cond_Scheme%' ORDER BY ValueDispOrder ASC");								
                $result=0;
                $rows_count=0;									
                $result = mysql_query($query);
                if ((mysql_num_rows($result) == 0)) {
                    echo "Error condition query failed";
                    exit;
                } 
                $rows_count= mysql_num_rows($result);
            ?>
            <select name="PkgCond" id="PkgCond">
            <?php
                for ($i=1; $i<=$rows_count; $i++) {
                $row=mysql_fetch_array($result);
                    echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
                }	
            ?>
            </select>
	    
            <p>Item Value:      <input type="text" name="Coll_Value" value="" size="10" id="Coll_Value"></p>
            <p>Storage Location 1:     
	    <?php
			    $query=("SELECT * FROM Matchbox_User_Coll_Value_Lists WHERE Username='$Username' AND Coll_List_Type LIKE '%Location%' AND Coll_List_Val_InactivFlg=0 ORDER BY Coll_List_Val_DisplOrd ASC");								
                            $result=0;
                            $rows_count=0;									
                            $result = mysql_query($query);
                            if ((mysql_num_rows($result) == 0)) {
                                echo "<input type=\"text\" name=\"Coll_Loc1\" value=\"\" size=\"20\" id=\"Coll_Loc1\"></p>";
                            } else {
                                ?>  
                                <select name="Coll_Loc1" id="Coll_Loc1">
                                <?php
                                    $rows_count= mysql_num_rows($result);
                                    for ($i=1; $i<=$rows_count; $i++) {
                                        $row=mysql_fetch_array($result);
                                        echo '<option value="'.$row["Coll_List_Value"].'">'.$row["Coll_List_Value"].'</option'."<br />";
                                    }
                            }
                        ?>
                            </select>
                    <p>Storage Location 2:    
			<?php
			    $query=("SELECT * FROM Matchbox_User_Coll_Value_lists WHERE Username='$Username' AND Coll_List_Type LIKE '%Location%'
                                    AND Coll_List_Val_InactivFlg=0 ORDER BY Coll_List_Val_DisplOrd ASC");								
                            $result=0;
                            $rows_count=0;									
                            $result = mysql_query($query);
                            if (!$result) {
                                echo "<input type=\"text\" name=\"Coll_Loc2\" value=\"\" size=\"20\" id=\"Coll_Loc2\"></p>";
                            } else {
                                ?>  
                                <select name="Coll_Loc2" id="Coll_Loc2">
                                <?php
                                    $rows_count= mysql_num_rows($result);
                                    for ($i=1; $i<=$rows_count; $i++) {
                                        $row=mysql_fetch_array($result);
                                        echo '<option value="'.$row["Coll_List_Value"].'">'.$row["Coll_List_Value"].'</option'."<br />";
                                    }
                            }
                        ?>
                            </select>
            <p>Purchase Date (format yyyy-mm-dd): <input type="text" name="Coll_Purch_Dt" value="" size="8" id="Coll_Purch_Dt"></p>
            <p>Seller:      
			
			<?php
			    $query=("SELECT * FROM Matchbox_User_Coll_Value_lists WHERE Username='$Username' AND Coll_List_Type LIKE '%Seller%' AND Coll_List_Val_InactivFlg=0 ORDER BY Coll_List_Val_DisplOrd ASC");

                $result=0;
                $rows_count=0;									
                $result = mysql_query($query);

			    if (!$result) {
                    echo "<input type=\"text\" name=\"Coll_Seller\" value=\"\" size=\"40\" id=\"Coll_Seller\"></p>";
                } else {
			?>  
				
				<select name="Coll_Seller" id="Coll_Seller">
                    <?php
                    $rows_count= mysql_num_rows($result);

                    for ($i=1; $i<=$rows_count; $i++) {
                        $row=mysql_fetch_array($result);
                        echo '<option value="'.$row["Coll_List_Value"].'">'.$row["Coll_List_Value"].'</option>';
			    	}
			    } ?>
				</select>

            <p>Purchase Price:      <input type="text" name="Coll_Purch_Price" value="" size="10" id="Coll_Purch_Price"></p>
            <p>Flag to Sell?     <input type="checkbox" name="CollSellFlg" id="CollSellFlg"><p>
            <p>Minimum Price to Sell: <input type="text" name="Coll_MinSell_Price" value="" size="10" id="Coll_MinSell_Price"></p>
            <p>Comment: </p>
            <textarea name="Coll_Comm" cols="45" rows="4" id="Coll_Comm"></textarea>
	        <input class="button dark" type="submit" name="var_coll_submit" value="Submit" id="var_coll_submit"/>
		<?php
		    $url = "Variation_Detail.php?model=".$Coll_VarID;
		?>
		<a class="button dark cancel" href="<?php $url; ?>">Cancel</a>		   
    	</form>
    </div>
</div>


<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="Search_Models.php">Search Models</a>
		<a href="Search_Releases.php">Search Releases</a>
		<a href="Update_Mdls_in_Coll.php">Update Models in Your Collection</a>
		<a href="index.php">Return to Main Page</a>		
	</div>
</div>
         
<?php include("includes/footer.php"); ?>