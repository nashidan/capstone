<?php

require('mysqli_connect.php'); // Connect to the db.


$amount = mysqli_real_escape_string($dbc,trim($_GET['_amount'])); 



if($amount > 10 || $amount < 1)
{
	exit("404 Error. Amount entered is not in range of  1 between 10 (inclusive).");
}


$sql = "SELECT * FROM news ORDER BY publishedAt DESC LIMIT $amount";


$result = mysqli_query($dbc,$sql);


///checking for final errors
if(!($result))
{ 
	
	echo '<h1>System Error</h1>
	<p class="error">You could not be updated due to a system error. 
	We apologize for any inconvenience.</p>';

	echo '<p>' . mysqli_error($dbc) . '<br><br>Query: ' . $q . '</p>';
} 



while ($row = $result->fetch_assoc())  
{
	$dbdata[]=$row;
}

//turning it into JSON, and wordwrapping it, so it doesn't go far off screen....

$json = json_encode($dbdata, JSON_PRETTY_PRINT);

$json = wordwrap($json,50 );

printf("%s", $json);


?>