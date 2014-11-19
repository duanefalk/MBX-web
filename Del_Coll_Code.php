<?php ob_start(); ?>
<?php
// we must never forget to start the session
session_start();
?>
<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>

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

<table id="structure">
<tr>

	<td id="page">

		<h2>Delete Seller or Location Code</h2>
		<br />

		<?php
                    $Code_to_Updt=$_GET["code"];
                    $User=$_SESSION['Username'];

		    $query=("SELECT * FROM Matchbox_User_Coll_Value_Lists WHERE Username='$User' AND Coll_List_Value='$Code_to_Updt'");								
		    $result=0;
		    $result=mysql_query($query);
		    if (mysql_num_rows($result) != 0) {
			$row=mysql_fetch_array($result);
		    } ELSE {
		        echo "Database problem- please email info@MBX-u.com";
		    }                   
                ?>

		<form name="Del_Coll_Code" action="Del_Coll_Code.php" method="post">
		    <?php  
                        echo "<br />";
			echo "Username: ".$User."<br />";
			echo "User Collection Name: ".$row["User_Coll_ID"]."<br />";
			echo "Code to Delete: ".$Code_to_Updt."<br />";
			echo "Code Type: ".$row["Coll_List_Type"]."<br />";
			echo "Code Display Order: ".$row["Coll_List_Val_DisplOrd"]."<br />";
                    ?>
		    
		    <input type="hidden" name="Code_to_Updt" value="<?php echo $Code_to_Updt;?>" id="Code_to_Updt">
                    <input type="submit" name="del_submit" class="button dark" value="DELETE?" id="del_submit"/>
        	</form>
                <?php
		    $url2= "Collection_Code_Lists.php";
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