<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>
<table id="structure">
	<tr>
		<td id="navigation">
			<a href="index.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Main Page</p></a>
		</td>
		<td id="page">
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
		
			<style>
				body{
					font: 62.5% "Trebuchet MS", sans-serif;
					/* margin: 50px; */
				}
				.demoHeaders {
					margin-top: 2em;
				}
				#dialog-link {
					padding: .4em 1em .4em 20px;
					text-decoration: none;
					position: relative;
				}
				#dialog-link span.ui-icon {
					margin: 0 5px 0 0;
					position: absolute;
					left: .2em;
					top: 50%;
					margin-top: -8px;
				}
				#icons {
					margin: 0;
					padding: 0;
				}
				#icons li {
					margin: 2px;
					position: relative;
					padding: 4px 0;
					cursor: pointer;
					float: left;
					list-style: none;
				}
				#icons span.ui-icon {
					float: left;
					margin: 0 4px;
				}
				.fakewindowcontain .ui-widget-overlay {
					position: absolute;
				}
			</style>
		</head>
		<body>
			

			<form name="SearchReleases" action="Search_Releases_Process.php" method="post">
				
			<h2 class="demoHeaders">Search by Package Info</h2>
			<p>Choose one or more package identifiers to search with.</p>
				<div id="accordion">
					
					<h3>Package Name, i.e. Construction Playset</h3>
						<div><input type=checkbox name="PkgName_Check"  id= "PkgName_Check" >Package Name<br>
						<input type="text" name="PkgName" id="PkgName" value="" size="40" id="PkgName"</p><br />		
						</div>
			
					<h3>Model Name on Package</h3>
						<div><input type=checkbox name="MdlNameOnPkg_Check"  id="MdlNameOnPkg_Check"   >Model Name on the Package:<br>
						<input type="text" name="MdlNameOnPkg" id="MdlNameOnPkg" value="" size="40" id="MdlNameOnPkg"</p>	
						</div>
						
					<h3>Package ID#</h3>
						<div><input type=checkbox name="PkgID_Check" id="PkgID_Check"  >Package ID#: <br>
						<input type="text" name="PkgID" id="PkgID" value="" size="40" </p>	
						</div>		
				</div>
			<br />	
				
			<h2 class="demoHeaders">Or Browse Release Data</h2>
			<p>Choose one or more criteria to browse with. Please be sure your selection is sufficently specific to</p>
			<p>provide meaningful results (i.e. specifying only 'released in USA' will produce a list too large to be useful.</p>
			<p>Note: These criteria will be ignored if you've selected a search above.</p>
				<div id="accordion2">
					
					<h3>Theme</h3>
						<div><input type=checkbox name="ReleaseTheme_Check" id="ReleaseTheme_Check"  >Release Theme:<br>
						<?php
						$query=("SELECT * FROM Test_Matchbox_Value_Lists WHERE ValueList LIKE '%ReleaseTheme%'");								
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
						<br />		
						</div>
					
					<h3>Series</h3>
						<div><input type=checkbox name="RelSeries_Check" id="RelSeries_Check"  >Series:<br>
						<?php
						$query=("SELECT * FROM Test_Matchbox_Value_Lists WHERE ValueList LIKE '%RelSeries%'");								
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
						<br />
						</div>
			
					<h3>No. in Series</h3>
						<div><input type=checkbox name="SeriesID_Check" id="SeriesID_Check" ># in Series:<br>
						<input type="text" name="SeriesID" id="SeriesID" value="" size="20" id="SeriesID"</p><br />
						</div>
			
					<h3>Release Year</h3>
						<div><input type=checkbox name="RelYr_Check" id="RelYr_Check"  >Release Year:<br>
						<input type="text" name="RelYr" id= "RelYr" value="" size="4" id="RelYr"</p><br />	
						</div>
			
					<h3>Country Where Released</h3>
						<div><input type=checkbox name="CountryOfSale_Check" id="CountryOfSale_Check"  >Country Where Released:<br>
						<?php
						$query=("SELECT * FROM Test_Matchbox_Value_Lists WHERE ValueList LIKE '%CountryOfSale%'");								
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
						<br />	
						</div>
			
				</div>
					<br /><br />
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
		
					<input type="button" name="testcheckbox" id="testcheckbox" value="Check Query" onclick="onCheckQuery()">
						
					<h2>Your Query So Far: </h2>
				<div id="querybox">
					<br />
					</p></p>
					<br />
				</div>
				
				<br /><br />
				<input type="submit"  name="submit" value="OK to Submit"/>
			</form>			
			<a href="Search_Releases_Menu.php">Cancel/Clear</a>
		</body>	
		</td>
	</tr>
</table>
<?php include("includes/footer.php"); ?>