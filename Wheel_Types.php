<?php ob_start(); ?>
<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>

<div class="row">
	<div class="large-12 columns">
		<h2>Wheel Types</h2>
		<p>Photo, code name and description of each wheel type used in the database.</p>
	</div>
</div>
<div class="row">
	<div class="large-12 columns">
		<?php
			$query="SELECT * FROM Matchbox_Wheels ORDER BY WheelCod ASC";
			$result=0;
			$rows=0;
			$result = mysql_query($query);
			$rows= mysql_num_rows($result);
			
			echo "<h5>"."Wheel Versions found: ".$rows."</h5>";
			
			if(!$result) {
				echo "<p><strong>No matching results found</strong></p>"; //mysql_error();
				exit;
			}
			else {
				echo "<ul class='large-block-grid-3'>";
				
				for ($i=1; $i<=$rows; $i++) {
					echo "<li class=\"carGrid\">";
						$row = mysql_fetch_array($result);
						$wheelphoto = WHEEL_URL . $row["WheelCod"] . ".jpg";
						echo "<p><img src=" . $wheelphoto . "/></p>"; 
						echo "<p>".$row["WheelCod"]."</p>";
						echo "<p>".$row["WheelTyp"]."</p>";
						echo "<p>".$row["WheelDescr"]."</p>";
					echo "</li>";
				}
				
				echo "</ul>";
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