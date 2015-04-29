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
        $query=("UPDATE Matchbox_User_Collections SET User_Coll_Inactiv_Flag=\"1\" WHERE Username='$User'");
        $outcome=mysql_query($query);
        if ($outcome) {
        //if ((mysql_query($query)) == true)
            //mark all codes inactive
            $query2=("UPDATE Matchbox_User_Coll_Value_Lists SET Coll_List_Val_InactivFlg=\"1\" WHERE Username='$User'");
            $outcome2=mysql_query($query2);
            if ($outcome2) {
                //mark all models inactive
                $query3=("UPDATE Matchbox_Collection SET Coll_InactiveFlg=\"1\" WHERE Username='$User'");
                $outcome3=mysql_query($query3);
            }          
	    redirect_to("Del_Coll_Outcome.php");
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
                    $User=$_SESSION['Username'];
		    $query=("SELECT * FROM Matchbox_User_Collections WHERE Username='$User' AND User_Coll_Inactiv_Flag=\"0\"");								
		    $result=0;
		    $result=mysql_query($query);
		    if ($result) {
			$row=mysql_fetch_array($result);
			$Coll_to_Del=$row['User_Coll_ID'];
		    } else {
		        echo "Can't find your collection- possible database problem- please email info@MBX-u.com";
			exit;
		    }                   
                ?>

		<form name="Delete_Collection" action="Delete_Collection.php" method="post">
		    <?php  
                        
			
			echo "<p><strong>Username:</strong> " . $User . "</p>";
			echo "<p><strong>Collection Name:</strong> " . $row["User_Coll_ID"] . "</p>";
			echo "<p><strong>Collection Description:</strong> " . $row["User_Coll_Desc"] . "</p>";
			echo "<p><strong>Date Created:</strong> " . $row["User_Coll_Created_Date"] . "</p>";

                        echo "<p><strong>NOTE: Deleting this collection will also delete any models and code values entered under it.</p>";
			echo "<p><strong>If you have any questions about how to proceed, click Cancel, below and email info@mbx-u.com with your question.</p>";
			echo "<br />";
                    ?>
		    <input type="hidden" name="Coll_to_Del" value="<?php echo $Coll_to_Del;?>" id="Coll_to_Del">
		    <div class="row">
			    <div class="large-2 small-4 columns">
				    <input type="submit" name="del_submit" class="button dark" value="DELETE?" id="del_submit"/>
			    </div>
			    <div class="large-2 small-4 columns end">
				    <?php
						$url2 = "Updt_Coll.php";
						echo "<a class='button dark cancel' href=\"".$url2."\">Cancel</a>";
					?>
			    </div>
		    </div>
        	</form>

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