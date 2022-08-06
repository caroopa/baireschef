<?php
	session_start();

	$detalle = $_GET["payment_id"];
	$_SESSION["sesion"]["detalle"] = $detalle;

	include("config/db.php");
	
	$nombre = $_SESSION["sesion"]["nombre"];
	$productos = $_SESSION["sesion"]["productos"];
	$direccion = $_SESSION["sesion"]["direccion"];
	$telefono = $_SESSION["sesion"]["telefono"];

	$sentenciaSQL = $conexion -> prepare("INSERT INTO compras (id, nombre, productos, direccion, telefono, detalle) 
	VALUES (NULL, '$nombre', '$productos', '$direccion', '$telefono', '$detalle');");
	$sentenciaSQL -> execute();
?>	

<?php	
	echo "<script>window.location.href='gEv872rmwd.php';</script>";
	die();
?>