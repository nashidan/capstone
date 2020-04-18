<?php


define('DB_USER', 'nashidan');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');
define('DB_NAME', 'capstone2020');

// Make the connection:
$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not connect to MySQL: ' . mysqli_connect_error() );

// Set the encoding...
mysqli_set_charset($dbc, 'utf8');

?>