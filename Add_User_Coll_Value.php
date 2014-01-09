<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php require_once("includes/functions.php"); ?>

<?php
    if (isset($_POST['submit'])) {

        $Coll_Username=$_POST['Coll_Username'];
        $User_Coll_ID=$_POST['User_Coll_ID'];
        $UserCollValType=$_POST['UserCollValType'];
        $UserCollValue=$_POST['UserCollValue'];
        $UserCollValueDisplOrd=$_POST['UserCollValueDisplOrd'];
        $Coll_List_Val_InactivFlg=0;

       
        $query="INSERT INTO Test_Matchbox_User_Coll_Value_Lists (Username, User_Coll_ID, Coll_List_Type, Coll_List_Value, Coll_List_Val_DisplOrd, Coll_List_Val_InactivFlg) 
            VALUES ('$Coll_Username','$User_Coll_ID','$UserCollValType', '  $UserCollValue', '$UserCollValueDisplOrd', '$Coll_List_Val_InactivFlg')";
   
        $outcome=mysql_query($query);
        if (!$outcome) {
            echo "<p>Subject creation failed. Please review entries.</p>";
            echo "<p>".mysql_error()."</p>";
            //drop down to form again
        }   
    }
//if post not set do initial form 
?>

<table id="structure">
    <tr>
            <td id="navigation">

                    <a href="Collection_Value_Lists.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Manage Collection Value Lists</p></a>
                    <a href="Manage_Collections.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Manage Collections</p></a>
                    <a href="index.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Main Page</p></a>	
            </td>
            <td id="page">
                <h2>Add a Collection Value</h2>
                <form name="Add_User_Coll_Value" action="Add_User_Coll_Value.php" method="post">
                    <p>Username: <input type="text" name="Coll_Username" value="duanefalk" size="20" id="Coll_Username"></p>
                    <p>Collection ID: <input type="text" name="User_Coll_ID" value="FALKCOLL1" size="20" id="User_Coll_ID"></p><br />
                    <p>Value Type: </p>
                        <?php
                                $query=("SELECT * FROM Test_Matchbox_Value_Lists WHERE ValueList LIKE '%UserCollValType%'");								
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
                <a href="Add_User_Coll_Value.php">Cancel</a>
            </td>
    </tr>
</table>
<?php include("includes/footer.php"); ?>