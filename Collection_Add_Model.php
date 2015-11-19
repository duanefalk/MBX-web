<?php
// we must never forget to start the session
session_start();
?>

<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>
<?php
    require_once("includes/db_connection.php");
    if (isset($_POST['Create_Coll_Submit'])) {
        echo "sees as post set";
        //open db
        //require_once("includes/db_connection.php");
        //Do collection table updates
        //Fields:
        $Username=$_POST['Username'];
        $User_Coll_ID=$_POST['User_Coll_ID'];
        $User_Coll_Desc=$_POST['User_Coll_Desc'];
        $User_Coll_Created_Date=$_POST['User_Coll_Created_Date'];
	
	echo $Username;
	echo $User_Coll;
	echo $User_Coll_Desc;
	echo $User_Coll_Create_Date;
	
	$query="INSERT INTO Matchbox_User_Collections (Username, User_Coll_ID, User_Coll_Desc, User_Coll_Created_Date) 
            VALUES ('$Username','$User_Coll_ID','$User_Coll_Desc', '$User_Coll_Created_Date')";
   
    
        // for some reason this statement executes the mysql_query rather than  just evaluate it. so just do it and check it in one
        $outcome=mysql_query($query);
        if ($outcome) {
        //if ((mysql_query($query)) == true)
            echo "<p>Done and returning</p>";
            //require_once("includes/close_db_connection.php");
            redirect_to("Create_Collection.php");
        } else {
            echo "<p>Subject creation failed. Please review entries.</p>";
            echo "<p>".mysql_error()."</p>";
            //drop down to form again
        }
     }
?>

<div class="row">
	<div class="large-12 columns">
		
		<h2>Add a Model to Your Collection</h2>
		<p>Note: you can have more than one collection if you desire. Info will NOT be shared across collections.</p>
		
		<?php $Username=$_SESSION['Username']; ?>
		<form action="Create_Collection.php" method="post">
			<label for="Username">Username:</label>
			<input type="text" name="Username" value="<? echo $Username?>" size="20" id="Username">
			
			<label for="User_Coll_ID">Collection Identifier:</label>
			<input type="text" name="User_Coll_ID" value="" size="8" id="User_Coll_ID">
			
			<label for="User_Coll_Desc">Collection Description:</label>
			<textarea name="User_Coll_Desc" cols="45" rows="4" id="User_Coll_Desc"></textarea>
			
			<label for="User_Coll_Created_Date">Date Created:</label>
			<input type="text" value="09/25/2013" id="User_Coll_Created_Date">
			
			<div class="row">
				<div class="large-3 small-6 columns">
					<input class="button dark" type="submit" name="Create_Coll_Submit" value="Submit"/>
				</div>
				<div class="large-3 small-6 columns end">
					<a class="button dark cancel" href="Create_Collection.php">Cancel</a>
				</div>
			</div>
		</form>
	</div>
</div>

<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="Collections.php">Return to Collections</a>
	</div>
</div>

<?php require("includes/footer.php"); ?>