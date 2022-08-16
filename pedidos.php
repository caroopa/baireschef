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

  $sentencia = $conexion -> prepare("SELECT * FROM productos WHERE id_categoria=4 AND activo=1");
  $sentencia -> execute();
  $listaGuarniciones = $sentencia -> fetchALL(PDO::FETCH_ASSOC);

	$sentencia1 = $conexion -> prepare("SELECT * FROM productos WHERE id_categoria=6 AND activo=1");
  $sentencia1 -> execute();
  $listaSalsas = $sentencia1 -> fetchALL(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
	<title>Baires Chef</title>
	<link rel="stylesheet" href="css/style.css">
	    <!-- Fontawesome -->
	<link
		rel="stylesheet"
		href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
	/>

</head>
<body>
	<!-- <a href="https://api.whatsapp.com/send?phone=5491127276893" class="btn-wsp" target="_blank">
		<i class="fa-brands fa-whatsapp wsp"></i>
	</a> -->

  <div class="carrito" data-visible="false">
    <div class="carrito-titulo">
      <div class="cart-container">
        <i class="fa-solid fa-circle-xmark btn-cerrar"></i></>
      </div>
      <p class="titulo">Carrito de compras</p>
    </div>
    <div class="container-carrito"></div>
    <div class="total">
      <p class="precio-total">Subtotal:</p>
      <p class="totall"></p>
    </div>
    <form action="direccion.php" method="POST">
      <input type="hidden" name="total" id="caja-total" value="" >
      <input type="hidden" name="productos" id="caja-productos" value="">
      <button class="pagar" name="finalizar">FINALIZAR COMPRA</button>
    </form>
  </div>

	<section id="pedidos">
		<nav>
			<ul>
				<li><a href="index.php"><img src="img/logo.png" alt="" class="logo" /></li></a>
				<div class="items-container">
					<li><a href="productos.php">Nuestros Platos</a></li>
					<li><a href="pedidos.php">Hacé tu pedido</a></li>
					<li>Packs</li>
					<li>Conocenos</li>
				</div>
				<i class="fa-solid fa-bars barra"></i>
				<div class="cart-container">
						<i class="fa-solid fa-cart-shopping cart"></i>
						<span id="checkout"></span>
				</div>
			</ul>
		</nav>

		<!-- <p id="obligatorio">Para las proteínas es obligatorio el agregado de una guarnición, y para las pastas una salsa.
		</p> -->

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
								<option value="" selected disabled="disabled">Elije</option>
              <?php foreach($listaGuarniciones as $guarnicion) { ?>
								<option value="<?php echo $guarnicion["precio"]; ?>"><?php echo $guarnicion["nombre"]; ?></option>
              <?php } ?>
							</select>
						<?php } else if($producto["id_categoria"] == 3){ ?>
							<select class="select-guarnicion" onchange="hola(this.options[this.selectedIndex].text, '<?php echo $producto['id']; ?>', this.options[this.selectedIndex].value)">
								<option value="" selected disabled="disabled">Elije</option>
							<?php foreach($listaSalsas as $salsa) { ?>
								<option value="<?php echo $salsa["precio"]; ?>"><?php echo $salsa["nombre"]; ?></option>
              <?php } ?>
							</select>
						<?php } ?>
					</div>
					<div class="table-data" id="<?php echo $producto['id']; ?>" data-precio = "<?php echo $producto['precio']; ?>"><?php echo $producto['precio']; ?></div>
					<div class="table-data"> 
					<?php if ($producto["activo"] == 1) { ?>
						<button class="sumar"
						onclick="add('<?php echo $producto['id']; ?>', '<?php echo $producto['nombre']; ?>', '<?php echo $producto['precio']; ?>', '<?php echo $producto['imagen']; ?>', '<?php echo $producto['id_categoria']; ?>')">
						SUMAR</button>
					<?php } else { ?>
						<button class="sin-stock" disabled>SIN STOCK</button>
					<?php } ?>
					</div>
				</div>
				<?php } ?>
				</div>
			</div>
		<!-- <div class="total-row">
			<p class="total-p">Total:</p>
		</div> -->
		</div>
		<footer>
			<img src="img/logo.png" alt="" class="logo2">
			<div class="v-line"></div>
			<div class="footer-container">
				<img src="img/iconos.png" alt="" class="iconos">
				<div class="nombres">
					<p>baireschefok@gmail.com</p>
					<p>+549112727-6893</p>
					<a href="https://www.instagram.com/baireschefok/"><p>BairesChefOK</p></a>
				</div>
			</div>
		</footer>
	</section>
	<script src="js/main.js"></script>
</body>
</html>