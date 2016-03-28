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
			<?php if ($_SESSION['Sec_Lvl'] > 1) { ?>
				<em>Hello, <?php $_SESSION['First_Name'] ?></em>
				<?php if ($_SESSION['Sec_Lvl'] == 3) { //code 3 = Dad ?>
					<a href='Add_Menu.php'>Add a New Record</a>
				<?php } ?>
				<a href='Edit_Account_Form.php'>Edit Account</a>
				<a href='logout.php'>Logout</a>
			<?php } else if ($_SESSION['Sec_Lvl'] == 1) { ?>
				<a href='website-updates.php'>Website Updates</a>
				<a href='Verification.php'>Create an Account</a>
				<a href='Authenticate-test.php'>Go to Login</a>
			<?php }	else { ?>
				<a href='website-updates.php'>Website Updates</a>
				<a href='Verification.php'>Create an Account</a>
				<a href='Authenticate-test.php'>Login</a>
			<?php }	?>
		</div>
	</div>
</div>