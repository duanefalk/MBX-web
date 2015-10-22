<?php ob_start(); ?>
<?php
	// we must never forget to start the session
	session_start();
	$pageTitle = "Create an Account";
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
		
		<form action="Create_User_Account_Process.php" method="post" id="signupForm" data-parsley-validate>
			
			<div class="row">
		        <div class="large-6 medium-6 columns">
			        <div class="formRow">			
						<label for="Username">Username*:</label>
						<input type="text" name="Username" value="" maxlength="30" id="Username" required>
					</div>
		        </div>
		        <div class="large-6 medium-6 columns">
			        <div class="formRow">
						<label for="Password">Password*:</label>
						<input type="password" name="Password" value="" maxlength="30" id="Password" required>
					</div>
		        </div>
	        </div>	
		
			<?php //$_SESSION['Sec_Lvl']=2; ?> 
		
			<div class="row">
		        <div class="large-6 medium-6 columns">
			        <div class="formRow">		
						<label for="First_Name">First Name*:</label>
						<input type="text" name="First_Name" value="" size="60" id="First_Name" data-parsley-type="alphanum" required>
					</div>
		        </div>
		        <div class="large-6 medium-6 columns">
			        <div class="formRow">
						<label for="Last_Name">Last Name*:</label>
						<input type="text" name="Last_Name" value="" size="60" id="Last_Name" data-parsley-type="alphanum" required>
					</div>
		        </div>
	        </div>
	        
	        <div class="row">
		        <div class="large-6 medium-6 columns">
			        <div class="formRow">
						<label for="User_Email">Email*:</label>
						<input type="email" name="User_Email" value="" size="60" id="User_Email" data-parsley-trigger="change" required>
					</div>
		        </div>
		        <div class="large-6 medium-6 columns">
			        <div class="formRow">
						<label for="User_Phone">Phone:</label>
						<input type="text" name="User_Phone" value="" size="20" id="User_Phone">
					</div>
		        </div>
	        </div>
			
			<div class="formRow">
				<label for="User_Url">Website URL:</label>
				<input type="url" name="User_Url" value="" size="60" id="User_Url">
			</div>
			
			<div class="formRow">
				<h4>Address</h4>
				<p>Enter your full address if you'd like us to send you a unique Code 2 Model</p>
			</div>			

			<div class="row">
				<div class="large-6 medium-6 columns">
			        <div class="formRow">
						<label for="User_Address_1">Address Line 1: <small>Street address, PO Box, company name, c/o</small></label>
						<input type="text" name="User_Address_1" value="" id="User_Address_1">
					</div>
		        </div>
		        <div class="large-6 medium-6 columns">
			        <div class="formRow">
						<label for="User_Address_2">Address Line 2: <small>Apartment, suite, unit, building, floor, etc</small></label>
						<input type="text" name="User_Address_2" value="" id="User_Address_2">
					</div>
		        </div>		
			</div>

 			<div class="row">
		        <div class="large-6 medium-6 columns">
			        <div class="formRow">
						<label for="Address_City">City:</label>
						<input type="text" name="Address_City" value="" id="Address_City">
					</div>
		        </div>
		        <div class="large-6 medium-6 columns">
			        <div class="formRow">
						<label for="Address_Region">State / Province / Region:</label>
						<input type="text" name="Address_Region" value="" id="Address_Region">
					</div>
		        </div>
	        </div>

			<div class="row">
		        <div class="large-6 medium-6 columns">
			        <div class="formRow">
						<label for="Address_Code">ZIP / Postal Code:</label>
						<input type="text" name="Address_Code" value="" id="Address_Code">
					</div>
		        </div>
		        <div class="large-6 medium-6 columns">
			        <div class="formRow">
						<label for="Address_Country">Country:</label>
						<input type="text" name="Address_Country" value="" id="Address_Country">
					</div>
		        </div>
	        </div>
			
			
			<div class="formRow">
				<label for="ddlAreasOfInterest">Areas of Interest (hold down ctrl or cmd key to choose as many as apply):</label>
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
			</div>
			
			<div class="formRow">		
				<label for="User_is_Dealer">Are you a Matchbox dealer?:</label>     
				<input type="radio" name="User_is_Dealer" id="User_is_Dealer1" value="0" checked> <label for="User_is_Dealer1">No</label><br>
				<input type="radio" name="User_is_Dealer" id="User_is_Dealer2" value="1"> <label for="User_is_Dealer2">Yes</label><br>
			</div>
			
			<div class="formRow">	
				<label for="txtUser_Memberships">Matchbox clubs you belong to:</label>
				<textarea name="User_Memberships" cols="45" rows="6" id="txtUser_Memberships"></textarea>
			</div>	
			
			<div class="row">
		        <div class="large-6 medium-6 columns">
			        <div class="formRow">
						<label for="">Preferred Scheme for Vehicle Condition <small>(alpha= MIB, Mint, Exc etc; num= 10, 9.5, 9 etc)</small></label>
						<input type="radio" name="Veh_Cond_Scheme" id="Veh_Cond_Scheme1" value="0" checked> <label for="Veh_Cond_Scheme1">Alpha</label><br>
						<input type="radio" name="Veh_Cond_Scheme" id="Veh_Cond_Scheme2" value="1"> <label for="Veh_Cond_Scheme2">Num</label><br>
					</div>
		        </div>
		        <div class="large-6 medium-6 columns">
			       	<div class="formRow">
						<label for="">Preferred Scheme for Pkg Condition <small>(as above)</small></label>
						<input type="radio" name="Pkg_Cond_Scheme" id="Pkg_Cond_Scheme1" value="0" checked> <label for="Pkg_Cond_Scheme1">Alpha</label><br>
						<input type="radio" name="Pkg_Cond_Scheme" id="Pkg_Cond_Scheme2" value="1"> <label for="Pkg_Cond_Scheme2">Num</label><br>
					</div>
		        </div>
	        </div>
			
			<div class="formRow">
				<label for="">Code 2 Preference</label>
				<input type="radio" name="Code2_Pref" id="Code2_Pref1" value="0" checked> <label for="Code2_Pref1">Combine Code 1 and Code 2 versions in displays</label><br>
				<input type="radio" name="Code2_Pref" id="Code2_Pref2" value="1"> <label for="Code2_Pref2">Show both Code 1 and Code 2, but separate them</label><br>
				<input type="radio" name="Code2_Pref" id="Code2_Pref3" value="2"> <label for="Code2_Pref3">Don't show Code 2 at all</label><br>
			</div>
			

		<p>Upon selecting 'Submit' below, you will be sent to the login page. Please login under your new account.</p>	
			
		<div class="row">
			<div class="large-2 small-6 columns">
				<input type="submit"  name="submit" class="button dark" value="Submit"/>
			</div>
			<div class="large-2 small-6 columns end">
				<a class="button dark cancel" href="Create_User_Account_Form.php">Reset</a>
			</div>
		</div>
	</form>
	
	</div>
</div>

<?php require("includes/footer.php"); ?>		