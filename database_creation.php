

<?php
//database calling====================================================================================


define('DB_HOST', 'localhost');

// Make the connection:
$dbc = @mysqli_connect(DB_HOST) OR die('Could not connect to MySQL: ' . mysqli_connect_error() );

// Set the encoding...
mysqli_set_charset($dbc, 'utf8');



//creating a user, nashidan
//========================================================================================================


$sql = "CREATE USER \'nashidan\'@\'%\' IDENTIFIED VIA mysql_native_password USING \'***\'GRANT SELECT, INSERT, UPDATE, DELETE, FILE ON *.* TO \'nashidan\'@\'%\' 
	REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0";

if (mysqli_query($dbc, $sql))
{
    echo "User created";
} 
else 
{
    echo "Error creating user. Possibly exists aleady: " . mysqli_error($conn);
}



// Creating a database named capstone2020
//=====================================================================================

$sql = "CREATE DATABASE IF NOT EXISTS capstone2020";


if (mysqli_query($dbc, $sql))
{
    echo "Database created successfully with the name capstone2020";
} 
else 
{
    echo "Error creating database. Possibly exists aleady: " . mysqli_error($conn);
}



define('DB_USER', 'nashidan');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');
define('DB_NAME', 'capstone2020');

// Make the connection:
$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not connect to MySQL: ' . mysqli_connect_error() );

// Set the encoding...
mysqli_set_charset($dbc, 'utf8');

//Creating our currencies table
//====================================================================================



$sql = "CREATE TABLE IF NOT EXISTS `currency_rates` (
  `row_id` int(7) NOT NULL,
  `date` date NOT NULL,
  `CHF` float NOT NULL,
  `CAD` float NOT NULL,
  `RUB` float NOT NULL,
  `DKK` float NOT NULL,
  `TRY` float NOT NULL,
  `CNY` float NOT NULL,
  `SEK` float NOT NULL,
  `INR` float NOT NULL,
  `USD` float NOT NULL,
  `BRL` float NOT NULL,
  `SGD` float NOT NULL,
  `AUD` float NOT NULL,
  `JPY` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"


if (mysqli_query($dbc, $sql))
{
    echo "currency table created";
} 
else 
{
    echo "Error creating table. Possibly exists aleady: " . mysqli_error($conn);
}


//creating our news table
//=====================================================================================

$sql = "CREATE TABLE IF NOT EXISTS `news` (
  `row_id` int(7) NOT NULL,
  `id` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `author` varchar(300) DEFAULT NULL,
  `title` varchar(300) DEFAULT NULL,
  `description` varchar(400) DEFAULT NULL,
  `url` varchar(300) DEFAULT NULL,
  `urlToImage` varchar(300) DEFAULT NULL,
  `publishedAt` varchar(200) DEFAULT NULL,
  `content` varchar(600) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"


if (mysqli_query($dbc, $sql))
{
    echo "news table created";
} 
else 
{
    echo "Error creating table. Possibly exists aleady: " . mysqli_error($conn);
}



//creating our oil rates tables
//===================================================================================


//====Oil Brent========================================

$sql = "CREATE TABLE `oil_brent` (
  `row_id` int(16) NOT NULL,
  `price` float NOT NULL,
  `formatted` varchar(20) NOT NULL,
  `currency` varchar(20) NOT NULL,
  `code` varchar(25) NOT NULL,
  `created_at` date NOT NULL,
  `type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4; "



if (mysqli_query($dbc, $sql))
{
    echo "oil brent created";
} 
else 
{
    echo "Error creating table. Possibly exists aleady: " . mysqli_error($conn);
}



//===Oil WTI=================================================



$sql = "CREATE TABLE `oil_wti` (
  `row_id` int(16) NOT NULL,
  `price` float NOT NULL,
  `formatted` varchar(20) NOT NULL,
  `currency` varchar(20) NOT NULL,
  `code` varchar(25) NOT NULL,
  `created_at` varchar(40) NOT NULL,
  `type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"



if (mysqli_query($dbc, $sql))
{
    echo "oil wti created";
} 
else 
{
    echo "Error creating table. Possibly exists aleady: " . mysqli_error($conn);
}


//closing the database
//===============================================================================

mysqli_close($dbc);


?>





