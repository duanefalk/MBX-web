<?php
	require("constants.php");
	$connection = mysql_connect(DB_SERVER,DB_USER,DB_PASS);

	if (!$connection) {
		echo "Database connection failed ";
	} else {
		//echo "Made the database connection";
	}
	
	$db_select = mysql_select_db(DB_NAME,$connection);
	if (!$db_select) {
		echo "Database selection failed.";
	}
?>