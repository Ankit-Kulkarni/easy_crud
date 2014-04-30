<!-- 
The MIT License (MIT)

Copyright (c) Ankit Kulkarni(twitter - @ankitkul1890)

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

 -->

 <!-- 

########################################################################
#                                                                      #
# To use this file you will have to include it in each of the file you #
# want to use the crud functionality.                                  #
#                                                                      #
#      require('easy_crud.php');                                       #
########################################################################

  -->

<?php

?>

<!-- including the connection file for database. -->
<?php include("db_connect.php"); ?>

<!-- $query = "INSERT INTO `User_Info` VALUES('', '$username', '$password')"; -->

<?php
function ins($table_name, $param) {
  $table_name;
  $part1="INSERT INTO `" .$table_name . "` VALUES(" ;  
  $part2 =  format_param_list($param) ;
  $query= $part1. $part2;
  echo $query;
  echo '<br><br><br>';
  if(run_query($query)) {
  	echo "Succefull insertion of data " ;
  }
  else {
  	echo "The username exists. Change it and try again." ;
  }

}

function format_param_list($param, $param_list){
# This function takes an Array as input and returns the formated string. Ex- ('value1','value2','value3',...)
	$part2="(";
	$max = count($param_list);
	$quote ="'";
	if($param == "col"){ $quote = "`" ;}
	for($s=0; $s<$max; $s++){
		
		$part2= $part2. $quote;
		$part2= $part2. $param_list[$s]. $quote. " ";
		
		if($max === ($s + 1)){
			
			break;
		}
		$part2= $part2. ", ";

	}
	
	$part2= $part2. ")";
	return $part2 ;
}

function run_query($query) {
# This function runs the query and return 1 if succesful else return 0.
	  if ($queryRun =  mysql_query($query)) {
	  	#code
	  	return 1;
	  }
	  else {
	  	return 0;
	  }
}

$val =  array('', 'John', 'Doe');
#ins("User_Info", $val ); // call the function
?>


<?php 
	$age=array("Peter"=>"35","Ben"=>"37","Joe"=>"43");
	$table_name = "User_Info" ;
	#$data = array('id' =>'' , 'Username'=>'arrayas' , 'Password'=>'nothing');
	$data["Id"] = " ";
	$username = "Username";
	$password = "Password" ;
	$username_val = "Doe1";
	$password_val = "b" ;
	$data[$username] = $username_val ;
	$data[$password]  = $password_val ;
?>


<?php
function ins_with_column_name($table_name,$data) {
# This function creates the format of the insert query .
# INSERT INTO table_name (column1,column2,column3,...) VALUES (value1,value2,value3,...)
	$initial="INSERT INTO `" .$table_name . "` " ;		
	$query ="";
	list($col, $val) = seperate_key_values($data) ;
	$col_val_list = cal_col_val($col, $val);
	$query = $initial .$col_val_list ;

	echo "<br><br>";		 
	echo $query;
	echo "<br>";
	if(run_query($query)) {
		echo "Succefull insertion of data " ;
	}
	else {
		echo "The username exists. Change it and try again." ;
	}
}

function cal_col_val($col, $val){
# This function takes formated columns and values and returns the concatenated strings of column names and values in query format.
# For ex- ('column1','column2','column3', ...) VALUES ('value1','value2','value3', ...) .		
	$col_val_list = $col. " VALUES " . $val ;
	return $col_val_list;
}

function seperate_key_values($data){
# This function takes assosiative array as input and return array containing formated columns and values
	$column_list = array();
	$value_list = array();		
	foreach ($data as $key => $value) {
		# inserting key and values in arrays
		array_push($column_list, $key) ;
		array_push($value_list, $value);		
	}
	$col = format_param_list("col", $column_list);
	$val = format_param_list("row", $value_list);
	return array($col, $val);
}


ins_with_column_name($table_name, $data) ;

?>