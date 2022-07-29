<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Baires Chef</title>
	<link rel="stylesheet" href="css/style.css">
	<link
		rel="stylesheet"
		href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
	/>

</head>
<body>
	<section id="carrito">
		<nav>
			<ul>
				<li><a href="index.php"><img src="img/logo.png" alt="" class="logo" /></li></a>
				<div class="items-container">
					<li><a href="productos.php">Nuestros Platos</a></li>
					<li><a href="pedidos.php">Hacé tu pedido</a></li>
					<li>Packs</li>
					<li>Conocenos</li>
					<div class="cart-container">
						<i class="fa-solid fa-cart-shopping cart"></i>
					</div>
				</div>
				<i class="fa-solid fa-bars barra"></i>
			</ul>
		</nav>
		<div class="carrito" data-visible="true">
			<div class="carrito-titulo">
				<div class="cart-container">
					<i class="fa-solid fa-cart-shopping btn-cerrar"></i></>
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
	

	</section>
	<script src="js/main.js"></script>
</body>
</html>