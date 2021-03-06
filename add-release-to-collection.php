<?php
	ob_start();
	session_start();
	require_once("includes/db_connection.php");
	$pageTitle = "Add Release to Collection";
	$pageDescription = "Add this matchbox model release to your collection.";
	include("includes/header.php");
	include("includes/functions.php");
?>

<div class="row">
	<div class="large-12 columns">
		
		<h2>Add a Release to Collection</h2>		
		
		<?php
		    if (isset($_POST['rel_coll_submit'])) {
		        //echo "sees as post set";
		        //open db
		
		        //Fields:
		        $User=$_POST['Coll_Username'];
			$User_Coll_ID=$_POST['User_Coll_ID'];

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
			$SellFlg =$_POST['SellFlg'];
			$MinSellPrice=$_POST['Coll_MinSell_Price'];
		        $CollComm=$_POST['Coll_Comm'];
		        $Coll_InactiveFlg="0";
		        
		        $query="INSERT INTO Matchbox_Collection (Username, User_Coll_ID, UMID, VerID, VarID, RelID, User_SpecID, Copy, VehCond, PkgCond, ItemVal, StorLoc, StorLoc2, PurchDt, Seller, PurchPrice, SellFlag, MinSellPrice, CollComm, Coll_InactiveFlg)
			VALUES ('$User','$User_Coll_ID','$UMID','$VerID', '$VarID', '$RelID', '$User_SpecID', '$Copy', '$VehCond', '$PkgCond', '$ItemVal', '$StorLoc', '$StorLoc2', '$PurchDt', '$Seller', '$PurchPrice', '$SellFlg', '$MinSellPrice', '$CollComm', '$Coll_InactiveFlg')";
		        $outcome=mysql_query($query);
		
		        if ($outcome) {
			    //echo "<p>Posted release ".$RelID. " to Collection</p>";
			    redirect_to("outcomes.php?message=Rel_success&model=$RelID");		
		            //Return;
		            $url = "ver-detail-var-listing.php?model=".$VerID;
				    echo "<a class='button dark' href=\"".$url."\">Return to Listing</a>";
		            exit;
		        } else {
		            echo "<p>Subject creation failed. Please review entries.</p>";
		            echo "<p>".mysql_error()."</p>";
		            //drop down to form again
		        }   
		    }
			//if post not set do initial form 
		?>
		
		
		
		<?php
			$Rel_to_Add = $_GET["model"];
			$Var_to_Add = substr($Rel_to_Add,0,-3);
			$User = $_SESSION['Username'];
			$Username = $_SESSION['Username'];
			$query3 = ("SELECT * FROM Matchbox_User_Collections WHERE Username='$User'");																
			$result3 = mysql_query($query3);
			$row3 = mysql_fetch_array($result3);
			$User_Coll_ID = $row3["User_Coll_ID"];
			
			echo "<p>Release Selected: " . $Rel_to_Add . "</p>";
		    
			//get and display photo
			$picture1= IMAGE_URL . $Rel_to_Add."_1.jpg";
			$picture1_loc=IMAGE_PATH. $Rel_to_Add."_1.jpg";
            
			if (file_exists($picture1_loc)) {
				echo "<img src=".$picture1." /><br></br>";
			} else {
				//no photo, echo DEFAULT_IMAGE;
				echo "<img src=".DEFAULT_IMAGE." /><br></br>";
			}
		?>
        
		<form name="Add_Rel_to_Coll" action="add-release-to-collection.php" method="post">	
	        <?php
                //$Coll_Username="duanefalk";
		$Coll_RelID=$Rel_to_Add;

			//updated 032218 to parse correctly for both LRxxx and SFxxxx models 
		
	            $Coll_VarID=substr($Coll_RelID,0,-3);
                $Coll_VerID=substr($Coll_RelID,0,-5);
                $Coll_UMID=substr($Coll_RelID,0,-9);

                //determine what copy to default in field
                $query=("SELECT * FROM Matchbox_Collection WHERE Username='$User' AND RelID='$Rel_to_Add'");								
				$result=mysql_query($query);

                if ($result) {
                    $copy_to_show= (mysql_num_rows($result)+1);
                } else {
                    $copy_to_show= "1";
                }     
            ?>
            
            <label for="Coll_Username">Username:</label>
		<input type="text" name="Coll_Username" value="<?php echo $User;?>" size="20" id="Coll_Username"></p>
		    
	    <label for="User_Coll_ID">Collection ID:</label>
		    <input type="text" name="User_Coll_ID" value="<?php echo $User_Coll_ID;?>" size="12" id="User_Coll_ID"></p>
            
            <label for="Coll_UMID">UMID:</label>
		    <input type="text" name="Coll_UMID" value="<?php echo $Coll_UMID;?>" size="6" id="Coll_UMID">
		    
	    <label for="Coll_VerID">Version ID:</label>
		    <input type="text" name="Coll_VerID" value="<?php echo $Coll_VerID;?>" size="10" id="Coll_VerID"></p>
		    
	    <label for="Coll_VarID">Variation ID:</label>
		     <input type="text" name="Coll_VarID" value="<?php echo $Coll_VarID;?>" size="13" id="Coll_VarID">
		    
	    <label for="Coll_RelID">Release ID:</label>
		    <input type="text" name="Coll_RelID" value="<?php echo $Coll_RelID;?>" size="16" id="Coll_RelID">
		    
	    <label for="User_SpecID">User-specific ID:</label>
		    <input type="text" name="User_SpecID" value="" size="20" id="User_SpecID">
            
            <label for="Coll_Copy">Copy No.:</label>
		    <input type="text" name="Coll_Copy" value="<?php echo $copy_to_show; ?>" size="2" id="Coll_Copy">
		    
		    
	    <label for="VehCond">Vehicle Condition:</label>
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
			$Veh_Cond_Scheme = "Num_cond";
		    } else {
			$Veh_Cond_Scheme = "Alpha_cond";			
		    }
				
		    $query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%$Veh_Cond_Scheme%' ORDER BY ValueDispOrder ASC");								
		    $result=0;
		    $rows_count=0;									
		    $result = mysql_query($query);
    
		    if (!$result) {
			echo "Error condition query failed";
			exit;
		    } 
    
		    $rows_count= mysql_num_rows($result);
		?>
           
            <select name="VehCond" id="VehCond">
                <?php
	                for ($i=1; $i<=$rows_count; $i++) {
                        $row=mysql_fetch_array($result);
                        echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option>';
                    }	
                ?>
            </select>
	    
            <label for="PkgCond">Package Condition:</label>
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
		    $Pkg_Cond_Scheme="Num_cond";
		} else {
		    $Pkg_Cond_Scheme="Alpha_cond";			
		}
			    
		$query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%$Pkg_Cond_Scheme%' ORDER BY ValueDispOrder ASC");								
                $result=0;
                $rows_count=0;									
                $result = mysql_query($query);
                if (!$result) {
                    echo "Error condition query failed";
                    exit;
                } 
                $rows_count= mysql_num_rows($result);
            ?>
            <select name="PkgCond" id="PkgCond">
            <?php
                for ($i=1; $i<=$rows_count; $i++) {
                $row=mysql_fetch_array($result);
                    echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option>';
                }	
            ?>
            </select>                    
            
            <label for="Coll_Value">Item Value:</label>
		<input type="text" name="Coll_Value" value="" size="10" id="Coll_Value">
            
            
           <label for="Coll_Loc1">Storage Location 1:</label>     
		<?php
		    $query=("SELECT * FROM Matchbox_User_Coll_Value_Lists WHERE Username='$User' AND Coll_List_Type LIKE '%Location%' AND Coll_List_Val_InactivFlg=0 ORDER BY Coll_List_Val_DisplOrd ASC");								
                    $result = 0;
                    $rows_count = 0;									
                    $result = mysql_query($query);
		    if (!$result) { ?>
		        <input type="text" name="Coll_Loc1" value="" size="20" id="Coll_Loc1">
		    <?php } else { ?>
		        <select name="Coll_Loc1" id="Coll_Loc1">
	              	<?php
			    $rows_count= mysql_num_rows($result);
		            for ($i=1; $i<=$rows_count; $i++) {
		                $row=mysql_fetch_array($result);
		                echo '<option value="'.$row["Coll_List_Value"].'">'.$row["Coll_List_Value"].'</option>';
		            }
		        ?>
			</select>
		    <?php } ?>   



            <label for="Coll_Loc2">Storage Location 2:</label>
				<?php
		    	$query=("SELECT * FROM Matchbox_User_Coll_Value_Lists WHERE Username='$Username' AND Coll_List_Type LIKE '%Location%' ORDER BY Coll_List_Val_DisplOrd ASC");
				$result=0;
				$rows_count=0;									
				$result = mysql_query($query);

                if (!$result) { ?>
					<input type="text" name="Coll_Loc2" value="" size="20" id="Coll_Loc2">
                <?php } else { ?>  
                    <select name="Coll_Loc2" id="Coll_Loc2">
                    <?php
	                    $rows_count= mysql_num_rows($result);
	                    for ($i=1; $i<=$rows_count; $i++) {
	                        $row=mysql_fetch_array($result);
	                        echo '<option value="'.$row["Coll_List_Value"].'">'.$row["Coll_List_Value"].'</option'."<br />";
	                    }
	                ?>
					</select>
                <?php } ?>
                
                
            <label for="Coll_Purch_Dt">Purchase Date (format yyyy-mm-dd):</label>
		<input type="text" name="Coll_Purch_Dt" value="" size="8" id="Coll_Purch_Dt">
            
            <label for="Coll_Seller">Seller:</label>					
				<?php
		    	$query=("SELECT * FROM Matchbox_User_Coll_Value_Lists WHERE Username='$Username' AND Coll_List_Type LIKE '%Seller%' ORDER BY Coll_List_Val_DisplOrd ASC");
                $result=0;
                $rows_count=0;									
                $result = mysql_query($query);

                if (!$result) {
                    echo "<input type=\"text\" name=\"Coll_Seller\" value=\"\" size=\"40\" id=\"Coll_Seller\"></p>";
                } else { ?>  
				<select name="Coll_Seller" id="Coll_Seller">
                	<?php
                    $rows_count= mysql_num_rows($result);
                    for ($i=1; $i<=$rows_count; $i++) {
                        $row=mysql_fetch_array($result);
                        echo '<option value="'.$row["Coll_List_Value"].'">'.$row["Coll_List_Value"].'</option>';
					} ?>
				</select>
				<?php } ?>
					
            <label for="Coll_Purch_Price">Purchase Price:</label>
		<input type="text" name="Coll_Purch_Price" value="" size="10" id="Coll_Purch_Price">
        
	    <label for="SellFlg">Flag to Sell?</label>
		<input type="checkbox" name="SellFlg" id="SellFlg" value="1">
            
            <label for="Coll_MinSell_Price">Minimum Price to Sell:</label>
		<input type="text" name="Coll_MinSell_Price" value="" size="10" id="Coll_MinSell_Price">
            
            <label for="Coll_Comm">Comment:</label>
		<textarea name="Coll_Comm" cols="45" rows="4" id="Coll_Comm"></textarea>
            
            <div class="row">
                <div class="large-3 small-6 columns">
	                <input type="submit" class="button dark" name="rel_coll_submit" value="Submit" id="rel_coll_submit"/>
                </div>
                <div class="large-3 small-6 columns end">
	                 <?php
		                $url = "ver-detail-var-listing.php?model=" . $Coll_VerID;
		            ?>
		            <a class="button dark cancel" href="<?php $url; ?>">Cancel</a>
                </div>
            </div>
    	</form>
    </div>
</div>
       
      <!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="search-models-menu.php">Search Models</a>
		<a href="search-releases-menu.php">Search Releases</a>
		<a href="Update_Mdls_in_Coll.php">Update Models in Your Collection</a>
		<a href="index.php">Return to Main Page</a>		
	</div>
</div>
<?php include("includes/footer.php"); ?>