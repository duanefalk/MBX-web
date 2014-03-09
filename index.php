<?php
// we must never forget to start the session
session_start();
?>

<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/navUtility.php"); ?>
<?php include("includes/header.php"); ?>


<div class="row slider">
	<div class="large-12 columns">
		<ul class="bxslider">
			<li><img src="images/banner1.jpg" title="" /></li>
			<li><img src="images/NoRelImageAvail.jpg" title="" /></li>
			<li><img src="images/NoImageAvail.jpg" title="" /></li>
		</ul>
	</div>
</div>


<div class="row">
	<div class="large-6 columns">
		<h2>The Matchbox Professor welcomes you to the MBX University!!</h2>
		<p>This site is for Matchbox collectors and anyone intrrested in Matchbox models</p>
	</div>
	
	<div class="large-6 columns">
		<div id="quick_search">
			<h3>Quick Search</h3>
			<form action="Search_Models_Process.php" method="post">			
				<h5>MAN (FAB) # (i.e. '800'):</h5>
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

