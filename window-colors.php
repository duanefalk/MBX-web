<?php 
	ob_start();
	$pageTitle = "Window Colors";
	$pageDescription = "View the common window colors used in Matchbox cars.";
	require_once("includes/db_connection.php");
	include("includes/header.php");
	include("includes/functions.php");
?>

<div class="row">
	<div class="large-12 columns">
		<h2>Window Colors</h2>
		<p>Photo and of some of the more common window colors used for Matchbox vehicles. Window colors are listed in the bdatabase with 2 characteristics: color and transparency, i.e. 'colorless/clear' is the typical clear window that you can see through.</p>
	</div>
</div>
<div class="row">
	<div class="large-12 columns">
		<h4>Transparency</h4>
	</div>
</div>

<div class="row">
	<div class="large-3 columns text-center">
		<h5>Clear</h5>
		<p><img src="images/ref_images/clear.jpg" width="120"></p>
	</div>
	
	<div class="large-3 columns text-center">
		<h5>Clouded</h5>
		<p><img src="images/ref_images/clouded.jpg" width="120"></p>
	</div>
	
	<div class="large-3 columns start text-center">
		<h5>Opaque</h5>
		<p><img src="images/ref_images/opaque.jpg" width="120"></p>
	</div>	
</div>


<div class="row">
	<div class="large-12 columns">		
		<h4>Common Colors</h4>
		<p>Most of these can appear in clear, clouded or opaque variations. White can be cloudy or opaque and the last two (black, chrome) are always opaque. Some color variations are very similar, such as pink & purple, green-blue & green. Hold the model up so light is shining through the windows to help distinguish the color.</p>
	</div>
</div>

<div class="row">
	<div class="large-3 columns text-center">
		<h5>Colorless</h5>
		<p><img src="images/ref_images/colorless.jpg" width="120"></p>
	</div>	
	<div class="large-3 columns text-center">
		<h5>Smoke</h5>
		<p><img src="images/ref_images/smoke.jpg" width="120"></p>
	</div>	
	<div class="large-3 columns text-center">
		<h5>Amber</h5>
		<p><img src="images/ref_images/amber.jpg" width="120"></p>
	</div>
	<div class="large-3 columns text-center">
		<h5>Yellow</h5>
		<p><img src="images/ref_images/yellow.jpg" width="120"></p>
	</div>	
</div>

<div class="row">
	<div class="large-3 columns text-center">
		<h5>Orange</h5>
		<p><img src="images/ref_images/orange.jpg" width="120"></p>
	</div>	
	<div class="large-3 columns text-center">
		<h5>Blue</h5>
		<p><img src="images/ref_images/blue.jpg" width="120"></p>
	</div>
	<div class="large-3 columns text-center">
		<h5>Blue-Green</h5>
		<p><img src="images/ref_images/blue-green.jpg" width="120"></p>
	</div>	
	<div class="large-3 columns text-center">
		<h5>Green</h5>
		<p><img src="images/ref_images/green.jpg" width="120"></p>
	</div>	
</div>

<div class="row">
	<div class="large-3 columns text-center">
		<h5>Yellow-Green</h5>
		<p><img src="images/ref_images/yellow-green.jpg" width="120"></p>
	</div>
	<div class="large-3 columns text-center">
		<h5>Red</h5>
		<p><img src="images/ref_images/red.jpg" width="120"></p>
	</div>	
	<div class="large-3 columns text-center">
		<h5>Pink</h5>
		<p><img src="images/ref_images/pink.jpg" width="120"></p>
	</div>
	<div class="large-3 columns text-center">
		<h5>Purple</h5>
		<p><img src="images/ref_images/purple.jpg" width="120"></p>
	</div>
</div>

<div class="row">
	<div class="large-3 columns text-center">
		<h5>White</h5>
		<p><img src="images/ref_images/white.jpg" width="120"></p>
	</div>	
	<div class="large-3 columns text-center">
		<h5>Black</h5>
		<p><img src="images/ref_images/black.jpg" width="120"></p>
	</div>	
	<div class="large-3 columns start text-center">
		<h5>Chrome</h5>
		<p><img src="images/ref_images/chrome.jpg" width="120"></p>
	</div>
	<div class="large-3 columns start text-center">
		<h5>Silver/Grey</h5>
		<p><img src="images/ref_images/silver.jpg" width="120"></p>
	</div>	
</div>

<div class="row">
	<div class="large-3 columns text-center">
		<h5>Cream</h5>
		<p><img src="images/ref_images/cream.jpg" width="120"></p>
	</div>
	<div class="large-3 columns text-center">
		<h5>Charcoal</h5>
		<p><img src="images/ref_images/charcoal.jpg" width="120"></p>
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