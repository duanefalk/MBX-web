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

                <h2>Wishlist for <?php echo $_SESSION["Username"]; ?></h2>
            <?php
		$User=$_SESSION["Username"];
                echo "<table border='1' style='border-collapse: collapse;border-color: silver;'>";  
                echo "<tr style='font-weight: bold;'>";  
                echo "<td width='200' align='center'>Variations</td>";  
                echo "<td width='200' align='center'>Releases</td>";
                echo "</tr>";  
                $result = mysql_query("SELECT * FROM Matchbox_User_Wishlist WHERE 'Username'=$User ORDER BY 'VarID','RelID'");
		if ($result) {
			while($row=mysql_fetch_array($result)) {	
				echo "<tr>";  
				echo "<td align='center' width='200'>" . $row['VarID'] . "</td>";  
				echo "<td align='center' width='200'>" . $row['RelID'] . "</td>";
				echo "</tr>";
			}
			echo "</table>";
		} else {
			echo "</table>"; 
			echo "No items in your wishlist";
		}
		
            ?>
	</div>
 </div>       



<?php include("includes/footer.php"); ?>
