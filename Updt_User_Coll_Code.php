<?php
// we must never forget to start the session
session_start();
?>
<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>

<div class="row">
    <div class="large-12 columns">

<?php
    $User=$_SESSION['Username'];
    if (isset($_POST['var_submit'])) {

	$CollCode=$_POST['Coll_Code'];
        $User=$_SESSION['Username'];

		$result=0;
		$query=("SELECT * FROM Matchbox_User_Coll_Value_Lists WHERE Username='$User' AND Coll_List_Val_InactivFlg=\"0\"");								
		$result=mysql_query($query);

		if ($result) {
		    $rows=mysql_num_rows($result);
		    
		    if ($rows > 0) {
				$location="Updt_User_Coll_Code_Process.php?code=".$CollCode;
				//echo "ready to go";	
				redirect_to($location);
		    } else {
				echo "<p>You have no codes for your collection</p>";
		    }
		}

	$CollCode=$_POST['Coll_Code'];
		
	$result = 0;
	$query = ("SELECT * FROM Matchbox_User_Coll_Value_Lists WHERE Username='$User' AND Coll_List_Val_InactivFlg=\"0\"");								
	$result = mysql_query($query);
	
	if ($result) {
	    $rows=mysql_num_rows($result);
	    if ($rows > 0) {
			$location="Updt_User_Coll_Code_Process.php?code=".$CollCode;
			redirect_to($location);
	    } else {
			echo "<p>You have no codes for your collection</p>";
	    }
	}


    } else { ?>
	
	<h2>Update/Delete Seller or Location Codes</h2>
	
	<table>  
		<thead>
			<td>Codes Type</td>
			<td>Value</td>
			<td>Sort Order</td>
		</thead>
		<?php 
			$result2=mysql_query("SELECT * FROM Matchbox_User_Coll_Value_Lists WHERE Username='$User' AND Coll_List_Val_InactivFlg=\"0\" ORDER BY Coll_List_Type, Coll_List_Val_DisplOrd ASC");
					
			if ($result2) {
			    $rows_count2=mysql_num_rows($result2);
			    for ($i=1; $i<=$rows_count2; $i++) {
			        echo "<tr>";
			        	$row2=mysql_fetch_array($result2);
						echo "<td>" . $row2['Coll_List_Type'] . "</td>";
						echo "<td>" . $row2['Coll_List_Value'] . "</td>";
						echo "<td>" . $row2['Coll_List_Val_DisplOrd'] . "</td>";
					echo "</tr>";
			    }
			} else {
			    echo "<tr><td>No codes defined</td></tr>";
			}
		?>   
	</table>

		
	<!--form name="Updt_User_Coll_Code" action="Updt_User_Coll_Code.php" method="post" data-parsley-validate>
	    <div class="formRow">
			<label for="Coll_Code">Enter Seller or Location Code to Update/Delete:</label>
			<input type="text" name="Coll_Code" value="" size="60" id="Coll_Code" required>
	    </div>
			
	    <div class="row">
			<div class="large-2 small-6 columns">
			    <input type="submit" value="Submit" class="button dark" id="var_submit" name="var_submit">
			</div>
			<div class="large-2 small-6 columns end">
			    <a class="button dark cancel" href="Updt_User_Coll_Code.php">Cancel</a>
			</div>
	    </div>
	</form-->
	
	<form name="Updt_User_Coll_Code" action="Updt_User_Coll_Code.php" method="post" data-parsley-validate>
	    <div class="formRow">
			<p>Select the Seller or Location Code to Update / Delete:</p>
			<?php 
				$result3 = mysql_query("SELECT * FROM Matchbox_User_Coll_Value_Lists WHERE Username='$User' AND Coll_List_Val_InactivFlg=\"0\" ORDER BY Coll_List_Type, Coll_List_Val_DisplOrd ASC");
							
				if ($result3) {
				    $rows_count3 = mysql_num_rows($result3);
				    for ($i=1; $i <= $rows_count3; $i++) {
					    $row3 = mysql_fetch_array($result3);
				        echo "<div class='radio'><input type='radio' name='Coll_Code' id='code" . $i . "' value='" . $row3['Coll_List_Value'] . "'><label for='code" . $i . "'>" . $row3['Coll_List_Value'] . "</label></div>";
				    }
				} else {}
			?>
	    </div>
			
	    <div class="row">
			<div class="large-2 small-6 columns">
			    <input type="submit" value="Submit" class="button dark" id="var_submit" name="var_submit">
			</div>
			<div class="large-2 small-6 columns end">
			    <a class="button dark cancel" href="Collection_Code_Lists.php">Cancel</a>
			</div>
	    </div>
	</form>

    <?php } ?>

    </div>
</div>


<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="Collection_Code_Lists.php">Manage Code Lists</a>
		<a href="index.php">Return to Main Page</a>
	</div>
</div>	

<?php include("includes/footer.php"); ?>