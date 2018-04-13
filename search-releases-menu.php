<?php 
	session_start();
	$pageTitle = "Search Releases";
	$pageDescription = "Search the Matchbox University database, by releases, find any matchbox car you're looking for";
	include("includes/header.php");
	require_once("includes/db_connection.php");
	require_once("includes/functions.php");
?>


<?php
    if (isset($_POST['submit'])) {
	$_SESSION['PkgName_Check']=$_POST['PkgName_Check'];
	$_SESSION['PkgName']=$_POST['PkgName'];
	$_SESSION['MdlNameOnPkg_Check']=$_POST['MdlNameOnPkg_Check'];
	$_SESSION['MdlNameOnPkg']=$_POST['MdlNameOnPkg'];
	$_SESSION['PkgID_Check']=$_POST['PkgID_Check'];
	$_SESSION['PkgID']=$_POST['PkgID'];
	
	$_SESSION['ReleaseTheme_Check']=$_POST['ReleaseTheme_Check'];
	$_SESSION['ReleaseTheme']=$_POST['ReleaseTheme'];
	$_SESSION['RelSeries_Check']=$_POST['RelSeries_Check'];
	$_SESSION['RelSeries']=$_POST['RelSeries'];
	$_SESSION['RelSubSeries_Check']=$_POST['RelSubSeries_Check'];
	$_SESSION['SubSeries']=$_POST['SubSeries'];	
	$_SESSION['SeriesID_Check']=$_POST['SeriesID_Check'];
	$_SESSION['SeriesID']=$_POST['SeriesID'];
	$_SESSION['RelYr_Check']=$_POST['RelYr_Check'];
	$_SESSION['RelYr']=$_POST['RelYr'];
	$_SESSION['CountryOfSale_Check']=$_POST['CountryOfSale_Check'];
	$_SESSION['CountryOfSale']=$_POST['CountryOfSale'];
    
	redirect_to("search-releases-process.php");
    }
?>







<head>
	<script>
		$(function() {
			$( "#accordion" ).accordion();

			// Hover states on the static widgets
			$( "#dialog-link, #icons li" ).hover(
				function() {
					$( this ).addClass( "ui-state-hover" );
				},
				function() {
					$( this ).removeClass( "ui-state-hover" );
				}
			);
		});
		
		$(function() {
			$( "#accordion2" ).accordion();
	
			// Hover states on the static widgets
			$( "#dialog-link, #icons li" ).hover(
				function() {
					$( this ).addClass( "ui-state-hover" );
				},
				function() {
					$( this ).removeClass( "ui-state-hover" );
				}
			);
		});
	</script>
</head>

<form name="SearchReleases" action="search-releases-menu.php" method="post" data-parsley-validate>
<div class="row">
	<div class="large-6 medium-6 columns">
	
		<h2 class="demoHeaders">Search by Package Info</h2>
		<p>Choose one or more package identifiers to search with.</p>

		<div id="accordion">
			<dl class="accordion" data-accordion>
				<dd>	
					<a href="#panela">Package Name, i.e. Construction Playset</a>
					<div id="panela" class="content">
						<input type=checkbox name="PkgName_Check" id="PkgName_Check" />
						<label for="PkgName_Check">Package Name:</label>
						<input type="text" name="PkgName" id="PkgName" value="" size="40" id="PkgName" />		
					</div>
				</dd>
			</dl>
			<dl class="accordion" data-accordion>
				<dd>
					<a href="#panelb">Model Name on Package</a>
					<div id="panelb" class="content">
						<input type=checkbox name="MdlNameOnPkg_Check" id="MdlNameOnPkg_Check" />
						<label for="MdlNameOnPkg_Check">Model Name on the Package:</label>
						<input type="text" name="MdlNameOnPkg" id="MdlNameOnPkg" value="" size="40" id="MdlNameOnPkg" />	
					</div>
				</dd>
			</dl>
			<dl class="accordion" data-accordion>
				<dd>
				<a href="#panelc">Package ID#</a>
				<div id="panelc" class="content">	
					<input type=checkbox name="PkgID_Check" id="PkgID_Check" />
					<label for="PkgID_Check">Package ID#:</label>
					<input type="text" name="PkgID" id="PkgID" value="" size="40" />	
				</div>
				</dd>
			</dl>
		</div>
		
	</div>
	<div class="large-6 medium-6 columns">	
				
		<h2 class="demoHeaders">Or Browse Release Data</h2>
		<p>Choose one or more criteria to browse with. Please be sure your selection is sufficently specific to provide meaningful results (i.e. specifying only 'released in USA' will produce a list too large to be useful. Note: These criteria will be ignored if you've selected a search above.</p>
		
		<div id="accordion2">
			<dl class="accordion" data-accordion>
				<dd>	
					<a href="#panel1">Theme</a>
					<div id="panel1" class="content">
						<input type=checkbox name="ReleaseTheme_Check" id="ReleaseTheme_Check" />
						<label for="ReleaseTheme_Check">Release Theme:</label>
						<?php
							$query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%ReleaseTheme%'");								
							$result=0;
							$rows_count=0;									
							$result = mysql_query($query);
							if (!result) {
								echo "Database query failed";
							}
							else {
								//echo "made connection ".$result."<br />";		
							}
							$rows_count= mysql_num_rows($result);
							// echo "Rows Count: ".$rows_count."<br />";
							?>
							<select name="ReleaseTheme" id="ReleaseTheme">
							<?php
								for ($i=1; $i<=$rows_count; $i++) {
									$row=mysql_fetch_array($result);
									echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
								}	
							?>
						</select>		
					</div>
				</dd>
			</dl>
				
			<dl class="accordion" data-accordion>
				<dd>	
					<a href="#panel2">Series</a>
					<div id="panel2" class="content">
						<input type=checkbox name="RelSeries_Check" id="RelSeries_Check"  />
						<label for="RelSeries_Check">Series:</label>
						<?php
							$query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%RelSeries%' ORDER BY ValueDispOrder ASC");									
							$result=0;
							$rows_count=0;									
							$result = mysql_query($query);
							if (!result) {
								echo "Database query failed";
							}
							else {
								//echo "made connection ".$result."<br />";		
							}
							$rows_count= mysql_num_rows($result);
							// echo "Rows Count: ".$rows_count."<br />";
							?>
							<select name="RelSeries" id="RelSeries">
							<?php
								for ($i=1; $i<=$rows_count; $i++) {
									$row=mysql_fetch_array($result);
									echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
								}	
							?>
						</select>		
					</div>
				</dd>
			</dl>

			<dl class="accordion" data-accordion>
				<dd>	
					<a href="#panel3">SubSeries</a>
					<div id="panel3" class="content">
						<input type=checkbox name="RelSubSeries_Check" id="RelSubSeries_Check" />
						<label for="RelSubSeries_Check">SubSeries:</label>
						<input type="text" name="SubSeries" id="SubSeries" value="" size="20" id="SubSeries" />										
					</div>
				</dd>
			</dl>			

			<dl class="accordion" data-accordion>
				<dd>	
					<a href="#panel4">No. in Series</a>
					<div id="panel4" class="content">
						<input type=checkbox name="SeriesID_Check" id="SeriesID_Check" />
						<label for="SeriesID_Check"># in Series:</label>
						<input type="text" name="SeriesID" id="SeriesID" value="" size="20" id="SeriesID" />										
					</div>
				</dd>
			</dl>			

			<dl class="accordion" data-accordion>
				<dd>	
					<a href="#panel5">Release Year </a>
					<div id="panel5" class="content">
						<input type=checkbox name="RelYr_Check" id="RelYr_Check" />
						<label for="RelYr_Check">Release Yr (yyyy):</label>
						<input type="text" name="RelYr" value="" size="4" id="RelYr" data-parsley-minlength="4" data-parsley-maxlength="4" data-parsley-type="integer">										
					</div>
				</dd>
			</dl>			

			<dl class="accordion" data-accordion>
				<dd>	
					<a href="#panel6">Country of Release</a>
					<div id="panel6" class="content">
						<input type=checkbox name="CountryOfSale_Check" id="CountryOfSale_Check"  />
						<label for="CountryOfSale_Check">Country Where Released:</label>
						<?php
							$query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%CountryOfSale%'");									
							$result=0;
							$rows_count=0;									
							$result = mysql_query($query);
							if (!result) {
								echo "Database query failed";
							}
							else {
								//echo "made connection ".$result."<br />";		
							}
							$rows_count= mysql_num_rows($result);
							// echo "Rows Count: ".$rows_count."<br />";
							?>
							<select name="CountryOfSale" id="CountryOfSale">
							<?php
								for ($i=1; $i<=$rows_count; $i++) {
									$row=mysql_fetch_array($result);
									echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option>';
								}	
							?>
						</select>		
					</div>
				</dd>
			</dl>						
		
		</div>
	</div>
	
</div>

<div class="row">
	
	<div class="large-12 columns">
		
		<input type="button" name="testcheckbox" class="button dark" id="testcheckbox" value="Check Query" onclick="onCheckQuery()">
		
		<h5>Your Query So Far:</h5>
		<div id="querybox"></div>
		
		<div class="row">
			<div class="large-2 small-6 columns">
				<input type="submit" class="button dark" name="submit" value="Submit"/>
			</div>
			<div class="large-2 small-6 columns end">
				<a class="button cancel" href="search-releases-menu.php">Clear</a>
			</div>
		</div>
			
	</div>
</div>	
</form>		
				
			
<script>
	var stringBuilt = false;					
	function onCheckQuery() {
		var browseString = document.getElementById("querybox");
		
		if (stringBuilt) {
			browseString.innerHTML = "";
			//browseString.appendChild(document.createElement("br"));
			//browseString.appendChild(document.createElement("br"));
			//browseString.appendChild(document.createElement("br"));
		}					
		
		if (document.getElementById("ReleaseTheme_Check").checked) {
			browseString.innerHTML = browseString.innerHTML + "<p>THEME: <strong>" + document.getElementById("ReleaseTheme").value + "</strong></p>";
			stringBuilt = true;
		}
		if (document.getElementById("RelSeries_Check").checked) {
			browseString.innerHTML = browseString.innerHTML + "<p>SERIES: <strong>" + document.getElementById("RelSeries").value + "</strong></p>";
			stringBuilt = true;
		}
		if (document.getElementById("RelSubSeries_Check").checked) {
			browseString.innerHTML = browseString.innerHTML + "<p>SUBSERIES: <strong>" + document.getElementById("SubSeries").value + "</strong></p>";
			stringBuilt = true;
		}	
		if (document.getElementById("SeriesID_Check").checked) {
			browseString.innerHTML = browseString.innerHTML + "<p>SERIES ID: <strong>" + document.getElementById("SeriesID").value + "</strong></p>";
			stringBuilt = true;
		}
		if (document.getElementById("RelYr_Check").checked) {
			browseString.innerHTML = browseString.innerHTML + "<p>REL YR: <strong>" + document.getElementById("RelYr").value + "</strong></p>";
			stringBuilt = true;
		}	
		if (document.getElementById("CountryOfSale_Check").checked) {
			browseString.innerHTML = browseString.innerHTML + "<p>SOLD IN: <strong>" + document.getElementById("CountryOfSale").value + "</strong></p>";
			stringBuilt = true;
		}	
		if (document.getElementById("PkgName_Check").checked) {
			browseString.innerHTML = browseString.innerHTML + "<p>PKG NAME: <strong>" + document.getElementById("PkgName").value + "</strong></p>";
			stringBuilt = true;
		}	
		if (document.getElementById("MdlNameOnPkg_Check").checked) {
			browseString.innerHTML = browseString.innerHTML + "<p>MDL NAME ON PKG: <strong>" + document.getElementById("MdlNameOnPkg").value + "</strong></p>";
			stringBuilt = true;
		}								
		if (document.getElementById("PkgID_Check").checked) {
			browseString.innerHTML = browseString.innerHTML + "<p>PKG ID: <strong>" + document.getElementById("PkgID").value + "</strong></p>";
			stringBuilt = true;
		}
	}
				
</script>
			
<?php include("includes/footer.php"); ?>