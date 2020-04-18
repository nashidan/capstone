<?php 

require('mysqli_connect.php'); // Connect to the db.

//Documentation link
//www.https://exchangeratesapi.io/

//base currency is USD for comparison

//API call for getting many years of data.
$API_call = 
'https://api.exchangeratesapi.io/history?start_at=2009-01-01&end_at=2020-02-10&symbols=AUD,CHF,CNY,INR,JPY,RUB,SEK,DKK,SGD,CAD,BRL,TRY,USD&base=USD';
//can change start here^^^^
//can make this call go back over 10 years!!!


//API Call for daily update, once initial fill has been done
//$API_call = 'https://api.exchangeratesapi.io/latest?base=USD&symbols=AUD,CHF,CNY,INR,JPY,RUB,SEK,DKK,SGD,CAD,BRL,TRY,USD';

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

		foreach($response1['rates'] as $date => $response)
		{


			$date = mysqli_real_escape_string($dbc,trim($date)); 

			$CHF = $response['CHF'];
			$CHF = mysqli_real_escape_string($dbc,trim($CHF)); 


			$CAD = $response['CAD'];
			$CAD = mysqli_real_escape_string($dbc,trim($CAD));

			$RUB = $response['RUB'];
			$RUB = mysqli_real_escape_string($dbc,trim($RUB));			

			$DKK = $response['DKK'];
			$DKK = mysqli_real_escape_string($dbc,trim($DKK));	

			$TRY = $response['TRY'];
			$TRY = mysqli_real_escape_string($dbc,trim($TRY));	


			$CNY = $response['CNY'];
			$CNY = mysqli_real_escape_string($dbc,trim($CNY));			

			$SEK= $response['SEK'];
			$SEK = mysqli_real_escape_string($dbc,trim($SEK));	

			$INR = $response['INR'];
			$INR = mysqli_real_escape_string($dbc,trim($INR));	


			$USD = $response['USD'];
			$USD = mysqli_real_escape_string($dbc,trim($USD));			

			$BRL = $response['BRL'];
			$BRL = mysqli_real_escape_string($dbc,trim($BRL));	

			$SGD = $response['SGD'];
			$SGD= mysqli_real_escape_string($dbc,trim($SGD));	

			$AUD = $response['AUD'];
			$AUD = mysqli_real_escape_string($dbc,trim($AUD));			

			$JPY = $response['JPY'];
			$JPY = mysqli_real_escape_string($dbc,trim($JPY));	


//===================================================================================================
	 		
			$table =  mysqli_real_escape_string($dbc,trim('currency_rates'));

//====================================================================================================
		
			$insert_this = "INSERT IGNORE INTO  
				$table (date, CHF, CAD, RUB, DKK, TRY , CNY, SEK, INR, USD, BRL, SGD, AUD, JPY)
				VALUES 
				      ('$date', $CHF, $CAD, $RUB, $DKK, $TRY , $CNY, $SEK, $INR, $USD, $BRL, $SGD, $AUD, $JPY)";

			$result = mysqli_query($dbc,$insert_this);

		}

?>