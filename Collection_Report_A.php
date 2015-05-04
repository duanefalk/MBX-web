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
		echo "<h6>User: ".$Username."</h6>";
		echo "<h6>Collection Name: ".$row['User_Coll_ID']."</h6>";
		echo "<h6>Description: ".$row['User_Coll_Desc']."</h6>";
		echo "<h6>Created on: ".$row['User_Coll_Created_Date']."</h6>";
	    
	    
		//collection code info
		echo "<table border='1' style='border-collapse: collapse;border-color: silver;'>";  
			echo "<tr style='font-weight: bold;'>";
				echo "<td width='200' align='center'>Sellers Defined</td>";  
			echo "</tr>";
			
			$result2=mysql_query("SELECT DISTINCT Coll_List_Value FROM Matchbox_User_Coll_Value_Lists
			     WHERE Username='$Username' AND Coll_List_Type LIKE '%Seller%' ORDER BY Coll_List_Val_DisplOrd ASC");
				
				//$result2 = mysql_query("SELECT Coll_List_Value FROM Matchbox_User_Coll_Value_Lists WHERE Username='$Username' AND Coll_List_Type='Seller'"); 		
			if ($result2) {
				$rows_count2=mysql_num_rows($result2);
				    for ($i=1; $i<=$rows_count2; $i++) {
					echo "<tr style='font-weight: normal;'>";
					$row2=mysql_fetch_array($result2);
					echo "<td align='center' width='200'>" . $row2['Coll_List_Value'] . "</td>";
				    }
			} else {
				echo "<td align='center' width='200'>" . "no sellers defined</td>";
			}
				
		echo "</table>";
		
		echo "<table border='1' style='border-collapse: collapse;border-color: silver;'>";  
			echo "<tr style='font-weight: bold;'>";
				echo "<td width='200' align='center'>Locations Defined</td>";  
			echo "</tr>";
				
			$result3=mysql_query("SELECT DISTINCT Coll_List_Value FROM Matchbox_User_Coll_Value_Lists
						     WHERE Username='$Username' AND Coll_List_Type LIKE '%Location%' ORDER BY Coll_List_Val_DisplOrd ASC");
			
			if ($result3) {
				$rows_count3=mysql_num_rows($result3);
				    for ($i=1; $i<=$rows_count3; $i++) {
					echo "<tr style='font-weight: normal;'>";
					$row3=mysql_fetch_array($result3);
					echo "<td align='center' width='200'>" . $row3['Coll_List_Value'] . "</td>";
				    }
			} else {
				echo "<td align='center' width='200'>" . "no sellers defined</td>";
			}
		echo "</table>";
		
		
		//Gather Collection record info
		$TotPurchPrice=0;
		$TotValue=0;
		$TotSellFlg=0;
		$MinSell=0;
		
		$result4=mysql_query("SELECT * FROM Matchbox_Collection WHERE Username='$Username'");
		if ($result4) {
			$rows_count4=mysql_num_rows($result4);
			for ($i=1; $i<=$rows_count4; $i++) {
				$row4=mysql_fetch_array($result4);
				$TotPurchPrice=$TotPurch_Price + $row4['PurchPrice'];
				$TotValue=$TotValue + $row4['ItemVal'];
				if ($row4['SellFlag']) {
					$TotSellFlg= $TotSellFlg +1;
					$MinSell= $MinSell + $row4['MinSellPrice'];
				}
			}	

			//Display tables w/ collection info
			echo "<table border='1' style='border-collapse: collapse;border-color: silver;'>";  
				echo "<tr style='font-weight: bold;'>";
					echo "<td width='200' align='center'># Model Records</td>";  
				echo "</tr>";
				echo "<tr style='font-weight: normal;'>";
					echo "<td align='center' width='200'>" . $rows_count4 . "</td>";
				echo "</tr>";
			echo "</table>";		

			echo "<table border='1' style='border-collapse: collapse;border-color: silver;'>";  
				echo "<tr style='font-weight: bold;'>";
					echo "<td width='200' align='center'>Tot. Purchase Cost</td>";
					echo "<td width='200' align='center'>Tot. Value</td>";	
				echo "</tr>";

				echo "<tr style='font-weight: normal;'>";
					echo "<td align='center' width='200'>" . $TotPurchPrice . "</td>";
					echo "<td align='center' width='200'>" . $TotValue . "</td>";
				echo "</tr>";
			echo "</table>";	

			echo "<table border='1' style='border-collapse: collapse;border-color: silver;'>";  
				echo "<tr style='font-weight: bold;'>";	
					echo "<td width='200' align='center'># Flagged to Sell</td>";
					echo "<td width='200' align='center'>Tot. Min. Sell Amt.</td>";
				echo "</tr>";
				echo "<tr style='font-weight: normal;'>";
					echo "<td align='center' width='200'>" . $TotSellFlg . "</td>";
					echo "<td align='center' width='200'>" . $MinSell . "</td>";
				echo "</tr>";
			echo "</table>";	
		} else {
			echo "There is a database error- please contact sys admin";
		}		
	
            ?>
	    <a id="printThis" class="button dark" href="javascript:window.print()">Print this Report</a>
	</div>
</div>

<?php include("includes/footer.php"); ?>

