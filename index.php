<?php include("config/db.php"); ?>

<?php 
  $sentenciaSQL = $conexion -> prepare("SELECT * FROM productos");
  $sentenciaSQL -> execute();
  $listaProductos = $sentenciaSQL -> fetchALL(PDO::FETCH_ASSOC); 
?>

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

    <header>
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
      <div class="header-container">
        <div class="titulos">
          <h1>Deleitate en sólo</h1>
          <h3>15 minutos</h3class=>
          <h2>
            Contamos con más de 26 platos para que <br />
            disfrutes en la comodidad de tu hogar.
          </h2>
        </div>
        <button class="ver-mas">Ver más</button>
      </div>
    </header>

    <section id="video">
      <video autoplay muted loop> <source src = "img/comida.mp4" type = "video/mp4">
        Tu navegador no soporta el video</video>
    </section>

    <section id="seccionarda">

      <div class="main">
        <div class="producto">
          <img src="img/productos/lomo.png" alt="" class="img-producto">
          <p>Lomo al Malbec</p>
          <p class="italic">guarnición a elección</p>
          <!-- <button class="btn-seleccionar" onclick="abrirModal(1);">Seleccionar</button>  -->
        </div>
        <div class="producto">
          <img src="img/productos/noquis.png" alt="" class="img-producto">
          <p>Ñoquis</p> 
          <p class="italic">salsa a elección</p>
          <!-- <button class="btn-seleccionar" onclick="abrirModal(2);">Seleccionar</button>  -->
        </div>
        <div class="producto">
          <img src="img/productos/champi.png" alt="" class="img-producto">
          <p>Pollo al champiñón</p>
          <p class="italic">guarnición a elección</p>
          <!-- <button class="btn-seleccionar" onclick="abrirModal(3);">Seleccionar</button>  -->
        </div>
      </div>

      <div class="packs">
        <div class="packs-container">
          <h1>¡Resolvé tu semana <br> con nosotros!</h1>
          <button class="btn-packs">Conocé nuestros packs</button>
        </div>
        <img src="img/paquetes.png" alt="" class="paquetes">
      </div>

      <div class="instrucciones">
        <h1>Instrucciones</h1>
        <div class="instrucciones-container">
          <div class="card">
            <img src="img/instrucciones1.png" alt="" class="instrucciones-img">
            <p>Abrí el paquete y retirá <br> la bolsa interior</p>
          </div>
          <div class="card">
            <img src="img/instrucciones2.png" alt="" class="instrucciones-img">
            <p>Introducí la bolsa en agua <br> hirviendo y esperá el tiempo <br> indicado en la etiqueta <br>del producto</p>
          </div>
          <div class="card">
            <img src="img/instrucciones3.png" alt="" class="instrucciones-img">
            <p>Retirá la bolsa del hervor, <br> serví el contenido y disfrutá <br> una rica comida casera.
          </div>
        </div>
      </div>

			<div class="ventana-modal">
				<img src="img/lomo.png" alt="" class="img-modal">
				<div class="texto">
					<h1>Lomo al Malbec</h1>
					<p>Una propuesta diferente.</p>
					<div class="botones">
            <form action="" method="post">
                <input type="hidden" name="nombre" value="Lomo al Malbec">
                <input type="hidden" name="precio" value="1500">
                <input type="hidden" name="imagen" value="lomo.png">
                <button name="btn" value="agregar" type="submit" class="btn-agregar">1500$</button> 
            </form>
					</div>
					<p>Seleccioná la guarnición que más te guste, tu elección.</p>
					<div class="botones">
						<button class="lista btn-agregar">Puré de papas</button>
						<button class="btn-agregar">Agregar al carrito</button>
					</div>
				</div>
        <button class="btn-cerrar-ventana" onclick="cerrarModal(1)">X</button>
			</div>
      <div class="ventana-modal">
				<img src="img/noquis.png" alt="" class="img-modal">
				<div class="texto">
					<h1>Ñoquis</h1>
					<p>Una propuesta diferente.</p>
					<div class="botones">
            <form action="" method="post">
                <input type="hidden" name="nombre" value="Noquis">
                <input type="hidden" name="precio" value="1500">
                <input type="hidden" name="imagen" value="noquis.png">
                <button name="btn" value="agregar" type="submit" class="btn-agregar">1500$</button> 
            </form>
					</div>
					<p>Seleccioná la guarnición que más te guste, tu elección.</p>
					<div class="botones">
						<button class="lista btn-agregar">Puré de papas</button>
						<button class="btn-agregar" >Agregar al carrito</button>
					</div>
				</div>
        <button class="btn-cerrar-ventana" onclick="cerrarModal(2)">X</button>
			</div>
      <div class="ventana-modal">
				<img src="img/champi.png" alt="" class="img-modal">
				<div class="texto">
					<h1>Pollo al Champiñón</h1>
					<p>Una propuesta diferente.</p>
					<div class="botones">
            <form action="" method="post">
                <input type="hidden" name="nombre" value="Pollo al champignon">
                <input type="hidden" name="precio" value="1500">
                <input type="hidden" name="imagen" value="champi.png">
                <button name="btn" value="agregar" type="submit" class="btn-agregar">1500$</button> 
            </form>
					</div>
					<p>Seleccioná la guarnición que más te guste, tu elección.</p>
					<div class="botones">
						<button class="lista btn-agregar">Puré de papas</button>
						<button class="btn-agregar">Agregar al carrito</button>
					</div>
				</div>
        <button class="btn-cerrar-ventana" onclick="cerrarModal(3)">X</button>
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