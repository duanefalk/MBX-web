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
	$Coll_to_Del=$_POST['Coll_to_Del'];
        
        //mark collection inactive
        $query=("UPDATE Matchbox_User_Collections SET User_Coll_Inactiv_Flag=\"1\" WHERE Username='$User' AND User_Coll_ID='$Coll_to_Del'");
        $outcome=mysql_query($query);
        if ($outcome) {
        //if ((mysql_query($query)) == true)
            //mark all codes inactive
            $query2=("UPDATE Matchbox_User_Coll_Value_Lists SET Coll_List_Val_InactivFlg=\"1\" WHERE Username='$User' AND User_Coll_ID='$Coll_to_Del'");
            $outcome2=mysql_query($query2);
            if ($outcome2) {
                //mark all models inactive
                $query3=("UPDATE Matchbox_Collection SET Coll_InactiveFlg=\"1\" WHERE Username='$User' AND User_Coll_ID='$Coll_to_Del'");
                $outcome3=mysql_query($query3);
            }          
	    redirect_to("Manage_Collections.php");
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

		<h2>Delete Your Collection</h2>
		<br />

		<?php
                    $Coll_to_Del=$_GET["coll"];
                    $User=$_SESSION['Username'];

		    $query=("SELECT * FROM Matchbox_User_Collections WHERE Username='$User' AND User_Coll_ID='$Coll_to_Del' AND User_Coll_Inactiv_Flag=\"0\"");								
		    $result=0;
		    $result=mysql_query($query);
		    if (mysql_num_rows($result) != 0) {
			$row=mysql_fetch_array($result);
		    } else {
		        echo "Database problem- please email info@MBX-u.com";
		    }                   
                ?>

		<form name="Delete_Collection" action="Delete_Collection.php" method="post">
		    <?php  
                        echo "<br />";
			echo "Username: ".$User."<br />";
			echo "User Collection Name: ".$row["User_Coll_ID"]."<br />";
			echo "Collection Description: ".$row["User_Coll_Desc"]."<br />";
			echo "Date Created: ".$row["User_Coll_Created_Date"]."<br />";
                        echo "<br />NOTE: Deleting this collection will also delete any models and code values entered under it. If you have any questions about how to proceed, email info@mbx-u.com<br />"
                    ?>
		    
		    <input type="hidden" name="Coll_to_Del" value="<?php echo $Coll_to_Del;?>" id="Coll_to_Del">
                    <input type="submit" name="del_submit" class="button dark" value="DELETE?" id="del_submit"/>
        	</form>
                <?php
		    $url2= "Manage_Collections.php";
		    echo "<a href=\"".$url2."\">Cancel</a>";
		?>
            </td>
	</tr>
</table>

<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="Manage_Collections.php">Manage Collection</a>
		<a href="index.php">Return to Main Page</a>
	</div>
</div>	

<?php include("includes/footer.php"); ?>