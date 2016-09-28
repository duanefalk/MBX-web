<?php 
	ob_start();
	session_start();
	$pageTitle = "Edit Account";
	$pageDescription = "Edit and updated your Matchbox University account information.";
	$Sec_Lvl=$_SESSION['Sec_Lvl'];
	$Username=$_SESSION['Username'];
?>


<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<div class="row">
	<div class="large-12 columns">
	
		<?php
			$query= ("SELECT * FROM MBXU_User_Accounts WHERE Username = '$Username'");
			$result = mysql_query($query);
			if(!$result) {			
				echo "<h3>Error - Cant find user record</h3>"; //mysql_error();
				exit;
			}
			$row=mysql_fetch_array($result);
		?>
		
		<h2>Edit Account</h2>
		<p>Update your account information. Current values are shown for each field.</p>
		<p>* required fields</p>
		
		<hr>
		
		<form action="edit-account-process.php" method="post">

			
			<div class="formRow">
				<label>Account Username:</label>
				<p><?php echo "$Username"; ?></p>  	  
			</div>
			
			<div class="formRow">
				<label for="txtPassword" id="lblPassword">Password* (at least 4 chars, alphanumeric only):</label>
				<input type="text" name="Password" value="" size="40" id="Password" />
			</div>
				
			<?php $_SESSION['Sec_Lvl']=2; ?> 
							
			<div class="row">
				<div class="large-6 medium-6 columns">
					<div class="formRow">
						<label for="User_Email">Email*:</label>
						<input type="text" name="User_Email" value="<?php echo $row['User_Email']; ?>" size="60" id="User_Email" />
					</div>
				</div>
				<div class="large-6 medium-6 columns">
					<div class="formRow">
						<label for="User_Phone">Phone</label>
						<input type="text" name="User_Phone" value="<?php echo $row['User_Phone']; ?>" size="20" id="User_Phone" />
					</div>
				</div>
			</div>	
				
			<div class="formRow">
				<label for="User_Url" id="lblURL">Your website:</label>
				<input type="text" name="User_Url" value="<?php echo $row['User_Url']; ?>" size="60" id="User_Url" />
			</div>
				
			<div class="formRow">
				<label for="Addr_Line_1" id="lblAddress">Address</label>
				<input type="text" name="Addr_Line_1" value="<?php echo $row['Addr_Line_1']; ?>" size="60" id="Addr_Line_1" />
			</div>
			<div class="formRow">
				<input type="text" name="Addr_Line_2" value="<?php echo $row['Addr_Line_2']; ?>" size="60" id="Addr_Line_2" />
			</div>
			<div class="formRow">
				<label for="City" id="lblAddress">City</label>
				<input type="text" name="City" value="<?php echo $row['City']; ?>" size="60" id="City" />
			</div>
			<div class="formRow">
				<label for="State_Prov_Regn" id="lblAddress">State/Province/Region</label>
				<input type="text" name="State_Prov_Regn" value="<?php echo $row['State_Prov_Regn']; ?>" size="60" id="State_Prov_Regn" />
			</div>
			<div class="formRow">
				<label for="Country" id="lblAddress">Country</label>
				<input type="text" name="Country" value="<?php echo $row['Country']; ?>" size="60" id="Country" />
			</div>
			<div class="formRow">
				<label for="Postal_Code" id="lblAddress">Postal Code</label>
				<input type="text" name="Postal_Code" value="<?php echo $row['Postal_Code']; ?>" size="60" id="Postal_Code" />
			</div>
		
			
			<div class="row">
				<div class="large-6 medium-6 columns">
					<div class="formRow">
						<label for="First_Name">First Name</label>
						<input type="text" id="First_Name" name="First_Name" value="<?php echo $row['First_Name']; ?>" size="60" id="First_Name" />
					</div>
				</div>
				<div class="large-6 medium-6 columns">
					<div class="formRow">
						<label for="Last_Name">Last Name</label>
						<input type="text" id="Last_Name" name="Last_Name" value="<?php echo $row['Last_Name']; ?>" size="60" id="Last_Name" />
					</div>	
				</div>
			</div>	
				
			<div class="formRow">
				<label for="ddlInterests" id="lblInterests">Areas of Interest (hold down ctrl or cmd key to choose as many as apply); <?php if ($row['Areas_of_Interest']) { echo "you previously selected: ". $row['Areas_of_Interest'];}?></label>
				<?php
					$query2=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%UserInterest%' ORDER BY ValueDispOrder ASC");								
					$result2=0;
					$rows_count2=0;									
					$result2 = mysql_query($query2);
					if (!result2) {
						echo "Database query failed";
					}
					else {
						//echo "made connection ".$result."<br />";		
					}
					$rows_count2= mysql_num_rows($result2);
					// echo "Rows Count: ".$rows_count."<br />";
				?>
				<select multiple size="10" name="Areas_of_Interest[]" id="ddlInterests">
					<?php
						for ($i=1; $i<=$rows_count2; $i++) {
							$row2 = mysql_fetch_array($result2);
							echo '<option value="'.$row2["ValueListEntry"].'">'.$row2["ValueListEntry"].'</option>';
						}	
					?>
				</select>
			</div>	
				
			<div class="formRow">
				<label for="" id="lblDealer">Are you a dealer?</label>
				<?php
				if ($row['User_is_Dealer']==1) {
					?>
					<input type="radio" name="User_is_Dealer" value="0" id="dealer1" /><label for="dealer1">No</label>
					<input type="radio" name="User_is_Dealer" value="1" id="dealer2" checked/><label for="dealer2">Yes</label>
				<?php
				} else {
					?>
					<input type="radio" name="User_is_Dealer" value="0" id="dealer1" checked/><label for="dealer1">No</label>
					<input type="radio" name="User_is_Dealer" value="1" id="dealer2" /><label for="dealer2">Yes</label>
					<?php
				}
				?>								
			</div>
				
			<div class="formRow">
				<label for="txtClubs">Matchbox clubs you belong to:</label>
				<textarea id="txtClubs" name="User_Memberships" value="<?php echo $row['User_Memberships']; ?>"cols="45" rows="4"></textarea>
			</div>
			
			<div class="row">
				<div class="large-6 medium-6 columns">
					<div class="formRow">
						<label for="">Preferred Scheme for Vehicle Condition <small>(alpha= MIB, Mint, Exc etc; num= 10, 9.5, 9 etc)</small></label>
						<?php
						if ($row['Veh_Cond_Scheme']==1) {
							?>
							<input type="radio" name="Veh_Cond_Scheme" value="0" id="scheme1" /><label for="scheme1">Alpha</label>
							<input type="radio" name="Veh_Cond_Scheme" value="1" id="scheme2" checked/><label for="scheme2">Num</label>
						<?php
						} else {
							?>
							<input type="radio" name="Veh_Cond_Scheme" value="0" id="scheme1" checked/><label for="scheme1">Alpha</label>
							<input type="radio" name="Veh_Cond_Scheme" value="1" id="scheme2" /><label for="scheme2">Num</label>
							<?php
						}
						?>
					</div>	
				</div>
				<div class="large-6 medium-6 columns">
					<div class="formRow">
						<label for="">Preferred Scheme for Pkg Condition <small>(as above)</small></label>
						<?php
						if ($row['Pkg_Cond_Scheme']==1) {
							?>
							<input type="radio" name="Pkg_Cond_Scheme" value="0" id="condition1" /><label for="condition1">Alpha</label>
							<input type="radio" name="Pkg_Cond_Scheme" value="1" id="condition2" checked/><label for="condition2">Num</label>
						<?php
						} else {
							?>
							<input type="radio" name="Pkg_Cond_Scheme" value="0" id="condition1" checked/><label for="condition1">Alpha</label>
							<input type="radio" name="Pkg_Cond_Scheme" value="1" id="condition2" /><label for="condition2">Num</label>
							<?php
						}
						?>							
					</div>
				</div>
			</div>	
					
				
			<div class="formRow">
				<label for="">Code 2 Preference</label>
				<?php
				if ($row['Code2_Pref']==2) {
					?>
					<input type="radio" name="Code2_Pref" value="0" id="code1" /><label for="code1">Combine Code 1 and Code 2 versions in displays</label><br />
					<input type="radio" name="Code2_Pref" value="1" id="code2" /><label for="code2">Show both Code 1 and Code 2, but separate them</label><br />
					<input type="radio" name="Code2_Pref" value="0" id="code3" checked/><label for="code3">Don't show Code 2 at all</label>
				<?php
				} elseif ($row['Code2_Pref']==1) {
					?>
					<input type="radio" name="Code2_Pref" value="0" id="code1" /><label for="code1">Combine Code 1 and Code 2 versions in displays</label><br />
					<input type="radio" name="Code2_Pref" value="1" id="code2" checked/><label for="code2">Show both Code 1 and Code 2, but separate them</label><br />
					<input type="radio" name="Code2_Pref" value="0" id="code3" /><label for="code3">Don't show Code 2 at all</label>
					<?php
				} else {
					?>
					<input type="radio" name="Code2_Pref" value="0" id="code1" checked/><label for="code1">Combine Code 1 and Code 2 versions in displays</label><br />
					<input type="radio" name="Code2_Pref" value="1" id="code2" /><label for="code2">Show both Code 1 and Code 2, but separate them</label><br />
					<input type="radio" name="Code2_Pref" value="0" id="code3" /><label for="code3">Don't show Code 2 at all</label>
					<?php
				}
				?>	
			</div>

			<input type="submit" class="button dark" name="submit" value="Submit"/>
			<a class="button cancel" href="edit-account-form.php">Cancel</a>
		</form>			
	</div>
</div>

<?php require("includes/footer.php"); ?>
						
			