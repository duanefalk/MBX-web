<?php
	// we must never forget to start the session
	session_start();
?>

<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<div class="row">
	<div class="large-12 columns">

		<h2>Create/Update Account</h2>
		
		<p>Please note: User information is not provided to any outside entity or used for any commercial purpose.</p>
		<p>A users list of with only name, email and url (if applicable) is available to all registered users.</p>
		<p><small>* required fields</small></p>
		
		<form action="Create_User_Account_Process.php" method="post">
						
			<label for="Username">Username* (4-20 chars, alphanumeric only):</label>
			<input type="text" name="Username" value="" size="20" id="Username">
			
			<label for="Password">Password* (at least 4 chars, alphanumeric only):</label>
			<input type="text" name="Password" value="" size="40" id="Password">
		
			<?php $_SESSION['Sec_Lvl']=2; ?> 
		
			<label for="First_Name">First Name*:</label>
			<input type="text" name="First_Name" value="" size="60" id="First_Name">
			
			<label for="Last_Name">Last Name*:</label>
			<input type="text" name="Last_Name" value="" size="60" id="Last_Name">
			
			<label for="User_Email">Email*:</label>
			<input type="text" name="User_Email" value="" size="60" id="User_Email">
			
			<label for="User_Url">Home page url (if you have a web site):</label>
			<input type="text" name="User_Url" value="" size="60" id="User_Url">
			
			<label for="User_Address">Address (please enter country at minimum; need full address to send special code 2 model to you):</label>
			<input type="text" name="User_Address" value="" size="60" id="User_Address">
			
			<label for="User_Phone">Phone:</label>
			<input type="text" name="User_Phone" value="" size="20" id="User_Phone">
			
			<label for="ddlAreasOfInterest">Areas of Interest (choose as many as apply):</label>
			<?php
				$query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%UserInterest%' ORDER BY ValueDispOrder ASC");								
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
				// echo "Rows Count: ".$rows_count."<br />";
				?>
				<select multiple size="10" name="Areas_of_Interest[]" id="ddlAreasOfInterest">
				<?php
					for ($i=1; $i<=$rows_count; $i++) {
						$row=mysql_fetch_array($result);
						echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
					}	
				?>
				</select>
				
		<label for="User_is_Dealer">Are you a dealer (of Matchbox; anything else- TMI!)?:</label>     
			<input type="radio" name="User_is_Dealer" id="User_is_Dealer1" value="0"> <label for="User_is_Dealer1">No</label><br>
			<input type="radio" name="User_is_Dealer" id="User_is_Dealer2" value="1"> <label for="User_is_Dealer2">Yes</label><br>
			
		<label for="txtUser_Memberships">Matchbox clubs you belong to:</label>
		<textarea name="User_Memberships" cols="45" rows="4" id="txtUser_Memberships"></textarea>
			
		<p>Preferred Scheme for Vehicle Condition</p>
		<p>(alpha= MIB, Mint, Exc etc; num= 10, 9.5, 9 etc): </p>
			<input type="radio" name="Veh_Cond_Scheme" id="Veh_Cond_Scheme1" value="0"> <label for="Veh_Cond_Scheme1">Alpha</label><br>
			<input type="radio" name="Veh_Cond_Scheme" id="Veh_Cond_Scheme2" value="1"> <label for="Veh_Cond_Scheme2">Num</label><br>
			
		<p>Preferred Scheme for Pkg Condition (as above):</p>
			<input type="radio" name="Pkg_Cond_Scheme" id="Pkg_Cond_Scheme1" value="0"> <label for="Pkg_Cond_Scheme1">Alpha</label><br>
			<input type="radio" name="Pkg_Cond_Scheme" id="Pkg_Cond_Scheme2" value="1"> <label for="Pkg_Cond_Scheme2">Num</label><br>
		
		<p>Code 2 Preference:</p>
			<input type="radio" name="Code2_Pref" id="Code2_Pref1" value="0"> <label for="Code2_Pref1">Combine Code 1 and Code 2 versions in displays</label><br>
			<input type="radio" name="Code2_Pref" id="Code2_Pref2" value="1"> <label for="Code2_Pref2">Show both Code 1 and Code 2, but separate them</label><br>
			<input type="radio" name="Code2_Pref" id="Code2_Pref3" value="2"> <label for="Code2_Pref3">Don't show Code 2 at all</label><br>

		<p>Upon selecting 'Submit' below, you will be sent to the login page. Please login under your new account.</p>	
			
		<input type="submit"  name="submit" class="button dark" value="Submit"/>
	</form>			
		
	<a href="Create_User_Account_Form.php">Reset</a>
	
	</div>
</div>

<?php require("includes/footer.php"); ?>		