<?php
error_reporting(0);
					$server_name='localhost';
					$user_name='india_master';
					$password='Apiece_1000';
					$database_name='master';
					$con=mysql_connect($server_name,$user_name,$password) or die('Server Not Found!!!'.mysql_error());
					mysql_select_db($database_name) or die('Database Not Found!!!'.mysql_error());
?>
