<?php
	session_start();
	include("config/db.php");
	
	$nombre = $_SESSION["sesion"]["nombre"];
	$productos = $_SESSION["sesion"]["productos"];
	$direccion = $_SESSION["sesion"]["direccion"];
	$telefono = $_SESSION["sesion"]["telefono"];

	if ($nombre != "" and $productos != "" and $telefono != "" and $direccion != "") {
		$sentenciaSQL = $conexion -> prepare("INSERT INTO compras (id, nombre, productos, direccion, telefono, detalle, efectivo) 
		VALUES (NULL, '$nombre', '$productos', '$direccion', '$telefono', '0', 'Sí');");
		$sentenciaSQL -> execute();

		include("config/mail.php");
	}
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
	<script>localStorage.removeItem("productos");</script>
</body>
</html>

<?php	
	session_unset();
	session_destroy();
	echo "<script>window.location.href='https://api.whatsapp.com/send?phone=5491127276893';</script>";
	die();
?>