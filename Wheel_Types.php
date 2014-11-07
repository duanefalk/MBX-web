<?php ob_start(); ?>
<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>

<div class="row">
	<div class="large-12 columns">
		<h2>Wheel Types</h2>
		<p>Photo, code name and description of each wheel type used in the database. Codes based on Christian Falkensteiner's naming scheme, following the general format:</p>
		<p>X-WWTT(RR)HH-NCC</p>
		<p>Where:</p>
		<p>X is an abbreviated code describing the style of the tire, i.e. dd10 for dot-dash 10 'spokes'.</p>
		<p>&#39;WW&#39; indicates a white-wall on the tire</p>
		<p>TT stands for color of the tire itself, i.e. bk for black</p>
		<p>(RR) is optional if the rim of the wheel is a different color</p>
		<p>HH is the color of the hub of the wheel, most commonly sv for silver, bk for black or wh for white</p>
		<p>N is included if a brand name is printed on the tire, ie. GYE for Goodyear Eagles</p>
		<p>CC is the color of the printing- typically wh for white or yl for yellow</p>
		<br></>
		<p>Examples are:</p>
		<p>spl5-bksv for split 5 spoke style with a black tire and silver hub</p>
		<p>pcss5-bkgd-GYEwh for a &#39;pc&#39; or premium.rubber wheel, 5 spoke spiral hub, black tire, gold hub with Goodyear Eagle printed in white</p>
		<p>co8r-bkgdbk is one of the newest style- concave 8 spoke with a ring around them; black tire, gold ring (rin) and black hub</p>
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
						echo "<p><img src=" . $wheelphoto . " width=100></p>"; 
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