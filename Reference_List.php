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

			echo "<h5>Reference Name      Reference Type      Details    Comments</h5>";
			
			$rows= mysql_num_rows($result);
			for ($i=1; $i<=$rows; $i++) {
				$row =mysql_fetch_array($result);
				echo "<p>".$row["RefName"]." ".$row["RefType"]." ".$row["RefDetails"]." ".$row["RefComment"]."</>";
			}	
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
