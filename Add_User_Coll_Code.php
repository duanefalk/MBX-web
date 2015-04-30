<?php
// we must never forget to start the session
session_start();
?>


<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php require_once("includes/functions.php"); ?>

<div class="row">
	<div class="large-12 columns">

		<?php
		    if (isset($_POST['submit'])) {
		
		        $Username=$_SESSION['Username'];
		        $User_Coll_ID=$_POST['User_Coll_ID'];
		        $UserCollValType=$_POST['UserCollValType'];
		        $UserCollValue=$_POST['UserCollValue'];
		        $UserCollValueDisplOrd=$_POST['UserCollValueDisplOrd'];
		        $Coll_List_Val_InactivFlg=0;
		
		       
		        $query="INSERT INTO Matchbox_User_Coll_Value_Lists (Username, User_Coll_ID, Coll_List_Type, Coll_List_Value, Coll_List_Val_DisplOrd, Coll_List_Val_InactivFlg) 
		            VALUES ('$Username','$User_Coll_ID','$UserCollValType', '  $UserCollValue', '$UserCollValueDisplOrd', '$Coll_List_Val_InactivFlg')";
		   
		        $outcome=mysql_query($query);
		        if (!$outcome) {
		            echo "<p>Subject creation failed. Please review entries.</p>";
		            echo "<p>".mysql_error()."</p>";
		            //drop down to form again
		        }   
		    }
		//if post not set do initial form 
		?>

		<h2>Add a Collection Code</h2>
		<form name="Add_User_Coll_Code" action="Add_User_Coll_Code.php" method="post" data-parsley-validate>
			
			<?php echo "User: ".$_SESSION['Username']."<br />"; 
				$Username=$_SESSION['Username'];
				$query2="SELECT * FROM Matchbox_User_Collections WHERE Username='$Username'";
				$result2=mysql_query($query2);
				$row2=mysql_fetch_array($result2);
				echo"<p><strong>Collection Name:</strong> " . $row2['User_Coll_ID'] . "</p>";
			?>
			
			<div class="formRow">			
				<label for="UserCollValType">Value Type:</label>
				<?php
				$query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%UserCollValType%'");								
				$result=0;
				$rows_count=0;									
				$result = mysql_query($query);
				if (!result) {
					echo "Database query failed";
				}
				else {
					//echo "made connection ".$result."<br />";		
				}
				$rows_count= mysql_num_rows($result);
				// echo "Rows COunt: ".$rows_count."<br />";
			?> 
				<select name="UserCollValType">
				
			<?php
				for ($i=1; $i<=$rows_count; $i++) {
					$row=mysql_fetch_array($result);
					echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
				}	
			?>
			</select>
			</div>
			
			<div class="formRow">			
				<label for="UserCollValue">Value:</label>
				<input type="text" name="UserCollValue" value="" size="40" id="UserCollValue">
			</div>
		
			<div class="formRow">			
				<label for="UserCollValueDisplOrd">Display Order:</label>
				<input type="number" name="UserCollValueDisplOrd" value="" id="UserCollValueDisplOrd" data-parsley-type="integer" data-parsley-error-message="This value is required and your value must be an integer!" required>
			</div>
			
			<div class="row">
				<div class="large-2 small-6 columns">
					<input class="button dark" type="submit" name="submit" value="Submit" id="submit"/>
				</div>
				<div class="large-2 small-6 columns end">
					<a class="button dark cancel" href="Add_User_Coll_Code.php">Cancel</a>	
				</div>
		</form>	
	
	</div>
</div>

<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="Collection_Code_Lists.php">Manage Collection Code Lists</a>
		<a href="Manage_Collections.php">Manage Collections</a>
	</div>
</div>
<?php include("includes/footer.php"); ?>