<?php 

require('mysqli_connect.php'); // Connect to the db.



//Documentation link
//www.https://exchangeratesapi.io/

//base currency is USD for comparison

//API Call for daily update, once initial fill has been done
$API_call = 'https://api.exchangeratesapi.io/latest?base=USD&symbols=AUD,CHF,CNY,INR,JPY,RUB,SEK,DKK,SGD,CAD,BRL,TRY,USD';

//=========================================================================================================

?>

<?php


		$curl = curl_init();
		curl_setopt_array($curl, 
		[
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $API_call
		]);
		
		$response = curl_exec($curl);
		curl_close($curl);
		
		
     	$response1 = json_decode($response, true);


     		$date = $response1['date'];
			$date = mysqli_real_escape_string($dbc,trim($date));


			$CHF = $response1['rates']['CHF'];
			$CHF = mysqli_real_escape_string($dbc,trim($CHF)); 


			$CAD = $response1['rates']['CAD'];
			$CAD = mysqli_real_escape_string($dbc,trim($CAD));


			$RUB = $response1['rates']['RUB'];
			$RUB = mysqli_real_escape_string($dbc,trim($RUB));			

			$DKK = $response1['rates']['DKK'];
			$DKK = mysqli_real_escape_string($dbc,trim($DKK));	

			$TRY = $response1['rates']['TRY'];
			$TRY = mysqli_real_escape_string($dbc,trim($TRY));	


			$CNY = $response1['rates']['CNY'];
			$CNY = mysqli_real_escape_string($dbc,trim($CNY));			

			$SEK=  $response1['rates']['SEK'];
			$SEK = mysqli_real_escape_string($dbc,trim($SEK));	

			$INR = $response1['rates']['INR'];
			$INR = mysqli_real_escape_string($dbc,trim($INR));	

			$USD = $response1['rates']['USD'];
			$USD = mysqli_real_escape_string($dbc,trim($USD));			

			$BRL = $response1['rates']['BRL'];
			$BRL = mysqli_real_escape_string($dbc,trim($BRL));	

			$SGD = $response1['rates']['SGD'];
			$SGD= mysqli_real_escape_string($dbc,trim($SGD));	

			$AUD = $response1['rates']['AUD'];
			$AUD = mysqli_real_escape_string($dbc,trim($AUD));			

			$JPY = $response1['rates']['JPY'];
			$JPY = mysqli_real_escape_string($dbc,trim($JPY));	


//===================================================================================================
	 		
			$table =  mysqli_real_escape_string($dbc,trim('currency_rates'));

//====================================================================================================
		
			$insert_this = "INSERT IGNORE INTO  
				$table (date, CHF, CAD, RUB, DKK, TRY , CNY, SEK, INR, USD, BRL, SGD, AUD, JPY)
				VALUES 
				      ('$date', $CHF, $CAD, $RUB, $DKK, $TRY , $CNY, $SEK, $INR, $USD, $BRL, $SGD, $AUD, $JPY)";

			$result = mysqli_query($dbc,$insert_this);


?>