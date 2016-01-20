<?php 
	ob_start();
	session_start();
	$pageTitle = "Delete Seller or Location Code";
	$pageDescription = "Delete a Seller or Location code from your Matchbox University collection.";
	require_once("includes/db_connection.php");
	include("includes/header.php");
	include("includes/functions.php");
?>

<?php
    if (isset($_POST['del_submit'])) {
   
	$User=$_SESSION['Username'];
	$Code_to_Updt=$_POST['Code_to_Updt'];
       
        $query=("UPDATE Matchbox_User_Coll_Value_Lists SET Coll_List_Val_InactivFlg=\"1\" WHERE Username='$User' AND Coll_List_Value='$Code_to_Updt'");
   
        $outcome=mysql_query($query);
        if ($outcome) {
        	//if ((mysql_query($query)) == true)
			redirect_to("Manage_Collections.php");
        } else {
            echo "<p>Deletion failed. Please review entries.</p>";
            echo "<p>".mysql_error()."</p>";
            //drop down to form again
        }   
    }
	//if post not set do initial form 
?>

<div class="row">
	<div class="large-12 columns">
		<h2>Delete Seller or Location Code</h2>

		<?php
		    $Code_to_Updt=$_GET["code"];
		    $User=$_SESSION['Username'];

		    $query=("SELECT * FROM Matchbox_User_Coll_Value_Lists WHERE Username='$User' AND Coll_List_Value='$Code_to_Updt'");								
		    $result=mysql_query($query);
		   
		    if ($result) {
			$row=mysql_fetch_array($result);
		    } else {
		        echo "Database problem- please email info@MBX-u.com";
		    }               
		?>

		<form name="Del_Coll_Code" action="Del_Coll_Code.php" method="post">
		    <?php  
			echo "<p><strong>Username:</strong> ".$User."</p>";
			echo "<p><strong>User Collection Name:</strong> ".$row["User_Coll_ID"]."</p>";
			echo "<p><strong>Code to Delete:</strong> ".$Code_to_Updt."</p>";
			echo "<p><strong>Code Type:</strong> ".$row["Coll_List_Type"]."</p>";
			echo "<p><strong>Code Display Order:</strong> ".$row["Coll_List_Val_DisplOrd"]."</p>";
            ?>
		    
		    <input type="hidden" name="Code_to_Updt" value="<?php echo $Code_to_Updt;?>" id="Code_to_Updt">
            <div class="row">
	            <div class="large-3 columns">
		            <input type="submit" name="del_submit" class="button dark" value="DELETE?" id="del_submit"/>
	            </div>
	            <div class="large-3 columns end">
		            <a class="button dark cancel" href="Collection_Code_Lists.php">Cancel</a>
	            </div>
            </div>
    	</form>
        
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