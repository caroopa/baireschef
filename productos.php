<?php 
  include("config/db.php");

  $filtro = "0";
  if(isset($_POST["btn-filtro"])) {
    $filtro = $_POST["btn-filtro"];
  }
  
  if($filtro == "0") {
    $sentenciaSQL = $conexion -> prepare("SELECT * FROM productos");
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
      <form action="pagar.php" method="POST">
        <input type="hidden" name="total" id="caja-total" value="" >
        <input type="hidden" name="productos" id="caja-productos" value="">
        <button class="pagar">FINALIZAR COMPRA</button>
      </form>
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
              <i class="cart fa-solid fa-cart-shopping"></i>
              <span id="checkout"></span>
            </div>
          </div>
          <i class="fa-solid fa-bars barra"></i>
        </ul>
      </nav>

			<div class="productos-container">
				<div class="filtro">
					<p class="subrayado"><u>Recomendados</u></p>
          <form action="productos.php" method="POST">
            <button type="submit" name="btn-filtro" value="0" class="btn-filtro">Todo</button>
          </form>
					<form action="productos.php" method="POST">
            <button type="submit" name="btn-filtro" value="1" class="btn-filtro">Pasta</button>
          </form>
					<form action="productos.php" method="POST">
            <button type="submit" name="btn-filtro" value="2" class="btn-filtro">Carnes</button>
          </form>
					<form action="productos.php" method="POST">
            <button type="submit" name="btn-filtro" value="3" class="btn-filtro">Arroz</button>
          </form>
					<form action="productos.php" method="POST">
            <button type="submit" name="btn-filtro" value="4" class="btn-filtro">Guarnición</button>
          </form>
				</div>
				<div class="main separacion">
				<?php foreach($listaProductos as $producto) { ?>
            <div class="producto">
              <img src="img/<?php echo $producto["imagen"]; ?>" alt="" class="img-producto">
              <p><?php echo $producto['nombre']; ?></p> 
              <p class="italic">salsa a elección</p>
              <button class="btn-seleccionar" onclick="abrirModal(<?php echo $producto['id']; ?>)">Seleccionar</button> 
            </div>
				<?php } ?>
				</div>
			</div>

			<?php foreach($listaProductos as $producto) { ?>
				<div class="ventana-modal">
					<img src="img/<?php echo $producto['imagen']; ?>" alt="" class="img-modal">
					<div class="texto">
						<h1><?php echo $producto['nombre']; ?></h1>
						<p><?php echo $producto['descripcion']; ?></p>
						<div class="botones">
            <button type="button" class="btn-agregar"><?php echo $producto["precio"]; ?></button> 
						</div>
						<p>Seleccioná la guarnición que más te guste, tu elección.</p>
						<div class="botones">
            <select class="select-guarnicion">
              <?php foreach($listaGuarniciones as $guarnicion) { ?>
              <option value="<?php echo $guarnicion["nombre"]; ?>"><?php echo $guarnicion["nombre"]; ?></option>
              <?php } ?>
            </select>
							<button class="btn-agregar"
              onclick="add('<?php echo $producto['id']; ?>', '<?php echo $producto['nombre']; ?>', '<?php echo $producto['precio']; ?>', '<?php echo $producto['imagen']; ?>')">
              Agregar al carrito</button>
						</div>
					</div>
					<button class="btn-cerrar-ventana" onclick="cerrarModal(<?php echo $producto['id']; ?>)">X</button>
				</div>
			<?php } ?>
		</section>

		<script src="js/main.js"></script>
  </body>
</html>
