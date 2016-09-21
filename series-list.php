<?php
	ob_start();
	$pageTitle = "List of Release Series";
	$pageDescription = "The Matchbox University lists all of the matchbox car releases";
	require_once("includes/db_connection.php");
	include("includes/header.php");
	include("includes/functions.php");
?>

<div class="row">
	<div class="large-12 columns">
		<h2>List of Release Series</h2>
		<p>Lists the series names used in the database, i.e. 1-75 for regular releases, Multi-packs, Superfast etc.</p>
	</div>
</div>
<div class="row">
	<div class="large-12 columns">
		<?php
			$query="SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE 'RelSeries' ORDER BY ValueDispOrder ASC";
			$result= mysql_query($query);
			echo "<table>";
				echo "<tr>";
					echo "<td><b>Series</b></td>";
				echo "</tr>";
			$rows= mysql_num_rows($result);
			for ($i=1; $i<=$rows; $i++) {
				$row =mysql_fetch_array($result);
				echo "<tr>";
				echo "<td>".$row["ValueListEntry"]."</td>";
				echo "</tr>";
			}
			echo "</table>";
		?>
	</div>
</div>

<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="about-site.php">About the Site</a>
	</div>
</div>

<?php include("includes/footer.php"); ?>