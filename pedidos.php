<?php
	include("config/db.php");

	// $sentenciaSQL = $conexion -> prepare("SELECT nombre FROM productos;");
	// $sentenciaSQL -> execute();	
	// $nombres = $sentenciaSQL -> fetchAll(PDO::FETCH_OBJ);
	// asort($nombres);
	// print_r($nombres);

	$sentenciaSQL = $conexion -> prepare("SELECT * FROM productos WHERE id_categoria <> 4 AND id_categoria <> 6 ORDER BY id_categoria ASC;");
	$sentenciaSQL -> execute();	
	$listaProductos = $sentenciaSQL -> fetchALL(PDO::FETCH_ASSOC);

  $sentencia = $conexion -> prepare("SELECT * FROM productos WHERE id_categoria=4");
  $sentencia -> execute();
  $listaGuarniciones = $sentencia -> fetchALL(PDO::FETCH_ASSOC);

	$sentencia1 = $conexion -> prepare("SELECT * FROM productos WHERE id_categoria=6");
  $sentencia1 -> execute();
  $listaSalsas = $sentencia1 -> fetchALL(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="css/style.css">
	    <!-- Fontawesome -->
	<link
		rel="stylesheet"
		href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
	/>

</head>
<body>
	<section id="pedidos">
		<nav>
			<ul>
				<li><a href="index.php"><img src="img/logo.png" alt="" class="logo" /></li></a>
				<div class="items-container">
					<li><a href="productos.php">Nuestros Platos</a></li>
					<li><a href="pedidos.php">Hacé tu pedido</a></li>
					<li>Packs</li>
					<li>Conocenos</li>
					<div class="cart-container">
						<a href="carrito.html"><i class="fa-solid fa-cart-shopping cart"></i></a>
						<span id="checkout"></span>
					</div>
				</div>
				<i class="fa-solid fa-bars barra"></i>
			</ul>
		</nav>

		<div class="table">
			<div class="table-header">
				<div class="header__item">Platos</div>
				<div class="header__item">Guarnición/Salsa</div>
				<div class="header__item">Precio</div>
				<div class="header__item">Sumar al carrito</div>
			</div>
			<div class="table-content">

				<?php foreach($listaProductos as $producto) { ?>
				<div class="table-row">
					<div class="table-data"><?php echo $producto["nombre"]; ?></div>
					<div class="table-data">
						<?php if($producto["id_categoria"] == 1 || $producto["id_categoria"] == 2) { ?>
							<select class="select-guarnicion" onchange="hola(this.options[this.selectedIndex].text, '<?php echo $producto['id']; ?>', this.options[this.selectedIndex].value)">
								<option selected>Elije</option>
              <?php foreach($listaGuarniciones as $guarnicion) { ?>
								<option value="<?php echo $guarnicion["precio"]; ?>"><?php echo $guarnicion["nombre"]; ?></option>
              <?php } ?>
							</select>
						<?php } else if($producto["id_categoria"] == 3){ ?>
							<select class="select-guarnicion" onchange="hola(this.options[this.selectedIndex].text, '<?php echo $producto['id']; ?>', this.options[this.selectedIndex].value)">
								<option selected>Elije</option>
							<?php foreach($listaSalsas as $salsa) { ?>
								<option value="<?php echo $salsa["precio"]; ?>"><?php echo $salsa["nombre"]; ?></option>
              <?php } ?>
							</select>
						<?php } ?>
					</div>
					<div class="table-data" id="<?php echo $producto['id']; ?>" data-precio = "<?php echo $producto['precio']; ?>"><?php echo $producto['precio']; ?></div>
					<div class="table-data"><button class="sumar" 
						onclick="add('<?php echo $producto['id']; ?>', '<?php echo $producto['nombre']; ?>', '<?php echo $producto['precio']; ?>', '<?php echo $producto['imagen']; ?>')">
						SUMAR</button></div>
				</div>
				<?php } ?>

				<!-- <div class="table-row">
					<div class="table-data">Lomo al Malbec</div>
					<div class="table-data">
						<select name="" id="">
							<option value="">Papas a las finas hierbas</option>
						</select>
					</div>
					<div class="table-data">1500</div>
					<div class="table-data"><button class="sumar"
						onclick="add(1, 'Lomo al Malbec', 1500, 'lomo.png')">SUMAR</button></div>
				</div>

				<div class="table-row">
					<div class="table-data">Ñoquis</div>
					<div class="table-data">
						<select name="" id="">
							<option value="">Bolognesa</option>
							<option value="">Blanca</option>
						</select>
					</div>
					<div class="table-data">1500</div>
					<div class="table-data"><button class="sumar"
						onclick="add(1, 'Lomo al Malbec', 1500, 'lomo.png')">SUMAR</button></div>
				</div>

				<div class="table-row">
					<div class="table-data">Guiso de lentejas</div>
					<div class="table-data"></div>
					<div class="table-data">1500</div>
					<div class="table-data"><button class="sumar"
						onclick="add(1, 'Lomo al Malbec', 1500, 'lomo.png')">SUMAR</button></div>
				</div> -->
			</div>
		</div>
		<div class="total-row">
			<p class="total-p">Total:</p>
		</div>
		</div>
	</section>
	<script src="js/main.js"></script>
</body>
</html>