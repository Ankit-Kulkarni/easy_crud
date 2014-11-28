<?php 
	$conn_error = "couldn't connect to database";
	$mysql_host = 'localhost';
	$mysql_user = 'root';
	$mysql_pass = 'pulkit5-1';
	$mysql_database = "dc_database";
	if (!@mysql_connect($mysql_host, $mysql_user, $mysql_pass) || !@mysql_select_db($mysql_database) ) {
		die($conn_error);
	}

?>