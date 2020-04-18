<?php


require('mysqli_connect.php'); // Connect to the db.


//front-end will have calenders to support date choice


$_start_date = mysqli_real_escape_string($dbc,trim($_GET['_start_date'])); 
$_end_date  = mysqli_real_escape_string($dbc,trim($_GET['_end_date'])); 


$_start_date =  DATE($_start_date);
$_end_date = DATE($_end_date);



/*

		//Used for testing without website front-end

		$_start_date = mysqli_real_escape_string($dbc,trim('2020-02-04')); 
		$_end_date  = mysqli_real_escape_string($dbc,trim('2020-02-10')); 


		$_start_date =  DATE($_start_date);
		$_end_date = DATE($_end_date);

		$_symbol1 = mysqli_real_escape_string($dbc,trim('CHF'));
		$_symbol2 = mysqli_real_escape_string($dbc,trim('CAD'));
		$_symbol3 = mysqli_real_escape_string($dbc,trim('RUB'));
		$_symbol4 = mysqli_real_escape_string($dbc,trim('DKK'));


		$_GET = array($_start_date, $_end_date, $_symbol1, $_symbol2, $_symbol3, $_symbol4);


*/


//iterating through the query parameters


foreach($_GET as $query_string_variable => $_symbol_)
{

	$_symbol_ =  mysqli_real_escape_string($dbc,$_symbol_); 


	//need to add another condition to grab HTML submit info...
	//Make it eqaul to form input Value, at the bottom of html form
	//it is what the gray box says, before clicking...
	if($_symbol_ == $_start_date || $_symbol_ == $_end_date)
	{
		continue;
	}


	$pulled =  "SELECT date, $_symbol_ FROM currency_rates 
				WHERE date BETWEEN '$_start_date' AND '$_end_date'";
				//ORDER BY date ASC";


	$result = mysqli_query($dbc,$pulled);



	while ($row = $result->fetch_assoc())  
	{
		$dbdata[]=$row;
	}

}

//After the loop...
//encoding the SQL results, 
//converting it to JSON, and printing to screen


$json = json_encode($dbdata, JSON_PRETTY_PRINT);

$json = wordwrap($json,80);

printf("%s", $json);

?>