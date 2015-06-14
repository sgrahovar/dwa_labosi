<?php

//$con = mysqli_connect('localhost', 'root', '123', 'dwa_labos');

$con = mysqli_connect('127.0.0.1', 'root', 'sanjin11', 'dwa_labos');

if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}	

mysqli_set_charset($con, "utf8");

?>