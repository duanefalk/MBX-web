<?php
// we must never forget to start the session
session_start();
$Sec_Lvl=$_SESSION['Sec_Lvl'];
$Username=$_SESSION['Username'];
?>


<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>
<table id="structure">
<tr>
	<td id="navigation">
	<a href="index.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Main Page</p></a>
	</td>
	<td id="page">
		<?php
			$query= ("SELECT * FROM Test_MBXU_USer_Accounts WHERE Username = '$Username'");
			$result = mysql_query($query);
			if (mysql_num_rows($result)==0) {			
				echo "<h3>Error - Cant find user record</h3>"; //mysql_error();
				exit;
			}
			$row=mysql_fetch_array($result);
		?>
		<h2>Edit Account</h2>
		<p></p>
		<p>Update your account information. Current values are shown for each field.</p>

		<br />
		<p>* required fields</p>
		<form action="Create_User_Account_Process.php" method="post">
		<br />
		<p>Username* (4-20 chars, alphanumeric only):   <?php echo "$Username"; ?> </p>  	  
		<p>Password* (at least 4 chars, alphanumeric only):     <input type="text" name="Password" value="" size="40" id="Password"</p>
		<?php $_SESSION['Sec_Lvl']=2; ?> 
		<p>Name*:      <input type="text" name="User_Name" value="<?php echo $row['$User_Name']; ?>" size="60" id="User_Name"</p>
		<p>Email*:      <input type="text" name="User_Email" value="<?php echo $row['$User_Email']; ?>" size="60" id="User_Email"</p>
		<p>Home page url (if you have a web site):      <input type="text" name="User_Url" value="<?php echo $row['$User_Url']; ?>" size="60" id="User_Url"</p>
		<p>Address (please enter country at minimum):      <input type="text" name="User_Address" value="<?php echo $row['$User_Address']; ?>" size="60" id="User_Address"</p>
		<p>Phone:      <input type="text" name="User_Phone" value="<?php echo $row['$User_Phone']; ?>" size="20" id="User_Phone"</p>
		<p>Areas of Interest (choose as many as apply): </p>
			<?php
				$query=("SELECT * FROM Test_Matchbox_Value_Lists WHERE ValueList LIKE '%UserInterest%' ORDER BY ValueDispOrder ASC");								
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
			<select multiple size=10 name="Areas_of_Interest[]">
			<?php
				for ($i=1; $i<=$rows_count; $i++) {
					$row=mysql_fetch_array($result);
					echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
				}	
			?>
				</select>
		<p>Are you a dealer (of Matchbox; anything else- TMI!)?: </p>     
			<input type="radio" name="User_is_Dealer" value="0">No<br>
			<input type="radio" name="User_is_Dealer" value="1">Yes<br>
		<p>Matchbox clubs you belong to:      </p>
				<textarea name="User_Memberships" value="<?php echo $row['$User_Memberships']; ?>"cols="45" rows="4">	
				</textarea>
			
		<p>Preferred Scheme for Vehicle Condition     </p>
		<p>(alpha= MIB, Mint, Exc etc; num= 10, 9.5, 9 etc): </p>
			<input type="radio" name="Veh_Cond_Scheme" value="0">Alpha<br>
			<input type="radio" name="Veh_Cond_Scheme" value="1">Num<br>
		<p>Preferred Scheme for Pkg Condition (as above):     </p>
			<input type="radio" name="Pkg_Cond_Scheme" value="0">Alpha<br>
			<input type="radio" name="Pkg_Cond_Scheme" value="1">Num<br>
		<p>Code 2 Preference: </p>
			<input type="radio" name="Code2_Pref" value="0">Combine Code 1 and Code 2 versions in displays<br>
			<input type="radio" name="Code2_Pref" value="1">Show both Code 1 and Code 2, but separate them<br>
			<input type="radio" name="Code2_Pref" value="2">Don't show Code 2 at all<br>

		<input type="submit"  name="submit" value="Submit"/>
		</form>			
		<a href="Edit_Account_Process.php">Cancel</a>
		<p></p>	
	</td>
</tr>
</table>
<?php require("includes/footer.php"); ?>
						
			