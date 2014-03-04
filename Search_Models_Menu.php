<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>
<table id="structure">
	<tr>
		<td id="navigation">
			<a href="index.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Main Page</p></a>
			<a href="similar_models_compare.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Differences Among Similar Models</p></a>
			<a href="model_search_help.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Tips on Searching for Models</p></a>

			
		</td>
		<td id="page">
		
		
			<head>
				<link href="css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet">
				<script src="js/jquery-1.9.1.js"></script>
				<script src="js/jquery-ui-1.10.3.custom.js"></script>
			
				<script>
				$(function() {
			
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
						/*margin: 50px;*/
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
				<form action="Search_Models_Process.php" method="post">
					
				<h2 class="demoHeaders">Choose the ID You Want to Search by<br /> <h3>Search will use only last data entered; if you get unexpected results, click on 'cancel' and retry:</h3>
					<div id="accordion">
						<h3>MAN (FAB) # (i.e. '800')</h3>
						<div><input type="text" name="MAN_No_1" value="" id="MAN_No_1"><input type="text" name="MAN_No_2" value="" id="MAN_No_2"></p>
						</div>
						
						<h3>Mack# (in format like '33-M')</h3>
						<div><input type="text" name="Mack_No" value="" id="Mack_No"></p>
						</div>

						<h3>Quick Name Search</h3>
						<div><input type="text" name="QuickName" value="" id="QuickName" size=40></p>
						</div>
						
						<h3>Complete Name Search (searches model, version and base names- takes a few seconds!)</h3>
						<div><input type="text" name="Name" value="" id="Name" size=40></p>
						</div>
						
						<h3>UMID# (LR and 3 numbers, e.g. 'LR025', or SF and 4 numbers, e.g. 'SF0858'. If LR or SF not specified will assume SF.</h3>
						<div><input type="text" name="UMID_1" value="" id="UMID_1"><input type="text" name="UMID_2" value="" id="UMID_2"></p>
						</div>
					</div>
					
				<h2 class="demoHeaders">Or Search by General Model Information<br /> <h3>(you may choose more than one of these criteria):</h3>	
					<div id="accordion2">
						
						
							<dl class="accordion" data-accordion>
								<dd>
									<a href="#panel1"><h3>Vehicle Type</h3></a>
									<div id="panel1" class="content">
										<input type=checkbox name="VehicleType_Check" id="VehicleType_Check" />
										<label>Vehicle Type:</label>
										<?php
											$query=("SELECT * FROM Test_Matchbox_Value_Lists WHERE ValueList LIKE '%VehicleType%'");								
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
										<select name="TypeofVehicle" id="TypeofVehicle" >
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
									<a href="#panel2"><h3>Make of Vehicle (i.e. Ford)</h3></a>
									<div id="panel2" class="content">
										<input type=checkbox name="VehicleMake_Check" id="VehicleMake_Check" />
										<label>Make of Vehicle:</label>
										<?php
											$query=("SELECT * FROM Test_Matchbox_Value_Lists WHERE ValueList LIKE '%VehMake%'");								
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
										<select name="VehicleMake" id="VehicleMake" >
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
									<a href="#panel3"><h3>Country of Make (i.e. Ford is made in the USA)</h3></a>
									<div id="panel3" class="content">
										<input type=checkbox name="MakeCountry_Check" id="MakeCountry_Check" />
										<label>Country of Make:</label>
										<?php
											$query=("SELECT * FROM Test_Matchbox_Value_Lists WHERE ValueList LIKE '%MakeCountry%'");								
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
										<select name="MakeCountry" id="MakeCountry">
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
				<h2 class="demoHeaders">Or Search by Text on the Model<br /> <h3></h3>	
					<div id="accordion2">
						<input type=checkbox name="TempaText_Check" id="TempaText_Check" >Text:<br>
						<input type="text" name="TempaText" value="" size="25" id="TempaText"></p>						
						</select>	
						</div>
					</div>		
				<p></p>	
				<input type="submit" class="button" name="submit" value="Search"/>
				<br /><br />
				<a href="Search_Models_Menu.php">Cancel/Clear</a>

				</form>			

			</body>
		</td>
	</tr>
</table>
<?php include("includes/footer.php"); ?>