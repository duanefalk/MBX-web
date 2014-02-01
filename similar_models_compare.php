<?php include("includes/header.php"); ?>
<table id="structure">
	<tr>
		<td id="navigation">
			<a href="index.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Main Page</p></a>
			<a href="Search_Models_Menu.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Search Models</p></a>
		</td>
		<td id="page">
			<h2>Differences Among Similar Models</h2>
			<p>Many of the Matchbox models, at first glance, appear to be the same. In many cases, however, the differences are significant enough to list them as distinct models and, once you are aware of them, are easy to spot.</p>
			<p>Listed below are those models that types of models. Click on the group that you would like to examine further and the specific differences will be described.</p>
			
			<?php
				$picture1= "Images/Similar_Models/Ford-GT.jpg";
				$url1= "Similar_Ford_GT.php";
				echo "<a href=\"".$url1."\">"."<img src=".$picture1." width=\"240\"></a>";
				echo "<br />";
				echo "Ford GTs MB634 & 671<br />";
				
				$picture1= "Images/Similar_Models/TBirds.jpg";
				$url1= "Similar_TBirds.php";
				echo "<a href=\"".$url1."\">"."<img src=".$picture1." width=\"240\"></a>";
				echo "<br />";
				echo "Ford T-Birds MB212, 268 & WRP02<br />";
			?>
		</td>
	</tr>
</table>
<?php include("includes/footer.php"); ?>