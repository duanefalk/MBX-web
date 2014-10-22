<?php ob_start(); ?>
<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>

<div class="row">
	<div class="large-12 columns">
		<h2>Photo Reference List & Links</h2>
		<p>Information about the sources for photos and good Matchbox links.</p>
	</div>
</div>
<div class="row">
	<div class="large-12 columns">
		<?php
			$query="SELECT * FROM Matchbox_References";
			$result= mysql_query($query);
			echo "<table>";
			echo "<tr>";
				echo "<td><b>Reference Name</b></td>";
				echo "<td><b>Reference Type</b></td>";
				echo "<td><b>Details</b></td>";
				echo "<td><b>Comments</b></td>";
			echo "</tr>";
			

			$rows= mysql_num_rows($result);
			for ($i=1; $i<=$rows; $i++) {
				$row =mysql_fetch_array($result);
				echo "<tr>";
					echo "<td><b>".$row["RefName"]."</b></td>";					
					echo "<td>".$row["RefType"]."</td>";
					if ($row["RefType"] == "Web Site") {
						echo "<td><a target='_blank' href='" . $row["RefDetails"] . "'>" . $row["RefDetails"] . "</a></td>";
					}
					else {
						echo "<td>".$row["RefDetails"]."</td>";
					}					
					echo "<td>".$row["RefComment"]."</td>";
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
		<a href="About_site.php">About the Site</a>
	</div>
</div>

<?php include("includes/footer.php"); ?>
