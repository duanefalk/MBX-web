<?php
// we must never forget to start the session
session_start();
?>
<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>

<?php $User=$_SESSION['Username']; ?>
<div class="large-12 columns">
<a href="Collection_Reports.php" class="button dark">Return to Collection Reports Menu</a>
<a href="index.php" class="button dark">Return to Main Page</a>
</div>

<form action="Collection_Report_M_Process.php" method="post">

	<!-- Search Options -->
	<div class="row">
		
		<div class="large-4 columns">				
			<h3 class="demoHeaders">Choose a Model/Release Criterion to Search by</h3>
			<p>Choose one (search will use the last chosen). If you make no selection, all models in collection will be shown</p>

                        <dl class="accordion" data-accordion>
				<dd>
					<a href="#panel11">MAN (FAB) # <small>Single or range of No's (i.e. '800'; enter one no. on the top line or one on each line for a range); shows all versions of the model that matches a MAN#</small></a>
					<div id="panel11" class="content">
						<input type="text" name="MAN_No_1" value="" id="MAN_No_1" placeholder="Man # 1" />
						<input type="text" name="MAN_No_2" value="" id="MAN_No_2" placeholder="Man # 2 (optional: if searching a range)" />
					</div>
				</dd>
			</dl>
		
			<dl class="accordion" data-accordion>
				<dd>
					<a href="#panel12">Mack # <small>(in format like '33-M')</small></a>
					<div id="panel12" class="content">
						<input type="text" name="Mack_No" value="" id="Mack_No" placeholder="Mack #" />
					</div>
				</dd>
			</dl>
			
			<dl class="accordion" data-accordion>
				<dd>
					<a href="#panel13">UMID # <small>LR and 3 numbers (e.g. 'LR025'), or SF and 4 numbers (e.g. 'SF0858'). If LR or SF not specified will assume SF; enter one no. on the top line, or one on each line for a range</small></a>
					<div id="panel13" class="content">
						<input type="text" name="UMID_1" value="" id="UMID_1" placeholder="UMID #1">
						<input type="text" name="UMID_2" value="" id="UMID_2" placeholder="UMID #2 (optional: if searching a range)">
					</div>
				</dd>
			</dl>
			
			<dl class="accordion" data-accordion>
				<dd>	
					<a href="#panel14">Theme</a>
					<div id="panel14" class="content">
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
					<a href="#panel15">Series</a>
					<div id="panel15" class="content">
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
					<a href="#panel16">Release Year(s)</small></a>
					<div id="panel16" class="content">
						<input type="text" name="Rel_Yr_1" value="" id="Rel_Yr_1" placeholder="Starting Year" />
						<input type="text" name="Rel_Yr_2" value="" id="Rel_Yr_2" placeholder="Ending Year (Optional: if searching a range)" />
					</div>
				</dd>
			</dl>		
			
			
                </div>
                
                <div class="large-4 columns">					
			<h3 class="demoHeaders">Or Search by Collection Information</h3>
			<p>(you may choose more than one of these criteria):</p>
                        
                         <dl class="accordion" data-accordion>
				<dd>
					<a href="#panel21">Seller</a>
					<div id="panel21" class="content">
						<input type=checkbox name="Seller_Check" id="Seller_Check" />
						<label for="Seller_Check">Seller:</label>
						<?php
							$query=("SELECT * FROM Matchbox_User_Coll_Value_Lists WHERE Username= '$User' AND Coll_List_Type LIKE '%Seller%'");								
									
							$result = mysql_query($query);
							if (result) {
                                                            $rows_count= mysql_num_rows($result);
                                                            // echo "Rows Count: ".$rows_count."<br />";
                                                            ?>
                                                            <select name="Seller" id="Seller" >
                                                            <?php
                                                                for ($i=1; $i<=$rows_count; $i++) {
                                                                    $row=mysql_fetch_array($result);
                                                                    echo '<option value="'.$row["Coll_List_Value"].'">'.$row["Coll_List_Value"].'</option'."<br />";
                                                                }
                                                            ?>
                                                            </select>     
                                                        <?php
                                                        } else {
                                                            echo "You haven't defined any sellers";
                                                        }     
                                                        ?>        
					</div>
				</dd>
			</dl>
		
                        <dl class="accordion" data-accordion>
				<dd>
					<a href="#panel22">Location</a>
					<div id="panel22" class="content">
						<input type=checkbox name="Location_Check" id="Location_Check" />
						<label for="Location_Check">Seller:</label>
						<?php
							$query=("SELECT * FROM Matchbox_User_Coll_Value_Lists WHERE Username= '$User' AND Coll_List_Type LIKE '%Location%'");								
									
							$result = mysql_query($query);
							if (result) {
                                                            $rows_count= mysql_num_rows($result);
                                                            // echo "Rows Count: ".$rows_count."<br />";
                                                            ?>
                                                            <select name="Location" id="Location" >
                                                            <?php
                                                                for ($i=1; $i<=$rows_count; $i++) {
                                                                    $row=mysql_fetch_array($result);
                                                                    echo '<option value="'.$row["Coll_List_Value"].'">'.$row["Coll_List_Value"].'</option'."<br />";
                                                                }
                                                            ?>
                                                            </select>     
                                                        <?php
                                                        } else {
                                                            echo "You haven't defined any locations";
                                                        }     
                                                        ?>        
					</div>
				</dd>
			</dl>
                
                        <dl class="accordion" data-accordion>
				<dd>
					<a href="#panel23">Models w/ >1 copy in Collection</a>
					<div id="panel23" class="content">
						<input type=checkbox name="Copies_Check" id="Copies_Check" />
                                                <label for="Copies_Check">Models w/ >1 Copy</label>
					</div>
				</dd>
			</dl>
                
                        <dl class="accordion" data-accordion>
				<dd>
					<a href="#panel24">Models Flagged to Sell</a>
					<div id="panel24" class="content">
						<input type=checkbox name="Sell_Check" id="Sell_Check" />
                                                <label for="Sell_Check">Models Flagged to Sell</label>
					</div>
				</dd>
			</dl>

                        <dl class="accordion" data-accordion>
				<dd>
					<a href="#panel25">Vehicle Condition</a>
					<div id="panel25" class="content">
						<input type=checkbox name="Cond_Check" id="Cond_Check" />
						<label for="Cond_Check">Vehicles in equal or worse condition than:</label>
						<?php
                                                        //find users cond scheme
                                                        $query=("SELECT * FROM MBXU_User_Accounts WHERE Username= '$User'");
                                                        $result = mysql_query($query);
                                                        if ($result) {
                                                            $row=mysql_fetch_array($result);
                                                            $Veh_Cond_Scheme= $row['Veh_Cond_Scheme'];
                                                            if ($Veh_Cond_Scheme=="1") {
                                                                $Veh_Cond_Typ="Num_Cond";
                                                            } else {
                                                                $Veh_Cond_Typ="Alpha_Cond";
                                                            }
                                                        } else {
                                                            echo "Database error- no account found";
                                                            exit;
                                                        }
                                                									
                                                        //display that list and get selection
							$query2=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%$Veh_Cond_Typ%'");																	
							$result2 = mysql_query($query2);
							if ($result2) {
								$rows_count2= mysql_num_rows($result2);
								// echo "Rows Count: ".$rows_count."<br />";
								echo "<select name=\"VehCond\" id=\"VehCond\" >";	                                                        
								for ($i=1; $i<=$rows_count2; $i++) {
                                                                    $row2=mysql_fetch_array($result2);
                                                                    echo '<option value="'.$row2["ValueListEntry"].'">'.$row2["ValueListEntry"].'</option'."<br />";
                                                                }
								echo "</select>";     
                                                        } else {
                                                            echo "Database error- no condition entries found";
                                                            exit;
                                                        }     
                                                ?>        
					</div>
				</dd>
			</dl> 
             
          
                </div>
                
                <div class="large-4 columns">
			<h3 class="demoHeaders">Sort Criteria</h3>
                        <p>(if none chosen will sort by UMID#):</p>
                        
                        <h4 class="demoHeaders">Sort Criterion 1</h4>
			<input type=radio name="Sort1" id="Sort1" value="UMID" checked>UMID#<br>
			<input type=radio name="Sort1" id="Sort1" value="MAN">MAN#<br>
			<input type=radio name="Sort1" id="Sort1" value="Mack">Mack#<br>
			<input type=radio name="Sort1" id="Sort1" value="Location">Seller<br>
			<input type=radio name="Sort1" id="Sort1" value="Seller">Location<br>
			<input type=radio name="Sort1" id="Sort1" value="MdlValue"">Value<br>
			<input type=radio name="Sort1" id="Sort1" value="PurchDt">Purchase Date<br>

			<h4 class="demoHeaders">Sort Criterion 2</h4>
			<input type=radio name="Sort2" id="Sort2" value="UMID" checked>UMID#<br>
			<input type=radio name="Sort2" id="Sort2" value="MAN">MAN#<br>
			<input type=radio name="Sort2" id="Sort2" value="Mack">Mack#<br>
			<input type=radio name="Sort2" id="Sort2" value="Location">Seller<br>
			<input type=radio name="Sort2" id="Sort2" value="Seller">Location<br>
			<input type=radio name="Sort2" id="Sort2" value="MdlValue"">Value<br>
			<input type=radio name="Sort2" id="Sort2" value="PurchDt">Purchase Date<br>
                </div>    
                        
    
        </div>                
</form>


                        
<?php include("includes/footer.php"); ?>