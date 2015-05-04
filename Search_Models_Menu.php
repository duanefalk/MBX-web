<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
	$pageTitle = "Search Models";
	include("includes/header.php"); 
?>


<form action="Search_Models_Process.php" method="post" data-parsley-validate>

	<!-- Search Options -->
	<div class="row">
		
		<div class="large-4 columns">				
			<h3 class="demoHeaders">Choose the ID You Want to Search by</h3>
			<p>Search will use only last data entered; if you get unexpected results, click on 'cancel' and retry:</p>
						
			<dl class="accordion" data-accordion>
				<dd>
					<a href="#panel4">MAN (FAB) # <small>Single or range of No's (i.e. '800'; enter one no. on the top line or one on each line for a range); shows all versions of the model that matches a MAN#</small></a>
					<div id="panel4" class="content">
						<div class="formRow">
							<input type="text" name="MAN_No_1" value="" id="MAN_No_1" placeholder="Man # 1" data-parsley-type="integer" />
						</div>
						<div class="formRow">
							<input type="text" name="MAN_No_2" value="" id="MAN_No_2" placeholder="Man # 2 (optional: if searching a range)" data-parsley-type="integer" />
						</div>
					</div>
				</dd>
			</dl>
		
			<dl class="accordion" data-accordion>
				<dd>
					<a href="#panel5">Mack # <small>(in format like '33-M')</small></a>
					<div id="panel5" class="content">
						<input type="text" name="Mack_No" value="" id="Mack_No" placeholder="Mack #" />
					</div>
				</dd>
			</dl>
			
			<dl class="accordion" data-accordion>
				<dd>
					<a href="#panel6">Quick Name Search</a>
					<div id="panel6" class="content">
						<input type="text" name="QuickName" value="" id="QuickName" placeholder="Quick Name Search" size="40" />
					</div>
				</dd>
			</dl>
		
			<dl class="accordion" data-accordion>
				<dd>
					<a href="#panel7">Complete Name Search <small>(searches model, version and base names- takes a few seconds!)</small></a>
					<div id="panel7" class="content">
						<input type="text" name="Name" value="" id="Name" size="40" placeholder="Complete Name Search" />
					</div>
				</dd>
			</dl>
			
			<dl class="accordion" data-accordion>
				<dd>
					<a href="#panel8">UMID # <small>LR and 3 numbers (e.g. 'LR025'), or SF and 4 numbers (e.g. 'SF0858'). If LR or SF not specified will assume SF; enter one no. on the top line, or one on each line for a range</small></a>
					<div id="panel8" class="content">
						<div class="formRow">
							<input type="text" name="UMID_1" value="" id="UMID_1" placeholder="UMID #1" data-parsley-type="alphanum" data-parsley-maxlength="6">
						</div>
						<div class="formRow">
							<input type="text" name="UMID_2" value="" id="UMID_2" placeholder="UMID #2 (optional: if searching a range)" data-parsley-type="alphanum" data-parsley-maxlength="6">
						</div>
					</div>
				</dd>
			</dl>
		</div>
	
		<div class="large-4 columns">					
			<h3 class="demoHeaders">Or Search by General Model Information</h3>
			<p>(you may choose more than one of these criteria):</p>	
			
			<dl class="accordion" data-accordion>
				<dd>
					<a href="#panel1">Vehicle Type</a>
					<div id="panel1" class="content">
						<input type=checkbox name="VehicleType_Check" id="VehicleType_Check" />
						<label for="VehicleType_Check">Vehicle Type:</label>
						<?php
							$query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%VehicleType%'");								
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
					<a href="#panel2">Make of Vehicle <small>(i.e. Ford)</small></a>
					<div id="panel2" class="content">
						<input type=checkbox name="VehicleMake_Check" id="VehicleMake_Check" />
						<label for="VehicleMake_Check">Make of Vehicle:</label>
						<?php
							$query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%VehMake%'");								
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
					<a href="#panel3">Country of Make <small>(i.e. Ford is made in the US)</small></a>
					<div id="panel3" class="content">
						<input type=checkbox name="MakeCountry_Check" id="MakeCountry_Check" />
						<label for="MakeCountry_Check">Country of Make:</label>
						<?php
							$query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%MakeCountry%'");								
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
			
		<div class="large-4 columns">
			<h3 class="demoHeaders">Or Search by Text on the Model</h3>	
			
			<dl class="accordion" data-accordion>
				<dd>
					<a href="#panel9">Text</a>
					<div id="panel9" class="content">
						<input type="text" name="TempaText" value="" size="25" id="TempaText" placeholder="Text" />
					</div>
				</dd>
			</dl>
		
		</div>
		
	</div>
	
	<!-- Search Submit -->
	<div class="row">
		
		<div class="large-12 columns">
			<input type="submit" class="button dark" name="submit" value="Search" />
		
			<a class="button cancel" href="Search_Models_Menu.php">Clear</a>
		</div>
		
	</div>
	
</form>	

<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="similar_models_compare.php">Differences Among Similar Models</a>
		<a href="model_search_help.php">Tips on Searching for Models</a>
	</div>
</div>
			
<?php include("includes/footer.php"); ?>