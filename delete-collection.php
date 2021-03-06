<?php
	ob_start();
	session_start();
	$pageTitle = "Delete Collection";
	$pageDescription = "Delete a collection from your Matchbox University account.";
	require_once("includes/db_connection.php");
	include("includes/header.php");
	include("includes/functions.php");
?>
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
	    redirect_to("delete-collection-outcome.php");
        } else {
            echo "<p>Deletion failed. Please review entries.</p>";
            echo "<p>".mysql_error()."</p>";
            //drop down to form again
        }
    }
//if post not set do initial form
?>

<div class="row">
	<div class="large-12 column">

		<h2>Delete Your Collection</h2>

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

		<form name="Delete_Collection" action="delete-collection.php" method="post">
		    <p><strong>Username:</strong> <?php echo $User; ?></p>
		    <p><strong>Collection Name:</strong> <?php echo $row["User_Coll_ID"]; ?></p>
			<p><strong>Collection Description:</strong> <?php echo $row["User_Coll_Desc"]; ?></p>
			<p><strong>Date Created:</strong> <?php echo $row["User_Coll_Created_Date"]; ?></p>

			<h4>NOTE: Deleting this collection will also delete any models and code values entered under it.</h4>
			<p>If you have any questions about how to proceed, click Cancel, below and email <a href="mailto:info@mbx-u.com">info@mbx-u.com</a> with your question.</p>

		    <input type="hidden" name="Coll_to_Del" value="<?php echo $Coll_to_Del;?>" id="Coll_to_Del">
		    <div class="row">
			    <div class="large-2 small-4 columns">
				    <input type="submit" name="del_submit" class="button dark" value="DELETE" id="del_submit"/>
			    </div>
			    <div class="large-2 small-4 columns end">
				    <?php
						$url2 = "update-collection.php";
						echo "<a class='button dark cancel' href=\"".$url2."\">Cancel</a>";
					?>
			    </div>
		    </div>
        </form>

	</div>
</div>

<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="manage-collections.php">Manage Collection</a>
		<a href="index.php">Return to Main Page</a>
	</div>
</div>

<?php include("includes/footer.php"); ?>