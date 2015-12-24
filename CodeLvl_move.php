<?php
define("DB_SERVER","localhost");
define("DB_USER","root");
define("DB_PASS","bandit");
define("DB_NAME","MBX DB");

// 1. create connection
$connection= mysql_connect(DB_SERVER,DB_USER,DB_PASS);
if (!$connection) {
	echo "Database connection failed ";
}
else {
	// echo "Made the database connection";
}
// 2. select database
	$db_select = mysql_select_db(DB_NAME,$connection);
	if(!$db_select) {
		echo "Database selection failed ";
	}

$query="SELECT * FROM Matchbox_Variations WHERE CodeLvl='2' AND VarID LIKE '%-a%'";
$result = mysql_query($query);
$rows= mysql_num_rows($result);
for ($i=1; $i<=$rows; $i++)
    {
    $row=mysql_fetch_array($result);
    $version=$row['VerID'];
    $secmanuf=$row['SecManuf'];
    $updt="UPDATE Matchbox_Versions SET CodeLvl='2', SecManuf='$secmanuf' WHERE VerID='$version'";
    $outcome=mysql_query($updt);
    if ($outcome) {
        echo "updated ".$version."<br />";
    } // success 
     else {
        echo "<p>Subject creation failed.</p>";
        echo "<p>".mysql_error()."</p>";
        exit;
     }
    }
echo "finished update";

// 3. close connection
    if (isset($connection)) {
        mysql_close($connection);
    }
?>
