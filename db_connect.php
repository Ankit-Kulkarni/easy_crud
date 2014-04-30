<?php 
	$conn_error = "couldn't connect to database";
	$mysql_host = 'localhost';
	$mysql_user = 'root';
	$mysql_pass = 'root';
	$mysql_database = "TEST_PHP";
	if (!@mysql_connect($mysql_host, $mysql_user, $mysql_pass) || !@mysql_select_db($mysql_database) ) {
		die($conn_error);
	}

?>