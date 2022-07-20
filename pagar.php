<?php 
	require "vendor/autoload.php";
	include("config/domicilio.php");

  session_start();
  if(isset($_POST["total"])) {
    $_SESSION["sesion"]["total"] = $_POST["total"];
    $_SESSION["sesion"]["productos"] = $_POST["productos"];
  }
?>

<?php
	require "vendor/autoload.php";
	MercadoPago\SDK::setAccessToken("TEST-1679717974175094-070717-9b1856b04e0e1d864603d21eaf212783-448338904");

	$preference = new MercadoPago\Preference();
	$item = new MercadoPago\Item();

	$item->id = "0001";
	$item->title = $_SESSION["sesion"]["productos"];
	$item->quantity = 1;
	$item->unit_price = $_SESSION["sesion"]["total"];
	$item->currency_id = "AR";

	$preference->items = array($item);
	$preference->back_urls = array(
		"success" => "http://localhost/baires/completado.php",
		"failure" => "http://localhost/baires/fallo.php"
	);
	$preference->auto_return = "approved";
	$preference->save();
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
		
    <div class="carrito" data-visible="false">
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
      <button class="pagar"><a href="pagar.php">FINALIZAR COMPRA</a></button>
    </div>

    <section id="productos">
      <nav>
        <ul>
          <li><a href="index.php"><img src="img/logo.png" alt="" class="logo" /></li></a>
          <div class="items-container">
            <li><a href="productos.php">Nuestros Platos</a></li>
            <li>Packs</li>
            <li>Conocenos</li>
            <li>Dónde estamos</li>
            <div class="cart-container">
              <i class="fa-solid fa-cart-shopping cart"></i>
            </div>
          </div>
          <i class="fa-solid fa-bars barra"></i>
        </ul>
      </nav>


		<!-- <p>¿Desea recibir envío a domicilio? Tiene un recargo de 100$.</p>
		<form action="pagar.php" method="post">
			<input type="hidden" name="nombre" value="Envío a domicilio">
			<input type="hidden" name="precio" value="100">
			<input type="hidden" name="imagen" value="">
			<button name="btn" value="agregar" type="submit" class="btn-agregar">Envío a domicilio</button> 
		</form>
		<form action="pagar.php" method="post">
			<input type="hidden" name="nombre" value="Sin envío a domicilio">
			<input type="hidden" name="precio" value="0">
			<input type="hidden" name="imagen" value="">
			<button name="btn" value="agregar" type="submit" class="btn-agregar">Sin envío a domicilio</button> 
		</form>

		<h1>Complete con su dirección</h1>
		<form action="" method="post">
			<input type="text" placeholder="Calle" name="calle">
			<input type="text" placeholder="Número" name="numero">
			<input type="text" placeholder="Piso y departamento (si es casa poner 'casa')." name="piso">
			<input type="text" placeholder="Localidad" name="localidad">
			<input type="text" placeholder="Entre Calles" name="calles">
			<button type="submit" name="btn-enviar-direccion">Enviar</button>
		</form> -->

    <div class="checkout-btn"></div>
		
		<script>
    // *-------------------MERCADO PAGO-------------------

    const mp = new MercadoPago("TEST-d278bc9c-11df-471b-8abe-bda7a6f1b308", {
      locale: "es-AR",
    });

    mp.checkout({
      preference: {
        id: "<?php echo $preference->id; ?>",
      },
      render: {
        container: ".checkout-btn",
        label: "Mercado Pago",
      },
    });

  </script>
		<script src="js/main.js"></script>
	</body>
</html>