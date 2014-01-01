<?php
// we must never forget to start the session
session_start();
?>

<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php
	if ($_SESSION['Sec_Lvl'] == 3) {
		$security= $_SESSION['$Sec_Lvl'];		
		echo "Admin level";

	}
?>

<table id="structure">
<tr>
	<td id="navigation">

	<a href="About_site.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">About the Site</p></a>
	<a href="Search_Models_Menu.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Search Models</p></a>
	<a href="Search_Releases_Menu.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Search Releases</p></a>
	<a href="Collections_Menu.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'"> Create/Manage Your Collections</p></a>
	<a href="Create_User_Account_Form.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'"> Account</p></a>
	<a href="Add_Menu.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'"> Add a New Record</p></a>
	<a href="User_Upload.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'"> Upload Photo or Comments</p></a>
	<a href="logout.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Logout</p</a>
	</td>
	<td id="page">
		<h2>The Matchbox Professor Welcomes you to the MBX University!!</h2>
		<h3>Be Sure to Root for our team: the Hard-Driving
		Revin' Rebels</h3>
		<p>This site is for Matchbox collectors and anyone intrrested in Matchbox models</p>
		
		<div id="quick_search" >
		<br /><br />		
		<h3>Quick Search</h3>
		<form action="Search_Models_Process.php" method="post">			
		<h5>MAN (FAB) # (i.e. '800'):</h5>
		<input type="text" name="MAN_No_1" value="" id="MAN_No_1">
					
		<input type="submit"  name="submit" value="Search"/>
		<br />
		<a href="Main_page.php">Cancel</a>	
						
	</td>
</tr>
<tr>
	
</tr>
</table>



<?php require("includes/footer.php"); ?>

