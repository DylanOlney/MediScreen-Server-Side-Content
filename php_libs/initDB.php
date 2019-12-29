<?php 
 $db_name = "mediscreendb";  
 $mysql_user = "root";  
 $mysql_pass = "";  
 $server_name = "localhost";  
 $conn = mysqli_connect($server_name, $mysql_user, $mysql_pass, $db_name);  
 if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: ".mysqli_connect_error();
	die();
 }

 ?>
