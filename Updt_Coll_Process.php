<?php ob_start(); ?>
<?php
// we must never forget to start the session
session_start();
?>
<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>

<?php
    if (isset($_POST['coll_submit'])) {

        //Fields:
        //Username
	//User_Coll_ID
	//User_Coll_Desc
	//User_Coll_Created_Date
	$User=$_SESSION['Username'];
        $User_Coll_ID=$_POST['Coll_to_Updt'];
	$User_Coll_Desc=addslashes($_POST['User_Coll_Desc']);

	echo $User;
	echo $User_Coll_ID;
	echo $User_Coll_Desc;
	
	//update record        
        $query=("UPDATE Matchbox_User_Collections SET
		User_Coll_Desc='$User_Coll_Desc'
	    WHERE Username='$User' AND User_Coll_ID='$User_Coll_ID'");
   
        $outcome=mysql_query($query);
        if ($outcome) {
        //if ((mysql_query($query)) == true)
	    redirect_to("Updt_Coll.php");
        } else {
            echo "<p>Subject creation failed. Please review entries.</p>";
            echo "<p>".mysql_error()."</p>";
            //drop down to form again
        }   
    } else {
//if post not set do initial form 
?>

<div class="row">
	<div class="large-12 columns">
		
		<h2>Update/Delete Collection</h2>

		<?php
            $User=$_SESSION['Username'];
		    $Coll_to_Updt=$_GET["CollID"];
		    $query=("SELECT * FROM Matchbox_User_Collections WHERE Username='$User' AND User_Coll_ID='$Coll_to_Updt'");								
		    $result=0;
		    $result=mysql_query($query);
		    
		    if (mysql_num_rows($result) != 0) {
				$row=mysql_fetch_array($result);
				$Coll_Desc=$row['User_Coll_Desc'];
		    } else {
		        echo "There is a database error- please notify system admin";
		    }                   
                ?>

		<form name="Updt_Coll_Process" action="Updt_Coll_Process.php" method="post">
		    <?php  
            	echo "<p><strong>Username:</strong> " . $User . "</p>";
				echo "<p><strong>Collection to Update / Delete:</strong> " . $Coll_to_Updt . "</p>";
				echo "<p><strong>Current Description:</strong> " . $Coll_Desc . "</p>";
			?>
		    <input type="hidden" name="Coll_to_Updt" value="<?php echo $Coll_to_Updt;?>" id="Coll_to_Updt">
		    <label for="User_Coll_Desc">New Coll Description:</label> 
			<textarea name="User_Coll_Desc" id="User_Coll_Desc" cols="45" rows="4"></textarea>
		    
		    <div class="row">
			    <div class="large-2 small-4 columns">
				    <input type="submit" name="coll_submit" class="button dark" value="Update" id="coll_submit"/>
			    </div>
			    <div class="large-3 small-4 columns">
				    <?php
						$url1 = "Delete_Collection.php?coll=" . $Coll_to_Updt;
						echo "<a class='button dark' href=\"".$url1."\">DELETE COLLECTION</a>";
					?>
			    </div>
			    <div class="large-2 small-4 columns end">
				    <?php
						$url2 = "Updt_Coll.php";
						echo "<a class='button dark cancel' href=\"".$url2."\">Cancel</a>";
					?>
			    </div>
		    </div>
    	</form>
	</div>
</div>

<?php } ?>


<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="Manage_Collections.php">Manage Collection</a>
		<a href="index.php">Return to Main Page</a>
	</div>
</div>	

<?php include("includes/footer.php"); ?>