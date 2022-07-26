<?php 
	require "vendor/autoload.php";

  session_start();
  if(isset($_POST["btn-enviar-direccion"])) {
    $nombre = $_POST["nombre"] ." ". $_POST["apellido"];
    $direccion = $_POST["calle"] . " " . $_POST["numero"]. " ".$_POST["piso"]. " (".$_POST["localidad"] .")";
    // $direccion .= " " . $_POST["partido"];

    $_SESSION["sesion"]["nombre"] = $nombre;
    $_SESSION["sesion"]["direccion"] = $direccion;
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