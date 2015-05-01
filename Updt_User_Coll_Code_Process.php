<?php ob_start(); ?>
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
    if (isset($_POST['var_coll_code_submit'])) {

        //Fields:
        //Username
	//User_Coll_ID
	//Coll_List_Type
	//Coll_List_Value
	//Coll_List_Val_DisplOrd
	//Coll_List_Val_InactivFlg
        //$User_CollID=$_POST['User_CollID'];
	$User=$_SESSION['Username'];
        $Code_to_Updt=$_POST['Code_to_Updt'];
	$Code_Type=$_POST['Coll_List_Type'];
	$Code_Order=$_POST['Coll_List_Val_DisplOrd'];
	//no need to change inactivflg

	//update record, omit copy, username, coll id, inactivflg since they dont change        
        $query=("UPDATE Matchbox_User_Coll_Value_Lists SET Coll_List_Type='$Code_Type', Coll_List_Val_DisplOrd='$Code_Order' WHERE (Username='$User' AND Coll_List_Value LIKE '%$Code_to_Updt%')");
   
        $outcome=mysql_query($query);
        if ($outcome) {
        //if ((mysql_query($query)) == true)
	    redirect_to("Updt_User_Coll_Code.php");
        } else {
            echo "<p>Subject creation failed. Please review entries.</p>";
            echo "<p>".mysql_error()."</p>";
            //drop down to form again
        }   
    } else {
	//if post not set do initial form 
?>

	<h2>Update/Delete Seller or Location Codes</h2>
	
	<?php
		$User=$_SESSION['Username'];
		$Code_to_Updt=$_GET["code"];
		$query=("SELECT * FROM Matchbox_User_Coll_Value_Lists WHERE Username='$User' AND Coll_List_Value LIKE'%$Code_to_Updt%'");								
		$result=0;
		$result=mysql_query($query);
		
		if ($result) {
			$rows=mysql_num_rows($result);
		
			if ($rows > 0) {
			    $row=mysql_fetch_array($result);
			    $Code_Type=$row['Coll_List_Type'];
			} else {
			    echo "You don't have that code.";
			    exit;
			}
		}
    ?>

	<form name="Updt_User_Coll_Code_Process" action="Updt_User_Coll_Code_Process.php" method="post" data-parsley-validate>
	    <?php  
        	echo "<p><strong>Username:</strong> ".$User."</p>";
			echo "<p><strong>Code to Updt/delete:</strong> ".$Code_to_Updt."</p>";
		?>
	    
	    <input type="hidden" name="Code_to_Updt" value="<?php echo $Code_to_Updt;?>" id="Code_to_Updt">
	    
	    <div class="formRow">
		    <label for="Coll_List_Type">Code Type (either Location or Seller):</label>
		    <select name="Coll_List_Type" id="Coll_List_Type">
				<option value="Location" <?php echo $Code_Type;?> <?php if ($Code_Type == "Location") { echo "selected"; } ?>>Location</option>
				<option value="Seller" <?php if ($Code_Type == "Seller") { echo "selected"; } ?>>Seller</option>
			</select>	
			<!--input type="text" name="Coll_List_Type" id="Coll_List_Type" value="<?php echo $Code_Type;?>" size="60" id="Coll_List_Type"-->
	    </div>
	    
	    <div class="formRow">
		    <label for="Coll_List_Val_DisplOrd">Code Display Order (1-4 digit#):</label>
		    <input type="text" name="Coll_List_Val_DisplOrd" id="Coll_List_Val_DisplOrd" value="<?php echo $row["Coll_List_Val_DisplOrd"];?>" size="4" id="Coll_List_Val_DisplOrd" data-parsley-type="integer">
	    </div>
	    
		<input type="submit" name="var_coll_code_submit" class="button dark" value="Update" id="var_coll_code_submit"/>
    </form>
    
    <?php
	    $url1= "Del_Coll_Code.php?code=".$Code_to_Updt;
	    echo "<a href=\"".$url1."\">DELETE THIS CODE</a>";
	    echo "<br></><br></>";
	    $url2= "Updt_User_Coll_Code.php";
	    echo "<a href=\"".$url2."\">Cancel</a>";
	?>
<?php } ?>

	</div>
</div>

<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="Manage_Collections.php">Manage Collection</a>
		<a href="index.php">Return to Main Page</a>
	</div>
</div>	

<?php include("includes/footer.php"); ?>