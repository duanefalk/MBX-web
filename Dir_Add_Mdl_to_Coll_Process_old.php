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
       
        $query="INSERT INTO Test_Matchbox_Collection (Username, User_Coll_ID, UMID, VerID, VarID, RelID, User_SpecID, Copy, VehCond, PkgCond, ItemVal, StorLoc,
            StorLoc2, PurchDt, Seller, PurchPrice, SellFlag, MinSellPrice, CollComm, Coll_InactiveFlg) 
            VALUES ('$Coll_Username','$User_CollID','$UMID', '$VerID', '$VarID', '$RelID', '$User_SpecID', '$Copy', '$VehCond', '$PkgCond', '$ItemVal', '$StorLoc',
            '$StorLoc2', '$PurchDt', '$Seller', '$PurchPrice', '$SellFlg', '$MinSellPric', '$CollComm', '$Coll_InactiveFlg')";
   
        $outcome=mysql_query($query);
        if ($outcome) {
        //if ((mysql_query($query)) == true)
	    redirect_to("Dir_Add_Mdl_to_Coll.php");
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
                <a href="Update_Mdls_in_Coll.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Update Models in Your Collection</p></a>
		<a href="index.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Main Page</p></a>			
	</td>
	<td id="page">
		<h2>Add Variation/Release to Collection</h2>
		<br />
		<p>Variation ID to add: "<?php echo $_GET["model"]; ?>"
		<?php
                    $Var_to_Add=$_GET["model"];
                    $User="duanefalk";
                    $User_CollID="FALKCOLL1";
                    
                    $picture1= IMAGE_URL . $Var_to_Add."_1.jpg";
		    $picture1_loc=IMAGE_PATH. $Var_to_Add."_1.jpg";
                    if (file_exists($picture1_loc)) {
                        echo "<img src=".$picture1." width=\"240\">";
                    } else {
                        //no photo, echo DEFAULT_IMAGE;
                        echo "<img src=".DEFAULT_IMAGE." width=\"240\">";
                    }
                ?>

		
        </td>
</tr>
</table>
<?php include("includes/footer.php"); ?>