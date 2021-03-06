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


<?php
	#helpers
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
		if ($queryRun = mysql_query($query)) {
			#code
			return 1;
		}
		else {
			return 0;
		}
	}
	function all_attribute($data)
	{
		# This function converts all the attributes entered in space saparated way into comma separated format.
	
		if($data=="*"){
					return $query="* FROM "."$table_name";	
				}
				else{
					$attributes=explode(" ",$data);
					//print_r($attributes);
					for ($index=0; $index < sizeof($attributes); $index++) {
						if ($index != sizeof($attributes)-1) {
						 	$all_attribute .="`".$attributes[$index]."`".", ";# code...
						 }
						 else{
						 	$all_attribute .="`".$attributes[$index]."`"." ";
						 }
						
					}
					return $query=$all_attribute."FROM"." "."$table_name";
					
				}
			

	}

?>



<?php
function insert() {
# This variadic function creates the format of the insert query .
# INSERT INTO table_name (column1,column2,column3,...) VALUES (value1,value2,value3,...)

	for ($i = 0; $i < func_num_args(); $i++) {
	    #printf("Argument %d: %s\n", $i, func_get_arg($i));
	    $param[$i]=func_get_arg($i);
	    
	}
	try {
		$param_len = count($param) ;
		if ( $param_len < 2 ) {
			echo "Insufficient Arguments!<br>"; 
		} elseif ($param_len == 2) {
			# code...
			$table_name = $param[0];
			$data = $param[1];
			$condition = "";
			#echo "<br> insert query with 2 param";			
			run_insert_query($table_name, $data, $condition);		

		} elseif ($param_len == 3) {
			# code...
			$table_name = $param[0];
			$data = $param[1];
			$condition = $param[2] ;
			#echo " <br> insert query with 3 param";
			run_insert_query($table_name, $data, $condition);
			
		}
		
		} catch (Exception $e) {
			return $e; 	
		}

		
	
}

function run_insert_query($table_name, $data, $condition){
		try{
			$initial="INSERT INTO `" .$table_name . "` " ;		
			$query ="";
			
			list($col, $val) = seperate_key_values($data) ;
			$col_val_list = cal_col_val($col, $val, $condition);
			$query = $initial .$col_val_list.";" ;

			#echo "<br><br>";		 
			echo $query;
			echo "<br>";
			if(run_query($query)) {
				echo "<br> Successfull insertion of data " ;
			}
			else {
				#echo " <br> The username exists. Change it and try again." ;
			}
		
	} catch (Exception $e) {
		return $e; 	
	}


}


function cal_col_val($col, $val, $condition){
# This function takes formated columns and values and returns the concatenated strings of column names and values in query format.
# For ex- ('column1','column2','column3', ...) VALUES ('value1','value2','value3', ...) .		
	
	$cond = "WHERE ". $condition;
	#echo " <br>This is \$cond -   " . $cond ;
	if($condition == ""){
		$col_val_list = $col. " VALUES " . $val ;
		
	}
	else{
		$col_val_list = $col. " VALUES " . $val ." " . $cond ;
	}
	
	return $col_val_list;
}

?>

<?php
	function select(){
		# This function creates the format of the SELECT query.
		# SELECT */column1,column2,column3,... FROM tablename WHERE condition.
		for ($i = 0; $i < func_num_args(); $i++) {
		    #printf("Argument %d: %s\n", $i, func_get_arg($i));
		    $param[$i]=func_get_arg($i);
		    
		}
		try {
				$param_len = count($param) ;
				if ( $param_len < 2 ) {
					echo "Insufficient Arguments!<br>"; 
				} elseif ($param_len == 2) {
					# code...
					$table_name = $param[0];
					$data = $param[1];
					$condition = "";
					//echo "<br> select query with 2 param";			
					run_select_query($table_name, $data, $condition);		

				} elseif ($param_len == 3) {
					# code...
					$table_name = $param[0];
					$data = $param[1];
					$condition = $param[2] ;
					//echo " <br> select query with 3 param";
					run_select_query($table_name, $data, $condition);
					
				}
				
				} catch (Exception $e) {
					return $e; 	
				}
	}

	function run_select_query($table_name, $data, $condition){
		try {
			$initial="SELECT ";

			$all_attribute=all_attribute($data);

			$cond = " WHERE ". $condition;
			if ($condition=="") {
				echo $query=$initial.$all_attribute.$table_name.";";
				echo "<br>";
			}
			else{
				echo $query=$initial.$all_attribute.$table_name.$cond.";";
				echo "<br>";
			} 


		} catch (Exception $e) {
			return $e; 	
		}
	}
?>
<?php 
	function update(){
		# This function creates the format of the UPDATE query.
		# UPDATE tablename SET values WHERE condition.
		for ($i = 0; $i < func_num_args(); $i++) {
		    #printf("Argument %d: %s\n", $i, func_get_arg($i));
		    $param[$i]=func_get_arg($i);
		    
		}
		try {
			$param_len = count($param) ;
			if ( $param_len < 2 ) {
				echo "Insufficient Arguments!<br>"; 
			} elseif ($param_len == 2) {
				# code...
				$table_name = $param[0];
				$data = $param[1];
				$condition = "";
				//echo "<br> select query with 2 param";			
				run_update_query($table_name, $data, $condition);		

			} elseif ($param_len == 3) {
				# code...
				$table_name = $param[0];
				$data = $param[1];
				$condition = $param[2] ;
				//echo " <br> select query with 3 param";
				run_update_query($table_name, $data, $condition);
				
			}
			
			} catch (Exception $e) {
				return $e; 	
			}
	}
	function run_update_query($table_name, $data, $condition){
		try {
			$initial="UPDATE `".$table_name."` SET ";

			$quote_for_attribute ="'";
			$quote_for_column ="`";
			$index=0;
			foreach ($data as $key => $value) {
			# inserting key and values in arrays
				if ($index!=sizeof($data)-1) {
					$set_value.= $quote_for_column.$key.$quote_for_column."= ".$quote_for_attribute.$value.$quote_for_attribute.", ";
				}else{
					$set_value.= $quote_for_column.$key.$quote_for_column."= ".$quote_for_attribute.$value.$quote_for_attribute." ";
				}
				$index++;		
		}
			//echo $set_value;
			if ($condition=="") {
				$query = $initial.$set_value.";";
			}else{
				$query = $initial.$set_value."WHERE ".$condition.";" ;
			}
			#echo "<br><br>";		 
			echo $query;
			echo "<br>";

		} catch (Exception $e) {
			return $e; 	
		}
	}
	
?>
<?php
	function delete(){
	# This function creates the format of the DELETE query.
	# DELETE */ column1, column2, column3, .... FROM tablename WHERE condition.
		for ($i = 0; $i < func_num_args(); $i++) {
		    #printf("Argument %d: %s\n", $i, func_get_arg($i));
		    $param[$i]=func_get_arg($i);
		    
		}
		try {
				$param_len = count($param) ;
				if ( $param_len < 2 ) {
					echo "Insufficient Arguments!<br>"; 
				} elseif ($param_len == 2) {
					# code...
					$table_name = $param[0];
					$data = $param[1];
					$condition = "";
					//echo "<br> select query with 2 param";			
					run_delete_query($table_name, $data, $condition);		

				} elseif ($param_len == 3) {
					# code...
					$table_name = $param[0];
					$data = $param[1];
					$condition = $param[2] ;
					//echo " <br> select query with 3 param";
					run_delete_query($table_name, $data, $condition);
					
				}
				
				} catch (Exception $e) {
					return $e; 	
				}
	}

	
	function run_delete_query($table_name, $data, $condition){
		try {
			$initial="DELETE ";

			$all_attribute=all_attribute($data);

			$cond = " WHERE ". $condition;
			if ($condition=="") {
				echo $query=$initial.$all_attribute.$table_name.";";
			}
			else{
				echo $query=$initial.$all_attribute.$table_name.$cond.";";
			} 


		} catch (Exception $e) {
			return $e; 	
		}
	}




?>