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

<table id="structure">
<tr>

	<td id="page">

		<h2>Delete Model from Collection</h2>
		<br />

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
		    } ELSE {
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
                         echo "<br />";
                        
                        //determine what copy to default in field
                        $query=("SELECT * FROM Matchbox_Collection WHERE Username='$User' AND VarID='$Var_to_Updt' AND Copy='$Copy_to_Updt'");								
			$result=0;
			$result=mysql_query($query);
			//echo "rows found: ".mysql_num_rows($result);
			$row=mysql_fetch_array($result);

			echo "Username: ".$User."<br />";
			echo "User Collection Name: ".$User_CollID."<br />";
			echo "Variation to Delete: ".$Var_to_Updt."<br />";
			echo "Copy to delete: ".$Copy_to_Updt."<br /><br />";
			
			echo "UMID: ".$row["UMID"]."<br />";
			echo "Version ID: ".$row["VerID"]."<br />";
			echo "Release ID: ".$row["RelID"]."<br />";
			echo "User-specific ID: ".$row["User_SpecID"]."<br />";
			echo "Vehicle Condition:  ".$row["VehCond"]."<br />";
			echo "Package Condition: ".$row["PkgCond"]."<br />";
			echo "Item Value: ".$row["ItemVal"]."<br />";
			echo "Storage Location 1: ".$row["StorLoc"]."<br />";
			echo "Storage Location 2: ".$row["StorLoc2"]."<br />";
			echo "Purchase Date: ".$row["PurchDt"]."<br />";
			echo "Seller: ".$row["Seller"]."<br />";
			echo "Purchase Price: ".$row["PurchPrice"]."<br />";
			echo "Flag to Sell? ".$row["SellFlag"]."<br />";
			echo "Minimum Price to Sell: ".$row["MinSellPrice"]."<br />";
			echo "Comment: ".$row["CollComment"]."<br />";	
                    ?>
		    
		    <input type="hidden" name="Var_to_Updt" value="<?php echo $Var_to_Updt;?>" id="Var_to_Updt">
		    <input type="hidden" name="Copy_to_Updt" value="<?php echo $Copy_to_Updt;?>" id="Copy_to_Updt"> 
                    <input type="submit" name="del_submit" class="button dark" value="DELETE?" id="del_submit"/>
        	</form>
                <?php
		    $url2= "Manage_Models_in_Collection.php";
		    echo "<a href=\"".$url2."\">Cancel</a>";
		?>
            </td>
	</tr>
</table>

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