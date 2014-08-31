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
		echo "<h2>Collection Summary</h2>";
		$Username=$_SESSION['Username'];
		$result = mysql_query("SELECT * FROM Matchbox_User_Collections WHERE Username='$Username'");
		$row=mysql_fetch_array($result);
		echo "<h5>User: ".$Username."</h5>";
		echo "<h5>Collection Name: ".$row['User_Coll_ID']."</h5>";
		echo "<h5>Description: ".$row['User_Coll_Desc']."</h5>";
		echo "<h5>Created on: ".$row['User_Coll_Created_Date']."</h5>";
	    
		echo "<table border='1' style='border-collapse: collapse;border-color: silver;'>";  
		echo "<tr style='font-weight: bold;'>";  
		echo "<td width='200' align='center'># of Sellers Defined</td>";  
		echo "<td width='200' align='center'># of Locations Defined</td>";
		echo "</tr>";
	
		$result2 = mysql_query("SELECT COUNT(DISTINCT(Coll_List_Value)) FROM Matchbox_User_Coll_Value_List WHERE Username='$Username' AND Coll_List_Type='Seller'"); 
                $row2=mysql_fetch_array($result2);
		echo "<h5>No. of Sellers Set Up: ".$row2['COUNT(DISTINCT(Coll_List_Value)']."</h5>";	
                   
            e
            ?>
	</div>
</div>

<?php include("includes/footer.php"); ?>

