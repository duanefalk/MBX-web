<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

<?php include("includes/header.php"); ?>

<head>
	<link href="css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet">
	<script src="js/jquery-1.9.1.js"></script>
	<script src="js/jquery-ui-1.10.3.custom.js"></script>

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

<form name="SearchReleases" action="Search_Releases_Process.php" method="post">

<div class="row">
	
	<div class="large-12 columns">
	
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
					<a href="#panel3">No. in Series</a>
					<div id="panel3" class="content">
						<input type=checkbox name="SeriesID_Check" id="SeriesID_Check" />
						<label for="SeriesID_Check"># in Series:</label>
						<input type="text" name="SeriesID" id="SeriesID" value="" size="20" id="SeriesID" />										
					</div>
				</dd>
			</dl>			

			<dl class="accordion" data-accordion>
				<dd>	
					<a href="#panel4">Release Year</a>
					<div id="panel4" class="content">
						<input type=checkbox name="RelYr_Check" id="RelYr_Check" />
						<label for="RelYr_Check">Release Yr:</label>
						<input type="text" name="RelYr" id= "RelYr" value="" size="4" id="RelYr" />										
					</div>
				</dd>
			</dl>			

			<dl class="accordion" data-accordion>
				<dd>	
					<a href="#panel5">Country of Release</a>
					<div id="panel5" class="content">
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
									echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
								}	
							?>
						</select>		
					</div>
				</dd>
			</dl>						
		
		</div>
		
		<input type="button" name="testcheckbox" class="button dark" id="testcheckbox" value="Check Query" onclick="onCheckQuery()">
					
		<h2>Your Query So Far:</h2>
		<div id="querybox">
			<br />
			<p></p>
			<br />
		</div>
		
		<input type="submit" class="button dark" name="submit" value="Submit"/>
			
		<a href="Search_Releases_Menu.php">Cancel/Clear</a>
			
			
	</div>

</div>
			
</form>			
				
			
			<script>
				var stringBuilt=false;					
				function onCheckQuery() {
					var browseString=document.getElementById("querybox");
					if (stringBuilt) {
						browseString.innerHTML="";
						browseString.appendChild(document.createElement("br"));
						browseString.appendChild(document.createElement("br"));
						browseString.appendChild(document.createElement("br"));
					}					
					
					if (document.getElementById("ReleaseTheme_Check").checked) {
					//	browseString.innerHTML=browseString.innerHTML+"replaced by next";	
					
					//	$("browseString.innerHTML").append("Appended text")
					//	var vMake= "Veh Make= "+document.getElementById("VehicleMake").value+" ";
						browseString.innerHTML=browseString.innerHTML+"THEME= "+document.getElementById("ReleaseTheme").value+"  ";
						stringBuilt=true;
					}
					if (document.getElementById("RelSeries_Check").checked) {
					//	browseString.innerHTML=browseString.innerHTML+"replaced by next";	
					
					//	$("browseString.innerHTML").append("Appended text")
					//	var vMake= "Veh Make= "+document.getElementById("VehicleMake").value+" ";
						browseString.innerHTML=browseString.innerHTML+"SERIES= "+document.getElementById("RelSeries").value+"  ";
						stringBuilt=true;
					}
					if (document.getElementById("SeriesID_Check").checked) {
					//	browseString.innerHTML=browseString.innerHTML+"replaced by next";	
					
					//	$("browseString.innerHTML").append("Appended text")
					//	var vMake= "Veh Make= "+document.getElementById("VehicleMake").value+" ";
						browseString.innerHTML=browseString.innerHTML+"SERIES ID= "+document.getElementById("SeriesID").value+"  ";
						stringBuilt=true;
					}
					if (document.getElementById("RelYr_Check").checked) {
					//	browseString.innerHTML=browseString.innerHTML+"replaced by next";	
					
					//	$("browseString.innerHTML").append("Appended text")
					//	var vMake= "Veh Make= "+document.getElementById("VehicleMake").value+" ";
						browseString.innerHTML=browseString.innerHTML+"REL YR= "+document.getElementById("RelYr").value+"  ";
						stringBuilt=true;
					}	
					if (document.getElementById("CountryOfSale_Check").checked) {
					//	browseString.innerHTML=browseString.innerHTML+"replaced by next";	
					
					//	$("browseString.innerHTML").append("Appended text")
					//	var vMake= "Veh Make= "+document.getElementById("VehicleMake").value+" ";
						browseString.innerHTML=browseString.innerHTML+"SOLD IN= "+document.getElementById("CountryOfSale").value+"  ";
						stringBuilt=true;
					}	
					if (document.getElementById("PkgName_Check").checked) {
					//	browseString.innerHTML=browseString.innerHTML+"replaced by next";	
					
					//	$("browseString.innerHTML").append("Appended text")
					//	var vMake= "Veh Make= "+document.getElementById("VehicleMake").value+" ";
						browseString.innerHTML=browseString.innerHTML+"PKG NAME= "+document.getElementById("PkgName").value+"  ";
						stringBuilt=true;
					}	
					if (document.getElementById("MdlNameOnPkg_Check").checked) {
					//	browseString.innerHTML=browseString.innerHTML+"replaced by next";	
					
					//	$("browseString.innerHTML").append("Appended text")
					//	var vMake= "Veh Make= "+document.getElementById("VehicleMake").value+" ";
						browseString.innerHTML=browseString.innerHTML+"MDL NAME ON PKG= "+document.getElementById("MdlNameOnPkg").value+"  ";
						stringBuilt=true;
					}								
					if (document.getElementById("PkgID_Check").checked) {
					//	browseString.innerHTML=browseString.innerHTML+"replaced by next";	
					
					//	$("browseString.innerHTML").append("Appended text")
					//	var vMake= "Veh Make= "+document.getElementById("VehicleMake").value+" ";
						browseString.innerHTML=browseString.innerHTML+"PKG ID= "+document.getElementById("PkgID").value+"  ";
						stringBuilt=true;
					}		

					//browseString.innerHTML=vTyp+vMake;
				}
							
			</script>
		
					

			
<?php include("includes/footer.php"); ?>