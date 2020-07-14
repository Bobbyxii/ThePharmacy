<?php

	
// Start the session
session_start();


	$username = "mytechra_bobby";
	$password = "Bobbyxiiwork2624";
	$hostname = "localhost";
	
$link = mysqli_connect ($hostname, $username,$password,"mytechra_pharmacy");

if (!$link){
	die ('no connection:' .mysqli_error());
}

?>