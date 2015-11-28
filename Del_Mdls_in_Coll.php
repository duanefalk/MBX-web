<?php ob_start(); ?>
<?php
// we must never forget to start the session
session_start();
?>
<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>

<?php
    if (isset($_POST['del_submit'])) {
   
	$User=$_SESSION['Username'];
	$VarID=$_POST['Var_to_Updt'];
	$Copy=$_POST['Copy_to_Updt'];
	echo "User is: ".$User;
	echo "copies: ".$Copy;
	echo "Var is: ".$VarID; 
	//exit;
	//update record, omit copy, username, coll id and var id since they are the keys for thesearch and cant change        
        $query=("UPDATE Matchbox_Collection SET Coll_InactiveFlg=\"1\" WHERE Username='$User' AND VarID='$VarID' AND Copy= '$Copy'");
   
        $outcome=mysql_query($query);
        if ($outcome) {
        //if ((mysql_query($query)) == true)

	    redirect_to("Manage_Models_in_Collection.php");
        } else {
            echo "<p>Deletion failed. Please review entries.</p>";
            echo "<p>".mysql_error()."</p>";
            //drop down to form again
        }   
    }
//if post not set do initial form 
?>

<div class="row">
	<div class="large-12 columns">
		<h2>Delete Model from Collection</h2>
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
		        echo "Database problem- please email info@MBX-u.com";
		    }                   
                    
            $picture1= IMAGE_URL . $Var_to_Updt."_1.jpg";
		    $picture1_loc=IMAGE_PATH. $Var_to_Updt."_1.jpg";
            if (file_exists($picture1_loc)) {
                echo "<img src=".$picture1." width=\"240\">";
            } else {
                echo "<img src=".DEFAULT_IMAGE." width=\"240\">";
            }
		?>

		<form name="Del_Mdls_in_Coll" action="Del_Mdls_in_Coll.php" method="post">
		    <?php  
                //determine what copy to default in field
                $query=("SELECT * FROM Matchbox_Collection WHERE Username='$User' AND VarID='$Var_to_Updt' AND Copy='$Copy_to_Updt'");								
				$result=0;
				$result=mysql_query($query);
				//echo "rows found: ".mysql_num_rows($result);
				$row=mysql_fetch_array($result);

				echo "<p>Username: ".$User."</p>";
				echo "<p>User Collection Name: ".$User_CollID."</p>";
				echo "<p>Variation to Delete: ".$Var_to_Updt."</p>";
				echo "<p>Copy to delete: ".$Copy_to_Updt."</p>";			
				echo "<p>UMID: ".$row["UMID"]."</p>";
				echo "<p>Version ID: ".$row["VerID"]."</p>";
				echo "<p>Release ID: ".$row["RelID"]."</p>";
				echo "<p>User-specific ID: ".$row["User_SpecID"]."</p>";
				echo "<p>Vehicle Condition:  ".$row["VehCond"]."</p>";
				echo "<p>Package Condition: ".$row["PkgCond"]."</p>";
				echo "<p>Item Value: ".$row["ItemVal"]."</p>";
				echo "<p>Storage Location 1: ".$row["StorLoc"]."</p>";
				echo "<p>Storage Location 2: ".$row["StorLoc2"]."</p>";
				echo "<p>Purchase Date: ".$row["PurchDt"]."</p>";
				echo "<p>Seller: ".$row["Seller"]."</p>";
				echo "<p>Purchase Price: ".$row["PurchPrice"]."</p>";
				echo "<p>Flag to Sell? ".$row["SellFlag"]."</p>";
				echo "<p>Minimum Price to Sell: ".$row["MinSellPrice"]."</p>";
				echo "<p>Comment: ".$row["CollComment"]."</p>";	
            ?>
		    
		    <input type="hidden" name="Var_to_Updt" value="<?php echo $Var_to_Updt;?>" id="Var_to_Updt">
		    <input type="hidden" name="Copy_to_Updt" value="<?php echo $Copy_to_Updt;?>" id="Copy_to_Updt"> 
		    
		    <div class="row">
			    <div class="large-4 small-6 columns">
				    <input type="submit" name="del_submit" class="button dark" value="DELETE?" id="del_submit" />
			    </div>
			    <div class="large-4 small-6 columns end">
				    <a class="button dark cancel" href="Manage_Models_in_Collection.php">Cancel</a>
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