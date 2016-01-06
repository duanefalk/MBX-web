<?php 
	ob_start();
	$pageTitle = "Processing Collection Model Update";
	session_start();
	require_once("includes/db_connection.php");
	include("includes/header.php");
	include("includes/functions.php");
?>
<?php
    if (isset($_POST['var_coll_submit'])) {

        //Fields:        
        //$User_CollID=$_POST['User_CollID'];
        $UMID=$_POST['Coll_UMID'];
        $VerID=$_POST['Coll_VerID'];
        $VarID=$_POST['Var_to_Updt'];
		$RelID=$_POST['Coll_RelID'];
        $User_SpecID=$_POST['User_SpecID'];
        $Copy=$_POST['Copy_to_Updt'];
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
        $User=$_SESSION['Username'];
	
		echo "User is: ".$User;
		echo "copies: ".$Copy;
		echo "Var is: ".$VarID; 
		//exit;
	
		//update record, omit copy, username, coll id and var id since they are the keys for thesearch and cant change        
        $query=("UPDATE Matchbox_Collection SET
		UMID='$UMID',
		VerID='$VerID',
		RelID='$RelID',
		User_SpecID='$User_SpecID',
		VehCond='$VehCond',
		PkgCond='$PkgCond',
		ItemVal='$ItemVal',
		StorLoc='$StorLoc',
		StorLoc2='$StorLoc2',
		PurchDt='$PurchDt',
		Seller='$Seller',
		PurchPrice='$PurchPrice',
		SellFlag='$SellFlg',
		MinSellPrice='$MinSellPrice',
		CollComm='$CollComm',
		Coll_InactiveFlg='$Coll_InactiveFlg' 
	    WHERE Username='$User' AND VarID='$VarID' AND Copy= '$Copy' ");
   
        $outcome=mysql_query($query);
        
        if ($outcome) {
        	//if ((mysql_query($query)) == true)
			redirect_to("Updt_Coll_Mdl.php");
        } else {
            echo "<p>Subject creation failed. Please review entries.</p>";
            echo "<p>".mysql_error()."</p>";
            //drop down to form again
        }   
    }
	//if post not set do initial form 
?>

<div class="row">
	<div class="large-12 columns">
		<h2>View/Update/Delete Model in Collection</h2>
		
		<p><strong>Variation ID to view / edit / delete:</strong> <?php echo $_GET["model"]; ?></p>
		<p><strong>Copy to view / edit / delete:</strong> <?php echo $_GET["copy"]; ?></p>
		
		<?php
		    $Var_to_Updt=$_GET["model"];
		    $Copy_to_Updt=$_GET["copy"];
		    $User=$_SESSION['Username'];
		    
		    $query=("SELECT * FROM Matchbox_Collection WHERE Username='$User' AND VarID='$Var_to_Updt'");								
		    $result=0;
		    $result=mysql_query($query);
		    
		    if (mysql_num_rows($result) != 0) {
				$row=mysql_fetch_array($result);
				$User_CollID=$row['User_Coll_ID'];
		    } else {
		        echo "You do not have a collection- please go to Create a Collection";
		    }                   
                    
		    $picture1= IMAGE_URL . $Var_to_Updt."_1.jpg";
		    $picture1_loc=IMAGE_PATH. $Var_to_Updt."_1.jpg";

		    if (file_exists($picture1_loc)) {
		        echo "<img src=".$picture1." />";
		    } else {
		        echo "<img src=".DEFAULT_IMAGE." />";
		    }
		?>

		<form name="Updt_Coll_Mdl_Process" action="Updt_Coll_Mdl_Process.php" method="post">
		    <?php                        
			    //determine what copy to default in field
			    $query=("SELECT * FROM Matchbox_Collection WHERE Username='$User' AND VarID='$Var_to_Updt' AND Copy='$Copy_to_Updt'");								
				$result=0;
				$result=mysql_query($query);
				//echo "rows found: ".mysql_num_rows($result);
				$row=mysql_fetch_array($result);
				$ItemVal=$row['ItemVal'];
				$PurchDt=$row['PurchDt'];
				$PurchPrice=$row['PurchPrice'];
				$SellFlg=$row["SellFlg"];
				$MinSellPrice=$row["MinSellPrice"];
				$Comment=$row['CollComm'];
				

				echo "<p><strong>Username:</strong> ".$User."</p>";
				echo "<p><strong>User Collection Name:</strong> ".$User_CollID."</p>";
				echo "<p><strong>Variation to View/Update:</strong> ".$Var_to_Updt."</p>";
				echo "<p><strong>Copy to View/Update:</strong> ".$Copy_to_Updt."</p>";

		    ?>
		    
		    <input type="hidden" name="Var_to_Updt" value="<?php echo $Var_to_Updt;?>" id="Var_to_Updt">
		    <input type="hidden" name="Copy_to_Updt" value="<?php echo $Copy_to_Updt;?>" id="Copy_to_Updt"> 
            
            <label for="Coll_UMID">UMID:</label>
            <input type="text" name="Coll_UMID" value="<?php echo $row["UMID"];?>" size="6" id="Coll_UMID">
            
            <label for="Coll_VerID">Version ID:</label>
            <input type="text" name="Coll_VerID" value="<?php echo $row["VerID"];?>" size="10" id="Coll_VerID">
            
            <label for="Coll_RelID">Release ID:</label>
            <input type="text" name="Coll_RelID" value="<?php echo $row["RelID"];?>" size="16" id="Coll_RelID">
            
            <label for="User_SpecID">User-specific ID:</label>
            <input type="text" name="User_SpecID" value="<?php echo $row["User_SpecID"];?>" size="20" id="User_SpecID">
            
            <label for="VehCond">Vehicle Condition:</label> 
		    <?php
		        //determine from account what scheme for vehicle condition
		        $query_cond=("SELECT * FROM MBXU_User_Accounts WHERE Username='$User'");
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
                    echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
                }	
            ?>
		    </select>			
			
			
            <label for="PkgCond">Package Condition:</label>
			<?php
		        //determine from account what scheme for pkg cond
				$query_cond2=("SELECT * FROM MBXU_User_Accounts WHERE Username='$User'");
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
		            echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
		        }	
		    ?>
		    </select>
		    
		    <label for="Coll_Value">Item Value:</label>
		    <input type="text" name="Coll_Value" value="<?php echo $ItemVal;?>" size="10" id="Coll_Value">
		    
		    <label for="Coll_Loc1">Storage Location 1:</label>
			<?php
			    $query=("SELECT * FROM Matchbox_User_Coll_Value_Lists WHERE Username='$User' AND Coll_List_Type LIKE '%Location%'
                        ORDER BY Coll_List_Val_DisplOrd ASC");								
                $result=0;
                $rows_count=0;									
                $result = mysql_query($query);
			    if ($result) {
					if ((mysql_num_rows($result) == 0)) {
					    echo "<input type=\"text\" name=\"Coll_Loc1\" value=\"\" size=\"20\" id=\"Coll_Loc1\"></p>";
					} else { ?>  
					    <select name="Coll_Loc1" value= "" id="Coll_Loc1">
						    <?php
						        $rows_count= mysql_num_rows($result);
						        for ($i=1; $i<=$rows_count; $i++) {
						            $row=mysql_fetch_array($result);
						            echo '<option value="'.$row["Coll_List_Value"].'">'.$row["Coll_List_Value"].'</option'."<br />";
						        }
						    ?>
					    </select>
					<?php 
					}
			    } ?>
            
            <label for="Coll_Loc2">Storage Location 2:</label>
			<?php
			    $query=("SELECT * FROM Matchbox_User_Coll_Value_Lists WHERE Username='$User' AND Coll_List_Type LIKE '%Location%'
                                    ORDER BY Coll_List_Val_DisplOrd ASC");								
                $result=0;
                $rows_count=0;									
                $result = mysql_query($query);
			    if ($result) {
					if ((mysql_num_rows($result) == 0)) {
					    echo "<input type=\"text\" name=\"Coll_Loc2\" value=\"\" size=\"20\" id=\"Coll_Loc2\"></p>";
					} else { ?>  
					    <select name="Coll_Loc2" value= "<?php echo $row["StorLoc2"];?>" id="Coll_Loc2">
					    <?php
					        $rows_count= mysql_num_rows($result);
					        for ($i=1; $i<=$rows_count; $i++) {
					            $row=mysql_fetch_array($result);
					            echo '<option value="'.$row["Coll_List_Value"].'">'.$row["Coll_List_Value"].'</option'."<br />";
					        }
					}
			    } ?>
                        </select>
      
			<label for="Coll_Purch_Dt">Purchase Date:</label>
			<input type="text" name="Coll_Purch_Dt" value="<?php echo $PurchDt;?>" size="8" id="Coll_Purch_Dt">
			
			<label for="Coll_Seller">Seller:</label>
			<?php
			    $query=("SELECT * FROM Matchbox_User_Coll_Value_Lists WHERE Username='$User' AND Coll_List_Type LIKE '%Seller%'
                                   ORDER BY Coll_List_Val_DisplOrd ASC");								
                $result=0;
                $rows_count=0;									
                $result = mysql_query($query);

			    if ($result) {
			        if ((mysql_num_rows($result) == 0)) {
			            echo "<input type=\"text\" name=\"Coll_Seller\" value=\"\" size=\"40\" id=\"Coll_Seller\"></p>";
			        } else {
			    	?>  
			    	<select name="Coll_Seller" value="<?php echo $row["Seller"];?>" id="Coll_Seller">
			            <?php
			                $rows_count= mysql_num_rows($result);
			                for ($i=1; $i<=$rows_count; $i++) {
			                    $row=mysql_fetch_array($result);
			                    echo '<option value="'.$row["Coll_List_Value"].'">'.$row["Coll_List_Value"].'</option'."<br />";
			        	}
			        }
			    } ?>
					</select>            
			
            <label for="Coll_Purch_Price">Purchase Price:</label>
            <input type="text" name="Coll_Purch_Price" value="<?php echo $PurchPrice;?>" size="10" id="Coll_Purch_Price">
            
            <?php if ($SellFlg) { ?>
			    <input type="checkbox" value="" name="CollSellFlg" id="CollSellFlg" checked />
		    <?php } else { ?>
		    	<input type="checkbox" value="" name="CollSellFlg" id="CollSellFlg" />
			<?php } ?>
			<label for="CollSellFlg">Flag to Sell?</label>
			
			<label for="Coll_MinSell_Price">Minimum Price to Sell:</label>
			<input type="text" name="Coll_MinSell_Price" value="<?php echo $MinSellPrice;?>" size="10" id="Coll_MinSell_Price">
			
			<label for="Coll_Comm">Comment:</label>
			<textarea name="Coll_Comm" cols="45" rows="4" id="Coll_Comm"><?php echo $Comment; ?></textarea>
			
			<div class="row">
				<div class="large-4 small-4 columns">
					<input type="submit" name="var_coll_submit" class="button dark" value="Update" id="var_coll_submit"/>
				</div>
				<div class="large-4 small-4 columns">
					<?php $url1 = "Del_Mdls_in_Coll.php?model=" . $Var_to_Updt . "&copy=" . $Copy_to_Updt; ?>
					<a href="<?php echo $url1; ?>" class="button dark cancel">Delete this Var/Copy</a>
				</div>
				<div class="large-4 small-4 columns">
					<?php $url2 = "Variation_Detail.php?model=" . $Coll_VarID; ?>
					<a href="<?php echo $url2; ?>" class="button dark cancel">Cancel</a>
				</div>
			</div>            
    	</form>      
    </div>
</div>

<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="Manage_Models_in_Collection.php">Manage Mdls in Collection</a>
		<a href="Search_Models.php">Search Models</a>
		<a href="Search_Releases.php">Search Releases</a>
		<a href="index.php">Return to Main Page</a>
	</div>
</div>	

<?php include("includes/footer.php"); ?>