<?php 

	include("db_connect.php");
	include("easy_crud.php");

?>

<?php
	$table_name = "User_Info" ;
	#$data = array('id' =>'' , 'Username'=>'arrayas' , 'Password'=>'nothing');
	$data["Id"] = " ";
	$username = "Username";
	$password = "Password" ;
	$username_val = "raonee1";
	$password_val = "sunnyverma" ;
	$data[$username] = $username_val ;
	$data[$password]  = $password_val ;
	$condition = "`Id` = 2" ;
?>

<?php

function test_insert($table_name, $data, $condition){
	# testing function with one parameter
	# return => error
	insert($table_name);
	
	
	# testing function with 2 parameters where
	# $table_name = "string", $data = "associative array"
	# return => Succefull insertion of data
	insert($table_name, $data);

	# testing function with 2 parameters where
	# $table_name = "string", $data = "associative array"
	# return => Succefull insertion of date_add()
	insert($table_name, $data, $condition);




}
test_insert($table_name, $data, $condition);
?>
