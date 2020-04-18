<?php 


//Don't need a database in this case, but still there
//require('mysqli_connect.php'); // Connect to the db.


//API source
//https://iexcloud.io/

//This program can be used to make calls for three different company symbol stocks
//These 3 companies can be compared


//API base call for filling our stock calls
//xsymbolx and xtimex will be replaced with what was provided by the user...
//this will be done with string replace function
$API_base = "https://cloud.iexapis.com/v1/stock/xsymbolx/chart/xtimex/?token=pk_8172b2d33abb4ad1ab9e57a9391dcf01";
				   
                                                                                    
//IEX API token
//included above. It is limited each month, so try to limit use....for now....
//$token = 'pk_8172b2d33abb4ad1ab9e57a9391dcf01';

//====================================================================================================

$company1 = $_GET['_company1'] ; 
$company2 = $_GET['_company2'] ; 
$company3 = $_GET['_company3'] ; 


//end user will be provided a list of valid choices
$_time_back = $_GET['_time_back'] ; 



//for testing purpose...

//$company1 = "aapl" ; 
//$company2 = "googl" ; 
//$company3 = "rfem" ; 


//$_time_back = "3m" ; 


//=========================================================================================================

?>



<?php
	
//API call for company 1

if(isset($company1))
{

		$replace_symbol1 = str_replace("xsymbolx",$company1,$API_base);
		$replace_time1 = str_replace("xtimex",$_time_back,$replace_symbol1);

		$temp_API = $replace_time1;

		$curl = curl_init();
		curl_setopt_array($curl, 
		[
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $temp_API
		]);
		
		$response = curl_exec($curl);
		curl_close($curl);


		if($response == "You have exceeded your allotted message quota. Please enable pay-as-you-go to regain access")
		{
			return "expired_token";
		}

		printf("%s", $response);		

}

else
{
	echo "enter atleast 1 company";
	exit(1);

}

//API call for company 2		

if(isset($company2))
{
		$replace_symbol2 = str_replace("xsymbolx",$company2,$API_base);
		$replace_time2 = str_replace("xtimex",$_time_back,$replace_symbol2);


		$temp_API = $replace_time2;

		$curl = curl_init();
		curl_setopt_array($curl, 
		[
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $temp_API
		]);
		
		$response = curl_exec($curl);
		curl_close($curl);


		if($response == "You have exceeded your allotted message quota. Please enable pay-as-you-go to regain access")
		{
			return "expired_token";
		}		

		printf("%s", $response);		

}		

//API call for company 3

if(isset($company3))
{
		$replace_symbol3 = str_replace("xsymbolx",$company3,$API_base);
		$replace_time3 = str_replace("xtimex",$_time_back,$replace_symbol3);

		$temp_API = $replace_time3;

		$curl = curl_init();
		curl_setopt_array($curl, 
		[
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $temp_API
		]);
		
		$response = curl_exec($curl);
		curl_close($curl);


		if($response == "You have exceeded your allotted message quota. Please enable pay-as-you-go to regain access")
		{
			return "expired_token";
		}
		
		printf("%s", $response);


}
//============================================================================


//===========================================================================================
?>


