<?php 
	ob_start(); 
	$pageTitle = "Wheel Types";	
	require_once("includes/db_connection.php");
	include("includes/header.php");
	include("includes/functions.php");	
?>

<div class="row">
	<div class="large-12 columns">
		<h2>Wheel Types</h2>
		<p>Photo, code name and description of each wheel type used in the database. Codes based on Christian Falkensteiner's naming scheme, following the general format:</p>
		<h4>X-WWTT(RR)HH-NCC</h4>
		<ul>
			<li>X is an abbreviated code describing the style of the tire, i.e. dd10 for dot-dash 10 'spokes'.</li>
			<li>WW indicates a white-wall on the tire</li>
			<li>TT stands for color of the tire itself, i.e. bk for black</li>
			<li>RR) is optional if the rim of the wheel is a different color</li>
			<li>HH is the color of the hub of the wheel, most commonly sv for silver, bk for black or wh for white</li>
			<li>N is included if a brand name is printed on the tire, ie. GYE for Goodyear Eagles</li>
			<li>CC is the color of the printing- typically wh for white or yl for yellow</li>
		</ul>
		<p>Examples are:</p>
		<ul>
			<li><strong>spl5-bksv</strong> for split 5 spoke style with a black tire and silver hub</li>
			<li><strong>pcss5-bkgd-GYEwh</strong> for a &#39;pc&#39; or premium rubber wheel, 5 spoke spiral hub, black tire, gold hub with Goodyear Eagle printed in white</li>
			<li><strong>co8r-bkgdbk</strong> is one of the newest style- concave 8 spoke with a ring around them; black tire, gold ring (rin) and black hub</li>
		</ul>	
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
				echo "<ul class='large-block-grid-5 small-block-grid-3'>";
				
				for ($i=1; $i<=$rows; $i++) {
					echo "<li class=\"carGrid\">";
						$row = mysql_fetch_array($result);
						
						
						$wheelphoto = WHEEL_URL . $row["WheelCod"] . ".jpg";
						$wheel_loc = WHEEL_PATH . $row["WheelCod"] . ".jpg";
						if ( file_exists($wheel_loc) ) {
							//echo "picture exists";
							echo "<a href=\"" . $url . "\">"."<img src=" . $wheelphoto . " width='160' /></a>";
						} else {
							//echo "cant find picture";
							//echo DEFAULT_IMAGE;
							echo "<a href=\"" . $url . "\">"."<img src=" . DEFAULT_WHEEL_IMAGE . " width='160' /></a>";
						}

						echo "<p><strong>".$row["WheelCod"]."</strong></p>";
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