<?php
// we must never forget to start the session
session_start();
$Sec_Lvl=$_SESSION['Sec_Lvl'];
$Code2_Pref=$_SESSION['Code2_Pref'];

?>

<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/functions.php"); ?>
<table id="structure">

	<tr>
		<td id="navigation">
			<?php echo "<a href=\"javascript:history.go(-1)\">Return to Previous Page</a>"; ?>
			<a href="Search_Models_Menu.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Search Models</p></a>
			<a href="Search_Releases_Menu.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Search Releases</p></a>
			<a href="Index.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Main Page</p></a>
		</td>
		<td id="page">
			<?php
			    $Model_for_microvar=$_GET["model"];
			    echo "<h2>Microvariations for Model ".$Model_for_microvar."</h2>";
			    echo "<br></>";
			    $query=("SELECT * FROM Test_Matchbox_Model_Microvariations WHERE UMID='$Model_for_microvar'");
			    $result = mysql_query($query);
			    if (!$result) {			
				echo "Database Error";
				echo "<br></>";;
			    }

			$row=mysql_fetch_array($result);
			echo "Microvariations: ".$row['Microvariations'];
			echo "<br></><br></>";
			echo "Last Updt date: ".date("F d, Y",strtotime($row['Microvar_Updt_Dt']));
			echo "<br></><br></><br></>";
			$url= "Models_Detail_and_Ver_Listing.php?model=".$Model_for_microvar;
			?>
			<a href= "<?php echo $url; ?>" >Return to model detail</a>
			
			
		</td>
	</tr>
</table>

<?php include("includes/footer.php"); ?>