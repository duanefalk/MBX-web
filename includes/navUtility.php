<div id="utilityNav">
	<div id="warningLocal">
		<div class="row">
			<div class="large-12 columns">
				<p>Achtung! This is your <em>local</em> version of MBX</p>
			</div>
		</div>
	</div>	
	<div class="row">
		<div class="large-12 columns">
			<?php			
				if ($_SESSION['Sec_Lvl'] > 1) {
					echo "<em>Hello, " . $_SESSION['First_Name'] . "</em>";
					
					//code 3 = Dad
					if ($_SESSION['Sec_Lvl'] == 3) {
						echo "<a href='Add_Menu.php'>Add a New Record</a>";						
					}
					
					echo "<a href='website-updates.php'>Website Updates</a>";
					echo "<a href='Edit_Account_Form.php'>Edit Account</a>";
					echo "<a href='logout.php'>Logout</a>";
				} else {
					echo "<a href='Create_User_Account_Form.php'>Create an Account</a>";
					echo "<a href='Authenticate-test.php'>Login</a>";			
				}		
			?>
		</div>
	</div>
</div>