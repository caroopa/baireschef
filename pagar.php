<?php 
	require "vendor/autoload.php";

  session_start();
  if(isset($_POST["btn-enviar-direccion"])) {
    $nombre = $_POST["nombre"] ." ". $_POST["apellido"];
    $direccion = $_POST["calle"] . " " . $_POST["numero"]. " ".$_POST["piso"]. " (".$_POST["localidadNombre"] .")";
    $telefono = $_POST["telefono"];
    $mail = $_POST["mail"];

    $_SESSION["sesion"]["nombre"] = $nombre;
    $_SESSION["sesion"]["direccion"] = $direccion;
    $_SESSION["sesion"]["telefono"] = $telefono;
    $_SESSION["sesion"]["total"] += $_REQUEST["localidad"];
    $_SESSION["sesion"]["mail"] = $mail;
  }
?>

<?php
	require "vendor/autoload.php";
	MercadoPago\SDK::setAccessToken("APP_USR-8648553591730493-080412-e88bb815cf49a8d6b161b1147bbb7b2b-64216401");

	$preference = new MercadoPago\Preference();
	$item = new MercadoPago\Item();

	$item->id = "0001";
	$item->title = $_SESSION["sesion"]["productos"];
	$item->quantity = 1;
	$item->unit_price = $_SESSION["sesion"]["total"];
	$item->currency_id = "AR";

	$preference->items = array($item);
	$preference->back_urls = array(
		"success" => "https://baireschef.com/success.php",
		"failure" => "https://baireschef.com/index.php"
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

    <section id="pagar">
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

      <div class="gracias">
        <h1>¡Gracias por tu pedido!</h1>
        <p>Total a pagar (subtotal + envío): $ <?php echo $_SESSION["sesion"]["total"]; ?></p>
        <p>Ahora, podés proceder a pagar con mercado pago.</p>
        <p>Si deseas hacerlo por transferencia o en efectivo, comunicate al Whatsapp.</p>
        <br>
        <button class="wsp-btn">Whatsapp</button>
        <div class="checkout-btn"></div>
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
		<script>
    // *-------------------MERCADO PAGO-------------------

    const mp = new MercadoPago("APP_USR-b38c8aeb-38ed-4d5a-8b8d-8888cdd29dd0", {
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
    <script>
      const wspBtn = document.querySelector(".wsp-btn");
      wspBtn.addEventListener("click", () => {
        window.location.href = "wsp-success.php";
      });</script>
		<script src="js/main.js"></script>
	</body>
</html>