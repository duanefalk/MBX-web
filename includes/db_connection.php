<?php
require("constants.php");
// 1. create connection
$connection= mysql_connect(DB_SERVER,DB_USER,DB_PASS);

if(!$connection) {
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
?>