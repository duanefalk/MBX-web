<?php ob_start(); ?>
<?php
// we must never forget to start the session
session_start();
?>


<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>

<?php
    if (isset($_POST['var_to_add'])) {
        echo "sees as post set";
        //open db
        //require_once("includes/db_connection.php");
        //Do collection table updates
        //Fields:
    	$User=$_SESSION['Username'];
	$query3=("SELECT * FROM Matchbox_User_Collections WHERE Username='$User'");								
	$result3=0;
	$rows_count3=0;									
	$result3 = mysql_query($query3);
	$row3=mysql_fetch_array($result3);
	$User_CollID=$row3["User_Coll_ID"];


	$VarID=$_POST["var_to_add"];
        $VerID=substr($VarID,0,10);
        $UMID=substr($VerID,0,6);        

	$Wishlist_InactivFlg="0";

	echo $VarID."<br />";
	echo $VerID."<br />";
	echo $UMID."<br />";
	echo $User."<br />";
	echo $User_Coll_ID."<br />";
	echo $Wishlist_InactivFlg."<br />";
     
        $query="INSERT INTO Matchbox_User_Wishlist (Username, User_Coll_ID, UMID, VerID, VarID, Wishlist_InactivFlg) 
            VALUES ('$User', '$User_CollID', '$UMID','$VerID', '$VarID', '$Wishlist_InactivFlg')";
   
        $outcome=mysql_query($query);
        if ($outcome) {
        //if ((mysql_query($query)) == true)
            echo "<p>Done and returning</p>";
            //require_once("includes/close_db_connection.php");
            //Return;
            $url= "Search_Models_Menu.php";
	    echo "<a href=\"".$url."\">Return to Search Models</a>";
            exit;
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
                <a href="Search_Models_Menu.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Search Models</p></a>
		<a href="Search_Releases_Menu.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Search Releases</p></a>
                <a href="Update_Mdls_in_Coll.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Update Models in Your Collection</p></a>
		<a href="index.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Main Page</p></a>			
	</td>
	<td id="page">
		<h2>Add Variation to Wishlist</h2>
		<br />
                <?php
                    $Var_to_Add=$_GET["model"];
                    $User=$_SESSION['Username'];
                    echo "Variation Selected: ".$Var_to_Add."<br /><br />";

                    $picture1= IMAGE_URL . $Var_to_Add."_1.jpg";
		    $picture1_loc=IMAGE_PATH. $Var_to_Add."_1.jpg";
                    if (file_exists($picture1_loc)) {
                        echo "<img src=".$picture1." width=\"240\">";
                    } else {
                        //no photo, echo DEFAULT_IMAGE;
                        echo "<img src=".DEFAULT_IMAGE." width=\"240\">";
                    }
                ?>
              
		<form name="Add_var_to_Wishlist" action="Add_Var_to_Wishlist.php" method="post">
		<input type="submit" value="<?php echo $Var_to_Add?>" id="submit" name="var_to_add">Add<br/>
        	</form>

                <?php
		    $url= "Variation_Detail.php?model=".$Var_to_Add;
		    echo "<a href=\"".$url."\">Cancel</a>";
		?>
            </td>
	</tr>
</table>
<?php include("includes/footer.php"); ?>