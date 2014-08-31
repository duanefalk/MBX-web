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
                echo "<h2>Seller Summary </h2>";  
                echo "<table border='1' style='border-collapse: collapse;border-color: silver;'>";  
                echo "<tr style='font-weight: bold;'>";  
                echo "<td width='200' align='center'>Country</td>";  
                echo "<td width='200' align='center'>Number of models</td>";
                echo "<td width='200' align='center'>Total $ Spent</td>";
                echo "</tr>";  
                $result = mysql_query("SELECT Seller,COUNT(*),SUM(PurchPrice)  
                FROM Matchbox_Collection  
                GROUP BY Seller;");  
                while($row=mysql_fetch_array($result))  
                {  
                    echo "<tr>";  
                    echo "<td align='center' width='200'>" . $row['Seller'] . "</td>";  
                    echo "<td align='center' width='200'>" . $row['COUNT(*)'] . "</td>";
                    echo "<td align='center' width='200'>" . $row['SUM(PurchPrice)'] . "</td>";
                    echo "</tr>";  
                }  
                echo "</table>";  
            ?>
	</div>
 </div>       



<?php include("includes/footer.php"); ?>
