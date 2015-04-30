<?php
ob_start();
// we must never forget to start the session
session_start();
?>

<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>
    
    
<div class="row">
	<div class="large-12 columns">
		<h2>Create a Collection</h2>
		
		<?php
		    //if the form was filled out already, process it				
		    if (isset($_POST['Create_Coll_Submit'])) {

				//Fields:
				$Username = $_SESSION['Username'];
				$OrigColl_ID=$_POST['User_Coll_ID'];
				$User_Coll_ID = mysql_real_escape_string($_POST['User_Coll_ID']);
				$OrigcollDesc=$_POST['User_Coll_Desc'];
				$User_Coll_Desc = mysql_real_escape_string($_POST['User_Coll_Desc']);
				$User_Coll_Created_Date = $_POST['User_Coll_Created_Date'];
			
				//Add the collection record
				//$query="INSERT INTO Matchbox_User_Collections (Username, User_Coll_ID, User_Coll_Desc, User_Coll_Created_Date) 
				//    VALUES ('$Username','$User_Coll_ID','$User_Coll_Desc', '$User_Coll_Created_Date')";
				$query = "INSERT INTO Matchbox_User_Collections (Username, User_Coll_ID, User_Coll_Desc, User_Coll_Created_Date) VALUES ('$Username','$User_Coll_ID','$User_Coll_Desc', '$User_Coll_Created_Date')";						
				$outcome = mysql_query($query);
				
				if ($outcome) {
					//finished, go back to manage collections
				?>				
					<p>You have created a collection.</p>
					<h5>Your Collection summary</h5>
					<p class="noMargin">Username: <?php echo $Username; ?></p>
					<p class="noMargin">ID: <?php echo $OrigColl_ID; ?></p>
					<p class="noMargin">Description: <?php echo $OrigcollDesc; ?></p>
					<p>Creation Date: <?php echo $User_Coll_Created_Date; ?></p>
					
					<p>You can go to <a href="Updt_Coll.php">View/Update</a> to see the details of this collection, or return to <a href="Manage_Collections.php">Manage collections</a></p>
					
				<?php		
					//Exit;
				} else {
				    echo "Subject creation failed. Please review entries.";
				    echo "<p>" . mysql_error() . "</p>";
				}		
		    } else {
			    
				$Username = $_SESSION["Username"];
				$rows_count = 0;				
				$query = ("SELECT * FROM Matchbox_User_Collections WHERE Username='$Username'");
				$result = mysql_query($query);
				
				
				if ($result) {
					$rows= mysql_num_rows($result);
					for ($i=1; $i<=$rows; $i++) {
						$row = mysql_fetch_array($result);
						if ($row['User_Coll_Inactiv_Flag']=="0") {?>
							<p>You already have a collection. You can go to View/Update to see the details on this collection.</p>
							<p><a href="Manage_Collections.php">Manage collections</a></p>
							<?php exit;
						}
					}
				} ?>	
				<p>Note: currently each account-holder can only have one collection. A future feature will allow you to have more than one collection if you desire.</p>
					
				<form action="Create_Collection.php" method="post" data-parsley-validate>
					
					<!--label for="Username">Username:</label>
					<input type="text" name="Username" value="<? echo $Username?>" size="20" id="Username"-->
					
					<div class="formRow">			
						<label for="User_Coll_ID">Collection Identifier: <small>(max 12 chars)</small></label>
						<input type="text" name="User_Coll_ID" value="" size="12" id="User_Coll_ID" maxlength="12" required>
					</div>	

					<div class="formRow">
						<label for="User_Coll_Desc">Collection Description: <small></small></label>
						<textarea name="User_Coll_Desc" id="User_Coll_Desc" cols="45" rows="4" required></textarea>
					</div>
					

					<div class="formRow">
						<label for="User_Coll_Created_Date">Date Created (yyyy-mm-dd):</label>
						<input type="text" name="User_Coll_Created_Date" value="<?php echo date('Y-m-d'); ?>" id="User_Coll_Created_Date">
					</div>

						
					<input type="submit" class="button dark" name="Create_Coll_Submit" value="Submit"/>
					<a class="button cancel" href="Create_Collection.php">Cancel</a>	
				</form>				    
		    <?php }
		?>
				
	</div>
</div>
	
<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="Manage_Collections.php">Manage Collections</a>
	</div>
</div>

<?php require("includes/footer.php"); ?>