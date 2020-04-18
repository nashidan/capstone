<?php 

require('mysqli_connect.php'); // Connect to the db.

/*

	API source
	https://www.oilpriceapi.com/

	API call for filling our Oil Brent table and Oil WTI
	These are two, among many, classifications of Oil that we will mine data from
	-WTI, which is sourced from Oklahoma
	0Brent, which is sourced from near the United Kingdom


	After filling our tables, we can use another program to support daily updates.
	These daily programs can be automated with Linux or Windows Task Scheduler.


	Base API call, that will modified with string replace.
	Our API source has different amounts of daily data for Brent and WTI
	Thuse, page number (at the end) has to be altered.

	
	Oil API token used in HTTP Request Header
	token == Token 8b3df4ab0b54394df588f3015daa7f77

*/

$API_base = 'https://api.oilpriceapi.com/v1/prices?by_code=xoil_codex&by_type=daily_average_price&page=xnumx';


//Array of our Oil Classifications, to be used with string replace
$oil_code = ['BRENT_CRUDE_USD','WTI_USD'];


//=========================================================================================================

?>


<?php

/* 
	In this function, here now, we make our HTTP call.
    it calls upon our altered API URL, and our headers above.
    It returns the JSON to the function caller below.

*/

	function fetch_json($API_base)
	{

		/*
		     This API requires use of headers in the request.
		     We keep it in this array, to call upon below
		*/

		$API_headers = 
    	   array(
	 	   			 'Content-Type: application/json',
	     		     'Authorization: Token 8b3df4ab0b54394df588f3015daa7f77'       
		  	    );


		$curl = curl_init();

		curl_setopt_array($curl, 
		[
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_HTTPHEADER => $API_headers ,
			CURLOPT_URL => $API_base
		]);
		
	
		$response = curl_exec($curl);

		curl_close($curl);
				
     	return json_decode($response, true);

	}
	

/*

	here, we pass our base API URL to swap oil classification call
    As it is the innner function, below, it is the one called first

*/

	function build_url($API_base,$oil_code,$page_num)
	{
		$replace_oil_code = str_replace("xoil_codex",$oil_code,$API_base);
		$replace_page_num =  str_replace("xnumx",$page_num,$replace_oil_code);

		$new_URL = $replace_page_num;

		return $new_URL;
	}


//==========================================================================================================
?>


<?php

	//going through the oil classification-code array
	for($a = 0 ;  $a < count($oil_code) ; $a++ )
	{

		/*  
			The response will be paginated, so despited around 8,500 results
			It will be divided into pages of 100.
			Below, we are going through the page numbers, as each page holds 100 results
		    brent has many, many pages. WTI has few pages.
		    Thus, different page ranges in use for our API calls.

		*/

		$pageNum = [85, 2];

		for($page = 1; $page <=  $pageNum[$a] ; $page++)
		{
				$response1 = fetch_json(build_url($API_base , $oil_code[$a] , $page));

				if($response1 <> 'expired_token')
				 {
					foreach($response1['data']['prices'] as $day => $response)
					{

							$price = $response['price'];
							$price = mysqli_real_escape_string($dbc,trim($price)); 

							$formatted = $response['formatted'];
							$formatted = mysqli_real_escape_string($dbc,trim($formatted));

							$currency = $response['currency'];
							$currency = mysqli_real_escape_string($dbc,trim($currency));


							$code = $response['code'];
							$code = mysqli_real_escape_string($dbc,trim($code));	


							$created_at = $response['created_at'];
							$created_at = mysqli_real_escape_string($dbc,trim($created_at));


							$type = $response['type'];
							$type = mysqli_real_escape_string($dbc,trim($type));	


							$oil_table = ['oil_brent', 'oil_wti'];
							$table =  mysqli_real_escape_string($dbc,trim($oil_table[$a]));


							$insert_this = "INSERT IGNORE INTO $table (price, formatted, currency, code, created_at, type) 
											VALUES 
											('$price', '$formatted', '$currency', '$code', DATE('$created_at'), '$type')";


							$result = mysqli_query($dbc,$insert_this);
			
					}
				}



			else 
			{
				//If token is all used up, display that message to screen.
				echo $response;
				break;
			}
		}
	
	}

?>