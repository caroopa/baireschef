<?php
	$host = "localhost";
	$bd = "baires";
	$user = "root";
	$password = "";

	try {
		$conexion = new PDO("mysql:host=$host;dbname=$bd",$user,$password);
	} catch (Exception $ex) {
		echo $ex -> getMessage(); 
	}
?>