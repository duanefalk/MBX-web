<?php
// we must never forget to start the session
session_start();
?>


<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php require_once("includes/functions.php"); ?>

<div class="row">
	<div class="large-12 columns">

		<?php
		    if (isset($_POST['submit'])) {
		
		        $Username=$_SESSION['Username'];
		        $User_Coll_ID=$_POST['User_Coll_ID'];
		        $UserCollValType=$_POST['UserCollValType'];
		        $UserCollValue=$_POST['UserCollValue'];
		        $UserCollValueDisplOrd=$_POST['UserCollValueDisplOrd'];
		        $Coll_List_Val_InactivFlg=0;
		
		       
		        $query="INSERT INTO Matchbox_User_Coll_Value_Lists (Username, User_Coll_ID, Coll_List_Type, Coll_List_Value, Coll_List_Val_DisplOrd, Coll_List_Val_InactivFlg) 
		            VALUES ('$Username','$User_Coll_ID','$UserCollValType', '  $UserCollValue', '$UserCollValueDisplOrd', '$Coll_List_Val_InactivFlg')";
		   
		        $outcome=mysql_query($query);
		        if (!$outcome) {
		            echo "<p>Subject creation failed. Please review entries.</p>";
		            echo "<p>".mysql_error()."</p>";
		            //drop down to form again
		        }   
		    }
		//if post not set do initial form 
		?>

		<h2>Add a Collection Code</h2>
		<form name="Add_User_Coll_Code" action="Add_User_Coll_Code.php" method="post">
		<?php echo "User: ".$_SESSION['Username']."<br />"; 
		$Username=$_SESSION['Username'];
		$query2="SELECT * FROM Matchbox_User_Collections WHERE Username='$Username'";
		$result2=mysql_query($query2);
		$row2=mysql_fetch_array($result2);
		echo"Collection Name: ".$row2['User_Coll_ID'];
		?>
		
		<p>Value Type: </p>
                <?php
                        $query=("SELECT * FROM Matchbox_Value_Lists WHERE ValueList LIKE '%UserCollValType%'");								
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
                        // echo "Rows COunt: ".$rows_count."<br />";
                ?>
                <select name="UserCollValType">
                <?php
                        for ($i=1; $i<=$rows_count; $i++) {
                                $row=mysql_fetch_array($result);
                                echo '<option value="'.$row["ValueListEntry"].'">'.$row["ValueListEntry"].'</option'."<br />";
                        }	
                ?>
                </select>
            <p>Value:     	  <input type="text" name="UserCollValue" value="" size="40" id="UserCollValue"</p>
            <p>Display Order:     <input type="text" name="UserCollValueDisplOrd" value="" size="4" id="UserCollValueDisplOrd"</p>
            <input type="submit" name="submit" value="Submit" id="submit"/>
		</form>
	    <a href="Add_User_Coll_Code.php">Cancel</a>		
	
	
	</div>
</div>

<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="Collection_Code_Lists.php">Manage Collection Code Lists</a>
		<a href="Manage_Collections.php">Manage Collections</a>
	</div>
</div>
<?php include("includes/footer.php"); ?>