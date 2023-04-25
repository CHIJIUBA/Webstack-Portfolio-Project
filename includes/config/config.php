<?php
session_start();
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'');
define('DB_NAME', 'flutterwave');

$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME); 

if(mysqli_connect_errno()) 
{
	echo "Failed to connect: " . mysqli_connect_errno();
}
?>
