<?php ob_start(); ?>
<?php
// we must never forget to start the session
session_start();
?>
<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>

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

	//exit;
	//update record, omit copy, username, coll id, inactivflg since they dont change        
        $query=("UPDATE Matchbox_User_Coll_Value_Lists SET
		Coll_List_Type='$Code_Type',
		Coll_List_Value='$Code_to_Updt',
		Coll_List_Val_DisplOrd='$Code_Order'
	    WHERE Username='$User' AND Coll_List_Value='$Code_to_Updt'");
   
        $outcome=mysql_query($query);
        if ($outcome) {
        //if ((mysql_query($query)) == true)
	    redirect_to("Updt_User_Coll_Code.php");
        } else {
            echo "<p>Subject creation failed. Please review entries.</p>";
            echo "<p>".mysql_error()."</p>";
            //drop down to form again
        }   
    }
//if post not set do initial form 
?>

<table id="structure">
<tr>

	<td id="page">

		<h2>Update/Delete Seller or Location Codes</h2>

		<br />
		<?php
                    $User=$_SESSION['Username'];
		    $Code_to_Updt=$_GET["code"];
		    $query=("SELECT * FROM Matchbox_User_Coll_Value_Lists WHERE Username='$User' AND Coll_List_Value='$Code_to_Updt'");								
		    $result=0;
		    $result=mysql_query($query);
		    if (mysql_num_rows($result) != 0) {
			$row=mysql_fetch_array($result);
			$User_CollID=$row['User_Coll_ID'];
			$Code_Type=$row['Coll_List_Type'];
		    } ELSE {
		        echo "There is a database error- please notify system admin";
		    }                   
                ?>

		<form name="Updt_User_Coll_Code_Process" action="Updt_User_Coll_Code_Process.php" method="post">
		    <?php  
                        echo "<br />";
			echo "Username: ".$User."<br />";
			echo "Code to Updt/delete: ".$Code_to_Updt."<br />";
			
                    ?>
		    <input type="hidden" name="Code_to_Updt" value="<?php echo $Code_to_Updt;?>" id="Code_to_Updt">
		    <p>Code Type:          <input type="text" name="Coll_List_Type" value="<?php echo $Code_Type;?>" size="60" id="Coll_List_Type"></p>
		    <p>Code Display Order:          <input type="text" name="Coll_List_Val_DisplOrd" value="<?php echo $row["Coll_List_Val_DisplOrd"];?>" size="4" id="Coll_List_Val_DisplOrd"></p>

                    <input type="submit" name="var_coll_code_submit" class="button dark" value="Update" id="var_coll_code_submit"/>
        	</form>
                <?php
		    $url1= "Del_Coll_Code.php?code=".$Code_to_Updt;
		    echo "<a href=\"".$url1."\">DELETE THIS CODE</a>";
		    echo "<br></><br></>";
		    $url2= "Updt_User_Coll_Code.php";
		    echo "<a href=\"".$url2."\">Cancel</a>";
		?>
            </td>
	</tr>
</table>

<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="Manage_Collections.php">Manage Collection</a>
		<a href="index.php">Return to Main Page</a>
	</div>
</div>	

<?php include("includes/footer.php"); ?>