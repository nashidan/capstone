<?php 
//documentation link
require('mysqli_connect.php'); // Connect to the db.



//AP source
//https://newsapi.org/

//API call for updating our News table 
//Update daily with 5 news stories
$API_call = 'https://newsapi.org/v2/top-headlines?category=business&country=us&pageSize=5&apiKey=f8f5634fce7543f6a591fb7628cd11b6';
				   
                                                                                    
//News API token
//token == f8f5634fce7543f6a591fb7628cd11b6

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


		foreach($response1['articles'] as $article)
		{


			$id = $article['source']['id'];
			$id = mysqli_real_escape_string($dbc,trim($id)); 


			$name = $article['source']['name'];
			$name = mysqli_real_escape_string($dbc,trim($name)); 


//=============================================================================			

			$author = $article['author'];
			$author = mysqli_real_escape_string($dbc,trim($author)); 


			$title = $article['title'];
			$title = mysqli_real_escape_string($dbc,trim($title)); 		

			$description = $article['description'];
			$description = mysqli_real_escape_string($dbc,trim($description));

			$url = $article['url'];
			$url = mysqli_real_escape_string($dbc,trim($url)); 		


			$urlToImage = $article['urlToImage'];
			$urlToImage = mysqli_real_escape_string($dbc,trim($urlToImage)); 			
	

			$publishedAt = $article['publishedAt'];
			$publishedAt = mysqli_real_escape_string($dbc,trim($publishedAt)); 			


			$content = $article['content'];
			$content = mysqli_real_escape_string($dbc,trim($content)); 


//===================================================================================================
	 		
			$table =  mysqli_real_escape_string($dbc,trim('news'));

//====================================================================================================
		
			$insert_this = "INSERT IGNORE INTO $table (id, name, author, title, description, url, urlToImage, publishedAt, content) 
							VALUES 
							('$id', '$name', '$author', '$title', '$description', '$url', '$urlToImage', DATE('$publishedAt') , '$content')";


			$result = mysqli_query($dbc,$insert_this);

		}

?>