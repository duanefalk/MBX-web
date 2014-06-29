<?php
// we must never forget to start the session
session_start();
?>

<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header-home.php"); ?>


<!--div class="row slider">
	<div class="large-12 columns">
		<ul class="bxslider">
			<li><img src="images/banner1.jpg" title="" /></li>
			<li><img src="images/NoRelImageAvail.jpg" title="" /></li>
			<li><img src="images/NoImageAvail.jpg" title="" /></li>
		</ul>
	</div>
</div-->


<div class="row">
	<div class="large-5 columns">
		<h4>The Matchbox Professor welcomes you to the MBX University!!</h4>
		<p>This site is for Matchbox collectors and anyone interested in Matchbox models. Do a quick lookup of a model using the MAN# (box to the right), or check out the more extensive search abilities in 'Search Models' and 'Search Releases' above.</p>

	</div>
	
	<div class="large-7 columns">
		<div id="quick_search">
			<h3>Quick Search</h3>
			<form action="Search_Models_Process.php" method="post">			
				<label for="MAN_No_1">MAN (FAB) # (i.e. '800'):</label>
				<input type="text" name="MAN_No_1" value="" id="MAN_No_1">
				<input type="submit" class="button" name="submit" value="Search"/>
			</form>
		</div>
	</div>
</div>

	<!--td id="navigation">
		<a href="About_site.php">About the Site</a>
		<a href="Search_Models_Menu.php">Search Models</a>
		<a href="Search_Releases_Menu.php">Search Releases</a>
		<?php
			if ($_SESSION['Sec_Lvl'] > 1) {
				echo "<a href=\"Collections_Menu.php\">Create/Manage Your Collections</a>";						
			}						
		?>	
	
		<a href="Create_User_Account_Form.php"> Account</a>
		<a href="User_Upload.php"> Upload Photo or Comments</a>
	
		<?php
			if ($_SESSION['Sec_Lvl'] == 3) {
				echo "<a href=\"Add_Menu.php\">Add a New Record</a>";						
			}						
		?>							
		
		<a href="logout.php">Logout</p</a>
	</td-->


<?php require("includes/footer.php"); ?>

