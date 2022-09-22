<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Baires Chef</title>

    <!-- Fontawesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    />
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <a href="https://api.whatsapp.com/send?phone=5491127276893" class="btn-wsp" target="_blank">
      <i class="fa-brands fa-whatsapp wsp"></i>
    </a>

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
