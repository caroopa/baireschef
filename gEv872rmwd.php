<?php	
  include("config/mail.php"); 
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
            <li>Packs</li>
            <li>Conocenos</li>
            <!-- <div class="cart-container">
              <i class="fa-solid fa-cart-shopping cart"></i>
            </div> -->
          </div>
          <i class="fa-solid fa-bars barra"></i>
        </ul>
      </nav>

      <div class="gracias">
        <h1>Pago completado.</h1>
      </div>

    </section>
    <script src="js/main2.js"></script>
	</body>
</html>