<?php 
  include("config/db.php");

  $filtro = "0";
  if(isset($_POST["btn-filtro"])) {
    $filtro = $_POST["btn-filtro"];
  }
  
  if($filtro == "0") {
    $sentenciaSQL = $conexion -> prepare("SELECT * FROM productos ORDER BY id_categoria ASC ");
    $sentenciaSQL -> execute();
    $listaProductos = $sentenciaSQL -> fetchALL(PDO::FETCH_ASSOC);
  }
  else {
    $sentenciaSQL = $conexion -> prepare("SELECT * FROM productos WHERE id_categoria=:filtro;");
    $sentenciaSQL -> bindParam(":filtro", $filtro);
    $sentenciaSQL -> execute();
    $listaProductos = $sentenciaSQL -> fetchALL(PDO::FETCH_ASSOC);
  }

  $sentencia = $conexion -> prepare("SELECT * FROM productos WHERE id_categoria=4");
  $sentencia -> execute();
  $listaGuarniciones = $sentencia -> fetchALL(PDO::FETCH_ASSOC);

	$sentencia1 = $conexion -> prepare("SELECT * FROM productos WHERE id_categoria=6 AND activo=1");
  $sentencia1 -> execute();
  $listaSalsas = $sentencia1 -> fetchALL(PDO::FETCH_ASSOC);
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

  <section id="productos">
      <nav>
        <ul>
          <li><a href="index.php"><img src="img/logo.png" alt="" class="logo" /></li></a>
          <div class="items-container">
            <li><a href="productos.php">Nuestros Platos</a></li>
            <li><a href="pedidos.php">Hacé tu pedido</a></li>
            <!-- <li>Packs</li>
            <li>Conocenos</li> -->
          </div>
          <i class="fa-solid fa-bars barra"></i>
          <div class="cart-container">
              <i class="fa-solid fa-cart-shopping cart"></i>
              <span id="checkout"></span>
          </div>
        </ul>
      </nav>

      <div class="notificacion">
        <i class="fa-solid fa-circle-check"></i>
        <p>El producto ha sido agregado.</p>
        <div class="btn-cerrar-noti">
          <i class="fa-solid fa-circle-xmark"></i></>
        </div>
      </div>

			<div class="productos-container">
				<div class="filtro">
					<p class="subrayado"><u>Filtros</u></p>
          <form action="productos.php" method="POST">
            <button type="submit" name="btn-filtro" value="0" class="btn-filtro">Todo</button>
          </form>
					<form action="productos.php" method="POST">
            <button type="submit" name="btn-filtro" value="1" class="btn-filtro">Carnes</button>
          </form>
					<form action="productos.php" method="POST">
            <button type="submit" name="btn-filtro" value="2" class="btn-filtro">Pollos</button>
          </form>
          <form action="productos.php" method="POST">
            <button type="submit" name="btn-filtro" value="3" class="btn-filtro">Pastas</button>
          </form>
					<form action="productos.php" method="POST">
            <button type="submit" name="btn-filtro" value="5" class="btn-filtro">Guisos</button>
          </form>
					<form action="productos.php" method="POST">
            <button type="submit" name="btn-filtro" value="4" class="btn-filtro">Guarniciones</button>
          </form>
          <form action="productos.php" method="POST">
            <button type="submit" name="btn-filtro" value="6" class="btn-filtro">Salsas</button>
          </form>
				</div>
				<div class="main separacion">
				<?php foreach($listaProductos as $producto) { ?>
            <div class="producto">
              <img src="img/productos/<?php echo $producto["imagen"]; ?>" alt="" class="img-producto">
              <p><?php echo $producto['nombre']; ?></p>
              <p>$<?php echo $producto['precio_base']; ?></p>
              <?php if($producto["id_categoria"] == "1" or $producto["id_categoria"] == "2") { ?>
                <p class="italic">guarnición a elección</p>
              <?php } else if($producto["id_categoria"] == "3") { ?>
                <p class="italic">salsa a elección</p>
              <?php } ?>
              <div class="agregar">
                <?php if ($producto["activo"] == 1) {
                  if ($producto['id_categoria'] != 4 and $producto['id_categoria'] != 6) { ?>
                  <button class="btn-sumar"
                  onclick="add('<?php echo $producto['id']; ?>', '<?php echo $producto['nombre']; ?>', '<?php echo $producto['precio']; ?>', '<?php echo $producto['imagen']; ?>', '<?php echo $producto['id_categoria']; ?>')">
                  Sumar al carrito</button>
                <?php }
                  } else { ?>
                  <button class="sin-stock" disabled>SIN STOCK</button>
                <?php } ?>
              </div>
              <div class="guarniciones">
                <?php if($producto["id_categoria"] == 1 || $producto["id_categoria"] == 2) { ?>
                  <select class="select-guarnicion2" onchange="hola(this.options[this.selectedIndex].text, '<?php echo $producto['id']; ?>', this.options[this.selectedIndex].value)">
                    <option value="" selected disabled="disabled">Elije</option>
                  <?php foreach($listaGuarniciones as $guarnicion) { ?>
                    <option value="<?php echo $guarnicion["precio"]; ?>"><?php echo $guarnicion["nombre"]; ?></option>
                  <?php } ?>
                  </select>
                <?php } else if($producto["id_categoria"] == 3){ ?>
                  <select class="select-guarnicion2" onchange="hola(this.options[this.selectedIndex].text, '<?php echo $producto['id']; ?>', this.options[this.selectedIndex].value)">
                    <option value="" selected disabled="disabled">Elije</option>
                  <?php foreach($listaSalsas as $salsa) { ?>
                    <option value="<?php echo $salsa["precio"]; ?>"><?php echo $salsa["nombre"]; ?></option>
                  <?php } ?>
                  </select>
                <?php } ?>
              </div>
              <!-- <button class="btn-seleccionar" onclick="abrirModal(<?php echo $producto['id']; ?>)">Información</button>  -->
              <a href="detalle.php?id=<?php echo $producto["id"]; ?>"><button class="btn-seleccionar">Ver detalles</button></a>
            </div>
				<?php } ?>
				</div>
			</div>

			<?php foreach($listaProductos as $producto) { ?>
				<!-- <div class="ventana-modal">
					<img src="img/productos/<?php echo $producto['imagen']; ?>" alt="" class="img-modal">
					<div class="texto">
						<h1><?php echo $producto['nombre']; ?></h1>
						<p><?php echo $producto['descripcion']; ?></p>
            <p><?php echo $producto['valorNutricional']; ?></p>
						<div class="botones">
              <a href="pedidos.php"><button class="btn-agregar">Comprar</button></a>
						</div>
					</div>
					<button class="btn-cerrar-ventana" onclick="cerrarModal(<?php echo $producto['id']; ?>)">X</button>
				</div> -->
			<?php } ?>

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
