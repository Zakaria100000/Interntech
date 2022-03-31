<?php 
$db_server = 'localhost'; 
$db_name = 'interntech'; 
$db_user = 'root'; 
$db_password = ''; 

$conn = mysqli_connect($db_server, $db_user, $db_password, $db_name); 
if (!$conn) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}