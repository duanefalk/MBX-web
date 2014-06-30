<?php
	// we must never forget to start the session
	session_start();
	$Sec_Lvl=$_SESSION['Sec_Lvl'];
	$Username=$_SESSION['Username'];
?>


<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<div class="row">
	<div class="large-12 columns">
	
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
		<p>Update your account information. Current values are shown for each field.</p>
		<p>* required fields</p>
		
		<hr>
		
		<form action="Create_User_Account_Process.php" method="post">
<<<<<<< HEAD
			
			<div class="formRow">
				<label>Username* (4-20 chars, alphanumeric only):</label>
				<p><?php echo "$Username"; ?></p>  	  
			</div>
			
			<div class="formRow">
				<label for="txtPassword" id="lblPassword">Password* (at least 4 chars, alphanumeric only):</label>
				<input type="text" name="Password" value="" size="40" id="Password" />
			</div>
				
				<?php $_SESSION['Sec_Lvl']=2; ?> 
				
			<div class="formRow">
				<label for="User_Name" id="lblName">Name*:</label>
				<input type="text" name="User_Name" value="<?php echo $row['$User_Name']; ?>" size="60" id="User_Name" />
			</div>
				
			<div class="formRow">
				<label for="User_Email" id="lblEmail">Email*:</label>
				<input type="text" name="User_Email" value="<?php echo $row['$User_Email']; ?>" size="60" id="User_Email" />
			</div>
				
			<div class="formRow">
				<label for="User_Url" id="lblURL">Your website:</label>
				<input type="text" name="User_Url" value="<?php echo $row['$User_Url']; ?>" size="60" id="User_Url" />
			</div>
				
			<div class="formRow">
				<label for="User_Address" id="lblAddress">Address</label>
				<input type="text" name="User_Address" value="<?php echo $row['$User_Address']; ?>" size="60" id="User_Address" />
			</div>
				
			<div class="formRow">
				<label for="User_Phone" id="lblPhone">Phone</label>
				<input type="text" name="User_Phone" value="<?php echo $row['$User_Phone']; ?>" size="20" id="User_Phone" />
			</div>
				
			<div class="formRow">
				<label for="ddlInterests" id="lblInterests">Areas of Interest</label>
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
				<select multiple size="10" name="Areas_of_Interest[]" id="ddlInterests">
					<?php
						for ($i=1; $i<=$rows_count; $i++) {
							$row = mysql_fetch_array($result);
							echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option>';
						}	
					?>
=======
		<br />
		<p>Username* (4-20 chars, alphanumeric only):   <?php echo "$Username"; ?> </p>  	  
		<p>Password* (at least 4 chars, alphanumeric only):     <input type="text" name="Password" value="" size="40" id="Password"</p>
		<?php $_SESSION['Sec_Lvl']=2; ?> 
		<p>First Name*:      <input type="text" name="First_Name" value="<?php echo $row['$First_Name']; ?>" size="60" id="First_Name"</p>
		<p>Last Name*:      <input type="text" name="Last_Name" value="<?php echo $row['$Last_Name']; ?>" size="60" id="Last_Name"</p>
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
>>>>>>> FETCH_HEAD
				</select>
			</div>
				
			<div class="formRow">
				<label for="" id="lblDealer">Are you a dealer <small>(of Matchbox, anything else- TMI!)</small></label>
				<input type="radio" name="User_is_Dealer" value="1" id="dealer1" /><label for="dealer1">Yes</label>
				<input type="radio" name="User_is_Dealer" value="0" id="dealer2" /><label for="dealer2">No</label>
			</div>
				
			<div class="formRow">
				<label for="txtClubs">Matchbox clubs you belong to:</label>
				<textarea id="txtClubs" name="User_Memberships" value="<?php echo $row['$User_Memberships']; ?>"cols="45" rows="4"></textarea>
			</div>
				
			<div class="formRow">
				<label for="">Preferred Scheme for Vehicle Condition <small>(alpha= MIB, Mint, Exc etc; num= 10, 9.5, 9 etc)</small></label>
				<input type="radio" name="Veh_Cond_Scheme" value="0" id="scheme1" /><label for="scheme1">Alpha</label>
				<input type="radio" name="Veh_Cond_Scheme" value="1" id="scheme2" /><label for="scheme2">Num</label>
			</div>	
			
			<div class="formRow">
				<label for="">Preferred Scheme for Pkg Condition <small>(as above)</small></label>
				<input type="radio" name="Pkg_Cond_Scheme" value="0" id="condition1" /><label for="condition1">Alpha</label>
				<input type="radio" name="Pkg_Cond_Scheme" value="1" id="condition2" /><label for="condition2">Num</label>
			</div>
				
			<div class="formRow">
				<label for="">Code 2 Preference</label>
				<input type="radio" name="Code2_Pref" value="0" id="code1" /><label for="code1">Combine Code 1 and Code 2 versions in displays</label><br />
				<input type="radio" name="Code2_Pref" value="1" id="code2" /><label for="code2">Show both Code 1 and Code 2, but separate them</label><br />
				<input type="radio" name="Code2_Pref" value="0" id="code3" /><label for="code3">Don't show Code 2 at all</label>
			</div>

		<input type="submit"  name="submit" value="Submit"/>
		</form>			
		<a href="Edit_Account_Process.php">Cancel</a>
		<p></p>	
	
	</div>
</div>

<?php require("includes/footer.php"); ?>
						
			