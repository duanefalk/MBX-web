<?php 
	ob_start();
	require_once("includes/db_connection.php");
	$pageTitle = "Links &amp; References";
	$pageDescription = "Credits to the many friends of Matchbox University who contribute their photos to our database.";
	include("includes/header.php");
	include("includes/functions.php"); 
?>
	
<div class="row">
	<div class="large-12 columns">
		<h2>Links & Photo References</h2>
					
        <p>My goal for this site is to present as comprehensive a listing as possible of Matchbox miniature models and variations. Photos of the models are, of course, a key part of such a listing.</p>
        <p>Whenever possible I have used photos from my own collection. My collection is nowhere near as extensive as many collectors&#39 however, and there are many rare or unusual variations that I don&#39t yet have and, truly, may never see. As a result, and as is the common case with many of the extensive Matchbox web sites, I&#39ve relied on other sources for pictures of many of the models.</p>
        <p>In all cases I attribute the photo to its source, whether my own collection (listed as MBX-u) or others. Under each photo is a reference field showing the source of the photo. A list of popular sites (with clickable urls when appropriate) and the most frequently used sources is shown below. There are some images that are of uncertain origin, which I list as 'OTHER'. And since the same photo is often used across multiple Matchbox sites, it&#39s sometimes hard to tell where it&#39s from originally. I&#39ve done my best to determine that, but certainly have some of them wrong. So, if you see any photos that you know are not referenced correctly, please drop me a note with the correct information and I will fix them.</p>
        <p>I am still in the process of photographing my collection, and will replace  photos from other sources with my own as that proceeds. I will do the same as I acquire new models.</p>
        <p>This is a totally non-commercial site so the images are used for informational purposes only.</p>
        <p>In the same spirit, my photos (those marked as source &#39MBX-u&#39) can be copied and saved, and I have no issue with them being used by other Matchbox collectors. I would ask only that you reference this site as the source.</p>
		<p>Regarding my approach to my photos- my goal was to show the details of the model as clearly as possible. You&#39ll find there are 2 views at the version level (from front/ left and back/right), and 2 views for each variation (side/top and base). I&#39ve tried to show the distinguishing characteristics among versions and variations (e.g. different info on the base of the model). </p>
	</div>
</div>

<div class="row">
	<div class="large-12 columns">
		<?php
			$query="SELECT * FROM Matchbox_References ORDER BY RefName ASC";
			$result= mysql_query($query);
			echo "<table>";
			echo "<thead>";
				echo "<th><strong>Reference Name</strong></th>";
				echo "<th><strong>Reference Type</strong></th>";
				echo "<th><strong>Details</strong></th>";
				echo "<th><strong>Comments</strong></th>";
			echo "</thead>";

			$rows= mysql_num_rows($result);
			for ($i=1; $i<=$rows; $i++) {
				$row =mysql_fetch_array($result);
				echo "<tr>";
					echo "<td><strong>".$row["RefName"]."</strong></td>";					
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
		<a href="about-site.php">About the Site</a>
		<a href="db-explain.php">About the Database</a>
		<a href="mb-code-system.php">The Code System</a>
		<a href="ref-files.php">Reference Files</a>
		<a href="dedication.php">Dedication</a>
	</div>
</div>
 
<?php include("includes/footer.php"); ?>
