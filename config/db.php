<?php
	$host = "localhost";
	$bd = "c1961260_baires";
	$user = "c1961260_baires";
	$password = "kanopi36FU";
	
	try {
		$conexion = new PDO("mysql:host=$host;dbname=$bd",$user,$password);
	} catch (Exception $ex) {
		echo $ex -> getMessage(); 
	}
?>