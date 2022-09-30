<?php 
  session_start();
  if(isset($_POST["finalizar"])) {
    $_SESSION["sesion"]["total"] = $_POST["total"];
    $_SESSION["sesion"]["productos"] = $_POST["productos"];
  }

  if(isset($_POST["btn-cupon"])) {
    if($_POST["cupon"] == "HOLA") {
			$descuento = 0.8;
			$_SESSION["sesion"]["total"] -= $_SESSION["sesion"]["total"] * $descuento;
			$mensaje = "Cupón aceptado, se ha descontado " . $descuento*100 . "%.";
		}
		else if($_POST["cupon"] == "CHAU") {
			$descuento = 0.99;
			$_SESSION["sesion"]["total"] -= $_SESSION["sesion"]["total"] * $descuento;
			$mensaje = "Cupón aceptado, se ha descontado " . $descuento*100 . "%.";
		}
		else if($_POST["cupon"] == "BAIRES01") {
			$descuento = 0.3;
			$_SESSION["sesion"]["total"] -= $_SESSION["sesion"]["total"] * $descuento;
			$mensaje = "Cupón aceptado, se ha descontado " . $descuento*100 . "%.";
		}
		else {
			$mensaje = "Cupón inválido";
		}
  }

  include("config/db.php");
	$sentenciaSQL = $conexion -> prepare("SELECT * FROM localidades ORDER BY nombre ASC ");
	$sentenciaSQL -> execute();
	$listaLocalidades = $sentenciaSQL -> fetchALL(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Baires Chef</title>
    <link rel="stylesheet" href="css/style.css" />
		<script src="https://sdk.mercadopago.com/js/v2"></script>
		
    <!-- Fontawesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    />
  </head>
  <body>
		<section id="direccion">
			<nav>
				<ul>
					<li><a href="index.php"><img src="img/logo.png" alt="" class="logo" /></li></a>
					<div class="items-container">
						<li><a href="productos.php">Nuestros Platos</a></li>
						<li><a href="pedidos.php">Hacé tu pedido</a></li>
						<!-- <li>Packs</li>
						<li>Conocenos</li> -->
						<!-- <div class="cart-container">
							<i class="fa-solid fa-cart-shopping cart"></i>
						</div> -->
					</div>
					<i class="fa-solid fa-bars barra"></i>
				</ul>
			</nav>
			<div class="container-direccion">
				<div class="direccion">
					<h2 class="titulo-direccion">Dirección</h2>
					<div class="recuadro-direccion">
						<form action="pagar.php" method="post" class="form-direccion">
							<div class="container-input">
								<div class="container-2">
									<label for="">Nombre</label>
									<input type="text" name="nombre" required/>
								</div>
								<div class="container-2">
									<label for="">Apellido</label>
									<input type="text" name="apellido"/>
								</div>
							</div>
							<div class="container-2">
								<label for="">Teléfono</label>
								<input type="text" name="telefono" required/>
							</div>
							<div class="container-2">
								<label for="">Mail</label>
								<input type="text" name="mail" required/>
							</div>
							<div class="container-2">
								<label for="">Calle</label>
								<input type="text" name="calle" required/>
							</div>
							<div class="container-input">
								<div class="container-2">
									<label for="">Número</label>
									<input type="text" name="numero" required/>
								</div>
								<div class="container-2">
									<label for="">Dpto./Piso</label>
									<input type="text" name="piso" />
								</div>
							</div>
							<div class="container-2">
								<label for="">Localidad</label>
								<select name="localidad" id="localidad" required
									onchange="mostrarPrecio(this.options[this.selectedIndex].value, this.options[this.selectedIndex].text, '<?php echo $_SESSION['sesion']['total']; ?>')">
									<option value="" selected disabled>Elije</option>
									<?php foreach($listaLocalidades as $localidad) { ?>
										<option value="<?php echo $localidad["precio"]; ?>"><?php echo $localidad["nombre"]; ?></option>
									<?php	} ?>
								</select>
								<p id="mostrarPrecio"></p>
								<p>Por otras localidades poner "Otro" y consultar con el vendedor.</p>
							</div>
							<!-- <label for="partido">Partido</label>
							<select name="" for="partido" name="partido" class="partido">
								<option value="" selected>Elije un partido</option>
								<option value="">3 de Febrero</option>
								<option value="">San Martín</option>
							</select> -->
							<input type="hidden" name="localidadNombre" id="caja-localidad" value="">
							<button
								type="submit"
								name="btn-enviar-direccion"
								class="btn-direccion"
							>
								Continuar
							</button>
						</form>
					</div>
				</div>

				<div class="descuento">
					<h2 class="titulo-direccion">Cupón de descuento</h2>
					<div class="recuadro-descuento">
						<form action="" method="post">
							<div class="container-2">
								<label for="">Cupón</label>
								<input type="text" name="cupon">
							</div>
							<p>Subtotal: $<?php echo $_SESSION["sesion"]["total"]; ?></p>
							<button type="submit" name="btn-cupon" class="btn-cupon">Descontar</button>
						</form>
						<p><?php if(isset($_POST["btn-cupon"])) {
							echo $mensaje;
						} ?></p>
					</div>
					<div class="recuadro-total">
						<h2>Total</h2>
						<h1 id="total"></h1>
					</div>
					<div class="programados">
						<p>Los envíos son programados los viernes (zona Norte y Oeste) y sábados (CABA y zona Sur).</p>
					</div>

				</div>

			<div class="productos">
				<h2 class="titulo-direccion">Productos</h2>
					<div class="lista-carrito"></div>
			</div>


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
		
		<script src="js/main1.js"></script>
	</body>
</html>