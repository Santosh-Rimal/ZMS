<?php

session_start();

define('SITEURL', 'http://localhost/zms/');
define ('LOCALHOST', 'localhost');
define ('DB_USERNAME', 'root');
define ('DB_PASSWORD', '');
define ('DB_NAME' ,'zoo-management');

// database connection
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); 

// select database
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
?>