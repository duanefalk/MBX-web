<?php
// we must never forget to start the session
session_start();
?>
<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>


<div class="row">
	<div class="large-12 columns">
	    <a href="Collection_Reports.php" class="button dark">Return to Collection Reports Menu</a>
            <a href="index.php" class="button dark">Return to Main Page</a>	
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
		
		echo "<tr style='font-weight: bold;'>";
		$result2 = mysql_query("SELECT COUNT(DISTINCT(Coll_List_Value)) FROM Matchbox_User_Coll_Value_List WHERE Username='$Username' AND Coll_List_Type='Seller'"); 		
		if ($result2) {
			$row2 = mysql_fetch_array($result2);			 
			echo "<td align='center' width='200'>" . $row2['COUNT(DISTINCT(Coll_List_Value)'] . "</td>";
		} else {
			echo "<td align='center' width='200'>" . "no sellers defined</td>";
		}
		$result3 = mysql_query("SELECT COUNT(DISTINCT(Coll_List_Value)) FROM Matchbox_User_Coll_Value_List WHERE Username='$Username' AND Coll_List_Type='Location'");
		if ($result3) {
			$row3 = mysql_fetch_array($result3);			 
			echo "<td align='center' width='200'>" . $row3['COUNT(DISTINCT(Coll_List_Value)'] . "</td>";
		} else {
			echo "<td align='center' width='200'>" . "no locations defined</td>";
		}
		echo "</tr>";
		echo "</table>";
            ?>
	</div>
</div>

<?php include("includes/footer.php"); ?>

