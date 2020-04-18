<?php

require('mysqli_connect.php'); // Connect to the db.

$_symbol_oil = mysqli_real_escape_string($dbc,trim($_GET['_symbol_oil'])); 

if($_symbol_oil == 'brent')
{
	$_table = mysqli_real_escape_string($dbc,trim('oil_brent')); 
}

else if($_symbol_oil == 'wti')
{
	$_table = mysqli_real_escape_string($dbc,trim('oil_wti')); 
}

else
{
	exit("404 Error. Company input was not recognized.");	
}

//front-end will have calenders to support date choice
$_start_date = mysqli_real_escape_string($dbc,trim($_GET['_start_date'])); 
$_end_date  = mysqli_real_escape_string($dbc,trim($_GET['_end_date'])); 


$_start_date =  DATE($_start_date);
$_end_date = DATE($_end_date);

/*
		//Used for testing without website front-end

		$_table = mysqli_real_escape_string($dbc,trim('oil_wti')); 

		$_start_date = mysqli_real_escape_string($dbc,trim('2020-02-04')); 
		$_end_date  = mysqli_real_escape_string($dbc,trim('2020-02-10')); 


		$_start_date =  DATE($_start_date);
		$_end_date = DATE($_end_date);

*/


$pulled =  "SELECT * FROM $_table
			WHERE created_at BETWEEN '$_start_date' AND '$_end_date'";


$result = mysqli_query($dbc,$pulled);


while ($row = $result->fetch_assoc())  
{
	$dbdata[]=$row;
}

//encoding the SQL results, 
//converting it to JSON, and printing to screen

$json = json_encode($dbdata, JSON_PRETTY_PRINT);

$json = wordwrap($json,80);

printf("%s", $json);

?>