<?php
	session_start();

	$detalle = $_GET["payment_id"];
	$_SESSION["sesion"]["detalle"] = $detalle;

	include("config/db.php");
	
	$nombre = $_SESSION["sesion"]["nombre"];
	$productos = $_SESSION["sesion"]["productos"];
	$direccion = $_SESSION["sesion"]["direccion"];
	$telefono = $_SESSION["sesion"]["telefono"];

	if ($nombre != "" and $productos != "" and $telefono != "") {
		$sentenciaSQL = $conexion -> prepare("INSERT INTO compras (id, nombre, productos, direccion, telefono, detalle) 
		VALUES (NULL, '$nombre', '$productos', '$direccion', '$telefono', '$detalle');");
		$sentenciaSQL -> execute();

		include("config/mail.php");
	}
?>

<?php	
	session_unset();
	session_destroy();
	echo "<script>window.location.href='index.php';</script>";
	die();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<script src="js/main2.js"></script>
</body>
</html>l