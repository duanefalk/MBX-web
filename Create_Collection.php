<?php
// we must never forget to start the session
session_start();
?>

<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<?php
    //if the form was filled out already, process it				
    if (isset($_POST['Create_Coll_Submit'])) {

		//Fields:
		$Username=$_POST['Username'];
		$User_Coll_ID=$_POST['User_Coll_ID'];
		$User_Coll_Desc=$_POST['User_Coll_Desc'];
		$User_Coll_Created_Date=$_POST['User_Coll_Created_Date'];
	
		echo $Username;
		echo $User_Coll_ID;
		echo $User_Coll_Desc;
		echo $User_Coll_Created_Date;
	
		//Add the collection record
		//$query="INSERT INTO Matchbox_User_Collections (Username, User_Coll_ID, User_Coll_Desc, User_Coll_Created_Date) 
		//    VALUES ('$Username','$User_Coll_ID','$User_Coll_Desc', '$User_Coll_Created_Date')";
		$query="INSERT INTO Matchbox_User_Collections VALUES ('$Username','$User_Coll_ID','$User_Coll_Desc', '$User_Coll_Created_Date')";
	    
					
		$outcome=mysql_query($query);
		if ($outcome) {
			//finished, go back to manage collections
			?>						
					
			<p>You have created a collection. You can go to View/Update to see the details on this collection.
			<a href="Manage_Collections.php"><p onmouseover=\"this.style.color='orange'\" onmouseout=\"this.style.color='white'\">
					Manage collections</p></a>
			<?php		
			Exit; 			
		} else {
		    echo "Subject creation failed. Please review entries.";
		    echo "<p>".mysql_error()."</p>";
		    //drop down to form again
		}

    }
?> 
    
    

<table id="structure">
<tr>
	<td id="navigation">
		<a href="Manage_Collections.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Manage Collections</p></a>
		<a href="index.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Main Page</p></a>			
	</td>
	<td id="page">
		<h2>Create a Collection</h2>
		<p>Note: currently each account-holder can only have one collection. A future feature will allow you to have more than one collection if you desire.</>
		<br></><br></>
		<?php
			//check for existing collection	
			//hard coding username for now					
			$Username=$_SESSION["Username"];
			$rows_count=0;
			$query2=("SELECT * FROM Matchbox_User_Collections WHERE Username='$Username'");
			$result2 = mysql_query($query2);
			$rows_count= mysql_num_rows($result2);
			if ($rows_count != 0) {
				echo "You already have a collection. You can go to View/Update to see the details on this collection.";		
				echo "<a href=\"Manage_Collections.php\"><p onmouseover=\"this.style.color='orange'\" onmouseout=\"this.style.color='white'\">
					Manage collections</p></a>";
				Exit; 
			}	
		?>		
		<form action="Create_Collection.php" method="post">
			<p>Username:     	  <input type="text" name="Username" value="<? echo $Username?>" size="20" id="Username"</p>
			<p>Collection Identifier:     	  <input type="text" name="User_Coll_ID" value="" size="20" id="User_Coll_ID"</p>
			<p>Collection Description:</p>
				<textarea name="User_Coll_Desc" cols="45" rows="4">
				</textarea>	
			<p>Date Created: 	  <input type="text" name="User_Coll_Created_Date" value="<?php echo date('Y-m-d'); ?>" id="User_Coll_Created_Date"</p>
			
			<br></>	
			<input type="submit" name="Create_Coll_Submit" value="Submit"/>
		</form>			
		<a href="Create_Collection.php">Cancel</a>						 						
	</td>
</tr>
</table>
<?php require("includes/footer.php"); ?>