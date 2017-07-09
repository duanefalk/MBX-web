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
				<em>Hello, <?php echo $_SESSION['First_Name'] ?></em>
				<?php if ($_SESSION['Sec_Lvl'] == 3) { //code 3 = Dad ?>
					<a href='add-menu.php'>Add a New Record</a>
				<?php } ?>
				<a href='website-updates.php'>Website Updates</a>
				<a href='edit-account-form.php'>Edit Account</a>
				<a href='logout.php'>Logout</a>
			<?php } else if ($_SESSION['Sec_Lvl'] == 1) { ?>
				<a href='website-updates.php'>Website Updates</a>
				<a href='verification.php'>Create an Account</a>
				<a href='authenticate-test.php'>Log in</a>
			<?php }	else { ?>
				<a href='website-updates.php'>Website Updates</a>
				<a href='verification.php'>Create an Account</a>
				<a href='authenticate-test.php'>Log in</a>
			<?php }	?>
		</div>
	</div>
</div>