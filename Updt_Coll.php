<?php
	ob_start();
	session_start();
	$pageTitle = "View/Update/Delete Collection";
	$pageDescription = "View, Update, or Delete your Matchbox University model collection.";
	require_once("includes/db_connection.php");
	include("includes/header.php");
	include("includes/functions.php");
?>

<?php
    if (isset($_POST['coll_updt_submit'])) {

        $User=$_SESSION['Username'];
	$User_Coll_Desc=mysql_real_escape_string($_POST['User_Coll_Desc']);
	$result=0;
	$query=("UPDATE Matchbox_User_Collections
		SET User_Coll_Desc='$User_Coll_Desc'
	        WHERE (Username='$User' AND User_Coll_Inactiv_Flag=\"0\")");
	
	$outcome=mysql_query($query);
        if ($outcome) {
        //if ((mysql_query($query)) == true)
	    redirect_to("Updt_Coll_Outcome.php");
        } else {
            echo "<p>Subject creation failed. Please review entries.</p>";
            echo "<p>".mysql_error()."</p>";
            //drop down to form again
        }  
    }
?>

<div class="row">
	<div class="large-12 columns">
		<h2>View/Update/Delete Collection</h2>
		
		<?php
		    $User=$_SESSION['Username'];
		    $result=0;
		    $query=("SELECT * FROM Matchbox_User_Collections WHERE Username='$User'");
		    $result=mysql_query($query);
		    if ($result) {
				$rows=mysql_num_rows($result);
				
				if ($rows>0) {
				    $row = mysql_fetch_array($result);
				    if ($row['User_Coll_Inactiv_Flag']=="1") {
						echo "You do not have a collection. Please create a collection first.";
						exit;			
				    } else {}
				} else {
				    echo "You do not have a collection. Please create a collection first.";
				    exit;
				}	

		    }
		    $Coll_ID = $row['User_Coll_ID'];
		    $Coll_Desc = $row['User_Coll_Desc'];
		?>
		
		<form name="Updt_Coll" action="Updt_Coll.php" method="post"  data-parsley-validate>
			<?php
			    echo "<p><strong>Username:</strong> " . $User . "</p>";
			    echo "<p><strong>Collection to Update / Delete:</strong> " . $Coll_ID . "</p>";
			    echo "<p><strong>Current Description:</strong> " . $Coll_Desc . "</p>";
			?>    
		    <label for="User_Coll_Desc">New Coll Description:</label> 
		    <textarea name="User_Coll_Desc" id="User_Coll_Desc" cols="45" rows="4" required></textarea>	
		
		
		    <div class="row">
			    <div class="large-2 small-4 columns">
				    <input type="submit" name="coll_updt_submit" class="button dark" value="Update" id="coll_updt_submit"/>
			    </div>
			    <div class="large-3 small-4 columns">
				    <?php
						$url1 = "Delete_Collection.php?coll=" . $Coll_ID;
					?>
					<a class="button dark" href="<?php echo $url1; ?>">DELETE COLLECTION</a>
			    </div>
			    <div class="large-2 small-4 columns end">
				    <a class="button dark cancel" href="Manage_Collections.php">Cancel</a>
			    </div>
		    </div>
		</form>    
	</div>
</div>
    
<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="Manage_Collections.php">Manage Collection</a>
		<a href="index.php">Return to Main Page</a>
	</div>
</div>	

<?php include("includes/footer.php"); ?>