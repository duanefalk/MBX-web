<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>

<?php
    if (isset($_POST['var_coll_submit'])) {

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
	    WHERE Username='$User' AND User_Coll_ID='$User_CollID' AND VarID='$VarID' AND Copy='$Copy'");
   
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

<table id="structure">
<tr>
	<td id="navigation">
                <a href="Search_Models.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Search Models</p></a>
		<a href="Search_Releases.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Search Releases</p></a>
                <a href="Manage_Models_in_Coll.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">return to Manage Collection</p></a>
		<a href="index.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Main Page</p></a>			
	</td>
	<td id="page">
		<h2>View/Update Model in Collection</h2>
		<br />
		<p>Variation ID to view/edit: <?php echo $_GET["model"]; ?>
		<p>Copy to view.edit: <?php echo $_GET["copy"]; ?>
		<br />
		<?php
                    $Var_to_Updt=$_GET["model"];
		    $Copy_to_Updt=$_GET["copy"];
                    $User="duanefalk";
                    $User_CollID="FALKCOLL1";
                    
                    $picture1= IMAGE_URL . $Var_to_Updt."_1.jpg";
		    $picture1_loc=IMAGE_PATH. $Var_to_Updt."_1.jpg";
                    if (file_exists($picture1_loc)) {
                        echo "<img src=".$picture1." width=\"240\">";
                    } else {
                        //no photo, echo DEFAULT_IMAGE;
                        echo "<img src=".DEFAULT_IMAGE." width=\"240\">";
                    }

		

                ?>

		<form name="Updt_Coll_Mdl_Process" action="Updt_Coll_Mdl_Process.php" method="post">
		    <?php  
                         echo "<br /><br />";
                        
                        //determine what copy to default in field
                        $query=("SELECT * FROM Matchbox_Collection WHERE Username='$User' AND User_Coll_ID='$User_CollID' AND VarID='$Var_to_Updt' AND Copy='$Copy_to_Updt'");								
			$result=0;
			$result=mysql_query($query);
			echo "rows found: ".mysql_num_rows($result);
			$row=mysql_fetch_array($result);

			echo $User."<br />";
			echo $User_CollID."<br />";
			echo $Var_to_Updt."<br />";
			echo $Copy_to_Updt."<br />";
			echo $row["UMID"]."<br />";
			echo $row["VerID"]."<br />";
			echo $row["RelID"]."<br />";
			echo $row["User_SpecID"]."<br />";
			echo $row["VehCond"]."<br />";
			echo $row["PkgCond"]."<br />";
			echo $row["ItemVal"]."<br />";
			echo $row["StorLoc"]."<br />";
			echo $row["StorLoc2"]."<br />";
			echo $row["PurchDt"]."<br />";
			echo $row["Seller"]."<br />";




                    ?>
		    <input type="hidden" name="Coll_Username" value="<?php echo $User;?>" id="Coll_Username">
		    <input type="hidden" name="User_CollID" value="<?php echo $User_CollID;?>" id="User_CollID">
		    <input type="hidden" name="Coll_VarID" value="<?php echo $Var_to_Updt;?>" id="Coll_VarID">
		    <input type="hidden" name="Coll_Copy" value="<?php echo $Copy_to_Updt;?>" id="Coll_Copy">
                    <p>UMID:          <input type="text" name="Coll_UMID" value="<?php echo $row["UMID"];?>" size="6" id="Coll_UMID"></p>
                    <p>Version ID:    <input type="text" name="Coll_VerID" value="<?php echo $row["VerID"];?>" size="10" id="Coll_VerID"></p>
                    <p>Release ID:    <input type="text" name="Coll_RelID" value="<?php echo $row["RelID"];?>" size="16" id="Coll_RelID"></p>
                    <p>User-specific ID:   <input type="text" name="User_SpecID" value="<?php echo $row["User_SpecID"];?>" size="20" id="User_SpecID"></p>
                    <p>Vehicle Condition: 
                        <?php
                            //vehicle condition
                            //Get this from session vars and add to user prefs hard code for now
                            $Cond_scheme="Alpha_cond";
    
                            $query=("SELECT * FROM Matchbox_Value_lists WHERE ValueList LIKE '%$Cond_scheme%' ORDER BY ValueDispOrder ASC");								
                            $result=0;
                            $rows_count=0;									
                            $result = mysql_query($query);
                            if ((mysql_num_rows($result) == 0)) {
                                echo "Error condition query failed";
                                exit;
                            } 
                            $rows_count= mysql_num_rows($result);
                        ?>
                        <select name="VehCond" value="<?php echo $row["VehCond"];?>" id="VehCond">
                        <?php
                            for ($i=1; $i<=$rows_count; $i++) {
                                $row=mysql_fetch_array($result);
                                echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
                            }	
                        ?>
                        </select>
                    <p>Package Condition: 
                        <?php
                            //Get this from session vars and add to user prefs hard code for now
                            $Cond_scheme="Alpha_cond";
    
                            $query=("SELECT * FROM Matchbox_Value_lists WHERE ValueList LIKE '%$Cond_scheme%' ORDER BY ValueDispOrder ASC");								
                            $result=0;
                            $rows_count=0;									
                            $result = mysql_query($query);
                            
                            if (mysql_num_rows($result) == 0) {
                                echo "Error condition query failed";
                                exit;
                            } 
                            $rows_count= mysql_num_rows($result);
                        ?>  
                        <select name="PkgCond" value="<?php echo $row["PkgCond"];?>" id="PkgCond">
                        <?php
                            for ($i=1; $i<=$rows_count; $i++) {
                                    $row=mysql_fetch_array($result);
                                    echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
                            }	
                        ?>
                        </select>
                    <p>Item Value:      <input type="text" name="Coll_Value" value="<?php echo $row["ItemVal"];?>" size="10" id="Coll_Value"></p>
                    <p>Storage Location 1:     
			<?php
			    $query=("SELECT * FROM Matchbox_User_Coll_Value_lists WHERE Username='$User' AND User_Coll_ID LIKE '%$User_CollID%' AND Coll_List_Type LIKE '%Location%'
                                    AND (!Coll_List_Val_InactivFlg) ORDER BY Coll_List_Val_DisplOrd ASC");								
                            $result=0;
                            $rows_count=0;									
                            $result = mysql_query($query);
                            if ((mysql_num_rows($result) == 0)) {
                                echo "<input type=\"text\" name=\"Coll_Loc1\" value=\"\" size=\"20\" id=\"Coll_Loc1\"></p>";
                            } ELSE {
                                ?>  
                                <select name="Coll_Loc1" value= "<?php echo $row["StorLoc"];?>" id="Coll_Loc1">
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
			    $query=("SELECT * FROM Matchbox_User_Coll_Value_lists WHERE Username='$User' AND User_Coll_ID LIKE '%$User_CollID%' AND Coll_List_Type LIKE '%Location%'
                                    AND (!Coll_List_Val_InactivFlg) ORDER BY Coll_List_Val_DisplOrd ASC");								
                            $result=0;
                            $rows_count=0;									
                            $result = mysql_query($query);
                            if ((mysql_num_rows($result) == 0)) {
                                echo "<input type=\"text\" name=\"Coll_Loc2\" value=\"\" size=\"20\" id=\"Coll_Loc2\"></p>";
                            } ELSE {
                                ?>  
                                <select name="Coll_Loc2" value= "<?php echo $row["StorLoc2"];?>" id="Coll_Loc2">
                                <?php
                                    $rows_count= mysql_num_rows($result);
                                    for ($i=1; $i<=$rows_count; $i++) {
                                        $row=mysql_fetch_array($result);
                                        echo '<option value="'.$row["Coll_List_Value"].'">'.$row["Coll_List_Value"].'</option'."<br />";
                                    }
                            }
                        ?>
                            </select>
                    <p>Purchase Date:      <input type="text" name="Coll_Purch_Dt" value="<?php echo $row["PurchDt"];?>" size="8" id="Coll_Purch_Dt"></p>
                    <p>Seller:      
			<?php
			    $query=("SELECT * FROM Matchbox_User_Coll_Value_lists WHERE Username='$User' AND User_Coll_ID LIKE '%$User_CollID%' AND Coll_List_Type LIKE '%Seller%'
                                    AND (!Coll_List_Val_InactivFlg) ORDER BY Coll_List_Val_DisplOrd ASC");								
                            $result=0;
                            $rows_count=0;									
                            $result = mysql_query($query);
                            if ((mysql_num_rows($result) == 0)) {
                                echo "<input type=\"text\" name=\"Coll_Seller\" value=\"\" size=\"40\" id=\"Coll_Seller\"></p>";
                            } ELSE {
				?>  
				<select name="Coll_Seller" value="<?php echo $row["Seller"];?>" id="Coll_Seller">
	                        <?php
                                    $rows_count= mysql_num_rows($result);
	                            for ($i=1; $i<=$rows_count; $i++) {
                                        $row=mysql_fetch_array($result);
                                        echo '<option value="'.$row["Coll_List_Value"].'">'.$row["Coll_List_Value"].'</option'."<br />";
				    }
			    }
                        ?>
			 </select>
                    <p>Purchase Price:      <input type="text" name="Coll_Purch_Price" value="<?php echo $row["PurchPrice"];?>" size="10" id="Coll_Purch_Price"></p>
                    <p>Flag to Sell?     <input type="checkbox" value="<?php echo $row["SellFlg"];?>" name="CollSellFlg"><P>
                    <p>Minimum Price to Sell: <input type="text" name="Coll_MinSell_Price" value="<?php echo $row["MinSellPrice"];?>" size="10" id="Coll_MinSell_Price"></p>
                    <p>Comment: </p>
                        <textarea name="Coll_Comm" cols="45" rows="4" value="<?php echo $row["CollComm"];?>" id="Coll_Comm">	
                        </textarea>
                    <input type="submit" name="var_coll_submit" value="Submit" id="var_coll_submit"/>
        	</form>
                <?php
		    $url= "Variation_Detail.php?model=".$Coll_VarID;
		    echo "<a href=\"".$url."\">Cancel</a>";
		?>
            </td>
	</tr>
</table>
<?php include("includes/footer.php"); ?>