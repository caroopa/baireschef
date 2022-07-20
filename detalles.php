<?php
	// require "config/config.php";
	require "config/db.php";

	$id = isset($_GET["id"]) ? $_GET["id"] : "";
	// $token = isset($_GET["token"]) ? $_GET["token"] : "";

	if($id == "" ) {
		echo "Error al procesar la petición.";
		exit;
	} else {

			$sql = $conexion -> prepare("SELECT count(id) FROM productos WHERE id=? AND activo=1");
			$sql -> execute([$id]);
			if($sql -> fetchColumn() > 0) {
				$sql = $conexion -> prepare("SELECT nombre, descripcion, precio, descuento FROM productos WHERE id=? AND activo=1");
				$sql -> execute([$id]);
				$row = $sql -> fetch(PDO::FETCH_ASSOC);
				$precio = $row["precio"];
				$descripcion = $row["descripcion"];
				$nombre = $row["nombre"];
				$descuento = $row["descuento"];
				$precio_desc = $precio - ($precio * $descuento) /100;

			}
		}
?>

<?php echo $nombre; ?>