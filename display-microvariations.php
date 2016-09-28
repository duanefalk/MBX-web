<?php
	session_start();
	$Sec_Lvl=$_SESSION['Sec_Lvl'];
	$Code2_Pref=$_SESSION['Code2_Pref'];
	$pageTitle = "Microvariations";
	$pageDescription = "These are the microvariations for this model.";
	require_once("includes/db_connection.php");
	include("includes/header.php");
	include("includes/functions.php");
?>

<div class="row">
	<div class="large-12 columns">
		<?php
			echo "<a href=\"javascript:history.go(-1)\">Return to Previous Page</a>";
			echo "<br /><br />";

			$Model_for_microvar=$_GET["model"];
			echo "<h3>Microvariations for ".$Model_for_microvar."</h3>";
			echo "<br />";
			$query=("SELECT * FROM Matchbox_Model_Microvariations WHERE UMID='$Model_for_microvar'");
			$result = mysql_query($query);
			if (!$result) {			
				echo "Database Error";
				echo "<br></>";;
			}

			$row=mysql_fetch_array($result);
			echo $row['Microvariations'];
			echo "<br></>";
			$url= "models-detail-ver-listing.php?model=".$Model_for_microvar;
		?>			
	</div>
</div>

<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="Search_Models_Menu.php">Search Models</a>
		<a href="Search_Releases_Menu.php">Search Releases</a>
		<a href="Index.php">Main Page</a>
	</div>
</div>

<?php include("includes/footer.php"); ?>