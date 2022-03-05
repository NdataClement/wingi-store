<?php 
	$host ='localhost';
	$user='root';
	$pass='';
	$db_name='wingi';

	$con=new MySQLi($host,$user,$pass,$db_name);

	if($con->connect_error)
	{
	    die('Database connection error: ' . $con->connect_error);
	}
 ?>