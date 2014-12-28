<?php 

	include("db_connect.php");
	include("easy_crud.php");

?>

<?php
	$table_name = "User_Info" ;
	$attribute="Username  Password"; # Attribute for select query are either in space separeted way or *.
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

function test_crud($table_name, $data, $attribute, $condition){
	echo "Function with one parameter: <br>";
	# testing function with 2 parameters where
	# return => error
	insert($table_name);
	select($table_name);
	update($table_name);
	delete($table_name);
	
	echo "<br><br>";
	echo "Function with 2 parameters:<br>";
	# testing function with 2 parameters where
	# $table_name = "string", $data = "associative array"
	# return => Succefull insertion of data
	insert($table_name, $data);
	select($table_name, $attribute);
	update($table_name, $data);
	delete($table_name, $attribute);

	# testing function with 2 parameters where
	# $table_name = "string", $data = "associative array"
	# return => Succefull insertion of date_add()
	echo "<br><br>";
	echo "Function with condition:<br>";
	insert($table_name, $data, $condition);
	select($table_name, $attribute, $condition);
	update($table_name, $data, $condition);
	delete($table_name, $attribute, $condition);




}
test_crud($table_name, $data, $attribute, $condition);